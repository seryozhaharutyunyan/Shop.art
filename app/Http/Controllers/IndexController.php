<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index()
    {

        $products = Product::orderBy('reviews_count', 'desc')->limit(8)->get();

        return view('index', compact( 'products', ));

    }
}
