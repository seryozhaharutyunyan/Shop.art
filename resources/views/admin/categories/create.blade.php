@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Create category</h2>
        <form action="{{route('admin.categories.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <input type="text" class="col-6" placeholder="Category name" name="name" value="{{old('name')}}">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </section>
@endsection
