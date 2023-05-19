<?php

namespace App\Http\Livewire\Admin\Report\Customer;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\TreasuryTransaction;
use Livewire\Component;

class DisplayReport extends Component
{
    public $customer,
        $customer_id,
        $report_type,
        $date = false,
        $reports_from_date,
        $reports_to_date;

    public $company,
        $sales,
        $general_sale_returns,
        $transactions;

    public function mount()
    {
        $this->reports_to_date = date('Y-m-d');
    }

    public function updatedCustomerId()
    {
        $this->customer = Customer::findOrFail($this->customer_id);
    }

    public function updatedReportType()
    {
        $this->date = $this->report_type != 1 ? true : false;
    }

    public function submit()
    {
        $this->validate();
        $this->customer->load('account');
        $this->sales                = Sale::with('saleProducts')->byTypeAndCompany(1)
            ->select('id', 'is_approved', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account')
            ->where('customer_id', $this->customer->id)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('invoice_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->general_sale_returns = Sale::with('saleProducts')->byTypeAndCompany(3)
            ->select('id', 'is_approved', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account')
            ->where('customer_id', $this->customer->id)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('invoice_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->transactions     = TreasuryTransaction::with(['shift_type:id,name', 'treasury:id,name'])
            ->where('money_for_account', '<>', 0)
            ->byAccountAndCompany($this->customer->account)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('transaction_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->company =  auth()->guard('admin')->user()->company;
    }

    public function render()
    {
        return view('livewire.admin.report.customer.display-report', ['customers' => $this->getCustomers()]);
    }

    public function rules()
    {
        return [
            'customer_id'   => ['required'],
            'report_type'   => ['required', 'in:1,2,3,4,5']
        ];
    }

    public function getCustomers()
    {
        return Customer::latest()->get();
    }
}
