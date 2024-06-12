<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $restaurants;

    public function __construct() 
    {
        $this->restaurants = Restaurant::pluck('restaurant_name', 'id');
    }

    public function index()
    {   
        $restaurants = $this->restaurants;
        $products = Product::all();

        return view('products.index', compact('restaurants', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        if($request->file('product_image')){

            $file = $request->file('product_image');
            $filename = $file->getClientOriginalName();
            $filepath = $file->store('uploads', 'public');
        }

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'product_slogan' => $request->input('product_slogan'),
            'product_price' => $request->input('product_price'),
            'product_quantity' => $request->input('product_quantity'),
            'product_image' => $request->file('product_image') == true ? $filepath : '',
            'restaurant_id' => $request->input('category'),
        ]);

        return redirect()->back()->withSuccess('Product Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {   
        $restaurants = $this->restaurants;
        $item = Product::find(decrypt($product));

        return view('products.edit', compact('item', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {    
        if($request->file('product_image')){

            $file = $request->file('product_image');
            $filename = $file->getClientOriginalName();
            $filepath = $file->store('uploads', 'public');
        }

        $item = $product->update([
            'restaurant_id' => $request->input('category'), 
            'product_name' => $request->input('product_name'),
            'product_slogan' => $request->input('product_slogan'),
            'product_price' => $request->input('product_price'),
            'product_quantity' => $request->input('product_quantity'),
            'product_image' => $request->file('product_image') == true ? $filepath : $product->product_image,

        ]);
      
        return redirect()->back()->withSuccess('Product Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = $product->delete();
        return redirect()->back()->withSuccess('Product Successfully Deleted!');
    }
}
