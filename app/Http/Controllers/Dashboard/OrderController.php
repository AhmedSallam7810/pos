<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){

        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%');

        })->paginate(10);

        return view('dashboard.orders.index',compact('orders'));
    }

    public function products(Order $order)
    {
        $products = $order->products;
        //dd($products);
        return view('dashboard.orders._products', compact('order', 'products'));

    }
}
