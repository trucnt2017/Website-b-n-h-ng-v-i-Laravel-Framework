@extends('admin.layout.index')
@section('content')
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="{{URL('trangchu/home')}}">Trang chủ</a> 
	<i class="icon-angle-right"></i>
</li>
<li>
	<i class="icon-plus-sign"></i>
	<a href="{{URL('admin/products/add')}}">Thêm mới sản phẩm </a>
</li>
</ul>
@include('admin.layout.alerts')
<div class="row-fluid sortable">		
<div class="box span12">
	<div class="box-header" data-original-title>
		<h2><i class="icon-th-list"></i><span class="break"></span>Danh sách sản phẩm</h2>
		<div class="box-icon">
			<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<table class="table table-striped table-bordered bootstrap-datatable datatable">
		  <thead>
			  <tr>
				  <th style="text-align: center;">STT</th>
				  <th>Tên sản phẩm</th>
				  <th>Giá nhập sản phẩm</th>
				  <th>Danh mục sản phẩm</th>
				  <th>Thời gian</th>
				  <th style="text-align: center;">Chi tiết / Sửa / Xóa</th>
			  </tr>
		  </thead>   
		  <tbody>
		  	<?php $stt = 0;?>
		  	@foreach($data as $item)
		  	<?php $stt = $stt + 1;?>
			<tr>
				<td class="center" style="text-align: center;">{{ $stt }}</td>
				<td >{{$item['name']}}</td>
				<td>{{number_format($item['cost'],0,',','.')}} VNĐ</td>
				<td >
					<?php $cat = DB::table('categorys')->where('id',$item['cat_id'])->first(); ?>
					@if(!empty ($cat->name))
						{{ $cat->name }}
					@endif
				</td>
				<td>
					<?php 
						echo \Carbon\Carbon::createFromTimeStamp(strtotime($item['created_at']))->diffForHumans();
					?>
				</td>
				<td class="center" style="text-align: center;">
					<a class="btn btn-success" href="{{URL::route('admin.products.getDetail',$item['id'])}}">
						<i class="halflings-icon white zoom-in"></i>  
					</a>
					<a class="btn btn-info" href="{{URL::route('admin.products.getEdit',$item['id'])}}">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a onclick="return xacnhanxoa('Bạn có muốn xóa không ?')" class="btn btn-danger" href="{{URL::route('admin.products.getDelete',$item['id'])}}">
						<i class="halflings-icon white trash"></i> 
					</a>
				</td>
			</tr>	
			@endforeach
		  </tbody>
	  </table>            
	</div>
</div><!--/span-->

</div><!--/row-->
@endsection