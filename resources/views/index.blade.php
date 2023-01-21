@extends('layouts.shop')

@section('content')
    <div class="content">
        <section class="col-12 m-5 d-flex flex-wrap">
            @foreach($products as $product)
                <div class="col-5 m-3">
                    <img class="col-12 " src="{{url('storage/'.$product->img)}}" alt="img" style="height: 200px;">
                    <div class="col-12">
                        <span class="mb-3 pb-3 font-monospace">Name {{$product->name}},</span><br>
                        <span class="mb-3 font-monospace">Price {{$product->price}}</span><br>
                        <a href="{{route('products.show', $product->id)}}" class="show m-3 text-info d-inline"><i
                                class="fa-solid fa-eye"></i></a>
                        <input type="hidden" value="{{$product->id}}">
                        @auth()
                            <form action="{{route('likes.store', $product->id)}}" method="post" class="d-inline">
                                @csrf
                                <span>{{  count($product->likes)  }}</span>
                                <button type="submit" class="border-0 bg-transparent m-0 p-0">
                                    @if(auth()->user()->likedProduct->contains($product->id))
                                        <i class="fas fa-heart"></i>
                                    @else
                                        <i class="far fa-heart"></i>
                                    @endif

                                </button>
                            </form>
                        @endauth
                        @guest()
                            <span>{{ count($product->likes) }}</span>
                            <i class="far fa-heart"></i>
                        @endguest
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection
