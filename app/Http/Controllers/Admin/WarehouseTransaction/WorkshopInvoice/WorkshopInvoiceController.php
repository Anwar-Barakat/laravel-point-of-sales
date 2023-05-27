<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\WorkshopInvoice;


use App\Models\WorkshopInvoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkshopInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.workshop-invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.workshop-invoices.create');
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
    public function show(WorkshopInvoice $workshop_invoice)
    {
        return view('admin.warehouse-transactions.workshop-invoices.show', ['workshop_invoice' => $workshop_invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkshopInvoice $workshop_invoice)
    {
        return view('admin.warehouse-transactions.workshop-invoices.edit', ['workshop_invoice' => $workshop_invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkshopInvoice $workshopInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkshopInvoice $workshopInvoice)
    {
        //
    }
}
