@extends('Layout.index.contain')
@section('content')
<!-- breadcrumbs -->

<!-- checkout -->
<?php
  $order_id=DB::table('orders')->select('id')->where('user_id',Auth::user()->id)->first();
  $Orders_details=DB::table('order_details')->select('id','price','quantity','total','note','product_id')->where('order_id',$order_id->id)->get();
  $product=DB::table('products')->get();
?>
	<div class="checkout">
		<div class="container">
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>SL No.</th>	
							<th>Product</th>
							<th>Quality</th>
							<th>Product Name</th>
							<th>Service Charges</th>
							<th>Price</th>
							<th>Remove</th>
						</tr>
					</thead>
					@foreach($Orders_details as $item)
						@foreach($product as $value)
						@if($item->product_id==$value->id)
					<tr class="rem1{{$item->id}}">
						<td class="invert">{{$item->id}}</td>
						<td class="invert-image"><img src="{!! asset('resources/upload/'.$value->image) !!}" alt=" " class="img-responsive" /></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                           
									<div class="entry value-minus">&nbsp;</div>
									<div class="entry value"><span>{{$item->quantity}}</span></div>
									<div class="entry value-plus active">&nbsp;</div>
								</div>
							</div>
						</td>
						
						<td class="invert">{{$value->name}}</td>
						<td class="invert">{{$value->cost}}</td>
						<td class="invert">{{$value->cost}}</td>
						<td class="invert">
							<div class="rem">
								<div class="close1" id="remove{{$item->id}}"> </div>
							</div>
							<script>$(document).ready(function(c) {
								$('#remove{{$item->id}}').on('click', function(c){
									$('.rem1{{$item->id}}').fadeOut('slow', function(c){
										$('.rem1{{$item->id}}').remove();
										$.ajax({
									type: 'post',
									url: 'delproduct',
									cache: false,
									dataType: 'json',
									data: { _token:'{!! csrf_token() !!}',
									id_product:{{$value->id}}
									},
									success: function(data) {

									},
									error: function (request, status, error) {
										alert(error);
										}
									});
									});
									});	  
									
								});
						   </script>
						</td>
					</tr>
					@endif
						@endforeach
					@endforeach
					<!-- <tr class="rem2">
						<td class="invert">2</td>
						<td class="invert-image"><a href="single.html"><img src="images/ss5.jpg" alt=" " class="img-responsive" /></a></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                           
									<div class="entry value-minus">&nbsp;</div>
									<div class="entry value"><span>1</span></div>
									<div class="entry value-plus active">&nbsp;</div>
								</div>
							</div>
						</td>
						<td class="invert">Floral Border Skirt</td>
						<td class="invert">$5.00</td>
						<td class="invert">$270.00</td>
						<td class="invert">
							<div class="rem">
								<div class="close2"> </div>
							</div>
							<script>$(document).ready(function(c) {
								$('.close2').on('click', function(c){
									$('.rem2').fadeOut('slow', function(c){
										$('.rem2').remove();
									});
									});	  
								});
						   </script>
						</td>
					</tr>
					<tr class="rem3">
						<td class="invert">3</td>
						<td class="invert-image"><a href="single.html"><img src="images/c7.jpg" alt=" " class="img-responsive" /></a></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                           
									<div class="entry value-minus">&nbsp;</div>
									<div class="entry value"><span>1</span></div>
									<div class="entry value-plus active">&nbsp;</div>
								</div>
							</div>
						</td>
						<td class="invert">Beige Sandals</td>
						<td class="invert">$5.00</td>
						<td class="invert">$212.00</td>
						<td class="invert">
							<div class="rem">
								<div class="close3"> </div>
							</div>
							<script>$(document).ready(function(c) {
								$('.close3').on('click', function(c){
									$('.rem3').fadeOut('slow', function(c){
										$('.rem3').remove();
									});
									});	  
								});
						   </script>
						</td>
					</tr> -->
								<!--quantity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--quantity-->
				</table>
			</div>
			<div class="checkout-left">	
				<div class="checkout-left-basket">
					<h4>Continue to basket</h4>
					<ul>
						<li>Product1 <i>-</i> <span>$200.00 </span></li>
						<li>Product2 <i>-</i> <span>$270.00 </span></li>
						<li>Product3 <i>-</i> <span>$212.00 </span></li>
						<li>Total Service Charges <i>-</i> <span>$15.00</span></li>
						<li>Total <i>-</i> <span>$697.00</span></li>
					</ul>
				</div>
				<div class="checkout-right-basket">
					<a href="products.html"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //single -->
@endsection