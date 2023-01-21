<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::paginate(20);
        return \view('admin.categories.index', \compact('categories'));
    }

    public function create(){
        return \view('admin.categories.create');
    }

    public function store(StoreRequest $request){
        $data=$request->all();
        Category::firstOrCreate(['name'=>$data['name']]);
        return \redirect()->route('admin.categories.index');
    }

    public function edit(Category $category){
        return \view('admin.categories.edit', \compact('category'));
    }

    public function update(UpdateRequest $request, Category $category){
        $data=$request->all();
        $category->update($data);
        return \redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category){
        $products=Product::where('category_id', $category->id);
        $category->delete();

        if(!empty($products)){

            foreach ($products as $product){

                $product->update('category_id', 'NULL');

            }
        }
        return \redirect()->route('admin.categories.index');
    }
}
