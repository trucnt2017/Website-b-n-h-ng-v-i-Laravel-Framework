<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['name','alias','cost','image','user_id','cat_id'];

    public function Cat(){
        return $this->belongTo('App\Cat','id','cat_id');
    }
    public function User(){
        return $this->belongTo('App\User');
    }
    public function productImages(){
        return $this->hasMany('App\Product_images','product_id','id');
    }
    public function productDetails(){
        return $this->hasOne('App\Product_details','product_id','id');
    }
    public function Comment()
    {
        return $this->hasmany('App\Comment','idProduct','id');
    }
}
