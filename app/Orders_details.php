<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders_details extends Model
{
    protected $table="order_details";
    protected $fillable=['price','quantity','total','note','product_id','order_id'];
    public function Orders(){
    	return $this->belongTo('App\Orders_details','id','order_id');
    }
}
