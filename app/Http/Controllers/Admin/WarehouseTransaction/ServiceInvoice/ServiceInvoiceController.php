<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\ServiceInvoice;

use App\Models\ServiceInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.service-invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.service-invoices.create');
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
    public function show(ServiceInvoice $services_invoice)
    {
        return view('admin.warehouse-transactions.service-invoices.show', ['services_invoice' => $services_invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceInvoice $services_invoice)
    {
        return view('admin.warehouse-transactions.service-invoices.edit', ['services_invoice' => $services_invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceInvoice $ServiceInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceInvoice $ServiceInvoice)
    {
        //
    }
}
