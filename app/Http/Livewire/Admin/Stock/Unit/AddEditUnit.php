<?php

namespace App\Http\Livewire\Admin\Stock\Unit;

use App\Models\OrderProduct;
use App\Models\SaleProduct;
use App\Models\Unit;
use Livewire\Component;

class AddEditUnit extends Component
{
    public Unit $unit;

    public $name_ar, $name_en;

    public function mount(Unit $unit)
    {
        $this->unit     = $unit;
        $this->name_ar  = $this->unit->getTranslation('name', 'ar');
        $this->name_en  = $this->unit->getTranslation('name', 'en');
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $orders_unit    = OrderProduct::where('unit_id', $this->unit->id)->count();
            $sales_unit     = SaleProduct::where('unit_id', $this->unit->id)->count();

            if ($orders_unit > 0 || $sales_unit > 0) {
                return redirect()->route('admin.units.index');
                toastr()->error(__('msgs.something_went_wrong'));
            }

            $this->unit->name       = [
                'ar'    => $this->name_ar,
                'en'    => $this->name_en,
            ];
            $this->unit->added_by   = get_auth_id();
            $this->unit->company_id = get_auth_com();
            $this->unit->save();
            toastr()->success(__('msgs.submitted', ['name' => __('stock.unit')]));
            return redirect()->route('admin.units.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.units.create')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.stock.unit.add-edit-unit');
    }

    public function rules(): array
    {
        return [
            'name_ar'           => ['required', 'min:3', 'string'],
            'name_en'           => ['required', 'min:3', 'string'],
            'unit.is_active'    => ['required', 'boolean'],
            'unit.status'       => ['required', 'in:retail,wholesale']
        ];
    }
}