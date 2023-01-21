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
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
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
                <a href="/"><i class="fa-solid fa-house"></i> Home</a>
            </li>
            <li>
                @auth()
                    <a href="#"><i class="fa-solid fa-user"></i> {{auth()->user()->name}}</a>
                    <ul>
                        <li><a href="{{route('users.account')}}"><i class="fa-solid fa-address-card"></i>
                                Account</a>
                        </li>
                        <li><a href="{{route('logout')}}"
                               onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-rectangle-xmark"></i> Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>

                @endauth

                @guest()
                    <a href="#"><i class="fa-solid fa-user"></i> Cabinet</a>
                    <ul>
                        <li><a href="{{\route('login')}}"><i class="fa-solid fa-user"></i> Login</a></li>
                        <li><a href="{{route('register')}}"><i class="fa-solid fa-id-card"></i> Register</a></li>
                    </ul>
                @endguest
            </li>
            @auth()
                <li>
                    <a href="{{route('orders.basked_auth')}}"><i class="fa-solid fa-basket-shopping"></i>
                        <span id="basked-a" class="m-2 text-danger position-absolute top-0 end-0">
                            @if($length)
                                {{$length}}
                            @else
                                {{0}}
                            @endif
                        </span></a>
                </li>
            @endauth
            @guest()
                <li>
                    <a href="{{route('orders.basked_guest')}}"><i class="fa-solid fa-basket-shopping"></i> <span
                            id="basked-g"
                            class="m-2 text-danger position-absolute top-0 end-0">0</span></a>
                </li>
            @endguest
        </ul>
    </nav>
</header>
<main>
    @include('include.menu')
    <div class="content">
        @yield('content')
    </div>

</main>
<script>

    if (window.localStorage.getItem('basked')) {
        $("#basked-g").text(localStorage.getItem('basked'));
    }
    if ($('.show')){
        $('.show').click(function (e) {
            let id = $(this).next().val();
            let token = "{{csrf_token()}}";

            $.ajax({
                url: "{{ route('reviewsCount') }}",
                method: 'POST',
                data: {id: id, _token: token,},
                success:function (data){
                    console.log(data);
                }
            });
        })
    }
</script>
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
<script src="{{asset('js\index.js')}}"></script>
</body>

</html>
