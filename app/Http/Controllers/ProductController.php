<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_index(){
        return view('products.index');
    }
    public function product_create_index()
    {
        return view('products.create');
    }
}
