<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Order;
use App\Models\Store;
use App\Models\Vendor;
use Livewire\Component;

class AddEditOrder extends Component
{
    public Order $order;

    public $vendors = [],
        $stores = [];

    public function mount(Order $order)
    {
        $this->order    = $order;
        $this->order['invoice_date']  = date('Y-m-d');
        $this->vendors  = Vendor::active()->where('company_code', get_auth_com())->get();
        $this->stores   = Store::active()->where('company_code', get_auth_com())->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->order['type']            = 1; // purchase
            $this->order['account_id']      = $this->order->vendor->account->id;
            $this->order['added_by']        = get_auth_id();
            $this->order['company_code']    = get_auth_com();

            $this->order->save();
            toastr()->success(__('msgs.submitted', ['name' => __('movement.order')]));
            return redirect()->route('admin.orders.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.orders.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.order.add-edit-order');
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
