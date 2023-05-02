<?php

namespace App\Http\Livewire\Admin\Setting\Treasury;

use App\Models\Admin;
use App\Models\Treasury;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTreasury extends Component
{
    use WithPagination;

    public $name,
        $order_by   = 'last_payment_collect',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus($id)
    {
        $treasury    = Treasury::findOrFail($id);
        $treasury->update(['is_active' => !$treasury->is_active]);
    }

    public function render()
    {

        return view('livewire.admin.setting.treasury.show-treasury', ['treasuries' => $this->getTreasuries()]);
    }

    public function getTreasuries()
    {
        return Treasury::search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
