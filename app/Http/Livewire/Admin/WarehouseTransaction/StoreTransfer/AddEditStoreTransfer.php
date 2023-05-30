<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\StoreTransfer;

use App\Models\Store;
use App\Models\StoreTransfer;
use Livewire\Component;

class AddEditStoreTransfer extends Component
{
    public StoreTransfer $transfer;

    public $stores = [];

    public function mount(StoreTransfer $transfer)
    {
        $this->transfer                 = $transfer;
        $this->transfer->transfer_date  = date('Y-m-d');
        $this->stores                   = $this->transfer->is_approved == 0 ? Store::active()->get() : [];
    }

    public function updatedTransferToStore($value)
    {
        if ($this->transfer->store_id == $value) {
            $this->transfer->to_store = '';
            toastr()->error(__('transaction.select_another_store'));
        }
    }

    public function submit()
    {
        $this->validate();
        try {
            $transferExists = StoreTransfer::where(['store_id' => $this->transfer->store_id, 'to_store' => $this->transfer->to_store, 'is_approved' => 0])->first();
            if ($transferExists) {
                toastr()->error(__('transaction.already_previous_transfer_order'));
                return false;
            }

            $this->transfer->added_by        = get_auth_id();
            $this->transfer->company_id      = get_auth_com();
            $this->transfer->save();

            toastr()->success(__('msgs.submitted', ['name' => __('transaction.store_transfer')]));
            return redirect()->route('admin.store-transfers.show', ['store_transfer' => $this->transfer]);
        } catch (\Throwable $th) {
            return redirect()->route('admin.store-transfers.index')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.store-transfer.add-edit-store-transfer');
    }

    public function rules()
    {
        return [
            'transfer.transfer_date'    => ['required', 'date'],
            'transfer.store_id'       => ['required', 'integer'],
            'transfer.to_store'         => ['required', 'integer'],
            'transfer.notes'            => ['required', 'min:10', 'max:255'],
        ];
    }
}
