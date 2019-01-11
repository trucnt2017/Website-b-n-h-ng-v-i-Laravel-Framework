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
use Session;
use Hash;
use Auth;
use App\Events\RedisEvent;
class HomeController extends Controller
{
    function __construct()
    {
        $message=Messages::all();
        view()->share('message',$message);
        $user=User::all();
        view()->share('user',$user);
     
    }
	public function getDanhSach()
	{
		$product = DB::table('Products')->select('id','name','image','cost','alias')->orderBy('id','DESC')->paginate(8);
        $mostview = DB::table('Product_details')->orderBy('view','DESC')->skip(0)->take(8)->get();
        $vi=$this->test(1);
        $aosomi=$this->test(2);
        $aothun=$this->test(3);
        $giay=$this->test(4);
        $thatlung=$this->test(5);
		return view('Layout.index.content',compact('product','mostview','vi','aosomi','aothun','giay','thatlung'));
	}
    public function test($value)
    {
        $loaisanpham= DB::table('categorys')->select(array('id'))->where('id',$value)->orWhere('parent_id',$value);
        $product_cats = DB::table('products')->whereIn('cat_id',$loaisanpham)->get();
        return $product_cats;
    }

	 public function chitietsanpham($id){
        $id=$id;
        
        $product = DB::table('Products')->where('id',$id)->first();
        $product_image = DB::table('Product_images')->select('id','image')->where('product_id',$product->id)->get();
        $product_detail =DB::table('Product_details')->where('product_id',$product->id)->first();
       
        $loaisanpham1= DB::table('categorys')->where('id',$product->cat_id)->first();
        if( $loaisanpham1->parent_id==0)
        {
            $loaisanpham= DB::table('categorys')->select(array('id'))->where('id',$loaisanpham1->id)->orWhere('parent_id',$loaisanpham1->id);
        }
        else
        {
            $loaisanpham= DB::table('categorys')->select(array('id'))->where('id',$loaisanpham1->parent_id)->orWhere('parent_id',$loaisanpham1->parent_id);
        }
      
        $product_cats = DB::table('products')->whereIn('cat_id',$loaisanpham)->get();

        if(! ( Session::get('id') == $id)){
            Product_details::where('product_id', $product->id)->increment('view');
            return view ('Layout.index.singleproduct',compact('id','product','product_image','product_detail','product_cats','loaisanpham'));
            Session::put('id', $id);
          }
    }


    public function getDangNhap(){
         //return redirect('trangchu/home');
         phpinfo();
         return back();

    }


    public function postDangNhap(Request $request){
        $login = array(
            'name' => $request->name,
            'password' => $request->password
        );
        if (Auth::attempt($login) && Auth::user()->status ==1   ) 
        {
            if(Auth::user()->level ==1 ){

               $User = User::all();
                 return redirect()->back();
                 
            }
            else{
                if(Auth::user()->level ==2)
                {
                    return redirect()->back();
                }
            }
               
        }
        else{
            if (Auth::attempt($login) && Auth::user()->status !=1) {
                return Redirect()->route('getBlockUser');
            }
            else{
                return redirect()->back();
            }
        }    
    }

    
    public function getDangKy(){
        $product = DB::table('Products')->select('id','name','image','cost','alias')->orderBy('id','DESC')->paginate(8);
        $categorys=DB::table('Categorys')->select('id')->where('id',11)->get();
        $shirt=DB::table('Products')->where('cat_id',1)->get();
        $mostview = DB::table('Product_details')->orderBy('view','DESC')->skip(0)->take(8)->get();
        return view('Layout.index.content',compact('product','mostview','shirt'));
        //return view('Layout.index.content');
    }


    // public function postDangKy(Request $request)
    // {
    //    return $request->url();
    // }
    
