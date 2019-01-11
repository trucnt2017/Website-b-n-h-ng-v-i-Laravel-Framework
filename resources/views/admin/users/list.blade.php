@extends('admin.layout.index')
@section('content')
<ul class="breadcrumb">
  <li>
      <i class="icon-home"></i>
      <a href="">Trang chủ</a>
      <i class="icon-angle-right"></i> 
  </li>
  <li>
	 <i class="icon-plus-sign"></i>
	 <a href="add">Thêm mới thành viên </a>
  </li>
</ul>
<div class="row-fluid sortable">		
<div class="box span12">
	@include('admin.layout.alerts')
	<div class="box-header" data-original-title>
		<h2><i class="halflings-icon white user"></i><span class="break"></span>Danh sách tài khoản</h2>
		<div class="box-icon">
			<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<form method="get">
			<input type="hidden" name="_token" value="{{ csrf_token()}}">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
				  	  <th style="text-align: center;">STT</th>
					  <th>Tên tài khoản</th>
					  <th>Thời gian đăng ký</th>
					  <th>Level</th>
					  <th>Trạng thái</th>
					  <th>Chi tiết / Sửa / Xóa</th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php $stt=0;?>
			  	@foreach($user as $us)
			  	<?php 
			  		$stt = $stt +1;
			  	?>
				<tr>
					<td style="text-align: center;">{{$stt}}</td>
					<td>{{$us->name}}</td>
					<td class="center">
						<?php 
							echo \Carbon\Carbon::createFromTimeStamp(strtotime($us['created_at']))->diffForHumans();
						?>
					</td>
					<td class="center">
						@if($us->level == 1)
							<span class="label label-info">Admin</span>
						@else
							<span class="label label-warning">Member</span>
						@endif
					</td>
					<td class="center">
						@if($us->status ==1)
							<span class="label label-success">Hoạt động</span>
						@else 
							<span class="label label-danger" style="background: red;">Đã khóa</span>
						@endif
					</td>
					<td class="center">
						<a class="btn btn-success" href="detail/{{$us->id}}">
							<i class="halflings-icon white zoom-in"></i>  
						</a>
						<a class="btn btn-info" href="edit/{{$us->id}}">
							<i class="halflings-icon white edit"></i>  
						</a>
						<a onclick="return xacnhanxoa('Bạn có muốn xóa không ?')"  class="btn btn-danger" href="xoa/{{$us->id}}">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
				@endforeach
			  </tbody>
		  </table>    
		</form>        
	</div>
</div><!--/span-->

</div><!--/row-->
@endsection