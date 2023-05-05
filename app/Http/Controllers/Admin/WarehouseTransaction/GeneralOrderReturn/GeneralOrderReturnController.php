<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\GeneralOrderReturn;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class GeneralOrderReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.general-order-returns.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.general-order-returns.create');
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $general_order_return)
    {
        return view('admin.warehouse-transactions.general-order-returns.edit', ['order' => $general_order_return]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
