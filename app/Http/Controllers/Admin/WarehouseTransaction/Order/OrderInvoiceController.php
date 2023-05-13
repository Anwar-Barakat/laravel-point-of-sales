<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Order $order)
    {
        $order->load('vendor:id,name,address,email', 'orderProducts');
        $company = auth()->guard('admin')->user()->company;
        return view('admin.warehouse-transactions.orders.invoice', ['order' => $order, 'company' => $company]);
    }
}
