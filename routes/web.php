<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// PaymentController routes
Route::get('pay', [PaymentController::class, 'pay']);
Route::get('success', [PaymentController::class, 'success']);
Route::post('checkout', 'PaymentController@checkout')->name('checkout')->middleware('auth');
Route::get('/paymentsuccess/{serviceID}/{paymentID}/{restoID}/{totalorder}/{remarks}/', 'PaymentController@paymentsuccess')->name('paymentsuccess')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/restaurant/{id}', 'HomeController@viewrestaurant')->name('view_restaurant')->middleware('can:only-customer-can-access');
Route::get('/viewproduct/{id}', 'HomeController@viewproductitem')->name('viewproduct')->middleware('can:only-customer-can-access');

// UserController routes
Route::resource('/users', 'UserController')->middleware('can:only-admin-can-access');
Route::get('/users/delete/{id}', 'UserController@delete')->middleware('can:only-admin-can-access');
Route::get('/users/edit/{id}', 'UserController@edit')->middleware('can:only-admin-can-access');

// RestaurantController routes
Route::resource('/restaurants', 'RestaurantController')->middleware('can:only-admin-can-access');

// ProductController routes
Route::resource('/products', 'ProductController')->middleware('can:only-admin-can-access');

// CartController routes
Route::resource('/carts', 'CartController')->middleware('can:only-customer-can-access');
Route::get('deletecartItem/{id}', 'CartController@deletecartItem')->name('deletecartItem')->middleware('can:only-customer-can-access');

// CartsorderController routes
Route::resource('/cartsorder', 'CartsorderController')->middleware('auth');

//StatusesActionController
Route::get('change_status/{orderID}/{statusID}', 'StatusesActionController@update_status')->name('change_status')->middleware('can:only-admin-and-cashier-can-access');

//StatusController
Route::get('/view_order/{id}', 'StatusController@show')->name('view_order_status')->middleware('can:only-admin-and-cashier-can-access');

//InventoryInController
Route::resource('/inventory', 'InventoryInController')->middleware('can:only-admin-and-cashier-can-access');
Route::get('/inventory/edit/{id}', 'InventoryInController@edit')->middleware('can:only-admin-and-cashier-can-access');
Route::get('/inventory/destroy/{id}', 'InventoryInController@destroy')->middleware('can:only-admin-and-cashier-can-access');