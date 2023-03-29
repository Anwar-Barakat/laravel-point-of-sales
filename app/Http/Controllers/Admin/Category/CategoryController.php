<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Section;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['addedBy', 'section', 'parentCategory'])->latest()->paginate(PAGINATION_COUNT);
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // dd('hi');
        // $auth   = auth()->guard('admin')->user();

        // if ($request->isMethod('post')) {
        //     $data                   = $request->only(['name', 'is_active', 'section_id', 'parent_id', 'description']);
        //     $data['company_code']   = $auth->company_code;
        //     $data['added_by']       = $auth->id;

        //     dd($data);

        //     Category::create($data);
        //     toastr()->success(__('msgs.created', ['name' => __('category.category')]));
        //     return redirect()->route('admin.categories.index');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data   = $request->only(['name_ar', 'name_en', 'is_active']);
        $auth   = auth()->guard('admin')->user();
        $category->update([
            'name'          => [
                'ar'    => $data['name_ar'],
                'en'    => $data['name_en'],
            ],
            'is_active'     => $data['is_active'],
            'added_by'      => $auth->id,
            'company_code'  => $auth->company_code,
        ]);
        toastr()->success(__('msgs.updated', ['name' => __('category.category')]));
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('category.category')]));
        return redirect()->route('admin.categories.index');
    }
}