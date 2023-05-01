<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Shift;

use App\Models\Shift;
use Livewire\Component;
use Livewire\WithPagination;

class ShowShift extends Component
{
    use WithPagination;

    public $auth;
    public $admin_has_opened_shift = false;

    public function mount()
    {
        $this->auth = auth()->guard('admin')->user();
        $this->admin_has_opened_shift =
            Shift::where(['admin_id' => get_auth_id(), 'company_code' => get_auth_com(), 'is_finished' => 0])->exists()
            ? true
            : false;
    }

    public function render()
    {
        $shifts = Shift::with(['admin:id,name', 'treasury:id,name'])->latest()->paginate(CUSTOM_PAGINATION);
        return view('livewire.admin.warehouse-transaction.shift.show-shift', ['shifts' => $shifts]);
    }
}
