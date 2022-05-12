<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $categories = Category::with('mainCategory')
        ->orderBy('name','ASC')
        ->get();

        return view('admin.categories.index',compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        Category::create([
            'name'   => $request->name,
            'status' => $request->status ? "1" : "0",
            'pid'    => $request->pid ? $request->pid : null,
        ]);

        return redirect()->route('admin.categories.index')->with('success', __('categories.category_added'));
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category): View
    {
        $categories = Category::all();
        return view('admin.categories.edit',compact('categories','category'));
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        Category::where('id', $category->id)
        ->update([
            'name'   => $request->name,
            'status' => $request->status ? "1" : "0",
            'pid'    => $request->pid ? $request->pid : null,
        ]);

        return redirect()->route('admin.categories.index')->with('success', __('categories.category_updated'));
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {

        Category::where('pid', $category->id)
        ->update([ 'pid' => null ]);

        $category->delete();
        return redirect()->back()->with('success', __('categories.category_deleted'));
    }
}
