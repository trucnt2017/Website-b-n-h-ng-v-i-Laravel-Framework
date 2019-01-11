
<div class="new-products">
	<div class="container">
		<h3 style="">Sản phẩm HOT</h3>
		<div class="agileinfo_new_products_grids">
			@foreach($mostview as $mostview_item)
			<?php
				$img = DB::table('product_images')->where('product_id',$mostview_item->product_id)->get();
				$products = DB::table('products')->select('name','id','image','alias')->where('id',$mostview_item->product_id)->first();
				$productdetail = DB::table('product_details')->select('unit_price','promotion_price')->where('product_id',$mostview_item->product_id)->first();
			?>
			<div class="col-md-3 agileinfo_new_products_grid">
				<div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
					<div  class="hs-wrapper hs-wrapper1">
						<img style="width: 100%;height: 100%;margin: 0 auto;display: block;" src="{!! asset('resources/upload/'.$products->image) !!}" alt="" class="img-responsive" />
						@foreach($img as $img_item)
							<img  style="width: 100%;height: 100%;margin: 0 auto;display: block;" src="{!! asset('resources/upload/'.$products->image) !!}" alt="" class="img-responsive" />
							<img style="width: 100%;height: 100%;margin: 0 auto;display: block;"   src="{!! asset('resources/upload/detail/'.$img_item->image) !!}" alt=" " class="img-responsive" />
							<div class="w3_hs_bottom w3_hs_bottom_sub">
								<ul>
									<li>
										<a href="#" data-toggle="modal" data-target="#myModal2{{$mostview_item->product_id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
									</li>
								</ul>
							</div>
							<div class="modal video-modal fade" id="myModal2{{$mostview_item->product_id}}" tabindex="-1" role="dialog" aria-labelledby="myModal2">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
										</div>
										<section>
											<div class="modal-body">
												<div class="col-md-4 modal_body_left">
													<img " src="{!! asset('resources/upload/'.$products->image) !!}" alt="{{$products->name}}" class="img-responsive" />
												</div>
												<div class="col-md-8 modal_body_right">
													<h4>{{ $products->name }}</h4>
													<p>{{ $mostview_item->description }}</p>
													<div class="rating">
														<div class="rating-left">
															<img src="" alt=" " class="img-responsive" />
														</div>
														<div class="clearfix"> </div>
													</div>
													<div class="modal_body_right_cart simpleCart_shelfItem">
														<p><span>$880</span> <i class="item_price">{{ number_format($mostview_item->unit_price,0,',','.') }}</i></p>
														<form action="#" method="post">
															<input type="hidden" name="cmd" value="_cart">
															<input type="hidden" name="add" value="1"> 
															<input type="hidden" name="w3ls_item" value="Laptop"> 
															<input type="hidden" name="amount" value="850.00">   
															<button type="submit" class="w3ls-cart">Add to cart</button>
														</form>
													</div>
													<h5>Color</h5>
													<div class="color-quality">
														<ul>
															<li><a href="#"><span></span></a></li>
															<li><a href="#" class="brown"><span></span></a></li>
															<li><a href="#" class="purple"><span></span></a></li>
															<li><a href="#" class="gray"><span></span></a></li>
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
					</div>
					<hr>
					<h5><a href="{{url('chi-tiet-san-pham',[$products->id,$products->alias])}}">{{$products->name}}</a></h5>
					<div class="simpleCart_shelfItem" style="margin-top: -10px;">
						@if($mostview_item->promotion_price !=0 && $mostview_item->promotion_price <= $mostview_item->unit_price)
							<p><span style="font-size: 1em;">{{ number_format($mostview_item->unit_price,0,',','.') }}</span> 
							<i class="item_price">{{ number_format($mostview_item->promotion_price,0,',','.') }} VND</i></p>
						@else 
							<p> <i class="item_price">{{ number_format($mostview_item->unit_price,0,',','.') }} VND</i></p>
						@endif
						
						


						<form id="cartform{{ $products->id }}" action="" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_product"  value="{{ $products->id }}">
							<input type="hidden" name="price_product"  value="{{$productdetail->promotion_price}}">
							
							<button class="btn btn-danger my-cart-btn" 
								data-id="{{ $products->id }}" 
								data-name="{{ $products->name }}" 
								data-summary="{{ $products->id }}" 
								data-price="{{$productdetail->promotion_price}}" 
								data-quantity="1" 
								data-image="{!! asset('resources/upload/'.$products->image) !!}"
								data-user="{{$name}}" >Add to Cart</button>
								<a href="{{url('chi-tiet-san-pham',[$products->id,$products->alias])}}" class="btn btn-info">Details</a>
						</form>
					
					
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			@endforeach
		</div>
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
							
								
								$(`#cartform${element}`).on('click', (e) => {
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
										id_product:$(`#cartform${element}`).find('input[name="id_product"]').val(),
										price_product:$(`#cartform${element}`).find('input[name="price_product"]').val()
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