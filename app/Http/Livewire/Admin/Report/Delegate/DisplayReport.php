<?php

namespace App\Http\Livewire\Admin\Report\Delegate;

use App\Models\Delegate;
use App\Models\Sale;
use App\Models\TreasuryTransaction;
use Livewire\Component;

class DisplayReport extends Component
{
    public $delegate,
        $delegate_id,
        $report_type,
        $date = false,
        $reports_from_date,
        $reports_to_date;

    public $company,
        $sales,
        $transactions;

    public function mount()
    {
        $this->reports_to_date = date('Y-m-d');
    }

    public function updatedDelegateId()
    {
        $this->delegate = Delegate::findOrFail($this->delegate_id);
    }

    public function updatedReportType()
    {
        $this->date = $this->report_type != 1 ? true : false;
    }

    public function submit()
    {
        $this->validate();
        $this->delegate->load('account');
        $this->sales                = Sale::with('saleProducts')->byTypeAndCompany(1)
            ->select('id', 'is_approved', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account', 'commission_value')
            ->where('delegate_id', $this->delegate->id)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('invoice_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->transactions     = TreasuryTransaction::with(['shift_type:id,name', 'treasury:id,name'])
            ->where('money_for_account', '<>', 0)
            ->byAccountAndCompany($this->delegate->account)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('transaction_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->company =  auth()->guard('admin')->user()->company;
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