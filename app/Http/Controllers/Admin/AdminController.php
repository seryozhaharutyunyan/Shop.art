<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index(){
        $products=Product::paginate(10);
        return \view('admin.index', \compact('products'));
    }

    public function account(){
        return \view('admin.account');
    }

    public function update(UpdateRequest $request, User $user){
        $data=$request->all();
        $data['password']=Hash::make($data['password']);
        $user->update($data);
        return \redirect()->route('admin.index');
    }
}
