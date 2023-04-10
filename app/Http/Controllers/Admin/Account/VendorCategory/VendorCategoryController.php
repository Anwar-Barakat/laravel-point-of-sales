<?php

namespace App\Http\Controllers\Admin\Account\VendorCategory;

use App\Http\Requests\Admin\StoreVendorCategoryRequest;
use App\Http\Requests\Admin\UpdateVendorCategoryRequest;
use App\Models\VendorCategory;
use App\Http\Controllers\Controller;
use App\Models\Section;

class VendorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['vendor_categories']  = VendorCategory::with(['addedBy:id,name', 'section:id,name'])->latest()->paginate(PAGINATION_COUNT);
        $data['sections']           = Section::active()->get();
        return view('admin.accounts.vendor-categories.index', $data);
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
    public function store(StoreVendorCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorCategory $vendorCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorCategory $vendorCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorCategoryRequest $request, VendorCategory $vendorCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendorCategory $vendorCategory)
    {
        //
    }
}
