@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5">
        <h2>Order Details</h2><br>
        <table class="table  caption-top col-12">
            <thead class="text-center">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Product name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @php $i=1 @endphp
            @foreach($order_d as $order)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>
                        <form action="{{ route('admin.orders.delete', $order->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="p-0 m-auto border-0">
                                <i class="fas fa-trash text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @php $i++ @endphp
            @endforeach
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
            {{$order_d->links()}}
        </div>
    </section>
@endsection
