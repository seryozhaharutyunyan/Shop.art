<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware'=>['auth', 'admin_moderator']], function () {

    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/account','AdminController@account')->name('admin.account');
    Route::patch('/{user}', 'AdminController@update')->name('admin.update');

    Route::group(['namespace' => 'Product', 'prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index')->name('admin.products.index');
        Route::get('/create', 'ProductController@create')->name('admin.products.create');
        Route::post('/', 'ProductController@store')->name('admin.products.store');
        Route::get('/{product}/edit', 'ProductController@edit')->name('admin.products.edit');
        Route::patch('/{product}', 'ProductController@update')->name('admin.products.update');
        Route::delete('/{product}', 'ProductController@destroy')->name('admin.products.destroy');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.users.index');
        Route::get('/create', 'UserController@create')->name('admin.users.create');
        Route::post('/', 'UserController@store')->name('admin.users.store');
        Route::delete('/{user}', 'UserController@destroy')->name('admin.users.destroy');
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.categories.index');
        Route::get('/create', 'CategoryController@create')->name('admin.categories.create');
        Route::post('/', 'CategoryController@store')->name('admin.categories.store');
        Route::get('/{category}/edit', 'CategoryController@edit')->name('admin.categories.edit');
        Route::patch('/{category}', 'CategoryController@update')->name('admin.categories.update');
        Route::delete('/{category}', 'CategoryController@destroy')->name('admin.categories.destroy');
    });

    Route::group(['namespace' => 'Order', 'prefix' => 'orders'], function () {
        Route::get('/', 'OrderController@index')->name('admin.orders.index');
        Route::get('/{order}/show', 'OrderController@show')->name('admin.orders.show');
        Route::patch('/{order}', 'OrderController@update')->name('admin.orders.update');
        Route::patch('/', 'OrderController@sent')->name('admin.orders.sent');
        Route::delete('/{order_details}', 'OrderController@destroy')->name('admin.orders.delete');
    });

});

Route::group(['namespace'=>'App\Http\Controllers\User', 'prefix'=>'users', 'middleware'=>'auth'], function (){
    Route::get('/account', 'UserController@account')->name('users.account');
    Route::patch('/{user}', 'UserController@update')->name('users.update');
});

Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');
Route::group(['namespace'=>'App\Http\Controllers', 'prefix'=>'orders'], function (){
    Route::post('/{product}', 'OrderController@store')->name('orders.store');
    Route::post('/', 'OrderController@storeGuest')->name('orders.store_guest');
    Route::get('/basked_auth', 'OrderController@baskedAuth')->name('orders.basked_auth');
    Route::patch('/{order}', 'OrderController@update')->name('orders.update');
    Route::get('/basked_guest', 'OrderController@baskedGuest')->name('orders.basked_guest');
    Route::delete('/{order_details}', 'OrderController@destroy')->name('orders.destroy');
    Route::get('/{order_details}', 'OrderController@edit')->name('orders.edit');
    Route::patch('/{product}/{order_details}', 'OrderController@updateQuantity')->name('orders.update_quantity');
});


Route::group(['namespace'=>'App\Http\Controllers\Product', 'prefix'=>'products'], function (){
    Route::get('/{product}/show', 'ProductController@show')->name('products.show');
    Route::get('/{category}/show_products', 'ProductController@show_products')->name('products.show_products');
});

Route::group(['namespace'=>'App\Http\Controllers', 'prefix'=>'likes'], function (){
    Route::post('/{product}', 'LikeController@store')->name('likes.store');
});

Route::post('/', function (\Illuminate\Http\Request $request){
   if($request->ajax()){
        $id=$request->id;
        $product=\App\Models\Product::where('id', $id)->first();
        $reviews_count=$product->reviews_count+1;
        $product->update([
            'reviews_count'=>$reviews_count
        ]);
   }
})->name(name:'reviewsCount');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

