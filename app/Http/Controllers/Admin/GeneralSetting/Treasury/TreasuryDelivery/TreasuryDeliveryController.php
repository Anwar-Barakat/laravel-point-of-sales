<?php

namespace App\Http\Controllers\Admin\GeneralSetting\Treasury\TreasuryDelivery;

use App\Http\Controllers\Controller;
use App\Models\Treasury;
use App\Models\TreasuryDelivery;
use Illuminate\Http\Request;

class TreasuryDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['treasury_delivery_id'  => ['required', 'integer']]);
        $comCode = auth()->guard('admin')->user()->company->id;

        /*
            check if parent(treasury_id) and child(treasury_delivery_id) registed before
        */
        if (TreasuryDelivery::where(['treasury_id' => $request->id, 'treasury_delivery_id' => $request->treasury_delivery_id, 'company_id' => $comCode])->exists()) {
            toastr()->error(__('msgs.exists', ['name' => __('treasury.treasury')]));
            return redirect()->back();
        }

        TreasuryDelivery::create([
            'treasury_id'           => $request->id,
            'treasury_delivery_id'  => $request->treasury_delivery_id,
            'company_id'          => $comCode,
            'added_by'              => auth()->guard('admin')->id()
        ]);

        toastr()->success(__('msgs.created', ['name' => __('treasury.treasury_delivery')]));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(TreasuryDelivery $treasuryDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TreasuryDelivery $treasuryDelivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TreasuryDelivery $treasuryDelivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TreasuryDelivery $treasuryDelivery)
    {
        $treasuryDelivery->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('treasury.treasury_delivery')]));
        return redirect()->back();
    }
}
