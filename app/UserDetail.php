<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table="user_details";
    protected $fillable = ['name','birthday','tel','email','address','city','user_id'];

    public function User(){
    	return $this->belongTo('App\User');
    }
}
