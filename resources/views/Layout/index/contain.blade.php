
<!DOCTYPE html>
<html>
<head>
<title>Women's Fashion a Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<base href="{{asset('')}}">
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Women's Fashion Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="assert/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="assert/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="assert/css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->

<script src="assert/js/jquery.min.js"></script>

<!-- //js -->
<!-- countdown -->
<link rel="stylesheet" href="assert/css/jquery.countdown.css" />
<!-- //countdown -->
<!-- cart -->
<script src="assert/js/simpleCart.min.js"></script>
<!-- cart -->
<!-- for bootstrap working -->
<script type="text/javascript" src="assert/js/bootstrap-3.1.1.min.js"></script>
<!-- //for bootstrap working -->
<link href='fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
<link href='fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

<!-- start-smooth-scrolling -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js"></script>





<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- //end-smooth-scrolling -->
</head>
	
<body>
<a href="#data" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>	
@include('Layout.index.cartbox')
<!-- header -->

	@include('Layout.index.header')


<!-- //header -->
<!-- banner -->
    @yield('content')
<!-- //top-brands -->
<!-- newsletter -->
	@include('Layout.index.about')
	<!-- //chatbox -->
	@include('Layout.index.chatbox')
<!-- //footer -->
<script type="text/javascript">
		var socket=io('http://localhost:6001');
		socket.on('productHaschange',function(data)	{
		alert("Sản phẩm ---"+data.name+"---đã được thay đổi quý khách vui lòng load"+
		" lại trang");

		
})
</script> 

</body>
</html>