<?php

namespace App\Http\Controllers\Admin\Account\FinancialAccount;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
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
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('admin.accounts.financial-accounts.edit', ['account' => $account]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        if ($account->childAccounts()->exists()) {
            toastr()->error(__('msgs.has_sth', ['name' => __('account.account'), 'sth' => __('account.accounts')]));
            return redirect()->route('admin.accounts.index');
        }

        if (!is_null($account->customer())) {
            toastr()->error(__('msgs.has_sth', ['name' => __('account.account'), 'sth' => __('stock.customer')]));
            return redirect()->route('admin.accounts.index');
        }

        if (!is_null($account->vendor())) {
            toastr()->error(__('msgs.has_sth', ['name' => __('account.account'), 'sth' => __('stock.customer')]));
            return redirect()->route('admin.accounts.index');
        }


        $account->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('account.account')]));
        return redirect()->route('admin.accounts.index');
    }
}