    public function postDangKy(Request $request){
        
        $user = new User();
        if ($request->input('txtPasss')) {
            $this->validate($request,
                [
                    'txtUserNames' => 'unique:users,name',
                    'txtRePasss'=>'same:txtPasss',
                    'txtEmails' => 'required|unique:users,email|regex:/^[a-z][a-z0-9]*(_[a-z0-9]+)*(\.[a-z0-9]+)*@[a-z0-9]([a-z0-9][a-z0-9]+)*(\.[a-z]{2,4}){1,2}$/ '
                ],
                [
                    'txtRePasss.same' => 'Xác nhận mật khẩu chưa đúng . ',
                    'txtEmails.regex'=> "Email không đúng định dạng " ,
                    'txtUserNames.unique' => "Tài khoản đã tồn tại "
                ]);
                $pass = $request->input('txtPasss');
                $user->password = Hash::make($pass);
        }
        $user->name = $request->txtUserNames;
        $user->email = $request->txtEmails;
        $user->level = 2;
        $user->status = 1;
        $user->remember_token = $request->input('_token');
        $user->save();

        $order=new Orders;
		$order->user_id=$user->id;
		$order->status=1;
		$order->payment_id=1;
        $order->save();
        
        $userdetail = new UserDetail;
        $userdetail->user_id=$user->id;
        if ($request->txtName == "") {
    		$userdetail->name = "";
    	}
    	else{
    		$userdetail->name = $request->txtName;
    	}
    	if ($request->txtBirthday == "") {
    		$userdetail->birthday = "";
    	}
    	else{
    		$userdetail->birthday = $request->txtBirthday;
    	}
    	if ($request->txtTel == "") {
    		$userdetail->tel = "";
    	}
    	else{
    		$userdetail->tel = $request->txtTel;
    	}
    	if ($request->txtEmails == "") {
    		$userdetail->email = "";
    	}
    	else{
    		$userdetail->email = $request->txtEmails;
    	}
    	if ($request->txtAddress == "") {
    		$userdetail->address = "";
    	}
    	else{
    		$userdetail->address = $request->txtAddress;
    	}
    	if ($request->txtCity == "") {
    		$userdetail->city = "";
    	}
    	else{
    		$userdetail->city = $request->txtCity;
    	}
    	$userdetail->save();
        return redirect()->back()->with(['flash_message'=>'Đăng ký thành công !. Bạn hãy đăng nhập!']);
    }
    
    public function getDangXuat(){
        Auth::logout();
        return redirect()->back();      
    } 


    public function getBlockUser(){
        return view('userblock');
    }
    public function comment($id,Request $request)
    {
       
        $comment= new Comment;
        $comment->idUser =Auth::user()->id;
        $comment->idProduct= $id;
        $comment->content= $request->Review;
        $comment->save();
        return back();
    }     
    public function comment1(Request $request)
    {
        $content=$request->request->get('content');
        $idproduct=$request->request->get('id');
        $comment= new Comment;
        $comment->idUser =Auth::user()->id;
        $comment->idProduct= $idproduct;
        $comment->content= $content;
        $comment->save();
        return $comment;
        
       
      
    }    
     public function message(Request $request)
    {
        $content=$request->request->get('content');
        $id=$request->request->get('id');
        if(Auth::user()->id!=1)
        {
        $message= new Messages;
        $message->content=$content;

        $message->idMe=Auth::user()->id;
        $message->idSent=1;
        $message->save();
        }
        else
        {
        $message= new Messages;
        $message->content=$content;
        $message->idMe=Auth::user()->id;
        $message->idSent= $id;
        $message->save();
        }
      
        return $message;
    }    
    public function checkout()
    {
    
      return view('Layout.checkout.checkout');
    } 
    public function timkiem(Request $Request)
    {
        $tukhoa=$Request->tukhoa;
        $mostview = DB::table('Product_details')->orderBy('view','DESC')->skip(0)->take(8)->get();
        $product_detail=DB::table('product_details')->where('keywords','like',"%$tukhoa%")->orwhere('unit_price','like',"%$tukhoa%")->orwhere('promotion_price','like',"%$tukhoa%")->take(30)->paginate(5);
    	return view('Layout.index.search',['tukhoa'=>$tukhoa,'product_detail'=>$product_detail,'mostview'=>$mostview]);
    }   
    public function getsanpham()
    {
      return view('Layout.index.product');
    } 
    
}
