<?php

namespace App\Http\Controllers\Admin\Account\TreasuryTransaction;

use App\Models\TreasuryTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class TreasuryTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!$this->hasOpenShift()) {
            toastr()->error(__('account.dont_have_open_shift'));
            return redirect()->route('admin.shifts.create');
        }
        return view('admin.accounts.treasury-transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TreasuryTransaction $treasuryTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TreasuryTransaction $treasuryTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TreasuryTransaction $treasuryTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TreasuryTransaction $treasuryTransaction)
    {
        //
    }


    private function hasOpenShift()
    {
        return Shift::where(['admin_id' => Auth::guard('admin')->id(), 'company_code' => Auth::guard('admin')->user()->company_code, 'is_finished' => 0])
            ->count() > 0;
    }
}
