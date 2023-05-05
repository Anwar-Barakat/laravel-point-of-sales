<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\GeneralOrderReturn;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class GeneralOrderReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.general-order-returns.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.general-order-returns.create', ['order_type' => 3]);
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
    public function show(Order $general_order_return)
    {
        return view('admin.warehouse-transactions.general-order-returns.show', ['order' => $general_order_return]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $general_order_return)
    {
        return view('admin.warehouse-transactions.general-order-returns.edit', ['order' => $general_order_return]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if ($order->orderProducts->count() > 0) {
            toastr()->error(__('msgs.order_has_items', ['name' => __('transaction.general_order_return')]));
            return redirect()->back();
        }

        if ($order->type == 3 && $order->is_approved == 1) {
            toastr()->error(__('transaction.already_approved'));
            return redirect()->back();
        }

        $order->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('transaction.general_order_return')]));
        return redirect()->back();
    }
}
