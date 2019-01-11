<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table="orders";
    protected $fillable=['status','user_id','payment_id'];
    public function ordersdetails(){
        return $this->hasOne('App\Orders_details','order_id','id');
    }
}
