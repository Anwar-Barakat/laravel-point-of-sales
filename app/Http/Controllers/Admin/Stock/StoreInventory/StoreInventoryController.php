<?php

namespace App\Http\Controllers\Admin\Stock\StoreInventory;

use App\Models\StoreInventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.stocks.stores-inventories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stocks.stores-inventories.create');
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
    public function show(StoreInventory $storeInventory)
    {
        return view('admin.stocks.stores-inventories.show', ['inventory' => $storeInventory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreInventory $storeInventory)
    {
        return view('admin.stocks.stores-inventories.edit', ['inventory' => $storeInventory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreInventory $storeInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreInventory $storeInventory)
    {
        //
    }
}