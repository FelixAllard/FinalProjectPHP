<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_index(){
        $products = Product::all();
        return view('products.index',['products'=>$products]);
    }
    public function product_create_index()
    {
        return view('products.create');
    }
    public function store_product(Request $request)
    {
        $date = $request->validate([
            'name' => 'required',
            'description' =>'nullable',
            'price' =>'required|numeric',
            'quantity' =>'required|numeric'
        ]);
        $newProduct = Product::create($date);
        return redirect(route('Product.index'));
    }
}
