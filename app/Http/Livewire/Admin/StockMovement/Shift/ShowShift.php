<?php

namespace App\Http\Livewire\Admin\StockMovement\Shift;

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
            Shift::where(['admin_id' => $this->auth->id, 'company_code' => $this->auth->company_code, 'is_finished' => 0])->exists()
            ? true
            : false;
    }

    public function render()
    {
        $shifts = Shift::with(['admin:id,name', 'treasury:id,name'])->latest()->paginate(CUSTOM_PAGINATION);
        return view('livewire.admin.stock-movement.shift.show-shift', ['shifts' => $shifts]);
    }
}
