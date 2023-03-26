<?php

namespace App\Http\Livewire\Admin\TreasuryDelivery;

use App\Models\Treasury;
use App\Models\TreasuryDelivery;
use Livewire\Component;

class ShowTreasuryDelivery extends Component
{
    public $treasuries, $treasury;

    public $treasury_delivery_id;

    public function mount()
    {
        $this->treasuries = Treasury::select('id', 'name')->active()->get();
    }

    public function store()
    {
        $this->validate([
            'treasury_delivery_id'  => ['required', 'integer']
        ]);

        $comCode = auth()->guard('admin')->user()->company_code;

        if (TreasuryDelivery::where(['treasury_id' => $this->treasury->id, 'treasury_delivery_id' => $this->treasury_delivery_id, 'company_code' => $comCode])->exists()) {
            toastr()->error(__('msgs.exists', ['name' => __('treasury.treasury')]));
            return false;
        }

        TreasuryDelivery::create([
            'treasury_id'           => $this->treasury->id,
            'treasury_delivery_id'  => $this->treasury_delivery_id,
            'company_code'          => $comCode,
            'added_by'              => auth()->guard('admin')->id()
        ]);

        toastr()->success(__('msgs.created', ['name' => __('treasury.treasury_delivery')]));
        $this->reset(['treasury_delivery_id']);
    }

    public function delete($id)
    {
        $treasury = TreasuryDelivery::findOrFail($id);
        $treasury->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('treasury.treasury_delivery')]));
    }

    public function render()
    {
        return view('livewire.admin.treasury-delivery.show-treasury-delivery');
    }
}
