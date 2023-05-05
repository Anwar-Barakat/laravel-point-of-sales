<?php

namespace App\Http\Livewire\Admin\Stock\Item;

use App\Models\Item;
use App\Models\ItemTransaction;
use Livewire\Component;

class ItemDetail extends Component
{
    public Item $item;

    public $item_transaction_type_id,
        $item_transaction_category_id,
        $store_id,
        $admin_id,
        $order_by = 'created_at',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public function mount(Item $item)
    {
        $this->item->load(['category:id,name', 'parentUnit:id,name', 'childUnit:id,name', 'addedBy:id,name', 'parentItem:id,name']);
    }
    public function render()
    {
        return view('livewire.admin.stock.item.item-detail', ['transactions' => $this->getTransactions()]);
    }

    public function getTransactions()
    {
        return  ItemTransaction::with(['transaction_type:id,name', 'transaction_category:id,name', 'unit:id,name', 'store:id,name', 'admin:id,name'])
            ->where(['company_id' => get_auth_com(), 'item_id' => $this->item->id])
            ->when($this->item_transaction_type_id,     fn ($q) => $q->where('item_transaction_type_id', $this->item_transaction_type_id))
            ->when($this->item_transaction_category_id, fn ($q) => $q->where('item_transaction_category_id', $this->item_transaction_category_id))
            ->when($this->store_id,                     fn ($q) => $q->where('store_id', $this->store_id))
            // ->when($this->invoices_from_date,   fn ($q) => $q->whereBetween('invoice_date', [$this->invoices_from_date, $this->invoices_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
