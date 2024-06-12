<?php

namespace App\Http\Controllers;

use Mail;
use Auth;
use App\Cart;
use App\User;
use App\Product;
use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $carts;

    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->carts = Cart::where('cart_placeorder_id', null);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {   
        $users = User::count();
        $carts = $this->carts->whereIn('cart_user_id', [Auth::id()])->count();
        $restaurants  = \App\Restaurant::all();
        $items = \App\InventoryIn::whereIn('inventory_statusID', [11])->count();

        $cartstatus = \App\Cartsorder::with('status')->get();

        $mappedcollection = $cartstatus->map(function($status, $key) {                                   
            return [
                'id' => $status->id,
                'status' => $status->status->status_name,
            ];
        })->groupBy(['status'])->map->count();

        Auth::user()->can('only-customer-can-access') ? $cartsorders = \App\Cartsorder::whereIn('co_user_id', [Auth::user()->id])->count() : $cartsorders = \App\Cartsorder::whereIn('co_status_id', [1, 3, 4, 7])->count();

        $statuses = \App\Statuses_action::whereIn('sa_status_id', [10])->with(['status', 'order'])->get();

        $mappedcollection_stats = $statuses->map(function($status, $key){
            return [
                'id' => $status->id,
                'cartsorder' => $status->order->co_totalpayment,
                'date' => $status->created_at,
                'year_month' => $status->created_at->format('F Y')
            ];
        })->groupBy('year_month');

        $dump = $mappedcollection_stats->map(function($item){return $item->sum('cartsorder');});

        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 500, 'height' => 200])
        ->labels($mappedcollection_stats->keys()->toArray())
        ->datasets([
            [
                "label" => "Overall sales per month",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                "data" => $dump->toArray(),
                "fill" => false,
            ],
        ])
        ->options([]);

        if($req->startdate == true AND $req->enddate == true){

            $dateRange =  $statuses->whereBetween('created_at', [$req->startdate, $req->enddate]);

             $mappedcollection_stats1 = $dateRange->map(function($status, $key){
                return [
                    'id' => $status->id,
                    'cartsorder' => $status->order->co_totalpayment,
                    'date' => $status->created_at,
                    'year_month' => $status->created_at->format('F Y')
                ];
            })->groupBy('year_month');

            $dump1 = $mappedcollection_stats1->map(function($item){return $item->sum('cartsorder');});

            $chartjs1 = app()->chartjs
            ->name('lineChartTest1')
            ->type('bar')
            ->size(['width' => 500, 'height' => 200])
            ->labels($mappedcollection_stats1->keys()->toArray())
            ->datasets([
                [
                    "label" => "Total sales of ".Carbon::createFromFormat('Y-m-d', \Request::get('startdate'))->format('F j, Y').' to '.Carbon::createFromFormat('Y-m-d', \Request::get('enddate'))->format('F j, Y'),
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    "data" => $dump1->toArray(),
                    "fill" => false,
                ],
            ])
            ->options([]);
            
        }else{

             $chartjs1 = "";
        }

        return view('home', compact('users', 'restaurants', 'carts', 'cartsorders', 'mappedcollection', 'chartjs', 'chartjs1', 'items'));

    }

    public function viewrestaurant($restaurant_id){
        
        $viewResto = Restaurant::find(decrypt($restaurant_id));
        $carts = $this->carts->whereIn('cart_user_id', [Auth::id()])->where('cart_restaurant_id', decrypt($restaurant_id))->get();

        return view('view_orders', compact('viewResto', 'carts'));
    }

    public function viewproductitem($id){

        $product = Product::find($id);
        return response()->json($product);
    }
}
