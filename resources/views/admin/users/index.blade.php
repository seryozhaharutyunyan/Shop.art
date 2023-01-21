@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Categories</h2>
        @if(auth()->user()->role_id===1)
            <a href="{{route('admin.users.create')}}" class="btn btn-block btn-info">Add</a>
        @endif
        <table class="table  caption-top col-12">
            <thead class="text-center">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                @can('view',auth()->user())
                    <th scope="col">Delete</th>
                @endcan
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                   @can('view',auth()->user())
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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
            {{$users->links()}}
        </div>
    </section>
@endsection
