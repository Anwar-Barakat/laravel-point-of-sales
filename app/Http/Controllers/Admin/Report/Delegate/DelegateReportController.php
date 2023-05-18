<?php

namespace App\Http\Controllers\Admin\Report\Delegate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DelegateReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('admin.reports.delegates.index');
    }
}