<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Categorys;
use App\Products;
use DB;
use App\Product_images;
use App\Product_details;
use App\UserDetail;
use App\Comment;
use App\Messages;
use App\Orders;
use App\Orders_details;
use Session;
use Hash;
use Auth;
class CartController extends Controller
{
    public function getproduct(Request $request)
    {
        $price_product=$request->request->get('price_product');
        $id_product=$request->request->get('id_product');
        $ordertest=DB::table('orders')->select('id','user_id')->where('user_id',Auth::user()->id)->first();
        if($ordertest==null)
        {
            $orders= new Orders;
            $orders->status=1;
            $orders->user_id=Auth::user()->id;
            $orders->payment_id=1;
            $orders->save();
            $order_id=$orders->id;
        }
        else
        {
            $order_id=$ordertest->id;
        }
       
        

        $checkproduct=DB::table('order_details')->select('id')->where('product_id',$id_product)->first();
        if($checkproduct==null)
        {
            $Orders_details= new Orders_details;
            $Orders_details->order_id=$order_id;
            $Orders_details->price=$price_product;
            $Orders_details->product_id=$id_product;
            $Orders_details->quantity=1;
            $Orders_details->total=$price_product;
            $Orders_details->note="";
            $Orders_details->save();
        }
        else
        {
            $Orders_details = Orders_details::find($checkproduct->id);
            $Orders_details->quantity= (int)$Orders_details->quantity+1;
            $Orders_details->total= (int)$Orders_details->total+  (int)$price_product;
            $Orders_details->save();
    
        }
       
      
        return ;
    }    
    public function delproduct(Request $request)
    {
        $id_product=$request->request->get('id_product');
        $checkproduct=DB::table('order_details')->select('id')->where('product_id',$id_product)->first();
        $checkproduct->id;
        $Orders_details = Orders_details::find($checkproduct->id);
        $Orders_details->delete($checkproduct->id);
        return ;
    }

    public function quantityproduct(Request $request)
    {
        $id_product=$request->request->get('id_product');
        $quantity=$request->request->get('quantity');
        $checkproduct=DB::table('order_details')->select('id')->where('product_id',$id_product)->first();
        $Orders_details = Orders_details::find($checkproduct->id);
        $Orders_details->quantity= $quantity;
        $Orders_details->total= (int)$quantity*(int)$Orders_details->price;
        $Orders_details->save();
        return ;
    }
    
  
}
