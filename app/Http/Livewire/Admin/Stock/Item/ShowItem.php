<?php

namespace App\Http\Livewire\Admin\Stock\Item;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ShowItem extends Component
{
    use WithPagination;

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
        $items = $this->getItems();
        return view('livewire.admin.stock.item.show-item', ['items' => $items]);
    }

    public function getItems()
    {
        return Item::with(['parentUnit:id,name', 'childUnit:id,name', 'category:id,name', 'addedBy:id,name', 'parentItem:id,name'])
            ->paginate(PAGINATION_COUNT);
    }
}
