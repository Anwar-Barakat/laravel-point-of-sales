<?php

namespace App\Http\Controllers\Admin\Report\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('admin.reports.vendors.index');
    }
}
