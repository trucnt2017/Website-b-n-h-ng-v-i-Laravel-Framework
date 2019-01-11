@extends('Layout.index.contain')
@section('content')
<!-- breadcrumbs -->

<?php
 $test=[];
 $array =DB::table('products')->select('id')->get();
 foreach($array as $element)
 {
   $test[] = (string)$element->id;  
 }
 if(Auth::check()){
	$flag=1;
	$name=Auth::user()->id;
  }
  else{
	$flag=0;
	$name=0;
  }
?>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js"></script>
<div class="breadcrumb_dress" style="margin-top: 15px;">
	<div class="container">
		<ul>
			<li><a href="{{ url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
			<li>Single Page</li>
			
		</ul>
	</div>
</div>

<!-- //breadcrumbs -->  
<!-- single -->
<div class="single">
	<div class="container">
		<div class="col-md-6 single-left">
			<div class="flexslider" >
				<ul class="slides">
					<?php
						$price =round(100- $product_detail->promotion_price * 100 / $product_detail->unit_price);
					 ?>
					@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price )
						<li data-thumb="{{ asset('resources/upload/'.$product->image)}}">
							<div class="thumb-image"> 
								<div class="imageAndText" style="position: relative;">
								 	<img src="{{ asset('resources/upload/'.$product->image)}}" data-imagezoom="true" class="align-center img-responsive" alt=""> 
								    <div class="col" style="position: absolute; z-index: 1; top: 0; right: -0;">
									    <div class="col-sm-6">
								        	<div class="mobiles_grid_pos">
												<h6 style="text-align: center;">- {{ $price }} %</h6>
											</div>
								        </div>
								    </div>
								</div>
							</div>
						</li>
					@else 
						<li data-thumb="{{ asset('resources/upload/'.$product->image)}}">
							<div class="thumb-image"> 
								<img src="{{ asset('resources/upload/'.$product->image)}}" data-imagezoom="true" class="img-responsive" alt=""> 
							</div>
						</li>
					@endif
					
					@foreach($product_image as $image_item)
					@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price )
					<li data-thumb="{{ asset('resources/upload/detail/'.$image_item->image)}} ">
						 <div class="thumb-image"> 
							 <div class="imageAndText" style="position: relative;">
							 	<img src="{{ asset('resources/upload/detail/'.$image_item->image)}}" data-imagezoom="true" class="align-center img-responsive" alt=""> 
							    <div class="col" style="position: absolute; z-index: 1; top: 0; right: -0;">
							        <div class="col-sm-6">
							        	<div class="mobiles_grid_pos">
											<h6 style="text-align: center;">- {{ $price }} %</h6>
										</div>
							        </div>
							    </div>
							</div>
						 </div>
					</li>
					@else 
					<li data-thumb="{{ asset('resources/upload/detail/'.$image_item->image)}} ">
						 <div class="thumb-image"> 
							 <img src="{{ asset('resources/upload/detail/'.$image_item->image)}}" data-imagezoom="true" class="align-center img-responsive" alt=""> 
						 </div>
					</li>
					@endif
					@endforeach
				</ul>
			</div>
			<!-- flexslider -->
				<script defer src="{{url('pages/js/jquery.flexslider.js')}}"></script>
				<link rel="stylesheet" href="{{url('pages/css/flexslider.css')}}" type="text/css" media="screen" />
				<script>
				// Can also be used with $(document).ready()
				$(window).load(function() {
				  $('.flexslider').flexslider({
					animation: "slide",
					controlNav: "thumbnails"
				  });
				});
				</script>
			<!-- flexslider -->
			<!-- zooming-effect -->
				<script src="{{url('pages/js/imagezoom.js')}}"></script>
			<!-- //zooming-effect -->
		</div>
		<div class="col-md-6 single-right">
			<h3>{{$product->name}}</h3>
			<div class="rating1">
				<span class="starRating">
					<input id="rating5" type="radio" name="rating" value="5">
					<label for="rating5">5</label>
					<input id="rating4" type="radio" name="rating" value="4">
					<label for="rating4">4</label>
					<input id="rating3" type="radio" name="rating" value="3" checked>
					<label for="rating3">3</label>
					<input id="rating2" type="radio" name="rating" value="2">
					<label for="rating2">2</label>
					<input id="rating1" type="radio" name="rating" value="1">
					<label for="rating1">1</label>
				</span>
			</div>
			<div class="description">
				<h5><i>Mô tả sản phẩm</i></h5>
				<p>{{$product_detail->description }}</p>
			</div>
			<div class="color-quality">
				<div class="color-quality-left">
					<h5>Color : </h5>
					<ul>
						<li><a href="#"><span></span></a></li>
						<li><a href="#" class="brown"><span></span></a></li>
						<li><a href="#" class="purple"><span></span></a></li>
						<li><a href="#" class="gray"><span></span></a></li>
					</ul>
				</div>
				<div class="color-quality-right">
					<h5>Quality :</h5>
					 <div class="quantity"> 
						<div class="quantity-select">                           
							<div class="entry value-minus1">&nbsp;</div>
							<div class="entry value1"><span>1</span></div>
							<div class="entry value-plus1 active">&nbsp;</div>
						</div>
					</div>
					<!--quantity-->
							<script>
							$('.value-plus1').on('click', function(){
								var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10)+1;
								divUpd.text(newVal);
							});

							$('.value-minus1').on('click', function(){
								var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10)-1;
								if(newVal>=1) divUpd.text(newVal);
							});
							</script>
						<!--quantity-->

				</div>
				<div class="clearfix"> </div>
			</div>
			<!-- <div class="occasional">
				<h5>RAM :</h5>
				<div class="colr ert">
					<div class="check">
						<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>3 GB</label>
					</div>
				</div>
				<div class="colr">
					<div class="check">
						<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>2 GB</label>
					</div>
				</div>
				<div class="colr">
					<div class="check">
						<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>1 GB</label>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div> -->
			<div class="simpleCart_shelfItem">
				@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price )
				<p><span>{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
				@else 
				<p><i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
				@endif
				<form action="#" method="post">
					<input type="hidden" name="cmd" value="_cart">
					<input type="hidden" name="add" value="1"> 
					<input type="hidden" name="w3ls_item" value="Smart Phone"> 
					<input type="hidden" name="amount" value="450.00">   
					<button type="submit" class="w3ls-cart">Thêm vào giỏ</button>
				</form>
			</div> 
		</div>
		<div class="clearfix"> </div>
	</div>
</div> 
<div class="additional_info">
	<div class="container">
		<div class="sap_tabs">	
			<div id="horizontalTab1" style="display: block; width: 100%; margin: 0px;">
				<ul>
					<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Product Information</span></li>
					<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Reviews</span></li>
				</ul>		
				<div class="tab-1 resp-tab-content additional_info_grid" aria-labelledby="tab_item-0">
					<h3>{{$product->name}}</h3>
					<p>{{$product_detail->description }}</p>
					<p id="txtIntro">{{$product_detail->intro }}</p>
                  	<script type="text/javascript"> ckeditor("txtIntro") </script>
					<p id="txtContent">{{$product_detail->content }}</p>
					<script type="text/javascript"> ckeditor("txtContent") </script>
				</div>	

				<div class="tab-2 resp-tab-content additional_info_grid" aria-labelledby="tab_item-1" >
					<h4>Reviews</h4>
					<?php 
							$comment = DB::table('Comment')->where('idProduct',$product->id)->get();
						 ?>
				<div id="data{{$id}}">
					@foreach($comment as $cm)
					<?php 
						$user = DB::table('users')->where('id',$cm->idUser)->first();
						$userdetail = DB::table('user_details')->where('user_id',$user->id)->first();
						
					 ?>
					<div class="additional_info_sub_grids" >
						<div class="col-xs-2 additional_info_sub_grid_left">
							<img src="{{url('public/pages/images/t1.png')}}" alt=" " class="img-responsive" />
						</div>
						<div class="col-xs-10 additional_info_sub_grid_right">
							<div class="additional_info_sub_grid_rightl">
								<a href="single.html">{{$user->name}}</a>
								<h5>{{$cm->created_at}}</h5>
								<p>{{$cm->content}}</p>
							</div>
							<div class="additional_info_sub_grid_rightr">
								<div class="rating">
									<div class="rating-left">
										<img src="{{url('pages/images/star-.png')}}" alt=" " class="img-responsive">
									</div>
									<div class="rating-left">
										<img src="{{url('pages/images/star-.png')}}" alt=" " class="img-responsive">
									</div>
									<div class="rating-left">
										<img src="{{url('pages/images/star-.png')}}" alt=" " class="img-responsive">
									</div>
									<div class="rating-left">
										<img src="{{url('pages/images/star.png')}}" alt=" " class="img-responsive">
									</div>
									<div class="rating-left">
										<img src="{{url('pages/images/star.png')}}" alt=" " class="img-responsive">
									</div>
									<div class="clearfix"> </div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="clearfix"> </div>
					</div>
			
					@endforeach
				</div>
					<div class="review_grids">
						<h5>Add A Review</h5>
						<form id="formMessage" action="comment/{{$product->id}}" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<textarea name="Review" onfocus="this.value = '';" onblur="if(this.value == '') {this.value = 'Add Your Review';}"  required="" >Add Your Review</textarea>
							<input type="submit" value="Submit" >
						</form>
					</div>
				</div> 			        					            	      
			</div>	
		</div>
		<!-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script> -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<?php $date = date('Y-m-d H:i:s');
		if(Auth::check()){
			$flag=1;
			$name=Auth::user()->name;

		}
		else{
			$flag=0;
			$name='';
		}
			?>
			
						<script type="text/javascript">
						$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
						var socket=io('http://localhost:6001')
						$('#formMessage').on('submit', (e) => {
							// con neu muon cai action gui dât len server thi comment cai
							
						    if ({{$flag}}==0) {
								alert('Quý khách vui lòng đăng nhập trước khi bình luận');
								e.preventDefault(); 
						    }
						    if ({{$flag}}==1)
						    {
						    socket.emit('createMessage', {
						        from: "{{$name}}",
						        text: $('[name=Review]').val(),
						        time: "{{$date}}",
						        id:"{{$id}}"
						    }, () => {
						        $('[name=content]').val("");
						        e.preventDefault(); 
						    });
								  // turn off event submit default
								  var fromdata=$(this).serialize();
  							e.preventDefault();
							$.ajax({
        				    type: 'post',
        				    url: 'abc',
        				    cache: false,
        				    dataType: 'json',
        				    data: { _token:'{!! csrf_token() !!}',
									 content:$('[name=Review]').val(),
									 id:"{{$id}}" },
        				    success: function(data) {
                  				
                			},
        				  	error: function (request, status, error) {
        					alert(error);
    						}
        					});
    
						   }
						 
					
    				
            			
        				
						});
					
						socket.on('newMessage',function(data)	{
							
							var id1 = data.id;
							$(`#data${id1}`).append('<div class="additional_info_sub_grids" ><div class="col-xs-2 additional_info_sub_grid_left"><img src="{{url('public/pages/images/t1.png')}}" alt=" " class="img-responsive" /></div><div class="col-xs-10 additional_info_sub_grid_right"><div class="additional_info_sub_grid_rightl"><a href="single.html">'+data.from+'</a><h5>'+data.time+'</h5><p>'+data.text+'</p></div><div class="additional_info_sub_grid_rightr"><div class="rating"><div class="rating-left"><img src="{{url('pages/images/star-.png')}}" alt=" " class="img-responsive"></div><div class="rating-left"><img src="{{url('pages/images/star-.png')}}" alt=" " class="img-responsive"></div><div class="rating-left"><img src="{{url('pages/images/star-.png')}}" alt=" " class="img-responsive"></div><div class="rating-left"><img src="{{url('pages/images/star.png')}}" alt=" " class="img-responsive"></div><div class="rating-left"><img src="{{url('pages/images/star.png')}}" alt=" " class="img-responsive"></div><div class="clearfix"> </div></div></div><div class="clearfix"> </div></div><div class="clearfix"> </div></div>');
						})
						</script> 
		
		<script src="{{url('pages/js/easyResponsiveTabs.js')}}" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#horizontalTab1').easyResponsiveTabs({
					type: 'default', //Types: default, vertical, accordion           
					width: 'auto', //auto or any width like 600px
					fit: true   // 100% fit in a container
				});
			});
		</script>
	</div>
