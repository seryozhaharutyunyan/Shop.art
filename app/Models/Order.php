<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $guarded=false;
    public $timestamps=false;

    public function order_details(){
        return $this->hasMany(OrderDetails::class, 'id', 'order_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
