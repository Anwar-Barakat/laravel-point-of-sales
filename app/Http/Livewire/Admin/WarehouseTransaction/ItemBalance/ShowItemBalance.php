<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ItemBalance;

use App\Models\Item;
use App\Models\ItemBatch;
use Livewire\Component;
use Livewire\WithPagination;

class ShowItemBalance extends Component
{
    use WithPagination;

    public $created_at,
        $name,
        $store_id,
        $item_id,
        $order_by = 'name',
        $production_date,
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public $production_from_date,
        $production_to_date;

    public function mount()
    {
        $this->production_to_date = date('Y-m-d');
    }


    public function render()
    {
        return view('livewire.admin.warehouse-transaction.item-balance.show-item-balance', [
            'items' => $this->getItems()
        ]);
    }

    public function getItems()
    {
        return Item::whereHas(
            'item_batches',
            function ($query) {
                $query->when($this->store_id,               fn ($q) => $q->where('store_id', $this->store_id));
                $query->when($this->item_id,                fn ($q) => $q->where('item_id', $this->item_id));
                $query->when($this->production_from_date,   fn ($q) => $q->whereBetween('production_date', [$this->production_from_date, $this->production_to_date]));
            }
        )->with(['childUnit', 'parentUnit', 'item_batches'])->where(['company_id' => get_auth_com()])
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->when($this->item_id,              fn ($q) => $q->where('id', $this->item_id))
            ->paginate($this->per_page);
    }
}