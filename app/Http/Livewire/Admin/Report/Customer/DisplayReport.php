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
        $account,
        $sales,
        $general_sale_returns,
        $services,
        $transactions;

    public function mount()
    {
        $this->reports_to_date = date('Y-m-d');
    }

    public function updatedCustomerId()
    {
        $this->customer = Customer::findOrFail($this->customer_id);
        $this->account  = $this->customer->account;
    }

    public function updatedReportType()
    {
        $this->date = $this->report_type != 1 ? true : false;
    }

    public function submit()
    {
        $this->validate();
        $this->sales                = get_account_sales(1, $this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->general_sale_returns = get_account_sales(3, $this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->transactions         = get_account_transactions($this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->services             = get_account_services($this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->company              = auth()->guard('admin')->user()->company;
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
