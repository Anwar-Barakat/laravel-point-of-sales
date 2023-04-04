<?php

namespace App\Http\Livewire\Admin\Item;

use App\Models\Item;
use Livewire\Component;

class ShowItem extends Component
{
    public $items = [],
        $active;

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
        return view('livewire.admin.item.show-item');
    }

    public function getItems()
    {
        return $this->items = Item::with(['parentUnit:id,name', 'childUnit:id,name', 'category:id,name', 'addedBy:id,name', 'parentItem:id,name'])
            ->get();
    }
}
