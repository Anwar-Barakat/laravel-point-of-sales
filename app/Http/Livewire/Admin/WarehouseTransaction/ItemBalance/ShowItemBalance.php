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
        $vendor_id,
        $store_id,
        $order_by = 'wholesale_qty',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.item-balance.show-item-balance', ['items' => $this->getItems()]);
    }

    public function getItems()
    {
        return Item::with(['childUnit', 'parentUnit', 'item_batches'])->where(['company_id' => get_auth_com()])
            ->search(trim($this->name))
            // ->when($this->vendor_id,            fn ($q) => $q->where('vendor_id', $this->vendor_id))
            // ->when($this->store_id,             fn ($q) => $q->where('store_id', $this->store_id))
            // ->when($this->invoices_from_date,   fn ($q) => $q->whereBetween('invoice_date', [$this->invoices_from_date, $this->invoices_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
        // ->get();
    }
}
