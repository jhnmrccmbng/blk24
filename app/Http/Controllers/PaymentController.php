<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Cartsorder;
use App\Cart;
use DB;
use Curl;
use Auth;

class PaymentController extends Controller
{
   public function pay(){

         $products = [
            [
            'name' => 'kape',
            'price' => 2555, 
            'quantity' => 2,
            ],
            [
            'name' => 'kape2',
            'price' => 2555,
            'quantity' => 1,
            ]
         ];

   		$data = [

   			'data' => [
   				'attributes' => [
   					// 'line_items' => [
	   				// 	[
	   				// 		'currency' 		=> 'PHP',
	   				// 		'amount'   		=>  10000,
	   				// 		'description' 	=> 'Text1',
	   				// 		'name' 			=> 'Test Product 1',
	   				// 		'quantity' 		=> 3,
	   				// 	],
        //              [
        //                 'currency'     => 'PHP',
        //                 'amount'       =>  30000,
        //                 'description'  => 'Text1',
        //                 'name'         => 'Test Product 2',
        //                 'quantity'     =>  2,
        //              ],
   					// ],
   					'payment_method_types' => [
   						'gcash', 'card'
   					],
   					'success_url' => 'http://localhost:8000',
   					'cancel_url' => 'http://localhost:8000',
   					'description' => 'BLK24 Cafe',
   				],

   			]
   		];

         // clear first
         $data['data']['attributes']['line_items'] = [];

         // populate with array
         foreach($products as $product) {
            $data['data']['attributes']['line_items'][] = [
               'currency' => 'PHP',
               'amount' => $product['price'],
               'description' => 'sample',
               'name' => $product['name'],
               'quantity' => $product['quantity'],
            ];
         }

   		$response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
   						->withHeader('Content-Type: application/json')
   						->withHeader('accept: application/json')
   						->withHeader('Authorization: Basic '.env('AUTH_PAY'))
   						->withData($data)
   						->asJson()
   						->post();

   		// dd($response);

   		\Session::put('session_id', $response->data->id);

   		return redirect()->to($response->data->attributes->checkout_url);
   }

   public function success(){

   		$sessionId = \Session::get('session_id');
   		dd($sessionId);
   }

   public function checkout(Request $request){
      
      $products = Cart::whereIn('cart_user_id', [Auth::id()])->where('cart_placeorder_id', null)->with('products')->get();

      if(($request->orderservicetype == 2 OR $request->orderservicetype == 1) AND ($request->orderpaymenttype == 1)){

        $place_order = Cartsorder::create([
          'co_user_id' => Auth::user()->id,
          'co_status_id' => 1, 
          'co_service_id' => $request->input('orderservicetype'),
          'co_paymentmethod_id' => $request->input('orderpaymenttype'),
          'co_restaurant_id' => $request->resto_id,
          'co_totalpayment' => $request->input('totalorder'),
          'co_receiptnumber' => Carbon::now()->format("Ymd-").substr(str_shuffle("0123456789"), 0, 5),
          'co_remarks' => $request->input('remarks'),
        ]);

        $update = Cart::whereIn('cart_user_id', [Auth::id()])->where('cart_placeorder_id', null)->update(['cart_placeorder_id' => $place_order->id]);
        
        return redirect()->to('/home')->withSuccess('Order successfully placed!');

      }else{
        
        $data = [

          'data' => [
            'attributes' => [
              'payment_method_types' => [
                'gcash', 'card'
              ],
              'success_url' => route('paymentsuccess', ['serviceID' => $request->orderservicetype, 'paymentID' => $request->orderpaymenttype, 'restoID' => $request->resto_id, 'totalorder' => $request->totalorder, 'remarks' => $request->remarks ?? '---']),
              'cancel_url' => 'http://localhost:8000',
              'description' => 'BLK24 Cafe - '.Auth::user()->name,
            ],
          ]
        ];

      // clear first
      $data['data']['attributes']['line_items'] = [];

       // populate with array
         foreach($products as $product) {
            $data['data']['attributes']['line_items'][] = [
               'currency' => 'PHP',
               'amount' => $product->products['product_price'] * 100,
               'description' => '---',
               'name' => $product->products['product_name'],
               'quantity' => $product['cart_product_qty'],
            ];
         }

      $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
              ->withHeader('Content-Type: application/json')
              ->withHeader('accept: application/json')
              ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
              ->withData($data)
              ->asJson()
              ->post($request->all());
              // if success
              // store details from request to database?
            // fake :  Model()
      $session = \Session::put('session_id', $response->data->id);
    
      return redirect()->to($response->data->attributes->checkout_url);

      }

   }

   public function paymentsuccess(Request $request, $serviceID, $paymentID, $restoID, $totalorder, $remarks){

    $products = Cart::whereIn('cart_user_id', [Auth::id()])->where('cart_placeorder_id', null)->with('products')->get();

    $place_order = Cartsorder::create([
          'co_user_id' => Auth::user()->id,
          'co_status_id' => 1, 
          'co_service_id' => $serviceID,
          'co_paymentmethod_id' => $paymentID,
          'co_restaurant_id' => $restoID,
          'co_totalpayment' => $totalorder,
          'co_receiptnumber' => Carbon::now()->format("Ymd-").substr(str_shuffle("0123456789"), 0, 5),
          'co_remarks' => $remarks,
      ]);

      $update = Cart::whereIn('cart_user_id', [Auth::id()])->where('cart_placeorder_id', null)->update(['cart_placeorder_id' => $place_order->id]);

      $place_order->update(['co_paymonggo_id' => \Session::get('session_id')]);
      $place_order->status_actions()->create(['sa_status_id' => 1, 'sa_user_id' => Auth::user()->id, 'sa_remarks' => '---',]);

    return redirect()->to('/home')->withSuccess('Order successfully placed!');

   }

}