</div>
<!-- Related Products -->
<div class="w3l_related_products">
	<div class="container">
		<h3>Cùng danh mục</h3>
		<ul id="flexiselDemo2">	
			@foreach($product_cats as $product_cats_item)
			<?php
				$img = DB::table('product_images')->where('product_id',$product_cats_item->id)->get(); 
				$product_detail =DB::table('product_details')->select('id','description','unit_price','promotion_price','product_id')->where('product_id',$product_cats_item->id)->first();
			 ?>		
			<li>
				<div class="w3l_related_products_grid">
					<div class="agile_ecommerce_tab_left mobiles_grid">
						<div class="hs-wrapper hs-wrapper3">
							<img style="width: 100%;height: 100%;margin:0 auto;display: block;" src="{!! asset('resources/upload/'.$product_cats_item->image) !!}" alt=" " class="img-responsive" />
							@foreach($img as $img_item)
							<img style="width: 100%;height: 100%;margin:0 auto;display: block;" src="{!! asset('resources/upload/detail/'.$img_item->image) !!}" alt=" " class="img-responsive" />
							@endforeach
							<div class="w3_hs_bottom">
								<div class="flex_ecommerce">
									<a href="#" data-toggle="modal" data-target="#myModal6"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
								</div>
							</div>
						</div>
						<div class="modal video-modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModal6">
							<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
								<section>
											<div class="modal-body">
												<div class="col-md-4 modal_body_left">
													<img " src="{!! asset('resources/upload/'.$product_cats_item->image) !!}" alt="{{$product_cats_item->name}}" class="img-responsive" />
												</div>
												<div class="col-md-8 modal_body_right">
													<h4>{{ $product_cats_item->name }}</h4>
													<p>{{ $product_detail->description }}</p>
													
													<div class="modal_body_right_cart simpleCart_shelfItem">
													@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
													<p><span >{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
													@else 
													<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
													@endif
													<p><a class="item_add" href="#">Add to cart</a></p>
											<p ><a class="item_add" href="{{url('chi-tiet-san-pham',[$product_cats_item->id,$product_cats_item->alias])}}">detail</a></p>
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
						<h5 style="font-size: 14px;"><a href="{{url('chi-tiet-san-pham',[$product_cats_item->id,$product_cats_item->alias])}}">{{ $product_cats_item->name }}</a></h5>
						<div class="simpleCart_shelfItem"> 
							@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
								<p class="flexisel_ecommerce_cart"><span>{{ number_format($product_detail->unit_price,0,',','.' )}}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.' )}}</i> VND</p>
							@else 
								<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
							@endif
							<form id="cartform{{ $product_cats_item->id }}" action="" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_product"  value="{{ $product_cats_item->id }}">
							<input type="hidden" name="price_product"  value="{{$product_detail->promotion_price}}">
							
							<button class="btn btn-danger my-cart-btn" 
								data-id="{{ $product_cats_item->id }}" 
								data-name="{{ $product_cats_item->name }}" 
								data-summary="{{ $product_cats_item->id }}" 
								data-price="{{$product_detail->promotion_price}}" 
								data-quantity="1" 
								data-image="{!! asset('resources/upload/'.$product_cats_item->image) !!}"
								data-user="{{$name}}" >Add to Cart</button>
								<a href="{{url('chi-tiet-san-pham',[$product_cats_item->id,$product_cats_item->alias])}}" class="btn btn-info">Details</a>
						</form>
						</div>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
		
			<script type="text/javascript">
				$(window).load(function() {
					$("#flexiselDemo2").flexisel({
						visibleItems:4,
						animationSpeed: 1000,
						autoPlay: true,
						autoPlaySpeed: 3000,    		
						pauseOnHover: true,
						enableResponsiveBreakpoints: true,
						responsiveBreakpoints: { 
							portrait: { 
								changePoint:480,
								visibleItems: 1
							}, 
							landscape: { 
								changePoint:640,
								visibleItems:2
							},
							tablet: { 
								changePoint:768,
								visibleItems: 3
							}
						}
					});
					
				});
			</script>
			<script type="text/javascript" src="{{url('pages/js/jquery.flexisel.js')}}"></script>
	</div>
</div>
<!-- //Related Products -->
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

<!-- //single -->
@endsection