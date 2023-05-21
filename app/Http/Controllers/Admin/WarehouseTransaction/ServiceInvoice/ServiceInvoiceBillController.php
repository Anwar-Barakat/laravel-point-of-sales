<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\ServiceInvoice;

use App\Http\Controllers\Controller;
use App\Models\ServiceInvoice;
use Illuminate\Http\Request;

class ServiceInvoiceBillController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ServiceInvoice $services_invoice)
    {
        $services_invoice->load('account:id,name,number', 'serviceInvoiceDetails');
        $company = auth()->guard('admin')->user()->company;
        return view('admin.warehouse-transactions.service-invoices.invoice', [
            'services_invoice'      => $services_invoice,
            'company'               => $company,
        ]);
    }
}
