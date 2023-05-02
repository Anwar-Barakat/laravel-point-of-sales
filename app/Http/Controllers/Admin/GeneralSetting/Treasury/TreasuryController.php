<?php

namespace App\Http\Controllers\Admin\GeneralSetting\Treasury;

use App\Models\Treasury;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTreasuryRequest;
use App\Http\Requests\Admin\UpdateTreasuryRequest;

class TreasuryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.general-settings.treasuries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.general-settings.treasuries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTreasuryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Treasury $treasury)
    {
        $treasury->load(['addedBy', 'updatedBy', 'treasuriesDelivery']);
        $treasuries = Treasury::select('id', 'name')->where(['company_id' => auth()->guard('admin')->user()->company->id])->active()->get();
        return view('admin.general-settings.treasuries.show', ['treasury' => $treasury, 'treasuries' => $treasuries]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treasury $treasury)
    {
        return view('admin.general-settings.treasuries.edit', ['treasury' => $treasury]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTreasuryRequest $request, Treasury $treasury)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treasury $treasury)
    {
        //
    }
}
