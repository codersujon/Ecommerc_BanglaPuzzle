<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Product/Create', [
            'categories' => Category::with('subcategories')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validateData =  $request->validate([
            'product_name' => 'required|max:255',
            'selectedCategory' => 'required',
            'selectedSubcategory' => 'required',
            'quantity' => 'required',
            'inStock' => 'required|boolean',
            'old_price' => 'required|numeric|min:0',
            'new_price' => 'required|numeric|min:0',
            'product_description' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ], [
            'product_image.required' => 'Product image is required.',
            'product_image.image' => 'The file must be an image.',
            'product_image.mimes' => 'The image must be a type of: jpeg, png, jpg, gif, svg.',
            'product_image.max' => 'The image must not be greater than 2MB.',
       ]);


       // Image Way 1
      //  $image = $request->file('product_image')->store('products', 'public');

       /**
        * Image Way 2
        */
        $imageName = Str::uuid() . '.' . $request->file('product_image')->getClientOriginalExtension();

        // Store the image with the new name
        $imagePath = $request->file('product_image')->storeAs('products', $imageName, 'public');

       Product::create([
            'title' => ucwords($request->product_name),
            'description' => $request->product_description,
            'image' => $imageName,
            'quantity' => $request->quantity,
            'old_price' => $request->old_price,
            'new_price' => $request->new_price,
            'category_id' => $request->selectedCategory,
            'subcategory_id' => $request->selectedSubcategory,
            'inStock' => $request->inStock,
       ]);

       return redirect()->route('products.index')->with('success', 'Product Added Successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
