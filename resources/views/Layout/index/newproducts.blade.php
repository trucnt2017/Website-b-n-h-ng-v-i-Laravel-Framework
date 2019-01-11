
<div class="new-products">
	<div class="container">
		<h3 style="">Sản phẩm mới</h3>
		<div id="data"></div>
		<div class="agileinfo_new_products_grids">
			@foreach($product as $keys => $product_item)
			<div class="col-md-3 agileinfo_new_products_grid">
				<div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
					<div id="{{ $keys }}" class="hs-wrapper hs-wrapper1">
						<img Hinh="{!! $product_item->id !!}" id="{{ $product_item->id }}" style="width: 100%;height: 100%;margin: 0 auto;display: block;" src="{!! asset('resources/upload/'.$product_item->image) !!}" alt="" class="img-responsive" />
						<?php
							$img = DB::table('product_images')->where('product_id',$product_item->id)->get();
							$product_details = DB::table('product_details')->where('product_id',$product_item->id)->get();  
							$product_detail =DB::table('product_details')->select('id','description','unit_price','promotion_price','product_id')->where('product_id',$product_item->id)->first();
							$products = DB::table('products')->select('name','id')->where('id',$product_detail->product_id)->get();
						?>
						@foreach($img as $key => $img_item)
							<img Hinh="{!! $product_item->id !!}" id="{{ $product_item->id }}"  style="width: 100%;height: 100%;margin: 0 auto;display: block;" src="{!! asset('resources/upload/'.$product_item->image) !!}" alt="" class="img-responsive" />
							<img Hinh="{{ $img_item->product_id }}" id="{{ $img_item->product_id }}" style="width: 100%;height: 100%;margin: 0 auto;display: block;"   src="{!! asset('resources/upload/detail/'.$img_item->image) !!}" alt=" " class="img-responsive" />
							@foreach($product_details as $product_details_item)
							<div class="w3_hs_bottom w3_hs_bottom_sub">
								<ul>
									<li>
										<a href="#" data-toggle="modal" data-target="#myModal2{{$product_details_item->product_id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
									</li>
								</ul>
							</div>
							<div class="modal video-modal fade" id="myModal2{{$product_details_item->product_id}}" tabindex="-1" role="dialog" aria-labelledby="myModal2">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
										</div>
										<section>
											<div class="modal-body">
												<div class="col-md-4 modal_body_left">
													<img " src="{!! asset('resources/upload/'.$product_item->image) !!}" alt="{{$product_item->name}}" class="img-responsive" />
												</div>
												<div class="col-md-8 modal_body_right">
													<h4>{{ $product_item->name }}</h4>
													<p>{{ $product_details_item->description }}</p>
													
													<div class="modal_body_right_cart simpleCart_shelfItem">
													@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
													<p><span >{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
													@else 
													<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
													@endif
														<form action="#" method="post">
															<input type="hidden" name="cmd" value="_cart">
															<input type="hidden" name="add" value="1"> 
															<input type="hidden" name="w3ls_item" value="Laptop"> 
															<input type="hidden" name="amount" value="850.00">   
															<button type="submit" class="w3ls-cart">Add to cart</button>
														</form>
											<p ><a class="item_add" href="{{url('chi-tiet-san-pham',[$product_item->id,$product_item->alias])}}">detail</a></p>
										</div>
										<h5>Color</h5>
										<div class="color-quality">
											<ul>
												<li><a href="#"><span></span>Red</a></li>
												<li><a href="#" class="brown"><span></span>Yellow</a></li>
												<li><a href="#" class="purple"><span></span>Purple</a></li>
												<li><a href="#" class="gray"><span></span>Violet</a></li>
											</ul>
										</div>
									</div>
									<div class="clearfix"> </div>
											</div>
										</section>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
							@endforeach
						@endforeach
					</div>
					<h5><a href="{{url('chi-tiet-san-pham',[$product_item->id,$product_item->alias])}}">{{$product_item->name}}</a></h5>
					<div class="simpleCart_shelfItem" style="margin-top: -10px;">
						@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
							<p><span >{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
						@else 
							<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
						@endif
						<form id="cartformnew{{ $product_item->id }}" action="" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_product"  value="{{ $product_item->id }}">
							<input type="hidden" name="price_product"  value="{{$product_details_item->promotion_price}}">
							
							<button class="btn btn-danger my-cart-btn" 
								data-id="{{ $product_item->id }}" 
								data-name="{{ $product_item->name }}" 
								data-summary="{{ $product_item->id }}" 
								data-price="{{$product_details_item->promotion_price}}" 
								data-quantity="1" 
								data-image="{!! asset('resources/upload/'.$product_item->image) !!}"
								data-user="{{$name}}" >Add to Cart</button>
								<a href="{{url('chi-tiet-san-pham',[$product_item->id,$product_item->alias])}}" class="btn btn-info">Details</a>
						</form>

					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			@endforeach
		</div>
		
	</div>
	<div class="col-md-9"></div>
	<div class="col-md-3">
		{!! $product->render() !!}
	</div>

</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
						$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
						var jsArray = <?php echo json_encode($test); ?>;
						jsArray.forEach(element => {
							
								
								$(`#cartformnew${element}`).on('click', (e) => {
									if({{$flag}}==0)
									{
										alert("Quý khách vui lòng đăng nhập trước khi mua hàng");
										e.preventDefault();
									}
									else
									{
										$.ajax({
										type: 'post',
										url: 'cartproduct',
										cache: false,
										dataType: 'json',
										data: { _token:'{!! csrf_token() !!}',
										id_product:$(`#cartformnew${element}`).find('input[name="id_product"]').val(),
										price_product:$(`#cartformnew${element}`).find('input[name="price_product"]').val()
										},
										success: function(data) {

										},
										error: function (request, status, error) {
											alert(error);
											}
										});
										e.preventDefault();
									}
										
								});
					
							
						
							
						
							
						});
					
             
					
					
					
						</script> 




