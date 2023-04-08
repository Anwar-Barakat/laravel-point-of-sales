<?php

namespace App\Http\Controllers\Admin\Account\FinancialAccount;

use App\Models\FinancialAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.accounts.financial-accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accounts.financial-accounts.create');
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
    public function show(FinancialAccount $financialAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialAccount $financialAccount)
    {
        return view('admin.accounts.financial-accounts.edit', ['financialAccount' => $financialAccount]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialAccount $financialAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialAccount $financialAccount)
    {
        $exists = $financialAccount->childAccounts()->count();
        if ($exists > 0) {
            toastr()->error(__('msgs.has_childs', ['name' => __('account.financial_account'), 'childs' => __('account.financial_accounts')]));
            return redirect()->route('admin.financial-accounts.index');
        }
        $financialAccount->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('account.financial_account')]));
        return redirect()->route('admin.financial-accounts.index');
    }
}
