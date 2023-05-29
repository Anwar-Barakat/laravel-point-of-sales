<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\StoreTransfer;

use App\Models\StoreTransfer;
use Livewire\Component;
use Livewire\WithPagination;

class ShowStoreTransfer extends Component
{
    use WithPagination;

    public
        $from_store,
        $to_store,
        $is_approved,
        $order_by   = 'transfer_date',
        $sort_by    = 'asc',
        $per_page   = CUSTOM_PAGINATION;

    public $transfer_from_date,
        $transfer_to_date;

    public function mount()
    {
        $this->transfer_from_date = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.store-transfer.show-store-transfer', ['store_transfers' => $this->getStoreTransfers()]);
    }

    public function getStoreTransfers()
    {
        return  StoreTransfer::when($this->from_store, fn ($q) => $q->where('from_store', $this->from_store))
            ->when($this->to_store, fn ($q) => $q->where('to_store', $this->to_store))
            ->when($this->is_approved, fn ($q) => $q->where('is_approved', $this->is_approved))
            ->when($this->transfer_to_date, fn ($q) => $q->whereBetween('transfer_date', [$this->transfer_from_date, $this->transfer_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
