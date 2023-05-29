<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\WorkshopInvoice;

use App\Http\Controllers\Controller;
use App\Models\WorkshopInvoice;
use Illuminate\Http\Request;

class WorkshopInvoiceBillController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(WorkshopInvoice $invoice)
    {
        $invoice->load('workshop', 'production_line', 'workshopItems');
        $company = auth()->guard('admin')->user()->company;
        return view('admin.warehouse-transactions.workshop-invoices.invoice', [
            'invoice'   => $invoice,
            'company'   => $company,
        ]);
    }
}
