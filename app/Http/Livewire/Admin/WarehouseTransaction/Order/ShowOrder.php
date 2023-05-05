<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ShowOrder extends Component
{
    use WithPagination;

    public $created_at,
        $vendor_id,
        $store_id,
        $order_by = 'created_at',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public $invoices_from_date,
        $invoices_to_date;

    public $order_type;

    public function mount($order_type)
    {
        $this->invoices_to_date = date('Y-m-d');
        $this->order_type       = $order_type;
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.order.show-order', ['orders' => $this->getOrders()]);
    }

    public function getOrders()
    {

        return  Order::with(['account', 'vendor'])
            ->where(['company_id' => get_auth_com(), 'type' => $this->order_type])
            ->when($this->vendor_id,            fn ($q) => $q->where('vendor_id', $this->vendor_id))
            ->when($this->store_id,             fn ($q) => $q->where('store_id', $this->store_id))
            ->when($this->invoices_from_date,   fn ($q) => $q->whereBetween('invoice_date', [$this->invoices_from_date, $this->invoices_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
