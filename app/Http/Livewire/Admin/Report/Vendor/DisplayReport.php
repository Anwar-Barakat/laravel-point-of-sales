<?php

namespace App\Http\Livewire\Admin\Report\Vendor;

use App\Models\Order;
use App\Models\ServiceInvoice;
use App\Models\TreasuryTransaction;
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
        $this->purchases                = Order::with('orderProducts')->byTypeAndCompany(1)
            ->select('id', 'is_approved', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account')
            ->where('vendor_id', $this->vendor->id)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('invoice_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->general_purchase_returns = Order::with('orderProducts')->byTypeAndCompany(3)
            ->select('id', 'is_approved', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account')
            ->where('vendor_id', $this->vendor->id)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('invoice_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->services = ServiceInvoice::with('serviceInvoiceDetails')
            ->select('id', 'is_approved', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account')
            ->where('account_id', $this->vendor->account->id)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('invoice_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->transactions     = TreasuryTransaction::with(['shift_type:id,name', 'treasury:id,name'])
            ->where('money_for_account', '<>', 0)
            ->byAccountAndCompany($this->vendor->account)
            ->when($this->reports_from_date, fn ($q) => $q->whereBetween('transaction_date', [$this->reports_from_date, $this->reports_to_date]))
            ->get();

        $this->company =  auth()->guard('admin')->user()->company;
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
