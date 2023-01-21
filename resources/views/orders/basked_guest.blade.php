@extends('layouts.shop')

@section('content')
    <section class="col-12 m-5">
        <h2>Orders</h2>
        @foreach($errors->all() as $error)
            <div class="text-danger">{{$error}}</div>
        @endforeach
        <table class="table  caption-top ">
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
            <tbody class="text-center"></tbody>
        </table>
        <div class="form-control text-center">
            <button id="basked" class="btn btn-block btn-info m-3">Send</button>
        </div>

    </section>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        let list = [];
        let k = 1;
        if(window.localStorage.getItem('product')){
            for (let item of JSON.parse(window.localStorage.getItem('product'))) {
                let tr = $("<tr><th scope=row>" + k + "</th></tr>");
                k++
                tr.append("<td>" + item.name + "</td>");
                tr.append("<td>" + item.price + "</td>");
                tr.append("<td>" + item.quantity + "</td>");
                tr.append("<td><a class='text-success m-3' href='{{ route('orders.edit',"+item.id+")}}'><i class='fas fa-pencil-alt m-2'></i></a></td>");
                tr.append("<td class='delete'><i class='fas fa-trash text-danger'></i></td>");
                tr.append("<input type='hidden' value=" + item.id + ">");
                list.push(tr);
            }
        }
        $('tbody').append(list);
        let bt_del = $('.delete').click(function () {
            let a = window.localStorage.getItem('basked');
            $data = JSON.parse(window.localStorage.getItem('product'));
            let p = [];
            let id = $(this).next().val();
            a:for (let item of $data) {
                b:for (let i in item) {
                    if (item.id == id) {
                        $(this).parent().remove();
                        continue a;
                    }
                }
                p.push(item);
            }
            a--
            window.localStorage.setItem('basked', a);
            window.localStorage.setItem('product', JSON.stringify(p));
            window.location.href = '{{route('orders.basked_guest')}}'
        })

        if (!(window.localStorage.getItem('basked')) || window.localStorage.getItem('basked') == 0) {
            $('div [class="form-control text-center"]').remove();
        }

        $('#basked').click(function () {
            let body = window.localStorage.getItem('product');
            let token = "{{csrf_token()}}";
            $.ajax({
                url: "{{ route('orders.store_guest') }}",
                method: 'POST',
                data: {body: body, _token: token,},
                success: function (data) {
                    if(data){
                        $("section[class='col-12 m-5'] h2").after("<div class='text-danger'>"+data+"</div>");
                    }else{
                        $("div[class='form-control text-center']").remove();
                        window.localStorage.clear();
                        window.location.href="{{route('index')}}";
                    }

                }
            });
        });
    </script>
@endsection
