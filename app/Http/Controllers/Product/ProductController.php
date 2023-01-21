<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show(Product $product)
    {
        return \view('products.show', \compact('product'));
    }

    public function show_products(Category $category)
    {

        $products=Product::where('category_id', $category->id)->paginate(10);
        $category_name=$category->name;
        return \view('products.show_products', \compact('products', 'category_name'));

    }

}
