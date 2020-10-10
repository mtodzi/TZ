<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ImagesWorking;

class ImageController extends Controller
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
    
    public function uploadImgProduct(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => 'required|file|image',
        ]);
        ImagesWorking::addImagesProduct($request->images, $product->id);
        return redirect()->route('product.show', ['product' => $product]);
    }
    
    public function destroyImgProduct(Request $request, Product $product){        
        $request->validate([
            'url' => 'required|string',
        ]);
        ImagesWorking::deleteImgProduct($product->id, $request->input('url'));
        return redirect()->route('product.show', ['product' => $product]);
    }
}
