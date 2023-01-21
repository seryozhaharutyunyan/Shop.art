<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='products';
    protected $guarded=false;
    public $timestamps=false;
    protected $withCount=['likeUsers'];


    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'product_user_likes', 'product_id', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(ProductUserLike::class,  'product_id', 'id');
    }



}
