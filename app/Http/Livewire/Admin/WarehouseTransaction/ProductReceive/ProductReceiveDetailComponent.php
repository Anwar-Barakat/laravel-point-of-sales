<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ProductReceive;

use App\Models\Item;
use App\Models\ProductReceive;
use App\Models\ProductReceiveDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReceiveDetailComponent extends Component
{
    use WithPagination;

    public ProductReceive $invoice;
    public $product;

    public $items = [], $item;
    public $products = [];

    protected $listeners = ['updateProductsReceiveDetail'];

    public function updateProductsReceiveDetail(ProductReceive $invoice)
    {
        $this->invoice = $invoice;
    }

    public function mount(ProductReceive $invoice, ProductReceiveDetail $product)
    {
        $this->invoice                  = $invoice;
        $this->product                  = $product ?? new ProductReceiveDetail();
        $this->invoice->invoice_date    = date('Y-m-d');
        $this->product->qty             = 1;
        $this->invoice->is_approved     == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
    }

    public function calcPrice()
    {
        $this->product->total_price = (int)$this->product->qty * (float)$this->product->unit_price;
    }

    public function updatedProductItemId()
    {
        $this->item             = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            if ($this->invoice->is_approved == 0) {
                DB::beginTransaction();

                $this->product->fill([
                    'product_receive_id'    => $this->invoice->id,
                    'added_by'              => get_auth_id(),
                    'company_id'            => get_auth_com(),
                ])->save();
                $totalPrices = ProductReceiveDetail::where('product_receive_id', $this->invoice->id)->where('company_id', get_auth_com())->sum('total_price');
                $this->invoice->fill([
                    'items_cost'            => $totalPrices,
                    'cost_before_discount'  => $totalPrices,
                    'cost_after_discount'   => $totalPrices,
                ])->save();

                DB::commit();
                $this->emit('updateProductsReceiveDetail', ['invoice' => $this->invoice]);
                toastr()->success(__('msgs.added', ['name' => __('stock.item')]));
                $this->reset('product');
                $this->product =  ProductReceiveDetail::make();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function edit(ProductReceiveDetail $product)
    {
        $this->product          = $product;
        $this->item             = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->product->item_id);
        $this->emit('updateProductsReceiveDetail', ['invoice' => $this->invoice]);
    }

    public function delete(ProductReceiveDetail $product)
    {
        $product->delete();
        $totalPrices = ProductReceiveDetail::where('product_receive_id', $this->invoice->id)->where('company_id', get_auth_com())->sum('total_price');
        $this->invoice->fill([
            'items_cost'            => $totalPrices,
            'cost_before_discount'  => $totalPrices,
            'cost_after_discount'   => $totalPrices,
        ])->save();

        $this->emit('updateProductsReceiveDetail', ['invoice' => $this->invoice]);
        toastr()->info(__('msgs.deleted', ['name' => __('stock.item')]));
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.product-receive.product-receive-detail-component', ['productsReceiveDetail' => $this->getProductsReceiveDetail()]);
    }

    public function rules(): array
    {
        return [
            'product.item_id'           => [
                'required',
                Rule::unique('product_receive_details', 'item_id')->where(function ($query) {
                    return $query->where('company_id', get_auth_com())
                        ->where('unit_id', $this->product->unit_id)
                        ->where('product_receive_id', $this->invoice->id);
                })->ignore($this->product->id)
            ],
            'product.unit_id'           => ['required', 'integer'],
            'product.unit_price'        => ['required', 'between:0,9999'],
            'product.qty'               => ['required', 'integer'],
            'product.production_date'   => ['date', 'nullable'],
            'product.expiration_date'   => ['date', 'nullable'],
            'product.total_price'       => ['required'],
        ];
    }

    public function getProductsReceiveDetail()
    {
        return ProductReceiveDetail::where('product_receive_id', $this->invoice->id)
            ->where('company_id', get_auth_com())->paginate(CUSTOM_PAGINATION - 5);
    }
}
