@extends('layouts.shop')

@section('content')
    <section class="col-12 m-5">
        <h2>Basked</h2>
        @foreach($errors->all() as $error)
            <div class="text-danger">{{$error}}</div>
        @endforeach
            <table class="table  caption-top col-12">
                <thead class="text-center">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @php $i=1 @endphp
                @foreach($order_details as $order_d)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$order_d->product->name}}</td>
                        <td>{{(float)$order_d->price*(int)$order_d->quantity}}</td>
                        <td>{{$order_d->quantity}}</td>
                        <td><a class="text-success m-3" href="{{ route('orders.edit', $order_d->id) }}"><i
                                    class="fas fa-pencil-alt m-2"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('orders.destroy', $order_d->id) }}" method="post">
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
                @if(!empty($order_details))
                    {{$order_details->links()}}
                @endif
            </div>
            @if(!empty($order))
                <form method="post" action="{{route('orders.update', $order->id)}}">
                    @csrf
                    @method('patch')
                    <div class="form-control">
                        <input type="hidden" value="{{date("Y-m-d H:i:s")}}" name="order_date">
                        <button class="btn btn-block btn-info m-3" id="basked">Send</button>
                    </div>
                </form>
            @endif
    </section>
@endsection
