<?php

namespace App\Http\Controllers\Admin\WarehouseTransaction\Order;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.warehouse-transactions.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse-transactions.orders.create');
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
    public function show(Order $order)
    {
        $order->load(['addedBy:id,name', 'vendor:id,name', 'account:id,name,number', 'orderProducts', 'store:id,name']);
        return view('admin.warehouse-transactions.orders.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.warehouse-transactions.orders.edit', ['order' => $order]);
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
            toastr()->error(__('msgs.has_items', ['name' => __('transaction.purchase_bill')]));
            return redirect()->back();
        }

        if ($order->type == 1 && $order->is_approved == 1) {
            toastr()->error(__('transaction.already_approved'));
            return redirect()->back();
        }

        $order->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('transaction.purchase_bill')]));
        return redirect()->back();
    }
}
