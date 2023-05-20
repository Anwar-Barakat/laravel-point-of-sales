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
        $this->accounts                 = Account::with(['accountType:id,name'])->select('id', 'name', 'account_type_id')->active()->get();
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function submit()
    {
        $this->validate();
        try {
            $this->invoice->added_by        = get_auth_id();
            $this->invoice->company_id      = get_auth_com();
            $this->invoice->save();

            toastr()->success(__('msgs.submitted', ['name' => __('transaction.service_invoice')]));
            return redirect()->route('admin.services-invoices.index');
        } catch (\Throwable $th) {
            return redirect()->route('admin.services-invoices.index')->with(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.warehouse-transaction.service-invoice.add-edit-service-invoice');
    }

    public function rules(): array
    {
        return [
            'invoice.service_type'    => ['required', 'boolean'],
            'invoice.account_id'      => ['required', 'integer'],
            'invoice.invoice_type'    => ['required', 'boolean'],
            'invoice.invoice_date'    => ['required', 'date'],
            'invoice.notes'           => ['required', 'min:10'],
        ];
    }
}
