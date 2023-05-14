<?php

namespace App\Http\Livewire\Admin\Report\Vendor;

use Livewire\Component;

class DisplayReport extends Component
{
    public $vendor_id,
        $report_type,
        $date = false,
        $reports_from_date,
        $reports_to_date;

    public function updatedReportType()
    {
        $this->date = $this->report_type != 1 ? true : false;
    }

    public function render()
    {
        return view('livewire.admin.report.vendor.display-report');
    }
}
