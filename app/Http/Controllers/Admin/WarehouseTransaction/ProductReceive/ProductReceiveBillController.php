<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\ProductReceive;

use App\Http\Controllers\Controller;
use App\Models\ProductReceive;
use Illuminate\Http\Request;

class ProductReceiveBillController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ProductReceive $invoice)
    {
        $invoice->load('workshop', 'production_line', 'productsReceiveDetail');
        $company = auth()->guard('admin')->user()->company;
        return view('admin.warehouse-transactions.products-receive.invoice', [
            'invoice'   => $invoice,
            'company'   => $company,
        ]);
    }
}
