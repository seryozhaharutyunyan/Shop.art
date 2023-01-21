@extends('layouts.shop')

@section('content')
    <div class="content">
        <section class="col-12 m-5 d-flex flex-wrap">
            <div class="col-12 m-3">
                <img class="col-5" src="{{url('storage/'.$product->img)}}" alt="img">
                <div class="col-12 mt-5">
                    @if(isset($product->category->name))
                        <span class="mb-5 pb-3 font-monospace">Category {{$product->category->name}},</span><br>
                    @endif
                    <span class="mb-5 pb-3 font-monospace">Name {{$product->name}},</span><br>
                    <span class="mb-5 font-monospace">Price {{$product->price}}</span>

                </div>
            </div>
            @if($product->quentity===0)
                {{'Not available}'}}
            @else
                @auth()
                    <form action="{{route('orders.update_quantity', [$product->id, $orderDetails->id])}}" method="post" id="order_form">
                        @csrf
                        @method('patch')
                        <input type="number" placeholder="Quantity" class="m-3 col-2" name="quantity" min="1" max="{{$product->quantity}}" value="1">
                        <button class="btn btn-block btn-info m-3">Order</button>
                    </form>
                @endauth
                @guest()
                    <input type="number" placeholder="Quantity" class="m-3 col-2" name="quantity" min="1" max="{{$product->quantity}}" value="1">
                    <button class="btn btn-block btn-info m-3" id="basked">Order</button>
                @endguest
            @endif
        </section>
    </div>
    <script>
        $("#basked").click(function () {
            let a = window.localStorage.getItem('basked');
            let product = [];
            let quantity = 1;
            if ($("input[name=quantity]").val()) {
                quantity = $("input[name=quantity]").val();
            }
            console.log(quantity);
            let p = {
                quantity: quantity,
                id: {{$product->id}},
                name: {!!'"'.$product->name.'"'!!},
                price: {!!'"'.$product->price.'"'!!},

            };
            console.log(p);
            if (window.localStorage.getItem('product')) {
                product = JSON.parse(window.localStorage.getItem('product'));
                let f=true;
                for (let i=0; i < product.length; i++) {
                    if (product[i].id == p.id) {
                        product[i].quantity += p.quantity;
                        f=false;
                    }
                }
                if(f){
                    product.push(p);
                }
            } else {
                product.push(p);
            }
            window.localStorage.setItem('basked',product.length)
            $("#basked-g").text(window.localStorage.getItem('basked'));
            window.localStorage.setItem('product', JSON.stringify(product));
        })
    </script>
@endsection
