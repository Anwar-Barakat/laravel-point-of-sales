<?php

namespace App\Http\Livewire\Admin\Stock\StoreInventory;

use App\Models\Store;
use App\Models\StoreInventory;
use Livewire\Component;
use Livewire\WithPagination;

class ShowStoreInventory extends Component
{
    use WithPagination;

    public $inventory_type,
        $store_id,
        $order_by = 'created_at',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public $inventory_from_date,
        $inventory_to_date;

    public $stores;

    public function mount()
    {
        $this->inventory_to_date = date('Y-m-d');
        $this->stores           = Store::active()->get();
    }

    public function render()
    {
        return view('livewire.admin.stock.store-inventory.show-store-inventory', ['inventories' => $this->getStoresInventories()]);
    }

    public function getStoresInventories()
    {

        return  StoreInventory::with(['store:id,name', 'addedBy:id,name'])
            ->where(['company_id' => get_auth_com()])
            ->when($this->inventory_type,       fn ($q) => $q->where('inventory_type', $this->inventory_type))
            ->when($this->store_id,             fn ($q) => $q->where('store_id', $this->store_id))
            ->when($this->inventory_from_date,  fn ($q) => $q->whereBetween('inventory_date', [$this->inventory_from_date, $this->inventory_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
