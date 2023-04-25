<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemTransactionRequest;
use App\Http\Requests\UpdateItemTransactionRequest;
use App\Models\ItemTransaction;

class ItemTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemTransaction $itemTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemTransaction $itemTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemTransactionRequest $request, ItemTransaction $itemTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemTransaction $itemTransaction)
    {
        //
    }
}
