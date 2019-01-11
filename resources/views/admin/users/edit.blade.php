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
      <a href="">Danh sách tài khoản </a>
  </li>
</ul>
<div class="row-fluid sortable">
<div class="box span12">
    @include('admin.layout.errors')
    <div class="box-header" data-original-title>
        <h2><i class="icon-plus-sign-alt"></i> <span class="break"></span>Thông tin thành viên</h2>
        <div class="box-icon">
            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <fieldset>
          <legend style="font-size: 18px;">Thông tin tài khoản</legend>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Tên đăng nhập </label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtUserName" value="{{$user->name}}" disabled >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Email</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="txtEmail" value="{{$user->email}}" disabled="">
                </div>
            </div>
            <div class="control-group">
               
                <label class="control-label" for="focusedInput">Mật khẩu</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="password" name="txtPass" value="$user->password">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Xác nhận mật khẩu</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="password" name="txtRePass" value="$user->password">
                </div>
               
            </div>
            <div class="control-group">
          
              <label class="control-label">Level</label>
              <div class="controls" >
                <label class="radio" style="float: left;" >
                <input type="radio" name="rdoLevel" id="optionsRadios1" value="1" checked=""
                @if($user->level ==1)
                  checked="checked"
                @endif
                > 
                Quản trị
                </label>
              </div>
              <div class="controls">
                <label class="radio" style="float: left;">
                  <input type="radio" name="rdoLevel" id="optionsRadios2" value="2"
                  @if($user->level ==2)
                    checked="checked"
                  @endif
                  >
                  Thành viên
                </label>
              </div>
            </div>
            <div class="control-group">
            <label class="control-label">Trạng thái tài khoản</label>
            <div class="controls" >
              <label class="radio" style="float: left;" >
              <input type="radio" name="rdoStatus" id="optionsRadios1" value="1" checked=""
              @if($user->status ==1)
                checked="checked"
              @endif
              > Hoạt động
              </label>
            </div>
            <div class="controls">
              <label class="radio" style="float: left;">
                <input type="radio" name="rdoStatus" id="optionsRadios2" value="2"
                @if($user->status ==2)
                  checked="checked"
                @endif
                >
                Khóa
              </label>
            </div>
          </div>
       
          </fieldset>
          <hr>
        
            <fieldset>
              <legend style="font-size: 18px;">Thông tin chi tài khoản</legend>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Họ và tên</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" name="txtName" value="{{old ('txtName',isset($user->UserDetail->name) ? $user->UserDetail->name : null)}}">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Ngày sinh</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" name="txtBirthday" value="{{old ('txtName',isset($user->UserDetail->birthday) ? $user->UserDetail->birthday : null)}}">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Điện thoại</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" name="txtTel" value="{{old ('txtName',isset($user->UserDetail->tel) ? $user->UserDetail->tel : null)}}">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Email</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" name="txtEmails" value="{{ old ('txtName',isset($user->UserDetail->email) ? $user->UserDetail->email : null)}}">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Địa chỉ</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" name="txtAddress" value="{{ old ('txtName',isset($user->UserDetail->address) ? $user->UserDetail->address : null)}}">
                  </div>
              </div>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Thành phố</label>
                  <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" name="txtCity" value="{{old ('txtName',isset($user->UserDetail->city) ? $user->UserDetail->city : null)}}">
                  </div>
              </div>
            </fieldset>
      
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            <button type="reset" class="btn">Hủy</button>
          </div>
        </form>  
    </div>
</div><!--/span-->
</div><!--/row-->
@endsection