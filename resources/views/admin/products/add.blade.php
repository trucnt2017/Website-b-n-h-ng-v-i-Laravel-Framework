@extends('admin.layout.index')
@section('content')
<ul class="breadcrumb">
  <li>
      <i class="icon-home"></i>
      <a href="{{ url ('/')}}">Trang chủ</a>
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
        <h2><i class="icon-plus-sign-alt"></i> <span class="break"></span>Thêm mới sản phẩm</h2>
        <div class="box-icon">
            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <form class="form-horizontal" action="add" method="POST" enctype="multipart/form-data" id="contain">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <fieldset>
          <legend style="font-size: 18px;">Thông tin sản phẩm</legend>
            <div class="control-group">
              <label class="control-label" for="typeahead">Danh mục sản phẩm</label> 
              <div class="controls">
                <select data-placeholder="Lựa chọn danh mục"  data-rel="chosen" name="sltParent">
                    <option value=""></option>
                    <?php cat_parent($cats,0,"--",old('sltParent')); ?>
                </select>
              </div>  
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Tên sản phẩm</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtProductName" value="{!! old('txtProductName') !!}">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giá nhập sản phẩm</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtCost" value="{!! old('txtCost') !!}">
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">Hình ảnh sản phẩm</label>
              <div class="controls">
                <input type="file" name="fImages" value="{!! old('fImages') !!}">
              </div>
            </div>
          </fieldset>
          <hr>
          <fieldset>
            <legend style="font-size: 18px;">Thông tin chi tiết sản phẩm</legend>
            <div class="control-group">
              <label class="control-label">Hình ảnh chi tiết</label>
              <div class="controls">
                <input type="file" name="fProductDetail[]"  multiple>
              </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giá bán</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtUnit_price" value="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giá khuyễn mãi</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtPromotion_price" value="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giới thiệu</label>
                <div class="controls" style="width: 55%;">
                  <textarea class="form-control"   name="txtIntro"></textarea>
                  <script type="text/javascript"> ckeditor("txtIntro") </script>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Nội dung</label>
                <div class="controls" style="width: 55%;">
                  <textarea class="form-control"  name="txtContent"></textarea>
                  <script type="text/javascript"> ckeditor("txtContent") </script>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Từ khóa</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtKeywords" value="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Mô tả</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtDescription" value="">
                </div>
            </div>
          </fieldset>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <button type="reset" class="btn">Hủy</button>
          </div>
        </form>  
    </div>
</div><!--/span-->
</div><!--/row-->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js"></script>
   <script>
           var socket=io('http://localhost:6001')
            $('#contain').on('submit', (e) => {
                socket.emit('productadd', {
                    name : $('[name=txtProductName]').val(),
                    img :$('[name=fImages]').val(),
                    price: $('[name=txtUnit_price]').val(),
                    pricepromotion :$('[name=txtPromotion_price]').val(),
                    txtDescription:$('[name=txtDescription]').val(),
                    txtIntro:$('[name=txtIntro]').val(),
                    txtContent:$('[name=txtContent]').val(),
                    txtKeywords:$('[name=txtKeywords]').val()
                });
                console.log("check");
            });

    </script> 
@endsection