@extends('layouts.shop')

@section('content')
    <section class="col-12 m-5">
        <p class="text-center col-10">Uor e-mail {{auth()->user()->email}}</p>
        <form class="col-10" action="{{route('users.update', auth()->user()->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <input type="password" class="col-6" name="pw" placeholder="Password">
                @error('pw')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" class="col-6" name="name" placeholder="Name" value="{{auth()->user()->name}}">
                @error('name')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="col-6" name="password" placeholder="New password">
                @error('password')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="col-6" name="password_confirmation" placeholder="Confirm new password">
                @error('password_confirmation')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
@endsection
