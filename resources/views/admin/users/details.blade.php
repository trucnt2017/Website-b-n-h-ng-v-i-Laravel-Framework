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
  <a href="{{ url ('/admin/user/list')}}">Danh sách tài khoản </a>
  <i class="icon-angle-right"></i>
</li>
<li>
	<i class="icon-plus-sign"></i>
	<a href="{{ url ('/admin/user/add')}}">Thêm mới tài khoản </a>
</li>
</ul>
<div class="row-fluid sortable">	
<div class="box span12">
	<div class="box-header">
		<h2 id="txtName"><i class="fa fa-info-circle" aria-hidden="true"></i><span class="break"></span>Thông tin chi tài khoản : {{$user->name}}</h2>
		<div class="box-icon">
			<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<fieldset>
			<table class="table table-bordered table-striped table-condensed">
				  <thead>
					  <tr>
						  <th>Tên tài khoản</th>
						  <th>Email</th>
						  <th style="text-align: center;">Level</th>
						  <th style="text-align: center;">Trạng thái</th>                                              
					  </tr>
				  </thead>   
				  <tbody>
					<tr>
						<td id="txtName">{{$user->name}}</td>
						<td class="center" id="txtEmail">
							{{ $user->email}}
						</td>
						<td class="center" id="rdoLevel" style="text-align: center;">
								@if($user->level == 1)
							<span class="label label-info">Admin</span>
						@else
							<span class="label label-warning">Member</span>
						@endif
						</td>
						<td class="center" id="rdoStatus" style="text-align: center;">
							@if($user->status ==1)
							<span class="label label-success">Hoạt động</span>
						@else 
							<span class="label label-danger" style="background: red;">Đã khóa</span>
						@endif
						</td>          
				  </tbody>
			 </table>  
		 	<form action="" class="form-group" >
            <fieldset>
	            <legend  style="width: 25%;font-size: 16px;text-align: center;">Thông tin chi tiết </legend>
	            <div class="control-group" >
                  <div class="controls"  >
                     <table class="table table-bordered table-striped table-condensed">
					  <thead>
						  <tr>
							  <th>Họ tên</th>
							  <th>Ngày sinh</th>
							  <th style="text-align: center;">Số điện thoại</th>
							  <th>Email</th>
							  <th>Địa chỉ</th>
							  <th>Thành phố</th>                                              
						  </tr>
					  </thead>   
					  <tbody>
						<tr>
							<td id="txtNames">
								{{old ('txtName',isset($user->UserDetail->name) ? $user->UserDetail->name : null)}}
							</td>
							<td class="center" id="txtBirthday">
								{{old ('txtName',isset($user->UserDetail->birthaday) ? $user->UserDetail->birthday : null)}}
							</td>
							<td class="center" id="txtTel" style="text-align: center;">
							{{old ('txtName',isset($user->UserDetail->tel) ? $user->UserDetail->tel : null)}}
							</td>
							<td class="center" id="txtEmails" >
								{{old ('txtName',isset($user->UserDetail->email) ? $user->UserDetail->email : null)}}
							</td>
							<td class="center" id="txtAddress" >
								{{old ('txtName',isset($user->UserDetail->address) ? $user->UserDetail->address : null)}}
							</td>            
							<td class="center" id="txtCity" >
								{{old ('txtName',isset($user->UserDetail->city) ? $user->UserDetail->city : null)}}
							</td>  
						</tr>
					  </tbody>
				 </table>  
                  </div>
	            </div>
            </fieldset>
          </form>
		</fieldset>

	</div>
</div><!--/span-->
</div><!--/row-->
@endsection