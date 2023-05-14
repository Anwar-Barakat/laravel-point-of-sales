<?php

namespace App\Http\Controllers\Admin\Report\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.vendors.index');
    }
}
