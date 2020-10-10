<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\ImagesWorking;

class ProductController extends Controller
{
    
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(20);
        
        return view('product.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        
        return view('product.create',['product'=>$product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'vendor_code' => 'required|string|max:255'
        ]);
        $product = new Product();
        $product->name_product =  $request->input('name_product');
        $product->vendor_code =  $request->input('vendor_code');
        $product->save();
        return redirect()->route('product.show', ['product' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $urls = ImagesWorking::getUrlImgProduct($product->id);
        return view('product.show',['product'=>$product, 'urls'=>$urls]);
    }
    //Ему тут не место 
    public function apiShow(Product $product)
    {
        $urls = ImagesWorking::getUrlImgProduct($product->id);
        return response()->json([
            'product'=>$product,
            'urls'=>$urls
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'vendor_code' => 'required|string|max:255'
        ]);
        $product->name_product =  $request->input('name_product');
        $product->vendor_code =  $request->input('vendor_code');
        $product->save();
        return redirect()->route('product.show', ['product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        ImagesWorking::deleteImgProductAll($product->id);
        $product->delete();
        return redirect()->route('product.index')->with(['success'=>'Продукт удален']);
    }
    
    public function loading(Product $product)
    {
        return view('product.loading',['product'=>$product]);
    }
}
