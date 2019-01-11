<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categorys;
use Hash;
class CatsController extends Controller
{
	public function getDanhSach()
	{
		$cat = Categorys::all();
    	return view('admin.cats.list',['cat'=>$cat]);
	}
	public function getThemDanhSach()
	{
        $parent = Categorys::select('id','name','parent_id')->get()->toArray();
        return view('admin.cats.add',['parent'=>$parent]);
	}
	public function postThemDanhSach(Request $request)
	{
    	$cat = new Categorys;
        $cat->name = $request->txtCatName;
        $cat->alias = changeTitle($request->txtCatName);
        $cat->keyword = $request->txtKeywords;
        $cat->parent_id = $request->sltParent;
        $cat->description = $request->txtDescription;
        $cat->save();
        return redirect('admin/cats/list')->with(['flash_message'=>'Danh mục được thêm mới thành công !']);
	}
	public function getXoa($id)
    {
      $parent = Categorys::where('parent_id',$id)->count();
        // Kiểm tra , nếu danh mục sản phẩm
        if ($parent == 0) {
            $cat = Categorys::find($id);
            $cat->delete($id);
            return redirect('admin/cats/list')->with(['flash_message'=>'Danh mục đã được xóa !']);
        }else{
            echo "<script type='text/javascript'> 
                alert('Bạn không thể xóa mục này !');
                window.location = '";
                echo url ('/admin/cats/list');
            echo "'
            </script>";
        }
    }
    
    public function getedit($id)
    {
    	
    	$data = Categorys::findOrFail($id)->toArray();
        $parent =Categorys::select('id','name','parent_id')->get()->toArray();
        return view('admin.cats.edit',compact('parent','data','id'));   
    }
    public function postedit($id,Request $request)
    {   
    	$cat = Categorys::find($id);
        $cat->name = $request->txtCatName;
        $cat->alias = changeTitle($request->txtCatName);
        $cat->keyword = $request->txtKeywords;
        $cat->parent_id = $request->sltParent;
        $cat->description = $request->txtDescription;
        $cat->save();
        return redirect('admin/cats/list')->with(['flash_message'=>'Danh mục được sửa thành công !']);
    }

    
  
}
