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
        $order_by = 'wholesale_qty',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.item-balance.show-item-balance', [
            'items' => $this->getItems()
        ]);
    }

    public function getItems()
    {
        return Item::with([
            'childUnit', 'parentUnit', 'item_batches' => function ($query) {
                return $query->when($this->store_id,             fn ($q) => $q->where('store_id', $this->store_id));
            }

        ])->where(['company_id' => get_auth_com()])
            ->search(trim($this->name))
            ->orderBy($this->order_by, $this->sort_by)
            ->when($this->item_id,              fn ($q) => $q->where('id', $this->item_id))
            ->paginate($this->per_page);
    }
}