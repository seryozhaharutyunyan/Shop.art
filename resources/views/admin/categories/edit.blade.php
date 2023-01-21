@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Create category</h2>
        <form action="{{route('admin.categories.update', $category->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <input type="text" class="col-6" placeholder="Category name" name="name" value="{{$category->name}}">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
@endsection
