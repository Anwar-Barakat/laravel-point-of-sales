<?php

namespace App\Http\Controllers\Admin\GeneralSetting\Setting;

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
        return view('admin.general-settings.settings.index', ['company' => $company]);
    }
}
