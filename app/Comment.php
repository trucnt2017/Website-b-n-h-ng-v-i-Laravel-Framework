<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comment";
    protected $fillable = ['idUser','idProduct','content'];
    public function Products()
    {
        return $this->belongsTo('App\Products','id','idProduct');
    }	
    public function User()
    {
       	return $this->belongsTo('App\User','id','idUser');
    }
}
