<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class DressController extends Controller
{
	public function getDanhSach()
	{
		 return view('Layout.dress.dress');
	}
  
}
