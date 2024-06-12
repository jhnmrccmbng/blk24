<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Service;
use App\Payment;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $carts;

    public function __construct()
    {   
        $this->middleware(['auth','verified']);
        $this->carts = Cart::where('cart_placeorder_id', null);
        $this->services = Service::pluck('service_name', 'id');
        $this->payments = Payment::pluck('payment_name', 'id');

    }

    public function index()
    {   
        $services = $this->services;
        $payments = $this->payments;
        $carts = $this->carts->whereIn('cart_user_id', [Auth::id()])->get(); 

        return view('carts.index', compact('carts', 'services', 'payments'));
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

       $view_cart = Cart::where('cart_product_id', '=', $request->order_product)->where('cart_user_id', Auth::user()->id)->where('cart_placeorder_id', null)->first();

      if($view_cart == true){

            $view_cart->update(['cart_product_qty' => $view_cart->cart_product_qty + $request->order_quantity]);
       
       }else{

            $cart = Cart::create([
                'cart_product_id' => $request->order_product,
                'cart_user_id' => Auth::user()->id,
                'cart_product_qty' => $request->order_quantity,
                'cart_product_price' => $request->product_price,
                'cart_restaurant_id' => $request->restaurant_id,
            ]);

       }
        return redirect()->back()->withSuccess('Item successfully added to cart!');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function deletecartItem($cart)
    {   

        $item = Cart::find($cart)->delete();
        return redirect()->back()->withSuccess('Item successfully removed to cart!');
    }
}
