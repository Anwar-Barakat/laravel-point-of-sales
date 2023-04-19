<?php

namespace App\Http\Controllers\Admin\Account\TreasuryTransaction;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (!$this->hasOpenShift()) {
            toastr()->error(__('account.dont_have_open_shift'));
            return redirect()->route('admin.shifts.create');
        }
        return view('admin.accounts.collect-transactions.create');
    }



    private function hasOpenShift()
    {
        return Shift::where(['admin_id' => Auth::guard('admin')->id(), 'company_code' => Auth::guard('admin')->user()->company_code, 'is_finished' => 0])
            ->count() > 0;
    }
}