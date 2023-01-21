<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Models\Category;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products=Product::paginate(20);
        return \view('admin.products.index', \compact('products'));
    }

    public function create(){
        $categories=Category::all();
        return \view('admin.products.create', \compact('categories'));
    }

    public function store(StoreRequest $request){
        $data=$request->all();
        $data['reviews_count']=0;
        $data['img'] = Storage::disk('public')->put('/img/product/' . $data['name'], $data['img']);
        Product::Create($data);
        return \redirect()->route('admin.products.index');
    }

    public function edit(Product $product){
        $categories=Category::all();
        return \view('admin.products.edit', \compact('product', 'categories'));
    }

    public function update(UpdateRequest $request, Product $product){
        $data=$request->all();
        if(isset($data['img']) && !empty($data['img'])){
            $data['img'] = Storage::disk('public')->put('/img/product/' . $data['name'], $data['img']);
        }
        $product->update($data);
        return \redirect()->route('admin.products.index');
    }

    public function destroy(Product $product){

        $order_details=OrderDetails::where('product_id', $product->id);
        $product->delete();

        if(!empty($order_details)){
            foreach ($order_details as $value){
                $order=$value->order;
                $value->delete();
                $order->delete();
            }
        }

        return \redirect()->route('admin.products.index');
    }
}
