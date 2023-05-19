<?php

namespace App\Http\Livewire\Admin\WarehouseTransaction\ServiceInvoice;

use App\Models\Account;
use App\Models\Service;
use App\Models\ServiceInvoice;
use Livewire\Component;

class AddEditServiceInvoice extends Component
{
    public ServiceInvoice $invoice;

    public $services    = [],
        $accounts       = [];

    public function mount(ServiceInvoice $invoice)
    {
        $this->invoice                  = $invoice;
        $this->invoice->invoice_date    = date('Y-m-d');
        $this->services                 = Service::active()->get();
        $this->accounts                 = Account::with(['accountType:id,name'])->select('id', 'name', 'account_type_id')->active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.service-invoice.add-edit-service-invoice');
    }

    public function rules(): array
    {
        return [
            'invoice.service_id'      => ['required', 'integer'],
            'invoice.account_id'      => ['required', 'integer'],
            'invoice.invoice_type'    => ['required', 'boolean'],
            'invoice.invoice_date'    => ['required', 'date'],
            'invoice.notes'           => ['required', 'min:10'],
        ];
    }
}
