@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Categories</h2>
        <a href="{{route('admin.categories.create')}}" class="btn btn-block btn-info">Add</a>
        <table class="table  caption-top col-12">
            <thead class="text-center">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>

                    <td>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="p-0 m-auto border-0">
                                <i class="fas fa-trash text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
            {{$categories->links()}}
        </div>
    </section>
@endsection
