<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Sale;

use App\Models\Customer;
use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\Store;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class SaleDetail extends Component
{
    use WithPagination;

    public Sale $sale;
    public SaleProduct $product;

    public $customers   = [],
        $stores         = [],
        $items          = [];
    public $batches, $unit, $item;

    public $sale_type;

    protected $listeners = ['updateSaleProducts'];

    public function updateSaleProducts(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function mount(Sale $sale, SaleProduct $product, $sale_type)
    {
        $this->sale                 = $sale;
        $this->sale_type            = $sale_type;
        $this->product              = $product;
        $this->product->sale_type   = $this->sale->invoice_sale_type;
        $this->product->qty         = 1;
        $this->customers            = Customer::active()->where('company_id', get_auth_com())->get();
        $this->stores               = Store::active()->where('company_id', get_auth_com())->get();
        $this->items                = Item::active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function updatedProductStoreId()
    {
        if ($this->product->item_id && $this->product->unit_id)
            $this->batches  = getBatches($this->product);
    }

    public function updatedProductItemId()
    {
        $this->item = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        if ($this->product->item_id && $this->product->unit_id)
            $this->batches  = getBatches($this->product);

        if ($this->item->type && $this->unit)
            $this->product->unit_price = $this->getUnitPrice();
    }

    public function updatedProductUnitId()
    {
        $this->getItemAndUnit();
        $this->batches  = getBatches($this->product);

        if ($this->product->item_id && $this->product->sale_type)
            $this->product->unit_price = $this->getUnitPrice();

        $this->product->total_price = intval($this->product->qty) * floatval($this->product->unit_price);
    }

    public function calcPrice()
    {
        $batch = ItemBatch::find($this->product->item_batch_id);
        if (!$batch) {
            toastr()->error(__('validation.select_item_batch'));
            $this->product->qty = 1;
        }

        if (isset($batch->qty)) {
            $batchQty = $this->unit->status == 'wholesale' ? $batch->qty : $batch->qty * $this->item->retail_count_for_wholesale;

            if ($this->product->qty > $batchQty) {
                toastr()->error(__('validation.qty_not_available_now'));
                $this->product->qty = 1;
            }
        }
        if ($this->product->qty && $this->product->unit_price)
            $this->product->total_price = intval($this->product->qty) * floatval($this->product->unit_price);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->product->sale_type   = $this->sale->invoice_sale_type;
            if (!$this->product->is_approved == 0) {
                toastr()->error(__('transaction.already_approved'));
                return redirect()->back();
            }

            if ($this->sale->type == 1) {
                $batch = ItemBatch::select('qty')->find($this->product->item_batch_id);
                if ($batch->qty < $this->product->qty) {
                    toastr()->error(__('validation.qty_not_available_now'));
                    $this->product->qty = 1;
                    return false;
                }
            }

            DB::beginTransaction();

            $this->product->fill([
                'type'          => $this->sale_type,
                'sale_id'       => $this->sale->id,
                'added_by'      => get_auth_id(),
                'company_id'    => get_auth_com(),
            ])->save();

            $totalPrices = SaleProduct::where('sale_id', $this->sale->id)->where('company_id', get_auth_com())->sum('total_price');
            $this->sale->fill([
                'items_cost'            => $totalPrices,
                'cost_before_discount'  => $totalPrices,
                'cost_after_discount'   => $totalPrices,
            ])->save();

            DB::commit();
            toastr()->success(__('msgs.added', ['name' => __('stock.item')]));
            $this->emit('updateSaleProducts', ['sale' => $this->sale]);
            $this->reset('product');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.sales.show', $this->sale)->with(['error' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $product                = SaleProduct::with('item')->findOrFail($id);
        $this->product          = $product;
        $this->getItemAndUnit();
        $this->batches          = getBatches($this->product);
    }

    public function delete($id)
    {
        $this->sale->saleProducts()->findOrFail($id)->delete();
        $totalPrices = SaleProduct::where('sale_id', $this->sale->id)->where('company_id', get_auth_com())->sum('total_price');
        $this->sale->fill([
            'items_cost'            => $totalPrices,
            'cost_before_discount'  => $totalPrices,
            'cost_after_discount'   => $totalPrices,
        ])->save();

        $this->emit('updateSaleProducts', ['sale' => $this->sale]);
        toastr()->info(__('msgs.deleted', ['name' => __('stock.items')]));
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.sale.sale-detail', ['sale' => $this->sale, 'sale_products' => $this->getSaleProducts()]);
    }

    public function rules(): array
    {
        return [
            'product.store_id'         => ['required', 'integer'],
            'product.sale_type'        => ['required', 'in:1,2,3'],
            'product.store_id'         => ['required', 'integer'],
            'product.unit_id'          => ['required', 'integer'],
            'product.item_id'          => [
                'required',
                'integer',
                Rule::unique('sale_products', 'item_id')->where(function ($query) {
                    return $query->where(['sale_id' => $this->sale->id, 'unit_id' => $this->product->unit_id, 'company_id' => get_auth_com()]);
                })->ignore($this->product->id)
            ],
            'product.item_batch_id'    => ['required', 'integer'],
            'product.unit_price'       => ['required', 'numeric', 'min:1'],
            'product.qty'              => ['required', 'integer', 'min:1'],
            'product.total_price'      => ['required', 'numeric', 'min:1'],
        ];
    }

    public function getUnitPrice()
    {
        $prices = [
            $this->item->retail_price,
            $this->item->retail_price_for_half_block,
            $this->item->retail_price_for_block,
            $this->item->wholesale_price,
            $this->item->wholesale_price_for_half_block,
            $this->item->wholesale_price_for_block,
        ];

        $index = $this->unit->status == 'wholesale'
            ? $this->product->sale_type + 2
            : $this->product->sale_type - 1;

        return $prices[$index];
    }

    public function getSaleProducts()
    {
        return SaleProduct::where('sale_id', $this->sale->id)
            ->where('company_id', get_auth_com())->paginate(CUSTOM_PAGINATION - 5);
    }

    public function getItemAndUnit()
    {
        $this->item = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->unit = Unit::select('id', 'name', 'status')->findOrFail($this->product->unit_id);
    }
}
