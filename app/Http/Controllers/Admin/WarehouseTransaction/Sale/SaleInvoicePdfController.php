<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleInvoicePdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Sale $sale)
    {
        $company = Auth::guard('admin')->user()->company;
        $pdf = Pdf::loadView('admin.warehouse-transactions.sales.print', ['sale' => $sale, 'company' => $company]);
        return $pdf->download(Carbon::now()->format('d-m-Y') . "-invoice#$sale->id.pdf");
    }
}
