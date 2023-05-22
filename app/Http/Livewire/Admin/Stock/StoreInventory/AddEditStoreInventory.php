<?php

namespace App\Http\Livewire\Admin\Stock\StoreInventory;

use App\Models\Store;
use App\Models\StoreInventory;
use Livewire\Component;

class AddEditStoreInventory extends Component
{
    public StoreInventory $inventory;

    public $stores    = [],
        $accounts       = [];

    public function mount(StoreInventory $inventory)
    {
        $this->inventory                    = $inventory;
        $this->inventory->inventory_date    = date('Y-m-d');
        $this->stores                       = Store::select('id', 'name')->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function render()
    {
        return view('livewire.admin.stock.store-inventory.add-edit-store-inventory');
    }

    public function rules(): array
    {
        return [
            'inventory.inventory_date'  => ['required', 'date'],
            'inventory.inventory_type'  => ['required', 'in:1,2,3,4'],
            'inventory.store_id'        => ['required', 'integer'],
            'inventory.notes'           => ['required', 'min:10'],
        ];
    }
}
