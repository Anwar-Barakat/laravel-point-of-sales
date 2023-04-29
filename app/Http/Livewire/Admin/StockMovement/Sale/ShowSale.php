<?php

namespace App\Http\Livewire\Admin\StockMovement\Sale;

use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;

class ShowSale extends Component
{
    use WithPagination;

    public $created_at,
        $customer_id,
        $delegate_id,
        $order_by = 'created_at',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public function render()
    {
        return view('livewire.admin.stock-movement.sale.show-sale', ['sales' => $this->getSales()]);
    }

    public function getSales()
    {
        return  Sale::with(['account', 'customer', 'delegate'])
            ->when($this->customer_id, fn ($q) => $q->where('customer_id', $this->customer_id))
            ->when($this->delegate_id, fn ($q) => $q->where('delegate_id', $this->delegate_id))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}