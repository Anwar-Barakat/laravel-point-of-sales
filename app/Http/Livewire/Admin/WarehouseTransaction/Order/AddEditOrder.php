<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Order;

use App\Models\Order;
use App\Models\Store;
use App\Models\Vendor;
use Livewire\Component;

class AddEditOrder extends Component
{
    public Order $order;

    public $vendors = [],
        $stores = [];
    public $order_type;

    public function mount(Order $order, $order_type)
    {
        $this->order                = $order;
        $this->order_type           = $order_type;
        $this->order->invoice_date  = date('Y-m-d');
        $this->vendors              = Vendor::active()->where('company_id', get_auth_com())->get();
        $this->stores               = Store::active()->where('company_id', get_auth_com())->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->order->type            = $this->order_type;
            $this->order->account_id      = $this->order->vendor->account->id;
            $this->order->added_by        = get_auth_id();
            $this->order->company_id      = get_auth_com();

            $this->order->save();

            if ($this->order->type == 1) {
                $name   = __('transaction.purchase_bill');
                $route  = route('admin.orders.show', ['order' => $this->order]);
            } elseif ($this->order->type == 3) {
                $name = __('transaction.general_order_return');
                $route  = route('admin.general-order-returns.show', ['general_order_return' => $this->order]);
            }

            toastr()->success(__('msgs.submitted', ['name' => $name]));
            return redirect()->to($route);
        } catch (\Throwable $th) {
            return redirect()->route('admin.orders.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.order.add-edit-order');
    }

    public function rules(): array
    {
        return [
            'order.vendor_id'       => ['required', 'integer'],
            'order.store_id'        => ['required', 'integer'],
            'order.invoice_type'    => ['required', 'boolean'],
            'order.invoice_date'    => ['required', 'date'],
            'order.notes'           => ['required', 'min:10'],
        ];
    }
}
