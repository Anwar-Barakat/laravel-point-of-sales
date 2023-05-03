<?php

namespace App\Http\Livewire\Admin\Stock\Item;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ShowItem extends Component
{
    use WithPagination;

    public $name,
        $type,
        $category_id,
        $order_by   = 'name',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;


    public  $active;

    public function mount()
    {
        $this->getItems();
    }

    public function updateStatus($id)
    {
        $item            = Item::findOrFail($id);
        $item->update(['is_active' => !$item->is_active]);
        $this->getItems();
    }

    public function render()
    {
        return view('livewire.admin.stock.item.show-item', ['items' => $this->getItems()]);
    }

    public function getItems()
    {
        return Item::with(['parentUnit:id,name', 'childUnit:id,name', 'category:id,name', 'addedBy:id,name', 'parentItem:id,name'])
            ->search(trim($this->name))
            ->when($this->category_id, fn ($q) => $q->where('category_id', $this->category_id))
            ->when($this->type, fn ($q) => $q->where('type', $this->type))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}