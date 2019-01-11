@extends('admin.layout.index')
@section('content')
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="{{ url ('/')}}">Trang chủ</a> 
	<i class="icon-angle-right"></i>
</li>
<li>
	<i class="icon-plus-sign"></i>
	<a href="add">Thêm mới danh mục </a>
</li>
</ul>
@include('admin.layout.alerts')
<div class="row-fluid sortable">		
<div class="box span12">
	<div class="box-header" data-original-title>
		<h2><i class="icon-th-list"></i><span class="break"></span>Danh mục sản phẩm</h2>
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
				  <th>Tên danh mục</th>
				  <th>Danh mục sản phẩm</th>
				  <th style="text-align: center;"> Sửa / Xóa </th>
			  </tr>
		  </thead>   
		  <tbody>
		  	<?php $stt = 0;?>
		  	@foreach($cat as $item)
		  	<?php $stt = $stt + 1;?>
			<tr>
				<td class="center" style="text-align: center;">{{ $stt }}</td>
				<td >{{$item->name}}</td>
				<td >
					@if($item->parent_id == 0)
						{{ "None" }}
					@else
						<?php
							$parent = DB::table('Categorys')->where('id',$item['parent_id'])->first();
							echo "$parent->name";
						?>
					@endif
				</td>
				<td class="center" style="text-align: center;">
					<a class="btn btn-info" href="edit/{{$item->id}}">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a onclick="return xacnhanxoa('Bạn có muốn xóa không ?')" class="btn btn-danger" href="xoa/{{$item->id}}">
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