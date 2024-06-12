<?php

namespace App\Http\Controllers;

use App\Category;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $categories;

    public function __construct() 
    {
        $this->categories = Category::pluck('category_name', 'id');
    }

    public function index()
    {   
        $branches = Restaurant::all();
        $categories = $this->categories;

        return view('restaurants.index', compact('branches', 'categories'));
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
        $file = $request->file('branch_image');
        $filename = $file->getClientOriginalName();
        $filepath = $file->store('uploads', 'public');
        
        $uploadedFile = new Restaurant();
        $uploadedFile->restaurant_name = $request->input('branch_name');
        $uploadedFile->restaurant_email = $request->input('branch_email');
        $uploadedFile->restaurant_address = $request->input('branch_address');
        $uploadedFile->restaurant_phone = $request->input('branch_phone');
        $uploadedFile->restaurant_url = $request->input('branch_url');
        $uploadedFile->restaurant_openhour = $request->input('openhrs');
        $uploadedFile->restaurant_closehour = $request->input('closehrs');
        $uploadedFile->restaurant_days = $request->input('days');
        $uploadedFile->restaurant_category_id = $request->input('category');

        $uploadedFile->restaurant_imagepath = $filepath;
        $uploadedFile->save();
        
        return redirect()->back()->withSuccess('Branch Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {   
        $categories = $this->categories;
        $branch = $restaurant;
        return view('restaurants.edit', compact('categories', 'branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {   

        if($request->file('branch_image')){

            $file = $request->file('branch_image');
            $filename = $file->getClientOriginalName();
            $filepath = $file->store('uploads', 'public');
        }

        $branch = $restaurant->update([
            'restaurant_name' => $request->input('branch_name'),
            'restaurant_address' => $request->input('branch_address'),
            'restaurant_email' => $request->input('branch_email'),
            'restaurant_phone' => $request->input('branch_phone'),
            'restaurant_url' => $request->input('branch_url'),
            'restaurant_openhour' => $request->input('openhrs'),
            'restaurant_closehour' => $request->input('closehrs'),
            'restaurant_days' => $request->input('days'),
            'restaurant_category_id' => $request->input('category'),
            'restaurant_imagepath' => $request->file('branch_image') == true ? $filepath : '',
        ]);

        return redirect()->back()->withSuccess('Branch Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete($restaurant);
        return redirect()->back()->withSuccess('Branch Successfully Deleted!');
    }
}
