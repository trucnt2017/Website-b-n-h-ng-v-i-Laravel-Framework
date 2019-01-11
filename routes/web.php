<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('Layout.index.test');
});
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@getDanhSach');
		Route::get('add','UserController@getThemDanhSach');
		Route::post('add','UserController@postThemDanhSach');
		Route::get('xoa/{id}','UserController@getXoa');
		Route::get('detail/{id}','UserController@getdetail');
		Route::get('edit/{id}','UserController@getedit');
		Route::post('edit/{id}','UserController@postedit');
	});
		Route::group(['prefix'=>'cats'],function(){
		Route::get('list','CatsController@getDanhSach');
		Route::get('edit/{id}','CatsController@getedit');
		Route::post('edit/{id}','CatsController@postedit');
		Route::get('xoa/{id}','CatsController@getXoa');
		Route::get('add','CatsController@getThemDanhSach');
		Route::post('add','CatsController@postThemDanhSach');
	});
		Route::group(['prefix'=>'products'],function(){
		Route::get('add','ProductController@getAdd');
		Route::post('add','ProductController@postAdd');
		Route::get('list','ProductController@getList');
		Route::get('delete/{id}',['as'=>'admin.products.getDelete','uses'=>'ProductController@getDelete']);
		Route::get('edit/{id}',['as'=>'admin.products.getEdit','uses'=>'ProductController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.products.postEdit','uses'=>'ProductController@postEdit']);
		Route::get('detail/{id}',['as'=>'admin.products.getDetail','uses'=>'ProductController@getDetail']);
		Route::get('delimg/{id}',['as'=>'admin.products.getDelImg','uses'=>'ProductController@getDelImg']);
	});

});
Route::group(['prefix'=>'trangchu'],function(){
	Route::get('home','HomeController@getDanhSach');
	Route::get('dress','DressController@getDanhSach');
});
Route::get('chi-tiet-san-pham/{id}/{tenloai}',['as'=>'chitietsanpham','uses'=>'HomeController@chitietsanpham']);
Route::post('comment/{id}','HomeController@comment');
Route::post('message','HomeController@message');
Route::post('abc','HomeController@comment1');
Route::get('dangnhap',['as'=>'getDangNhap','uses'=>'HomeController@getDangNhap']);
Route::post('dangnhap',['as'=>'postDangNhap','uses'=>'HomeController@postDangNhap']);
Route::get('dangky',['as'=>'getDangKy','uses'=>'HomeController@getDangKy']);
Route::post('dangky',['as'=>'postDangKy','uses'=>'HomeController@postDangKy']);
Route::get('dangxuat',['as'=>'getDangXuat','uses'=>'HomeController@getDangXuat']);
Route::post('cartproduct','CartController@getproduct');
Route::post('delproduct','CartController@delproduct');
Route::post('quantityproduct','CartController@quantityproduct');
Route::get('checkout','HomeController@checkout');
Route::post('timkiem','HomeController@timkiem');
Route::get('timkiem/{key}','HomeController@timkiem');
Route::get('product','HomeController@getsanpham');