<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale;

class SaleInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Sale $sale)
    {
        $sale->load('customer:id,name,address,email', 'saleProducts');
        $company = auth()->guard('admin')->user()->company;
        return view('admin.warehouse-transactions.sales.invoice', ['sale' => $sale, 'company' => $company]);
    }
}
