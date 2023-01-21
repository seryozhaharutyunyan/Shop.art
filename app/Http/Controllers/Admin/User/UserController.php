<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\User\PasswordMail;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        $users=User::paginate(20);
        return \view('admin.users.index', \compact('users'));
    }

    public function create(){
        return \view('admin.users.create');
    }

    public function store(StoreRequest $request){
        $data=$request->validated();
        $roles=Role::all();
        foreach ($roles as $role){
            if($role->name==='moderator'){
                $data['role_id']=$role->id;
            }
        }
        $password=Str::random(10);
        $data['password']=Hash::make($password);
        User::firstOrCreate(['email'=>$data['email']], $data);
        Mail::to($data['email'])->send(new PasswordMail($password));
        return \redirect()->route('admin.users.index');
    }

    public function destroy(User $user){
        $orders=Order::where('user_id', $user->id);
        $user->delete();
        if(!empty($orders)){
            foreach ($orders as $order){
                $order->delete();
            }
        }
        return \redirect()->route('admin.users.index');
    }
}
