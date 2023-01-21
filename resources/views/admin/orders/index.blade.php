@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Orders</h2><br>


        <table class="table  caption-top col-12">
            <thead class="text-center">
            <tr>
                <th scope="col">id</th>
                <th scope="col">User name</th>
                <th scope="col">Price</th>
                <th>Show</th>
                <th scope="col">Send</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @php $i=1 @endphp
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{$i}}</th>
                    @if($order->user->name)
                    <td>{{$order->user->name}}</td>
                    @else
                        <td>Anonymously</td>
                    @endif
                    <td>{{$order->price}}</td>
                    <td><a href="{{route('admin.orders.show', $order->id)}}" class="m-3 text-info d-inline"><i
                                class="fa-solid fa-eye"></i></a></td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" class="p-0 m-auto border-0">
                                <i class="fa-solid fa-arrow-up-right-from-square text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @php $i++ @endphp
            @endforeach
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
            {{$orders->links()}}
        </div>
    </section>
@endsection
