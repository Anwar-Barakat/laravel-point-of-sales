<?php

namespace App\Http\Livewire\Admin\GeneralSetting\Treasury;

use App\Models\Admin;
use App\Models\Treasury;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTreasury extends Component
{
    use WithPagination;

    public $name,
        $added_by,
        $order_by   = 'last_payment_collect',
        $sort_by    = 'asc',
        $per_page   = PAGINATION_COUNT;

    public function render()
    {
        $treasuries = Treasury::with(['addedBy:id,name', 'updatedBy:id,name'])
            ->when($this->added_by, fn ($q) => $q->where('added_by', $this->added_by))
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
        return view('livewire.admin.general-setting.treasury.show-treasury', ['treasuries' => $treasuries]);
    }
}