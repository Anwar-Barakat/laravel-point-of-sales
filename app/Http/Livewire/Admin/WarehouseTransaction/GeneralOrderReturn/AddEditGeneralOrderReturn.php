<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\GeneralOrderReturn;

use App\Models\Order;
use App\Models\Store;
use App\Models\Vendor;
use Livewire\Component;

class AddEditGeneralOrderReturn extends Component
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

    public function submit()
    {
        $this->validate();
        try {
            if (!$this->order_type === 3) {
                toastr()->error(__('msgs.something_went_wrong'));
                return redirect()->back();
            }

            $this->order['type']            = 3; // general order return
            $this->order['account_id']      = $this->order->vendor->account->id;
            $this->order['added_by']        = get_auth_id();
            $this->order['company_id']      = get_auth_com();

            $this->order->save();
            toastr()->success(__('msgs.submitted', ['name' => __('transaction.general_order_return')]));
            return redirect()->route('admin.general-order-returns.index', ['order' => $this->order]);
        } catch (\Throwable $th) {
            return redirect()->route('admin.general-order-returns.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.general-order-return.add-edit-general-order-return');
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
