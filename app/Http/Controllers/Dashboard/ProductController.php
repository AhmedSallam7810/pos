<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products=Product::when($request->search,function ($query)use ($request){
            return $query->whereTranslationLike('name','%'.$request->search.'%');
        })->when($request->category_id,function($query) use ($request){
            return $query->where('category_id',$request->category_id);
        })->latest()->paginate(10);

        $categories=Category::all();

        return view('dashboard.products.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('dashboard.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rules=[
            'category_id'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required'
        ];

        foreach(config('translatable.locales') as $locale){
            $rules[$locale.'.name']=['required',Rule::unique('product_translations','name')];

        }

        $request->validate($rules);

        $formField=$request->all();

        $image=$request->file('image');

        if($image){

            $image->storeAs('product_images',$image->hashName(),'public_upload');
            $formField['image']=$image->hashName();
        }

        Product::create($formField);

        return redirect()->route('dashboard.products.index')
        ->with('success',__('site.added_successfully'));
        
    }

   
    public function edit(Product $product)
    {
        $categories=Category::all();
        return view('dashboard.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules=[
            'category_id'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required'
        ];

        foreach(config('translatable.locales') as $locale){
            $rules[$locale.'.name']=['required',Rule::unique('product_translations','name')->ignore($product->id,'product_id')];

        }

        $request->validate($rules);

        $formField=$request->all();

        $image=$request->file('image');

        if($image){

            Storage::disk('public_upload')->delete('product_images/'.$product->image);
            $image->storeAs('product_images',$image->hashName(),'public_upload');
            $formField['image']=$image->hashName();
        }

        $product->update($formField);

        return redirect()->route('dashboard.products.index')
        ->with('success',__('site.updated_successfully'));
        
    }

    
    public function destroy(Product $product)
    {
        if($product->image!='default.png'){
            Storage::disk('public_upload')->delete('product_images/'.$product->image);
        }
        $product->delete();
        
     
        return redirect()->route('dashboard.products.index')->with('success', __('site.deleted_successfully'));
    }
}
