window.onload = function () {
    echo.init({
        offset: 250,
		throttle: 50,
		unload: false,
		
    });
    if(typeof minPrice !== 'undefined' && typeof maxPrice !== 'undefined'){
    	sliderPrice(minPrice, maxPrice);
    };
    if(0){
    	$('body').bind('cut copy paste', function (e) {
	        e.preventDefault();
	    });
	    $("body").on("contextmenu",function(e){
	        return false;
	    });
		$(document).keydown(function(event){
			if (event.keyCode == 123 || (event.ctrlKey && event.keyCode == 85) || (event.ctrlKey && event.shiftKey && event.keyCode == 73 || event.keyCode == 116)) {
	            return false;
	        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
	            return false; //Prevent from ctrl+shift+i
	        }
		});
    }
    
};

$('.input-radio').click(function() {
	var payment_method = $('input[name=payment_method]:checked').val();
	
	if(payment_method == 'bacs'){
		$('.payment_method_bacs').show();
		$('.payment_method_cod').hide();
	}else if(payment_method == 'cod'){
		$('.payment_method_bacs').hide();
		$('.payment_method_cod').show();
	}
});

$('#dathang').click(function(){
	$('#checkout').submit();
	$(this).attr("disabled", true);
});


$('.image-item').click(function(){
	var image = $(this).attr('data');
	$('#gallery-image').attr('src', image);
	$('.image-item').removeClass('bdred');
	$(this).addClass('bdred');
});

$('.minus').click(function(){
	var first = $('#quantity').val();
	if(parseInt(first) > 1){
		$('#quantity').val(parseInt(first) - 1);
	}
	
});
$('.plus').click(function(){
	var first = $('#quantity').val();
	$('#quantity').val(parseInt(first) + 1);
});

function addCart(productId){
	var quantity = parseInt($('#quantity').val());
	$.ajax({
	  method: "POST",
	  url: "/sam/cart/addcart",
	  data: { productId: productId, quantity: quantity }
	})
	  .done(function( msg ) {
	  	
	    $('#quantity').val(1);
	    $('#box-cart').html(msg);
	    var totalCart = $('#total-item').val();
	    $('#num-cart').text(totalCart);
	    $('#dropdownMenu2').trigger("click");

	 });
};

function callMe(){
		var productName = $('#name-pr').val();
		var productId = $('#tuvan-pr').val();
		var tuvanName = $('#tuvan-name').val();
		$( "#tuvan-name" ).keyup(function() {
	  $('.error-name').text('');
	});
	$( "#tuvan-phone" ).keyup(function() {
	  $('.error-phone').text('');
	});
		if(tuvanName == ''){
			$('#tuvan-name').focus();
			$('.error-name').text('Họ tên không được để trống.');
			
		}else{
			$('.error-name').text('');
		}
		var tuvanPhone = $('#tuvan-phone').val();
		if(tuvanPhone == ''){
			$('#tuvan-phone').focus();
			$('.error-phone').text('Số điện thoại không được để trống.');
			
		}else {

        if (!isPhone(tuvanPhone)) {
        	$('#tuvan-phone').focus();
				$('.error-phone').text('Số điện không thoại hợp lệ.');
        }	
		}
		if(tuvanPhone != '' && tuvanName !=''){
			$.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>sam/products/tuvan',
                data: { productName: productName, productId: productId, tuvanName: tuvanName, tuvanPhone:tuvanPhone},
                success: function (html) {
            		$('#tv-success').html('Cảm ơn bạn! Yêu cầu của bạn đã được gửi.');
                	$('#tuvan-name').val('');
                	$('#tuvan-phone').val('');
                    
                }
            });
		}
	};
function isPhone(phone) {
  var phoneRe = /^(09)|(02)|(01[2689])[0-9]$/;
  var digits = phone.replace(/\D/g, "");
  return phoneRe.test(digits);
};

function sliderPrice(min, max){
    var range = parseInt(min) - 2;
    $( "#slider-range" ).slider({
      range: true,
      min: min,
      max: max,
      values: [ range, max ],
      slide: function( event, ui ) {
        $( "#amount" ).html( "Khoảng giá : $" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        $( "#minPrice" ).val(ui.values[ 0 ]);
        $( "#maxPrice" ).val(ui.values[ 1 ]);
      }
    });
    $( "#amount" ).html( "Khoảng giá : $" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    $( "#minPrice" ).val($( "#slider-range" ).slider( "values", 0 ));
    $( "#maxPrice" ).val($( "#slider-range" ).slider( "values", 1 ));
};
function removeCartItemMenu(id, cart){
	$.ajax({
	  	method: "POST",
	  	url: "/sam/cart/removeCartItemMenu",
	  	data: { id: id }
	})
	  	.done(function( msg ) {
	  	if(cart == 'cart'){
	  		location.reload();	
	  	}else{
	  		$('#box-cart').html(msg);
	    	var totalCart = $('#total-item').val();
	   		$('#num-cart').text(totalCart);
	    	$('#dropdownMenu2').trigger("click");
	  	}
	    

	});
};