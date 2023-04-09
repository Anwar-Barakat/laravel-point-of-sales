<?php

namespace App\Http\Controllers\Admin\Stock\Unit;

use App\Http\Requests\Admin\StoreUnitRequest;
use App\Http\Requests\Admin\UpdateUnitRequest;
use App\Models\Unit;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units  = Unit::latest()->paginate(PAGINATION_COUNT);
        return view('admin.stocks.units.index', ['units' => $units]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stocks.units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        $auth   = auth()->guard('admin')->user();
        if ($request->isMethod('post')) {
            $data                   = $request->only(['is_active', 'status']);
            $data['name']['ar']     = $request->name_ar;
            $data['name']['en']     = $request->name_en;
            $data['added_by']       = $auth->id;
            $data['company_code']   = $auth->id;

            Unit::create($data);
            toastr()->success(__('msgs.created', ['name' => __('stock.unit')]));
            return redirect()->route('admin.units.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.stocks.units.edit', ['unit' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $auth   = auth()->guard('admin')->user();
        if ($request->isMethod('put')) {
            $data                   = $request->only(['is_active', 'status']);
            $data['name']['ar']     = $request->name_ar;
            $data['name']['en']     = $request->name_en;
            $data['updated_by']     = $auth->id;
            $data['company_code']   = $auth->id;

            $unit->update($data);
            toastr()->success(__('msgs.created', ['name' => __('stock.unit')]));
            return redirect()->route('admin.units.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('stock.unit')]));
        return redirect()->back();
    }
}
