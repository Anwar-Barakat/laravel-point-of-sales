<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ProductionLine;

use App\Models\ProductionLine;
use Livewire\Component;

class AddEditProductionLine extends Component
{
    public  $production_line;

    public function mount(ProductionLine $production_line)
    {
        $this->production_line              = $production_line ?? new ProductionLine();
        $this->production_line->plan_date   = date('Y-m-d');
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->production_line->added_by    = get_auth_id();
            $this->production_line->company_id  = get_auth_com();
            $this->production_line->save();
            toastr()->success(__('msgs.submitted', ['name' => __('transaction.production_line')]));
            $this->reset('production_line');
        } catch (\Throwable $th) {
            return redirect()->route('admin.production-lines.index')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.production-line.add-edit-production-line');
    }

    public function rules()
    {
        return [
            'production_line.plan_date'     => ['required', 'date'],
            'production_line.plan'          => ['required', 'min:10', 'max:255'],
        ];
    }
}
