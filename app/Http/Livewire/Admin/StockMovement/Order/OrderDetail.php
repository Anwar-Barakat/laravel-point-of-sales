<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetail extends Component
{
    use WithPagination;

    public Order $order;

    public $items = [];
    public $item_id = null,
        $unit_id = '';
    public $wholesale_unit = null,
        $retail_unit = null,
        $qty = 1,
        $unit_price = '',
        $total_price = 1;

    public $consuming = false,
        $production_date = null,
        $expiration_date = null;


    public function mount(Order $order)
    {
        $this->order = $order;
        $this->order->is_approved == 0 ?  $this->items = Item::select('id', 'name')->active()->get() : [];
    }

    public function calcPrice()
    {
        $this->total_price = (int)$this->qty * (float)$this->unit_price;
    }

    public function updatedItemId()
    {
        $item                   = Item::with(['parentUnit', 'childUnit'])->findOrFail($this->item_id);
        $this->consuming        = $item->type == 2 ? true : false;
        $this->wholesale_unit   = $item->parentUnit;
        $this->retail_unit      = $item->childUnit ?? null;
    }

    public function submit()
    {
        try {
            if ($this->order->is_approved == 0) {
                OrderProduct::create([
                    'order_id'          => $this->order->id,
                    'unit_id'           => $this->unit_id,
                    'item_id'           => $this->item_id,
                    'unit_price'        => $this->unit_price,
                    'qty'               => $this->qty,
                    'production_date'   => $this->production_date,
                    'expiration_date'   => $this->expiration_date,
                    'total_cost'        => $this->total_price,
                    'added_by'          => Auth::guard('admin')->id(),
                    'company_code'      => Auth::guard('admin')->user()->company_code,
                ]);
            }
            toastr()->success(__('msgs.added', ['name' => __('stock.item')]));
            $this->resetExcept('order', 'items');
        } catch (\Throwable $th) {
            return redirect()->route('admin.orders.show', $this->order)->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.order.order-detail');
    }

    public function rules(): array
    {
        return [
            'item_id'           => ['required'],
            'unit_id'           => ['required'],
            'unit_price'        => ['required', 'integer'],
            'qty'               => ['required', 'integer'],
            'production_date'   => ['required_if:','date'],
            'expiration_date'   => ['date', 'after:production_date'],
            'total_price'       => ['required'],
        ];
    }
}