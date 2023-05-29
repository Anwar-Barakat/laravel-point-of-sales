<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\StoreTransfer;


use App\Models\StoreTransfer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.store-transfers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.store-transfers.create');
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
    public function show(StoreTransfer $store_transfer)
    {
        return view('admin.warehouse-transactions.store-transfers.show', ['store_transfer' => $store_transfer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreTransfer $store_transfer)
    {
        return view('admin.warehouse-transactions.store-transfers.edit', ['store_transfer' => $store_transfer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreTransfer $storeTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreTransfer $storeTransfer)
    {
        //
    }
}