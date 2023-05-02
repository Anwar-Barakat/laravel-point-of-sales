<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $company   = Company::with(['admin', 'parentVendor', 'parentCustomer', 'parentDelegate'])
            ->where('admin_id', auth()->guard('admin')->user()->id)->first();
        return view('admin.settings.index', ['company' => $company]);
    }
}
