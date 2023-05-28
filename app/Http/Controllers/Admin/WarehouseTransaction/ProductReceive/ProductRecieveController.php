<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\ProductReceive;

use App\Models\ProductRecieve;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductRecieveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.products-receive.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.products-receive.create');
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
    public function show(ProductRecieve $product_recieve)
    {
        return view('admin.warehouse-transactions.products-receive.show', ['product_recieve' => $product_recieve]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductRecieve $product_recieve)
    {
        return view('admin.warehouse-transactions.products-receive.edit', ['product_recieve' => $product_recieve]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductRecieve $productRecieve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductRecieve $productRecieve)
    {
        //
    }
}
