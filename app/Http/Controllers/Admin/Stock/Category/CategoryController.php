<?php

namespace App\Http\Controllers\Admin\Stock\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['addedBy', 'section', 'parentCategory'])->latest()->paginate(CUSTOM_PAGINATION);
        return view('admin.stocks.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stocks.categories.create');
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.stocks.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->subCategories()->count() > 0) {
            toastr()->error(__('stock.category_has_cats'));
            return redirect()->back();
        }

        $category->clearMediaCollection('categories');
        Media::where(['model_id' => $category->id, 'collection_name' => 'categories'])->delete();
        $category->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('stock.category')]));
        return redirect()->route('admin.categories.index');
    }
}
