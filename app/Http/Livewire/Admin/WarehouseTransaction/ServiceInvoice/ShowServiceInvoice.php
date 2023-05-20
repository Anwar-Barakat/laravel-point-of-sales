<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ServiceInvoice;

use App\Models\ServiceInvoice;
use Livewire\Component;
use Livewire\WithPagination;

class ShowServiceInvoice extends Component
{
    use WithPagination;

    public $created_at,
        $account_id,
        $service_type,
        $order_by = 'created_at',
        $sort_by = 'desc',
        $per_page = CUSTOM_PAGINATION;

    public $invoices_from_date,
        $invoices_to_date;

    public $order_type;

    public function mount()
    {
        $this->invoices_to_date = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.service-invoice.show-service-invoice', ['service_invoices' => $this->getServiceInvoices()]);
    }


    public function getServiceInvoices()
    {

        return  ServiceInvoice::with(['account', 'service'])
            ->where(['company_id' => get_auth_com()])
            ->when($this->service_type,         fn ($q) => $q->where('service_type', $this->service_type))
            ->when($this->account_id,           fn ($q) => $q->where('account_id', $this->account_id))
            ->when($this->invoices_from_date,   fn ($q) => $q->whereBetween('invoice_date', [$this->invoices_from_date, $this->invoices_to_date]))
            ->orderBy($this->order_by, $this->sort_by)
            ->paginate($this->per_page);
    }
}
