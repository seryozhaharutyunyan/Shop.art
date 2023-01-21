@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Categories</h2>
        <a href="{{route('admin.products.create')}}" class="btn btn-block btn-info">Add</a>
        <table class="table  caption-top col-12">
            <thead class="text-center">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Edit</th>
                @can('view', auth()->user())
                    <th scope="col">Delete</th>
                @endcan
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td><a class="text-success m-3" href="{{ route('admin.products.edit', $product->id) }}"><i
                                class="fas fa-pencil-alt m-2"></i></a>
                    </td>
                    @can('view', auth()->user())
                        <td>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="p-0 m-auto border-0">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
            {{$products->links()}}
        </div>
    </section>
@endsection
