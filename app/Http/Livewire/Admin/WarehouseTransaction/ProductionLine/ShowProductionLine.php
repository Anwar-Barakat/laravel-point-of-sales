<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ProductionLine;

use App\Models\ProductionLine;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProductionLine extends Component
{
    use WithPagination;

    public
        $is_closed,
        $order_by = 'created_at',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public $production_from_date,
        $production_to_date;

    public function mount()
    {
        $this->production_from_date = date('Y-m-d');
    }

    public function updateStatus(ProductionLine $production_line)
    {
        if ($production_line->is_closed == 0)
            $production_line->update(['is_closed' => !$production_line->is_clsoed]);
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.production-line.show-production-line', ['production_lines' => $this->getProductionLines()]);
    }

    public function getProductionLines()
    {

        return  ProductionLine::where(['company_id' => get_auth_com()])
            ->when($this->is_closed,            fn ($q) => $q->where('is_closed', $this->is_closed))
            ->when($this->production_to_date,  fn ($q) => $q->whereBetween('plan_date', [$this->production_from_date, $this->production_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
