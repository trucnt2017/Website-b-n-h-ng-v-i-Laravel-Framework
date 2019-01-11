<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    protected $table = 'categorys';
    protected $fillable = ['name','alias','keyword','parent_id','description'];

    public function product(){
    	return $this->hasMany('App\Products','cat_id','id');
    }
}
