@extends('admin.layouts.admin')

@section('content')
    <section class="col-12 m-5 d-flex flex-wrap justify-content-center">
        @foreach($products as $product)
            <div class="col-5 m-3">
                <img class="col-12 " src="{{url('storage/'.$product->img)}}" alt="img" style="height: 200px;">
                <div class="col-12">
                    <span class="mb-3 pb-3 font-monospace">Name {{$product->name}},</span><br>
                    <span class="mb-3 font-monospace">Price {{$product->price}}</span>
                </div>
            </div>
        @endforeach
    </section>
@endsection
