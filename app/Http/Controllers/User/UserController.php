<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function account()
    {
        return \view('users.account');
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return \redirect()->route('index');
    }
}
