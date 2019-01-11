@extends('admin.layout.index')
@section('content')
<ul class="breadcrumb">
  <li>
      <i class="icon-home"></i>
      <a href="">Trang chủ</a>
      <i class="icon-angle-right"></i> 
  </li>
  <li>
      <i class="fa fa-th" aria-hidden="true"></i>
      <a href="">Danh sách sản phẩm </a>
  </li>
</ul>
<div class="row-fluid sortable">
<div class="box span12">
    @include('admin.layout.errors')
    <div class="box-header" data-original-title>
        <h2><i class="icon-plus-sign-alt"></i> <span class="break"></span>Trình sửa sản phẩm</h2>
        <div class="box-icon">
            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <form id="contain" class="form-horizontal" action="" method="POST" enctype="multipart/form-data" name="fProductDetail" >
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <fieldset>
          <legend style="font-size: 18px;">Thông tin sản phẩm</legend>
            <div class="control-group">
              <label class="control-label" for="typeahead">Danh mục sản phẩm</label> 
              <div class="controls">
                <select data-placeholder="Lựa chọn danh mục"  data-rel="chosen" name="sltParent">
                    <option value=""></option>
                    <?php cat_parent($cats,0,"--",$product['cat_id']) ?>
                </select>
              </div>  
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Tên sản phẩm</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtProductName" value="{{ old('txtProductName',isset($product) ? $product['name'] : null )}}">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giá nhập sản phẩm</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtCost" value="{{ old('txtCost',isset($product) ? $product['cost'] :null )}}">
                </div>
            </div>
            <div class="control-group" >
              <label class="control-label">Hình ảnh hiện tại </label>
              <div class="controls" style="width: 26%;">
                <img src="{{ asset('resources/upload/'.$product['image'])}}">
                <input type="hidden" name="img_current" value="{{ $product['image'] }}">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Hình ảnh sản phẩm</label>
              <div class="controls">
                <input type="file" name="fImages">
              </div>
            </div>
          </fieldset>
          <hr>
          <fieldset>
            <legend style="font-size: 18px;">Thông tin chi tiết sản phẩm</legend>
               <form action="" class="form-group" >
                <fieldset>
                  @if($product_count == 0)
                    <legend  style="width: 25%;font-size: 14px;text-align: center;">Sản phẩm chưa có hình ảnh chi tiết</legend>
                  @else
                  <legend style="width: 20%;font-size: 14px;text-align: center;">Hình ảnh chi tiết hiện tại</legend>
                  <div class="control-group"  >
                    @foreach($product_image as $key => $item)
                      <div class="controls" id="{{$key }}" style="width: 20%;margin-bottom: 3px;float: left;margin: 0 auto;" >
                         <img src="{{ asset('resources/upload/detail/'.$item['image'])}}" idPic="{!! $item['id'] !!}" id="{{ $key }}" style="width: 215px;height: 143px;">
                         <a href="javascript:void(0)" type="button"  id="del_img_detail" class="btn btn-danger btn-circle btn-lg " style="position: relative;top:-142px;left: 175px;"><i class="icon-remove-sign " style="display: block;"></i></a>
                      </div>
                    @endforeach
                  </div>
                  @endif
                </fieldset>
              </form>
         
            <div class="control-group" >
              <label class="control-label">Hình ảnh chi tiết</label>
              <div class="controls">
                <input type="file" name="fProductDetail[]"  multiple>
              </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giá bán</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtUnit_price" value="{{ old('txtUnit_price',isset($product_detail) ? $product_detail['unit_price'] :null ) }}">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giá khuyễn mãi</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtPromotion_price" value="{{ old('txtPromotion_price',isset($product_detail) ? $product_detail['promotion_price'] : null ) }}">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giới thiệu</label>
                <div class="controls" style="width: 55%;">
                  <textarea class="form-control"   name="txtIntro">{{ old('txtIntro',isset($product_detail) ? $product_detail['intro'] : null)}}</textarea>
                  <script type="text/javascript"> ckeditor("txtIntro") </script>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Nội dung</label>
                <div class="controls" style="width: 55%;">
                  <textarea class="form-control"  name="txtContent">{{ old('txtContent',isset($product_detail) ? $product_detail['content'] : null )}}</textarea>
                  <script type="text/javascript"> ckeditor("txtContent") </script>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Từ khóa</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtKeywords" value="{{ old('txtKeywords',isset($product_detail) ? $product_detail['keywords'] : null)}}">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Mô tả</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtDescription" value="{{ old('txtDescription',isset($product_detail) ? $product_detail['description'] : null)}}">
                </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
              <button type="reset" class="btn">Hủy</button>
            </div>
          </fieldset>
        </form>  
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js"></script>
   <script>

           var socket=io('http://localhost:6001')
            $('#contain').on('submit', (e) => {
                socket.emit('productchange', {
                    id:"{{$id}}",
                    name : $('[name=txtProductName]').val(),
                    price: $('[name=txtUnit_price]').val(),
                    pricepromotion :$('[name=txtPromotion_price]').val(),
                    img :$('[name=img_current]').val()
                });
                console.log("check");
            });

    </script> 
</div><!--/span-->
</div><!--/row-->
@endsection