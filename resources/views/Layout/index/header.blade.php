	@include('Layout.login.dialog')

<style type="text/css">
	#dangnhap{
		position: absolute;
		left: 25;
		padding-top: 15px;
		display: block;
		background: white;
	}
	#dangnhap .btn:hover{
		background: #528B8B;
		color: white;
	}
	#dangnhap .btn{
		border:blue solid 1px;
		background: white;
		color: black;
		height: 50px;
		font-weight: bold;
	}
	#SingForm .btn{
		border: none; /* Remove borders */
	    color: white; /* Add a text color */
	    padding: 14px 28px; /* Add some padding */
	    cursor: pointer; /* Add a pointer cursor on mouse-over */
	}
	#SingForm .success {background-color: #4CAF50;} /* Green */
	#SingForm .success:hover {background-color: #46a049;}
</style>
<div class="divcontent">
<div class="header" id="home1">
<div class="container">
	@if(Auth::check())
	<?php
	$idcart=DB::table('orders')->select('id')->where('user_id',Auth::user()->id)->first();
	$orderdetail=DB::table('order_details')->select('price','quantity','total','product_id')->where('order_id',$idcart->id)->get();
	$products = DB::table('products')->select('name','id','image','alias')->get();
	?>
	<script>
		var Array_orderdetail = <?php echo json_encode($orderdetail); ?>;
		var Array_product= <?php echo json_encode($products); ?>;
		
		Array_orderdetail.forEach(detail => {
			Array_product.forEach(product => {
			if(detail.product_id==product.id)
			{
			    $('body').append(
					'<button id="'+product.id+'" class="btn btn-danger my-cart-btn"'+ 
								'data-id="'+product.id+'"'+
								'data-name="'+product.name+'"'+ 
								'data-summary="'+product.id+'"'+ 
								'data-price="1"'+
								'data-quantity="'+detail.quantity+'"'+
								'data-image="resources/upload/'+product.image+'"'+
								'data-user="1" style="display:none" >Add to Cart</button>'
				);	
			}
			});
		});
	window.onload = function(){
		Array_orderdetail.forEach(detail => {
			Array_product.forEach(product => {
			if(detail.product_id==product.id)
			{
				document.getElementById(product.id).click();
				document.getElementById(product.id).remove();
			}
			});
		});
	}
	
	</script>
	<div class="dropdown" id="dangnhap">
	    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Xin chào , <span style="color: #CC9900"> {{ Auth::user()->name }}</span>
	    <span class="caret"></span></button>
	    <ul class="dropdown-menu">
	      <li><a href=""><span><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile </span></a></li>
	      @if(Auth::user()->level==1)
	      <li><a href="admin/user/list"><span><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Quản lí </span></a></li>
	      @endif
	      <li class="divider"></li>
	      <li>
	      	<a href="{{ route('getDangXuat') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="fa fa-sign-out">
                <span><i class="fa fa-sign-out" aria-hidden="true"></i>Đăng xuất</span>
            </a>
            <form id="logout-form" action="{{  route('getDangXuat') }}" method="PUT" style="display: none;">
	            {{ method_field('PUT') }}
	       		{{ csrf_field() }}
            </form>
	      </li>
	    </ul>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		     $("#login").hide();
		});
	</script>
	<div class="w3l_login" id="login">
		<a href="#" data-toggle="modal" data-target="#myModal88">
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
		</a>
	</div>
	<div class="cart cart box_1"> 
		<button class="glyphicon glyphicon-shopping-cart my-cart-icon" type="submit" name="submit" value=""><i class="badge badge-notify my-cart-badge" aria-hidden="true"></i></button>
	</div>
	
                      
	@else
	<div class="w3l_login" id="login">
		<a href="#" data-toggle="modal" data-target="#myModal88">
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
		</a>
	</div>
	<div class="cart cart box_1"> 
			<button class="glyphicon glyphicon-shopping-cart my-cart-icon" type="submit" name="submit" value=""><i class="badge badge-notify my-cart-badge" aria-hidden="true"></i></button>
	</div>
	@endif
</div>
</div>




<!-- header-bot -->
<a href="javascript:;" id="sidebar" onclick="return:true;">
                            <span  ></span>
                            Ẩn Tin Nhắn
                        </a>
<div class="header-bot">
	<div class="header-bot_inner_wthreeinfo_header_mid">
		<div class="col-md-4 header-middle">
			<form action="timkiem" method="post">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="search" name="tukhoa" placeholder="Search here..." required="">
					<input type="submit" value=" ">
				<div class="clearfix"></div>
			</form>
		</div>
		<!-- header-bot -->
			<div class="col-md-4 logo_agile">
				<h1><a href="trangchu/home"><span>E</span>lite Shoppy <i class="fa fa-shopping-bag top_logo_agile_bag" aria-hidden="true"></i></a></h1>
			</div>
        <!-- header-bot -->
		<div class="col-md-4 agileits-social top_content">
						<ul class="social-nav model-3d-0 footer-social w3_agile_social">
						                                   <li class="share">Share On : </li>
															<li><a href="#" class="facebook">
																  <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
															<li><a href="#" class="twitter"> 
																  <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
															<li><a href="#" class="instagram">
																  <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
															<li><a href="#" class="pinterest">
																  <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
														</ul>



		</div>
		<div class="clearfix"></div>
	</div>
</div>

<!-- //header-bot -->
	<div class="navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.html" class="act">Home</a></li>	
						<!-- Mega Menu -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="col-sm-3">
										<ul class="multi-column-dropdown">
											<h6>Clothing</h6>
											<li><a href="trangchu/dress">Dresses<span>New</span></a></li>
											<li><a href="sweaters.html">Sweaters</a></li>
											<li><a href="skirts.html">Shorts & Skirts</a></li>
											<li><a href="jeans.html">Jeans</a></li>
											<li><a href="shirts.html">Shirts & Tops<span>New</span></a></li>
										</ul>
									</div>
									<div class="col-sm-3">
										<ul class="multi-column-dropdown">
											<h6>Ethnic Wear</h6>
											<li><a href="salwars.html">Salwars</a></li>
											<li><a href="sarees.html">Sarees<span>New</span></a></li>
											<li><a href="products.html"><i>Summer Store</i></a></li>
										</ul>
									</div>
									<div class="col-sm-2">
										<ul class="multi-column-dropdown">
											<h6>Foot Wear</h6>
											<li><a href="sandals.html">Flats</a></li>
											<li><a href="sandals.html">Sandals</a></li>
											<li><a href="sandals.html">Boots</a></li>
											<li><a href="sandals.html">Heels</a></li>
										</ul>
									</div>
									<div class="col-sm-4">
										<div class="w3ls_products_pos">
											<h4>50%<i>Off/-</i></h4>
											<img src="images/1.jpg" alt=" " class="img-responsive" />
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</ul>
						</li>
						<li><a href="about.html">About Us</a></li>
						<li><a href="short-codes.html">Short Codes</a></li>
						<li><a href="mail.html">Mail Us</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
</div>

	