<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\UserDetail;
use App\Orders;
use Hash;
class UserController extends Controller
{
	public function getDanhSach()
	{
		$User = User::all();
    	return view('admin.users.list',['user'=>$User]);
	}
	public function getThemDanhSach()
	{
    	return view('admin.users.add');
	}
	public function postThemDanhSach(Request $request)
	{
    	$this->validate($request,
            [
                'txtUserName'=>'required',
                'txtEmail'=>'required',
                'txtPass'=>'required',
                'txtRePass'=>'required',
               
            ],
            [
                'txtUserName.required'=>'Bạn Chưa Nhập Tên Đăng Nhập',
                'txtEmail.required'=>'Bạn Chưa Nhập Email',
                'txtPass.required'=>'Bạn Chưa Nhập Pass',
                'txtRePass.required'=>'Bạn Chưa Nhập Pass Xác Nhận',
               
            ]);
        $user = new User;
        $user->name=$request->txtUserName;
        $user->email=$request->txtEmail;
        $user->password= Hash::make($request->txtPass);
        $user->level=$request->rdoLevel;
        $user->status=1;
        $user->remember_token = $request->_token;
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
        if($request->txtPass != $request->txtRePass)
    	{
    		return redirect('admin/user/add')->with('errors','Bạn đã nhập sai mật khẩu');
    	}
        return redirect('admin/user/add')->with('flash_message','Bạn đã thêm tài khoản thành công');
	}
	public function getXoa($id)
    {
      $user = User::find($id);
      $user->delete();
        return redirect('admin/user/list')->with('flash_message','Bạn Đã xóa thành công');
    }
    public function getdetail($id)
    {
      $user = User::find($id);
      return view('admin.users.details',['user'=>$user]);
    }
    public function getedit($id)
    {
      $user = User::find($id);
      return view('admin.users.edit',['user'=>$user]);
    }
    public function postedit($id,Request $request)
    {   
    	$user = User::find($id);
    	if ($request->txtPass) {
    		$user->password =Hash::make($request->txtPass);
    	}
    
    	if ($request->rdoLevel) {
    		$user->level =$request->rdoLevel;
    	}
		if ($request->rdoStatus) {
    		$user->status =$request->rdoStatus;
    	}
		$user->remember_token =$request->_token;
		$user->save();
		
		$userdetail = User::find($id)->UserDetail;
		if (!empty($userdetail)) {
			if ($request->txtName == "") {
            $userdetail->name = "";
	        }
	        else{
	            $userdetail->name =$request->txtName;
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
	            $userdetail->tel =  $request->txtTel;
	        }
			if ($request->txtEmails == "") {
	            $userdetail->email = "";
	        }
	        else{
	            $userdetail->email =  $request->txtEmails;
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
	            $userdetail->city =  $request->txtCity;
	        }
			$userdetail->save();
		}
		
      return redirect('admin/user/list')->with('flash_message','Bạn Đã sửa thành công');
    }

    
  
}
