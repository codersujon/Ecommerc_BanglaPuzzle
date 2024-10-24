<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Category/Index', [
            'categories' => Category::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Inline Validation
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            'description' => 'required'
        ]);

        Category::create([
            'category_name' => ucwords($request->category_name),
            'description' => $request->description
        ]);
        return redirect()->route('categories.index')->with('success', "Category Created!");
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
        return Inertia::render('Category/Edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'category_name' => ucwords($request->category_name),
            'description' => $request->description
        ]);
        return redirect()->route('categories.index')->with('success', "Category Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', "Category Deleted!");
    }
}
