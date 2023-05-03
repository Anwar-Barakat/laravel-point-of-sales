<?php

namespace App\Http\Livewire\Admin\Stock\Delegate;

use App\Models\Delegate;
use Livewire\Component;
use Livewire\WithPagination;

class ShowDelegate extends Component
{
    use WithPagination;

    public $name,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;

    public function updateStatus($id)
    {
        $delegate    = Delegate::findOrFail($id);
        $delegate->update(['is_active' => !$delegate->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.stock.delegate.show-delegate', ['delegates' => $this->getDelegates()]);
    }

    public function getDelegates()
    {
        return  Delegate::with(['account'])
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);;
    }
}