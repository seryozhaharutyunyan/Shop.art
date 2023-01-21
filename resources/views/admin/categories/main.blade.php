@extends('layouts.shop')

@section('main')

        <div class="mune">
            <aside>
                <div class="category">
                    <h3>Menu</h3>
                    <div>
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{route('products.show_product', $category->id)}}">{{$category->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>
        </div>


@endsection
