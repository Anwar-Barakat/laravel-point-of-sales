<?php

namespace App\Http\Controllers\Admin\StockMovement\Sale;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.stock-movements.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stock-movements.sales.create');
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
    public function show(Sale $sale)
    {
        return view('admin.stock-movements.sales.show', ['sale' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        return view('admin.stock-movements.sales.edit', ['sale' => $sale]);
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