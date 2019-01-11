<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_details extends Model
{
    protected $table = 'product_details';
    protected $fillable = ['unit_price','promotion_price','intro','content','keywords','description','view','product_id'];

    public function Product(){
    	return $this->belongTo('App\Product','id','product_id');
    }
}
