<?php

namespace App\Http\Livewire\Admin\StockMovement\Order;

use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddEditOrder extends Component
{
    public Order $order;
    public $auth;

    public $vendors = [];

    public function mount(Order $order)
    {
        $this->auth     = Auth::guard('admin')->user();
        $this->order    = $order;
        $this->order['invoice_date']  = date('Y-m-d');
        $this->vendors  = Vendor::active()->where('company_code', $this->auth->company_code)->get();
    }

    // public function updated($fields)
    // {
    //     return $this->validateOnly($fields);
    // }

    public function submit()
    {
        $this->validate();
        try {
            $this->order['type']            = 1; // purchase
            $this->order['account_id']      = $this->order->vendor->account->id;
            $this->order['added_by']        = $this->auth->id;
            $this->order['company_code']    = $this->auth->company_code;

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
            'order.invoice_type'    => ['required', 'boolean'],
            'order.invoice_date'    => ['required', 'date'],
            'order.notes'           => ['required', 'min:10'],
        ];
    }
}
