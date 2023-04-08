<?php

namespace App\Http\Controllers\Admin\Stock\Section;

use App\Http\Requests\Admin\StoreSectionRequest;
use App\Http\Requests\Admin\UpdateSectionRequest;
use App\Models\Section;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections  = Section::with(['addedBy'])->latest()->paginate(PAGINATION_COUNT);
        return view('admin.stocks.sections.index', ['sections' => $sections]);
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
    public function store(StoreSectionRequest $request)
    {
        $data   = $request->only(['name_ar', 'name_en', 'is_active']);
        $auth   = auth()->guard('admin')->user();

        Section::create([
            'name'          => [
                'ar'    => $data['name_ar'],
                'en'    => $data['name_en'],
            ],
            'is_active'     => $data['is_active'],
            'added_by'      => $auth->id,
        ]);
        toastr()->success(__('msgs.created', ['name' => __('section.section')]));
        return redirect()->route('admin.sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $data   = $request->only(['name_ar', 'name_en', 'is_active']);
        $auth   = auth()->guard('admin')->user();

        $section->update([
            'name'          => [
                'ar'    => $data['name_ar'],
                'en'    => $data['name_en'],
            ],
            'is_active'     => $data['is_active'],
            'updated_by'    => $auth->id,
        ]);
        toastr()->success(__('msgs.created', ['name' => __('section.section')]));
        return redirect()->route('admin.sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}