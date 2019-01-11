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
      <a href="{{ url ('/admin/cats/list')}}">Danh mục sản phẩm </a>
  </li>
</ul>
<div class="row-fluid sortable">
<div class="box span12">
    @include('admin.layout.errors')
    <form class="form-horizontal" action="add" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="box-header" data-original-title>
        <h2><i class="icon-plus-sign-alt"></i> <span class="break"></span>Thêm mới danh mục</h2>
        <div class="box-icon">
            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="typeahead">Danh mục sản phẩm</label> 
              <div class="controls">
                <select data-placeholder="Lựa chọn danh mục"  data-rel="chosen" name="sltParent">
                    <option value="0">Lựa chọn danh mục</option>
                    <?php cat_parent($parent); ?>
                </select>
              </div>  
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Tên danh mục</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtCatName">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Từ khóa</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtKeywords">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" >Mô tả</label>
                <div class="controls">
                  <textarea class="form-control" rows="6" cols="50" name="txtDescription"></textarea>
                </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Thêm danh mục</button>
              <button type="reset" class="btn">Hủy</button>
            </div>
        
        </form>   

    </div>
    </form>
</div><!--/span-->
</div><!--/row-->
@endsection