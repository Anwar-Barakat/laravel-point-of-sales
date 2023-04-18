<?php

namespace App\Http\Controllers\Admin\Account\AccountType;

use App\Http\Requests\Admin\StoreAccountTypeRequest;
use App\Http\Requests\Admin\UpdateAccountTypeRequest;
use App\Models\AccountType;
use App\Http\Controllers\Controller;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account_types = AccountType::with(['addedBy:id,name'])->latest()->paginate(CUSTOM_PAGINATION);
        return view('admin.accounts.account-types.index', ['account_types' => $account_types]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountType $accountType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountType $accountType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountTypeRequest $request, AccountType $accountType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountType $accountType)
    {
        //
    }
}
