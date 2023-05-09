<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\GeneralSaleReturn;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class GeneralSaleReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.general-sale-returns.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.general-sale-returns.create', ['sale_type' => 3]);
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
    public function show(Sale $general_sale_return)
    {
        return view('admin.warehouse-transactions.general-sale-returns.show', ['sale' => $general_sale_return, 'sale_type' => 3]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $general_sale_return)
    {
        return view('admin.warehouse-transactions.general-sale-returns.show', ['sale' => $general_sale_return, 'sale_type' => 3]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
