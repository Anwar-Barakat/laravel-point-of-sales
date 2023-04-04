<?php

namespace App\Http\Livewire\Admin\Item;

use App\Models\Item;
use Livewire\Component;

class ShowItem extends Component
{
    public $items = [];

    public function mount()
    {
        $this->items = Item::with(['parentUnit:id,name', 'childUnit:id,name', 'category:id,name', 'addedBy:id,name', 'parentItem:id,name'])
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.item.show-item');
    }
}
