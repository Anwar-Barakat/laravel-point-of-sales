<?php

namespace App\Http\Livewire\Admin\Report\Delegate;

use App\Models\Delegate;
use App\Models\Sale;
use App\Models\TreasuryTransaction;
use Livewire\Component;

class DisplayReport extends Component
{
    public $delegate,
        $account,
        $delegate_id,
        $report_type,
        $date = false,
        $reports_from_date,
        $reports_to_date;

    public $company,
        $sales,
        $services,
        $transactions;

    public function mount()
    {
        $this->reports_to_date = date('Y-m-d');
    }

    public function updatedDelegateId()
    {
        $this->delegate = Delegate::findOrFail($this->delegate_id);
        $this->account  = $this->delegate->account;
    }

    public function updatedReportType()
    {
        $this->date = $this->report_type != 1 ? true : false;
    }

    public function submit()
    {
        $this->validate();
        $this->sales                = get_account_sales(1, $this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->transactions         = get_account_transactions($this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->services             = get_account_services($this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->company              = auth()->guard('admin')->user()->company;
    }

    public function render()
    {
        return view('livewire.admin.report.delegate.display-report', ['delegates' => $this->getDelegates()]);
    }

    public function rules()
    {
        return [
            'delegate_id'   => ['required'],
            'report_type'   => ['required', 'in:1,2,3,4']
        ];
    }

    public function getDelegates()
    {
        return Delegate::latest()->get();
    }
}
