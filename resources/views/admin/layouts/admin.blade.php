<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admincss.css')}}" type="text/css">

    <title>SHOP.ART</title>
</head>
<body>
<header>
    <div class="coles">
        <h1><a href="/">SHOP.ART</a></h1>
    </div>
    <nav>
        <ul>
            <li>
                <a href="{{route('admin.index')}}"><i class="fa-solid fa-house"></i> Home</a>
            </li>
            <li>
                <a href="#"><i class="fa-solid fa-user"></i> {{auth()->user()->name}}</a>
                <ul>
                    <li><a href="{{route('admin.account')}}"><i class="fa-solid fa-address-card"></i> Account</a></li>
                    <li><a href="{{route('logout')}}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-rectangle-xmark"></i> Logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<main>
    <div class="mune">
        <aside>
            <div class="category">
                <h3>Menu</h3>
                <div>
                    <ul>
                        <li><a href="{{route('admin.users.index')}}">Users</a></li>
                        @can('view',auth()->user())
                            <li><a href="{{route('admin.categories.index')}}">Categories</a></li>
                        @endcan
                        <li><a href="{{route('admin.products.index')}}">Products</a></li>
                        <li><a href="{{route('admin.orders.index')}}">Orders</a></li>
                    </ul>
                </div>
            </div>
        </aside>
    </div>
    <div class="content">
        @yield('content')
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/52548d1980.js" crossorigin="anonymous"></script>
</body>

</html>
