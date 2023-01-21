@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Create category</h2>
        <form action="{{route('admin.users.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <input type="text" class="col-6" name="name" value="{{old('name')}}" placeholder="User name">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="email" class="col-6" name="email" value="{{old('email')}}" placeholder="Email">
                @error('email')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </section>
@endsection
