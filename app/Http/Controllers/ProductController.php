<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Input;
use File;
use App\Products;
use App\Categorys;
use App\Product_images;
use App\Product_details;
use App\User;

use Request;
use Auth;
use Session;

class ProductController extends Controller
{
    public function getAdd(){
    	$cats = Categorys::select('name','id','parent_id')->get()->toArray();
    	return view ('admin.products.add',compact('cats'));
    }
   public function postAdd(Request $request){
     
        $file_name = $request::file('fImages')->getClientOriginalName(); 
        $product = new Products();
        $product->name=Request::input('txtProductName');
        $product->alias=changeTitle(Request::input('txtProductName'));
        $product->cost=Request::input('txtCost');
        $product->image=$file_name;
        $product->user_id = Auth::user()->id;
        $product->cat_id=Request::input('sltParent');
        $request::file('fImages')->move('resources/upload/',$file_name);
        $product->save();

        $product_id = $product->id;

        if (Input::hasFile('fProductDetail')) {
            foreach (Input::file('fProductDetail') as $file) {
                $product_image = new Product_images();
                if (isset($file)) {
                    $product_image->image=$file->getClientOriginalName();
                    $product_image->product_id = $product_id;
                    $file->move('resources/upload/detail/',$file->getClientOriginalName());
                    $product_image->save();
                }
            }
        }

        $product_details = new Product_details();
        $product_details->product_id = $product_id;
           if (Request::input('txtUnit_price') == "") {
            $product_details->unit_price = 0;
        }
        else{
            $product_details->unit_price=Request::input('txtUnit_price');
        }
        if (Request::input('txtPromotion_price') == "") {
            $product_details->promotion_price = 0;
        }
        else{
            $product_details->promotion_price = Request::input('txtPromotion_price');
        }
        if (Request::input('txtIntro') == "") {
            $product_details->intro = "";
        }
        else{
            $product_details->intro = Request::input('txtIntro');
        }
        if (Request::input('txtContent') == "") {
            $product_details->content = "";
        }
        else{
            $product_details->content = Request::input('txtContent');
        }
        if (Request::input('txtKeywords') == "") {
            $product_details->keywords = "";
        }
        else{
            $product_details->keywords = Request::input('txtKeywords');
        }
        if (Request::input('txtDescription') == "") {
            $product_details->description = "";
        }
        else{
            $product_details->description = Request::input('txtDescription');
        }
        $product_details->view = 0;
        $product_details->save();

        return redirect('admin/products/list')->with(['flash_message'=>'Sản phẩm được thêm mới thành công !']);
    }
    public function getList(){
    	$data =Products::select('id','name','cost','cat_id','created_at')->orderBy('id','DESC')->get()->toArray();
            $User = User::all();
                 //return view('admin.users.list',['user'=>$User]);
                return view('admin.products.list',['user'=>$User],compact('data'));
    }
    public function getDelete($id){
    	// Rang buoc du lieu khi xoa product 
        // Ta xoa hinh truoc , xoa bang sau
        $product_image =  Product_images::where('product_id',$id);
        foreach ($product_image as  $value) {
            // Xoa hinh trong product_image
            File::delete('resources/upload/detail/'.$value['image']);
        }
        
        // Xoa du lieu trong bang productImages
        $product_images = Product_images::where('product_id',$id);
        $product_images->delete($product_image);

        // Xoa du lieu trong bang productDetails
        $product_detail = Products::find($id)->productDetails->toArray();
        $productDetails = Product_details::where('product_id',$id);
        $productDetails->delete($product_detail);

        $product = Products::find($id);
        // Xoa hinh trong product
        File::delete('resources/upload/'.$product->image);
        // Xoa du lieu trong bang Product
        $product->delete($id);
    	
    	return redirect('admin/products/list')->with(['flash_message'=>'Sản phẩm đã được xóa !']);
    }
    public function getEdit($id){
        $id=$id;
        $cats = Categorys::select('name','id','parent_id')->get()->toArray();
        $product = Products::find($id);
        $product_detail = Products::find($id)->productDetails->toArray();
        $product_image = Products::find($id)->productimages->toArray();
        $product_images = Products::find($id)->productimages;
        $product_count = $product_images->count();
        return view('admin.products.edit',compact('cats','product','product_detail','product_image','product_count','id'));
    }
    public function postEdit($id ,Request $request){
        
        $product = Products::find($id);
        $product->name=Request::input('txtProductName');
        $product->alias=changeTitle(Request::input('txtProductName'));
        $product->cost=Request::input('txtCost');
        $product->user_id = 1;
        $product->cat_id=Request::input('sltParent');
        $img_current = 'resources/upload/'.Request::input('img_current');
        if (!empty(Request::file('fImages'))) {
            $file_name = Request::file('fImages')->getClientOriginalName();
            $product->image = $file_name;
            Request::file('fImages')->move('resources/upload/',$file_name);
            if (File::exists($img_current)) {
                File::delete($img_current);
            }
        }
        else{
            echo "Không có file";
        }
        $product->save();

        $product_details = Products::find($id)->productDetails;
        if (Request::input('txtUnit_price') == "") {
            $product_details->unit_price = 0;
        }
        else{
            $product_details->unit_price=Request::input('txtUnit_price');
        }
        if (Request::input('txtPromotion_price') == "") {
            $product_details->promotion_price = 0;
        }
        else{
            $product_details->promotion_price = Request::input('txtPromotion_price');
        }
        if (Request::input('txtIntro') == "") {
            $product_details->intro = "";
        }
        else{
            $product_details->intro = Request::input('txtIntro');
        }
        if (Request::input('txtContent') == "") {
            $product_details->content = "";
        }
        else{
            $product_details->content = Request::input('txtContent');
        }
        if (Request::input('txtKeywords') == "") {
            $product_details->keywords = "";
        }
        else{
            $product_details->keywords = Request::input('txtKeywords');
        }
        if (Request::input('txtDescription') == "") {
            $product_details->description = "";
        }
        else{
            $product_details->description = Request::input('txtDescription');
        }
        $product_details->view = 0;
        $product_details->save();

        if (!empty(Request::file('fProductDetail'))) {
            foreach (Request::file('fProductDetail') as $file) {
                $product_image = new Product_images();
                if (isset($file)) {
                   $product_image->image = $file->getClientOriginalName();
                   $product_image ->product_id= $id;
                   $file->move('resources/upload/detail/',$file->getClientOriginalName());
                   $product_image->save();
                }
            }
        }

        return redirect('admin/products/list')->with(['flash_message'=>'Sản phẩm sửa thành công !']);
    }

    public function getDetail($id){
        $data = Products::findOrFail($id)->toArray();
        $detail =  Products::find($id)->productDetails->toArray();
        $product_images = Products::find($id)->productimages;
        $product_count = $product_images->count();
        $product_image = Products::find($id)->productimages->toArray();
        return view('admin.products.details',compact('data','id','detail','product_count','product_image'));
    }
    public function getDelImg($id){
        $idPic = (int)Request::get('idPic');
        $image_detail = ProductImage::find($idPic);
        if (!empty($image_detail)) {
            $img = 'resources/upload/detail/'.$image_detail->image;
            if (File::exists($img)) {
                File::delete($img);
            }
            $image_detail->delete();
        }
        return "Oke";
    }
}
