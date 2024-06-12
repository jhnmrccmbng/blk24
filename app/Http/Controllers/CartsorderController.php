<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Status;
use App\Cartsorder;
use Illuminate\Http\Request;

class CartsorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $carts = Cart::where('cart_placeorder_id', null)->whereIn('cart_user_id', [Auth::id()])->count();

        if(Auth::user()->can('only-customer-can-access')){

             $orders = Cartsorder::whereIn('co_user_id', [Auth::user()->id])->orderBy('id', 'desc')->get();
        
        }else{

            $statuses = Status::whereIn('id', [1, 7, 3, 4, 9, 10])->orderby('id')->pluck('status_name', 'id');

            $orders = Cartsorder::whereIn('co_status_id', [1, 3, 4, 7])->orderBy('id', 'desc')->get();
        }

        return view('cartsorder.index', compact('carts', 'orders', 'statuses'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cartsorder  $cartsorder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $cartsorder = Cartsorder::with('user', 'status', 'placed_at_carts.products')->find($id);
        return response()->json($cartsorder);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cartsorder  $cartsorder
     * @return \Illuminate\Http\Response
     */
    public function edit(Cartsorder $cartsorder)
    {   
        return view('cartsorder.edit', compact('cartsorder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cartsorder  $cartsorder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cartsorder $cartsorder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cartsorder  $cartsorder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cartsorder $cartsorder)
    {
        //
    }
}
