<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sales                      = Sale::query();
        $data['total_orders']       = $sales->count();
        $data['total_orders_today'] = Sale::salesOnDay(Carbon::today());
        $data['increase_in_sales']  = Sale::increaseInSale();
        $data['total_products']     = Product::all()->count();
        
        return view('home', $data);
    }
}
