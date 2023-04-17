<?php

namespace App\Http\Controllers\Admin\Account\TreasuryTransaction;

use App\Models\TreasuryTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin.accounts.shift-movements.create');
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
}
