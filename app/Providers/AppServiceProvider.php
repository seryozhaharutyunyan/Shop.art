<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $categories=Category::all();
        view()->share('categories', $categories);
        \view()->composer('*', function ($viwe){
            if(Auth::check()){
                $order=Order::where('user_id', Auth::user()->id)->where('order_date', null)->first();
                if($order){
                    $length=OrderDetails::where('order_id', $order->id)->count();
                }else{
                    $length=0;
                }

                view()->share('length', $length);
            }
        });



    }
}
