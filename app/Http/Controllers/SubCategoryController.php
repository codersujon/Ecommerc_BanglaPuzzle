<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Subcategory/Index', [
            'subcategories' => SubCategory::latest()->with('category')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Subcategory/Create',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Inline Validation
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|max:255',
            'description' => 'required'
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'subcategory_name' => ucwords($request->subcategory_name),
            'description' => $request->description
        ]);

        return redirect()->route('subcategories.index')->with('success', "SubCategory Created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $subcategory = SubCategory::with('category')->findOrFail($id);
        return Inertia::render('Subcategory/Edit', [
            'subcategory' => $subcategory,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Inline Validation
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|max:255',
            'description' => 'required'
        ]);

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($validateData);
        return redirect()->route('subcategories.index')->with('success', 'SubCategory Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'SubCategory Deleted!');

    }
}
