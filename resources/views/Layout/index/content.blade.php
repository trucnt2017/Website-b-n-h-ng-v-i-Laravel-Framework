@extends('Layout.index.contain')   
@section('content')
   @if(!Auth::check())
	<script>
		$('#myModal88').modal('show');
	</script>
	@endif

<!-- //banner -->

<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="col-md-5 wthree_banner_bottom_left">
				<div class="video-img">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
						<span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
					</a>
				</div>
				<!-- pop-up-box -->    
						<link href="assert/css/popuo-box.css" rel="stylesheet" type="text/css" property="" media="all" />
						<script src="assert/js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!--//pop-up-box -->
					<div id="small-dialog" class="mfp-hide">
						<iframe src="assert/https://player.vimeo.com/video/23259282?title=0&byline=0&portrait=0"></iframe>
					</div>
					<script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
					</script>
			</div>
			<div class="col-md-7 wthree_banner_bottom_right">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home">T-shirts</a></li>
						<li role="presentation"><a href="#skirts" role="tab" id="skirts-tab" data-toggle="tab" aria-controls="skirts">Skirts</a></li>
						<li role="presentation"><a href="#watches" role="tab" id="watches-tab" data-toggle="tab" aria-controls="watches">Watches</a></li>
						<li role="presentation"><a href="#sandals" role="tab" id="sandals-tab" data-toggle="tab" aria-controls="sandals">Sandals</a></li>
						<li role="presentation"><a href="#jewellery" role="tab" id="jewellery-tab" data-toggle="tab" aria-controls="jewellery">Jewellery</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
							<div class="agile_ecommerce_tabs">
								<?php $stt=0 ?>
								@foreach($vi as $keys => $product_item)
								<?php $stt=$stt+1 ?>
								@if($stt>3)
								@break
								@endif
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
										<img Hinh="{!! $product_item->id !!}" id="{{ $product_item->id }}" style="
    									height: 100%;" src="{!! asset('resources/upload/'.$product_item->image) !!}" alt="" class="img-responsive" />
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
										<div class="w3_hs_bottom">
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
													<p><a class="item_add" href="#">Add to cart</a></p>
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
									<h5><a href="{{url('chi-tiet-san-pham',[$product_item->id,$product_item->alias])}}">{{ $product_item->name }}</a></h5>
									<div class="simpleCart_shelfItem">
									@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
									<p><span >{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
									@else 
									<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
									@endif
									<p><a class="item_add" href="#">Add to cart</a></p>
									</div>
								</div>
						@endforeach
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="skirts" aria-labelledby="skirts-tab">
							<div class="agile_ecommerce_tabs">
								<?php $stt=0 ?>
								@foreach($aosomi as $keys => $product_item)
								<?php $stt=$stt+1 ?>
								@if($stt>3)
								@break
								@endif
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
										<img Hinh="{!! $product_item->id !!}" id="{{ $product_item->id }}" style="
    									height: 100%;" src="{!! asset('resources/upload/'.$product_item->image) !!}" alt="" class="img-responsive" />
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
										<div class="w3_hs_bottom">
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
													<p><a class="item_add" href="#">Add to cart</a></p>
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
									<h5><a href="{{url('chi-tiet-san-pham',[$product_item->id,$product_item->alias])}}">{{ $product_item->name }}</a></h5>
									<div class="simpleCart_shelfItem">
									@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
									<p><span >{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
									@else 
									<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
									@endif
									<p><a class="item_add" href="#">Add to cart</a></p>
									</div>
								</div>
								
			
					@endforeach
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="watches" aria-labelledby="watches-tab">
							<div class="agile_ecommerce_tabs">
								<?php $stt=0 ?>
								@foreach($aothun as $keys => $product_item)
								<?php $stt=$stt+1 ?>
								@if($stt>3)
								@break
								@endif
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
										<img Hinh="{!! $product_item->id !!}" id="{{ $product_item->id }}" style="
    									height: 100%;" src="{!! asset('resources/upload/'.$product_item->image) !!}" alt="" class="img-responsive" />
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
										<div class="w3_hs_bottom">
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
													<p><a class="item_add" href="#">Add to cart</a></p>
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
									<h5><a href="{{url('chi-tiet-san-pham',[$product_item->id,$product_item->alias])}}">{{ $product_item->name }}</a></h5>
									<div class="simpleCart_shelfItem">
									@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
									<p><span >{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
									@else 
									<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
									@endif
									<p><a class="item_add" href="#">Add to cart</a></p>
									</div>
								</div>
								
			
					@endforeach
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="sandals" aria-labelledby="sandals-tab">
							<div class="agile_ecommerce_tabs">
								<?php $stt=0 ?>
								@foreach($giay as $keys => $product_item)
								<?php $stt=$stt+1 ?>
								@if($stt>3)
								@break
								@endif
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
										<img Hinh="{!! $product_item->id !!}" id="{{ $product_item->id }}" style="
    									height: 100%;" src="{!! asset('resources/upload/'.$product_item->image) !!}" alt="" class="img-responsive" />
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
										<div class="w3_hs_bottom">
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
													<p><a class="item_add" href="#">Add to cart</a></p>
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
									<h5><a href="{{url('chi-tiet-san-pham',[$product_item->id,$product_item->alias])}}">{{ $product_item->name }}</a></h5>
									<div class="simpleCart_shelfItem">
									@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
									<p><span >{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
									@else 
									<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
									@endif
									<p><a class="item_add" href="#">Add to cart</a></p>
									</div>
								</div>
								
	
					          @endforeach
								<div class="clearfix"> </div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="jewellery" aria-labelledby="jewellery-tab">
							<div class="agile_ecommerce_tabs">
								<?php $stt=0 ?>
								@foreach($thatlung as $keys => $product_item)
								<?php $stt=$stt+1 ?>
								@if($stt>3)
								@break
								@endif
								<div class="col-md-4 agile_ecommerce_tab_left">
									<div class="hs-wrapper">
										<img Hinh="{!! $product_item->id !!}" id="{{ $product_item->id }}" style="
    									height: 100%;" src="{!! asset('resources/upload/'.$product_item->image) !!}" alt="" class="img-responsive" />
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
										<div class="w3_hs_bottom">
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
													<p><a class="item_add" href="#">Add to cart</a></p>
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
									<h5><a href="{{url('chi-tiet-san-pham',[$product_item->id,$product_item->alias])}}">{{ $product_item->name }}</a></h5>
									<div class="simpleCart_shelfItem">
									@if($product_detail->promotion_price !=0 && $product_detail->promotion_price <= $product_detail->unit_price)
									<p><span >{{ number_format($product_detail->unit_price,0,',','.') }}</span> <i class="item_price">{{ number_format($product_detail->promotion_price,0,',','.') }} VND</i></p>
									@else 
									<p> <i class="item_price">{{ number_format($product_detail->unit_price,0,',','.') }} VND</i></p>
									@endif
									<p><a class="item_add" href="#">Add to cart</a></p>
									</div>
								</div>
								
					
					@endforeach
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
					<!--modal-video-->
				
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //banner-bottom -->


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

@include('Layout.index.newproducts')

<!-- //new-products -->
<!-- top-brands -->
@include('Layout.index.topbrands')

@include('Layout.index.mostviewproduct')

@endsection