<?php

namespace App\Http\Controllers\Admin\Report\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('admin.reports.customers.index');
    }
}
