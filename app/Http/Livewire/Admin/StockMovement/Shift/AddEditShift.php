<?php

namespace App\Http\Livewire\Admin\StockMovement\Shift;

use App\Models\Shift;
use App\Models\Treasury;
use Livewire\Component;

class AddEditShift extends Component
{
    public Shift $shift;

    public $treasuries = [];

    public function mount(Shift $shift)
    {
        $this->shift        = $shift;
        $this->treasuries   = Treasury::where(['admin_id' => app('auth_id'), 'company_code' => app('auth_com')])->active()->get();
    }

    public function submit()
    {
        $this->validate();
        try {
            $shiftOpened = Shift::where(['admin_id' => app('auth_id'), 'company_code' => app('auth_com'), 'is_finished' => 0])->exists();
            if ($shiftOpened) {
                toastr()->error(__('movement.you_have_opened_shift'));
                return redirect()->route('admin.shifts.create');
            }

            $treasuryOpened = Shift::where(['treasury_id' => $this->shift->treasury_id, 'company_code' => app('auth_com'), 'is_finished' => 0])->exists();
            if ($treasuryOpened) {
                toastr()->error(__('movement.treasury_opened'));
                return redirect()->route('admin.shifts.create');
            }

            $this->shift->admin_id      = app('auth_id');
            $this->shift->company_code  = app('auth_com');

            $this->shift->save();
            toastr()->success(__('msgs.added', ['name' => __('movement.treasury_shifts')]));
            return redirect()->route('admin.shifts.index');
        } catch (\Throwable $th) {
            // return redirect()->back()->with(['error' => $th->getMessage()]);
            return redirect()->route('admin.shifts.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock-movement.shift.add-edit-shift');
    }

    public function rules(): array
    {
        return [
            'shift.treasury_id'     => ['required', 'integer']
        ];
    }
}