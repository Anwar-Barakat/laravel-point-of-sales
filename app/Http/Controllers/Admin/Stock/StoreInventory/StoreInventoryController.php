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
    public function show(StoreInventory $stores_inventory)
    {
        return view('admin.stocks.stores-inventories.show', ['stores_inventory' => $stores_inventory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreInventory $stores_inventory)
    {
        return view('admin.stocks.stores-inventories.edit', ['stores_inventory' => $stores_inventory]);
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
    public function destroy(StoreInventory $stores_inventory)
    {
        if ($stores_inventory->storeInventoryItems->count() > 0) {
            toastr()->error(__('msgs.order_has_items', ['name' => __('stock.store_inventory')]));
            return false;
        }
        $stores_inventory->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('stock.store_inventory')]));
        return redirect()->back();
    }
}
