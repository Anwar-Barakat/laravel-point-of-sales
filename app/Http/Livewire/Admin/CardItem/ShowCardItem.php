<?php

namespace App\Http\Livewire\Admin\CardItem;

use App\Models\CardItem;
use Livewire\Component;

class ShowCardItem extends Component
{
    public $cardItems = [];

    public function mount()
    {
        $this->cardItems = CardItem::with(['parentUnit:id,name', 'childUnit:id,name', 'category:id,name', 'addedBy:id,name', 'parentItem:id,name'])
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.card-item.show-card-item');
    }
}
