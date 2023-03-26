<?php

namespace App\Http\Controllers\Admin\InvoiceCategory;

use App\Models\InvoiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInvoiceCategoryRequest;
use App\Http\Requests\Admin\UpdateInvoiceCategoryRequest;

class InvoiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoiceCategories  = InvoiceCategory::latest()->paginate(PAGINATION_COUNT);
        return view('admin.invoice-categories.index', ['invoiceCategories' => $invoiceCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceCategoryRequest $request)
    {
        $data   = $request->only(['name_ar', 'name_en', 'is_active']);
        $auth   = auth()->guard('admin')->user();
        InvoiceCategory::create([
            'name'          => [
                'ar'    => $data['name_ar'],
                'en'    => $data['name_en'],
            ],
            'is_active'     => $data['is_active'],
            'added_by'      => $auth->id,
            'company_code'  => $auth->company_code,
        ]);
        toastr()->success(__('msgs.created', ['name' => __('invoiceCat.invoice_category')]));
        return redirect()->route('admin.invoice-categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceCategory $invoiceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceCategory $invoiceCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceCategoryRequest $request, InvoiceCategory $invoiceCategory)
    {
        $data   = $request->only(['name_ar', 'name_en', 'is_active']);
        $auth   = auth()->guard('admin')->user();
        $invoiceCategory->update([
            'name'          => [
                'ar'    => $data['name_ar'],
                'en'    => $data['name_en'],
            ],
            'is_active'     => $data['is_active'],
            'added_by'      => $auth->id,
            'company_code'  => $auth->company_code,
        ]);
        toastr()->success(__('msgs.updated', ['name' => __('invoiceCat.invoice_category')]));
        return redirect()->route('admin.invoice-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceCategory $invoiceCategory)
    {
        $invoiceCategory->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('invoiceCat.invoice_category')]));
        return redirect()->route('admin.invoice-categories.index');
    }
}
