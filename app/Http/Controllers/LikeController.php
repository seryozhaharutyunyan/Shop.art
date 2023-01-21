<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use App\Models\ProductUserLike;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function store(Product $product)
    {
        if(\auth()->check()){
            \auth()->user()->likedProduct()->toggle($product->id);
        }else{
            ProductUserLike::create([
                'product_id'=>$product->id,

            ]);
        }
        return \redirect()->back();
    }
}
