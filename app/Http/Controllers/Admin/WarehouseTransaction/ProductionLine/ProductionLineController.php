<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\ProductionLine;

use App\Models\ProductionLine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductionLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.production-lines.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.production-lines.create');
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
    public function show(ProductionLine $production_line)
    {
        return view('admin.warehouse-transactions.production-lines.show', ['production_line' => $production_line]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionLine $production_line)
    {
        return view('admin.warehouse-transactions.production-lines.edit', ['production_line' => $production_line]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionLine $productionLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionLine $productionLine)
    {
        //
    }
}
