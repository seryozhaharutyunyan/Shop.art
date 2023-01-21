@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Create products</h2>
        <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" class="col-6" name="name" value="{{old('name')}}" placeholder="Name">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" class="col-6" name="price" value="{{old('price')}}" placeholder="Price(5.8$)" required pattern="\d+\.?\d*[A-Za-z\$]*">
                @error('price')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="number" class="col-6" name="quantity" value="{{old('quantity')}}" placeholder="Quantity">
                @error('quantity')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <textarea class="col-6" name="description" placeholder="Description">{{old('description')}}</textarea>
                @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-control-sm col-6" name="category_id">
                    <option>Categories</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id==old('category_id') ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="file" class="col-6" name="img" placeholder="Image" accept="image/*">
                @error('img')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </section>
@endsection
