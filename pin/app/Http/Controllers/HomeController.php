<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order, App\OrderProduct, App\Product;
use Auth;
use DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = DB::table('ideas_product')
                    ->join('ideas_order_product','ideas_order_product.product_id','=','ideas_product.id')
                    ->join('ideas_order', 'ideas_order_product.order_id','=','ideas_order.id')
                    ->where('ideas_order.user_id',Auth::user()->id)
                    ->select('ideas_product.name as name','ideas_product.price as price', 'ideas_product.created_at as created_at',
                    'ideas_product.featured_image as featured_image', 'ideas_order_product.id as product_id', 'ideas_order_product.ID_id as ID_id', 'ideas_order_product.PIN as PIN' )
                    ->get();
        
        return view('home')->with('products',$products);
    }
}
