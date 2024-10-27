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
<<<<<<< HEAD
        return Inertia::render('Subcategory/Create',[
            'categories' => Category::all()
=======
        return Inertia::render('Subcategory/Create', [
            "categories" => Category::all(),
>>>>>>> add39943fc9deeb54ef449774d8c00dfad6318b8
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
    public function edit(SubCategory $subCategory)
    {
        return Inertia::render('Subcategory/Edit', [
            'subcategory' => SubCategory::with('category')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
<<<<<<< HEAD
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'SubCategory Deleted!');
=======
       
>>>>>>> add39943fc9deeb54ef449774d8c00dfad6318b8
    }
}
