<script type='text/javascript' src="cart_shop/js/jquery.mycart.js"></script>
<script type="text/javascript">
	
    $(function () {
        
      var goToCartIcon = function($addTocartBtn){
        var $cartIcon = $(".my-cart-icon");
        var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
        $addTocartBtn.prepend($image);
        var position = $cartIcon.position();
        $image.animate({
          top: position.top,
          left: position.left
        }, 500 , "linear", function() {
          $image.remove();
        });
      }
          
      $('.my-cart-btn').myCart({
      });
  
    
    });
    </script>
      <!-- //cart-js -->  