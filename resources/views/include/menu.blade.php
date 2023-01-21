<div class="mune">
    <aside>
        <div class="category">
            <h3>Menu</h3>
            <div>
                <ul>
                    @foreach($categories as $category)
                        <li><a href="{{route('products.show_products', $category->id)}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>

