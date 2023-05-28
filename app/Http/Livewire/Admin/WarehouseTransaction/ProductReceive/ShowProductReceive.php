<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ProductReceive;

use App\Models\ProductReceive;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProductReceive extends Component
{
    use WithPagination;

    public $created_at,
        $production_line_id,
        $store_id,
        $order_by = 'created_at',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public $invoices_from_date,
        $invoices_to_date;

    public function mount()
    {
        $this->invoices_to_date = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.product-receive.show-product-receive', ['productsRecieves' => $this->getProductsReceives()]);
    }

    public function getProductsReceives()
    {
        return  ProductReceive::with(['production_line:id,plan'])->active()
            ->when($this->production_line_id,   fn ($q) => $q->where('production_line_id', $this->production_line_id))
            ->when($this->store_id,             fn ($q) => $q->where('store_id', $this->store_id))
            ->when($this->invoices_from_date,   fn ($q) => $q->whereBetween('invoice_date', [$this->invoices_from_date, $this->invoices_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
