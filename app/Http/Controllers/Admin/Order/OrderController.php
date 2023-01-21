<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::where('status', 'not sent')->where('order_date', '<>', null)->paginate(20);
        //dd($orders);
        return \view('admin.orders.index', \compact('orders'));
    }

    public function show(Order $order){
        $order_d=OrderDetails::where('order_id', $order->id)->paginate(20);
        //dd($order_d);
        return \view('admin.orders.show', \compact('order_d'));
    }

    public function destroy(OrderDetails $orderDetails){
        $order=Order::where('id', $orderDetails->order_id)->first();
        $count=OrderDetails::where('order_id', $orderDetails->order_id)->count();
        $orderDetails->delete();
        if($count==1){
            $order->delete();
        }
        return \redirect()->route('admin.orders.index');
    }

    public function update(Order $order){
        $order->update([
            'status'=>'sent'
        ]);
        return \redirect()->route('admin.orders.index');
    }
}
