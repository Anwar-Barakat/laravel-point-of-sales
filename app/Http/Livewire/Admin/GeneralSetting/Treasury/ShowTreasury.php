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
        $order_by   = 'last_payment_collect',
        $sort_by    = 'asc',
        $per_page   = PAGINATION_COUNT;

    public function render()
    {
        $treasuries = Treasury::search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
        return view('livewire.admin.general-setting.treasury.show-treasury', ['treasuries' => $treasuries]);
    }
}
