<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('frontend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('category_create')) {
            abort(403);
        }
        return view('frontend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('category_create')) {
            abort(403);
        }

        $request->validate([
            'category_name' => 'required | unique:categories,category_name',
            'description' => 'required',
        ]);

        Category::create($request->all());
        if ($request->has('modaltype')) {
            return redirect()->back()
                ->with('success', 'Category created successfully.');
        }

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = Category::find($category->id);

        return view('frontend.categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (!Gate::allows('category_edit')) {
            abort(403);
        }
        $category = Category::find($category->id);
        return view('frontend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (!Gate::allows('category_edit')) {
            abort(403);
        }
        $request->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);

        $category = Category::find($category->id);
        $category->category_name = $request->category_name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!Gate::allows('category_delete')) {
            abort(403);
        }
        $category = Category::find($category->id);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
