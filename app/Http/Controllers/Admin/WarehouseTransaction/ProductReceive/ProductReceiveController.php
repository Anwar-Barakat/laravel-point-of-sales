<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\ProductReceive;

use App\Models\ProductReceive;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductReceiveController extends Controller
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
    public function show(ProductReceive $products_receive)
    {
        return view('admin.warehouse-transactions.products-receive.show', ['products_receive' => $products_receive]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductReceive $products_receive)
    {
        return view('admin.warehouse-transactions.products-receive.edit', ['products_receive' => $products_receive]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductReceive $ProductReceive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductReceive $ProductReceive)
    {
        //
    }
}