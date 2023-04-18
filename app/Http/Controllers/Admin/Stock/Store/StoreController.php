<?php

namespace App\Http\Controllers\Admin\Stock\Store;

use App\Http\Requests\Admin\StoreStoreRequest;
use App\Http\Requests\Admin\UpdateStoreRequest;
use App\Models\Store;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::with(['addedBy'])->latest()->paginate(CUSTOM_PAGINATION);
        return view('admin.stocks.stores.index', ['stores' => $stores]);
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
    public function store(StoreStoreRequest $request)
    {
        $auth   = auth()->guard('admin')->user();
        $data   = $request->only(['name_ar', 'name_en', 'is_active', 'address', 'mobile']);

        Store::create([
            'name'          => [
                'ar'    => $data['name_ar'],
                'en'    => $data['name_en'],
            ],
            'address'       => $data['address'],
            'mobile'        => $data['mobile'],
            'is_active'     => $data['is_active'],
            'added_by'      => $auth->id,
            'company_code'  => $auth->company_code,
        ]);
        toastr()->success(__('msgs.created', ['name' => __('stock.store')]));
        return redirect()->route('admin.stores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $auth   = auth()->guard('admin')->user();
        $data   = $request->only(['name_ar', 'name_en', 'is_active', 'address', 'mobile']);

        $store->update([
            'name'          => [
                'ar'    => $data['name_ar'],
                'en'    => $data['name_en'],
            ],
            'address'       => $data['address'],
            'mobile'        => $data['mobile'],
            'is_active'     => $data['is_active'],
            'updated_by'    => $auth->id,
            'company_code'  => $auth->company_code,
        ]);
        toastr()->success(__('msgs.updated', ['name' => __('stock.store')]));
        return redirect()->route('admin.stores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('stock.store')]));
        return redirect()->route('admin.stores.index');
    }
}
