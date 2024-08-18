<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

    }

    public function create(Client $client){
        $categories=Category::with('products')->get();
        $orders=$client->orders()->with('products')->latest()->paginate(5);
        return view('dashboard.clients.orders.create',compact('categories','client','orders'));
    }

    public function store(Request $request, Client $client){

        $request->validate([
            'products'=>['required','array']
        ]);

        $this->attach_order($request,$client);

        return redirect()->route('dashboard.orders.index')
        ->with('success', __('site.added_successfully'));
    
    }

    public function edit(Client $client, Order $order){

        $categories=Category::with('products')->get();

        $orders=$client->orders()->with('products')->paginate(5);
       
        return view('dashboard.clients.orders.edit',compact('categories','client','order','orders'));
    }

    public function update(Request $request,Client $client, Order $order){

            
            $request->validate([
                'products'=>['required','array']
            ]);

            $this->detach_order($order);
            $this->attach_order($request,$client);


            return redirect()->route('dashboard.orders.index')
            ->with('success', __('site.updated_successfully'));
    
    }

    public function destroy(Client $client,Order $order) {
        
        $this->detach_order($order);

        return redirect()->route('dashboard.orders.index')
            ->with('success', __('site.deleted_successfully'));
    }


    public function attach_order($request,$client){

        $order=new Order();

        $order->client_id=$client->id;

        $total_price=0;

        foreach($request->products as $productKey =>$productQuantity){

            $product=Product::findOrFail($productKey);

            $total_price+=($product->sale_price) * $productQuantity['quantity'];
            
            $product->stock-=$productQuantity['quantity'];
            
            $product->update();
        }

        $order->total_price=$total_price;
        $order->save();
        $order->products()->attach($request->products);
    }



    public function detach_order($order){
        
        foreach( $order->products as $product){
            $product->stock+=$product->pivot->quantity;
            $product->update();
        }

        $order->delete();

    }



}
