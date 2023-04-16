<?php

namespace App\Http\Livewire\Admin\StockMovement\Shift;

use App\Models\Shift;
use App\Models\Treasury;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddEditShift extends Component
{
    public Shift $shift;

    public $auth,
        $treasuries = [];

    public function mount(Shift $shift)
    {
        $this->shift        = $shift;
        $this->auth         = Auth::guard('admin')->user();
        $this->treasuries   = Treasury::where(['admin_id' => $this->auth->id, 'company_code' => $this->auth->company_code])->active()->get();
    }

    public function submit()
    {
        $this->validate();
        try {
            $shiftOpened = Shift::where(['admin_id' => $this->auth->id, 'company_code' => $this->auth->company_code, 'is_finished' => 0])->exists();
            if ($shiftOpened) {
                toastr()->error(__('movement.shift_opened'));
                return redirect()->route('admin.shifts.create');
            }

            $treasuryOpened = Shift::where(['treasury_id' => $this->shift->treasury_id, 'company_code' => $this->auth->company_code, 'is_finished' => 0])->exists();
            if ($treasuryOpened) {
                toastr()->error(__('movement.treasury_opened'));
                return redirect()->route('admin.shifts.create');
            }

            $this->shift->admin_id      = $this->auth->id;
            $this->shift->company_code  = $this->auth->company_code;

            $this->shift->save();
            toastr()->success(__('msgs.added', ['name' => __('movement.treasury_shifts')]));
            return redirect()->route('admin.shifts.create');
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
            'shift.treasury_id'     => [
                'required',
                // 'min:3',
                // Rule::unique('shifts', 'treasury_id')->ignore($this->shift->id)->where(function ($query) {
                //     return $query->where('company_code', $this->auth->company_code);
                // })
            ]
        ];
    }
}
