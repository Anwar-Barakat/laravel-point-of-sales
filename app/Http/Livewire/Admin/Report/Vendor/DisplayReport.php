<?php

namespace App\Http\Livewire\Admin\Report\Vendor;

use App\Models\Vendor;
use Livewire\Component;
use Psy\Command\HistoryCommand;

class DisplayReport extends Component
{
    public $vendor,
        $account,
        $vendor_id,
        $report_type,
        $date = false,
        $reports_from_date,
        $reports_to_date;

    public $company,
        $purchases,
        $general_purchase_returns,
        $services,
        $transactions;

    public function mount()
    {
        $this->reports_to_date = date('Y-m-d');
    }

    public function updatedVendorId()
    {
        $this->vendor   = Vendor::findOrFail($this->vendor_id);
        $this->account  = $this->vendor->account;
    }

    public function updatedReportType()
    {
        $this->date = $this->report_type != 1 ? true : false;
    }

    public function submit()
    {
        $this->validate();
        $this->purchases                = get_account_orders(1, $this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->general_purchase_returns = get_account_orders(3, $this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->services                 = get_account_services($this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->transactions             = get_account_transactions($this->account->id, $this->reports_from_date, $this->reports_to_date);
        $this->company                  = auth()->guard('admin')->user()->company;
    }

    public function render()
    {
        return view('livewire.admin.report.vendor.display-report', ['vendors' => $this->getVendors()]);
    }

    public function rules()
    {
        return [
            'vendor_id'     => ['required'],
            'report_type'   => ['required', 'in:1,2,3,4,5,6']
        ];
    }

    public function getVendors()
    {
        return Vendor::with('account')->latest()->get();
    }
}
