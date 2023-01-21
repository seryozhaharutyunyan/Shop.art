<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;


class OrderController extends Controller
{
    public function store(Product $product, StoreRequest $request)
    {
        $data = $request->all();

        $price = (int)$data['quantity'] * (float)$product->price;
        $user_order = Order::where('user_id', auth()->user()->id)->where('order_date', null);
        if ($user_order->count() === 0) {
            $order = Order::create([
                'price' => $price,
                'user_id' => \auth()->user()->id,
                'status' => 'not sent',
            ]);
        } else {
            $order = $user_order->first();
            $price += $order->price;
            $order->update([
                'price' => $price,
            ]);
        }
        $order_direction = OrderDetails::where('product_id', $product->id)->where('order_id', $order->id);
        if ($order_direction->count() === 0) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $data['quantity'],
                'price' => $product->price,
            ]);
        } else {
            $order_details = $order_direction->first();
            $quantity = $order_details->quantity + $data['quantity'];
            $order_details->update([
                'quantity' => $quantity,
            ]);
        }

        return \redirect()->route('index');
    }

    public function baskedAuth()
    {
        $order = Order::where('user_id', auth()->user()->id)->where('order_date', null)->first();
        if ($order) {
            $order_details = OrderDetails::where('order_id', $order->id)->paginate(20);
        } else {
            $order_details = [];
        }

        //dd($order_details);
        return \view('orders.basked_auth', \compact('order', 'order_details'));
    }

    public function update(UpdateRequest $request, Order $order, OrderDetails $details)
    {
        $data = $request->all();
        $order_details = OrderDetails::where('order_id', $order->id)->get();
        foreach ($order_details as $item) {
            $product = Product::where('id', $item->product_id)->first();
            $quantity_p = $product->quantity;
            if ($item->quantity > $quantity_p) {
                return \back()->withErrors("There are not so many goods name: $product->name there are $quantity_p")->withInput();
            }
            $quantity=$quantity_p-$item->quantity;
            $product->update([
                'quantity'=>$quantity
            ]);
        }
        //dd($quantity_p);
        $order->update($data);
        return \redirect()->route('index');
    }

    public function destroy(OrderDetails $orderDetails)
    {
        $order=Order::where('id', $orderDetails->order_id)->first();
        $count=OrderDetails::where('order_id', $orderDetails->order_id)->count();
        $orderDetails->delete();
        if($count==1){
            $order->delete();
        }
        return \redirect()->route('orders.basked_auth');
    }

    public function edit(OrderDetails $orderDetails)
    {
        $product = $orderDetails->product;
        //dd($product);
        return \view('orders.edit', \compact('product', 'orderDetails'));
    }

    public function updateQuantity(StoreRequest $request, Product $product, OrderDetails $orderDetails)
    {
        $data = $request->all();
        $price=$orderDetails->price*$data['quantity'];
        $order=Order::where('id', $orderDetails->order_id)->first();
        $order->update([
            'price'=>$price
        ]);
        $orderDetails->update($data);
        return \redirect()->route('orders.basked_auth');
    }

    public function baskedGuest()
    {
        return \view('orders.basked_guest');
    }

    public function storeGuest(Request $request)
    {
        if($request->ajax()){
            $data=\json_decode($request->body);
            $price=0;
            foreach ($data as $item){
                $price+=$item->price;
            }
            $date=date("Y-m-d H:i:s");
            $order=Order::create([
                'price'=>$price,
                'order_date'=>$date,
                'status'=>'not sent',
            ]);
            foreach ($data as $item){

                $product=Product::where('id', $item->id)->first();

                if($item->quantity>$product->quantity){
                    $error="There are not so many goods name: $product->name there are $product->quantity";
                    return response ()->json($error);
                }else{

                    $quantity= $product->quantity - $item->quantity;
                    OrderDetails::create([
                        'order_id'=>$order->id,
                        'product_id'=>$item->id,
                        'quantity'=>$item->quantity,
                        'price'=>($item->price/$item->quantity),
                    ]);
                    $product->update([
                        'quantity'=>$quantity,
                    ]);
                }

            }
        }

    }
}
