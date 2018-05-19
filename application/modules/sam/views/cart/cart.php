<?php 
	$carts = $this->cart->contents();
	if($this->cart->total_items() > 0){
		echo '<input type="hidden" id="total-item" value="'.$this->cart->total_items().'" />';
		foreach ($carts as $cart) {
			echo '<div class="row m-0 border-bottom">';
				echo '<div class="col-3 pl-0 pr-0">';
					echo '<img src="/assets/sam/images/products/thumb/'.$cart['image'].'" class="img-fluid" />';
				echo '</div>';
				echo '<div class="col-7 pt-2 pr-0">';
					echo '<a class="color-text main-hover" href="/san-pham/'.$cart['slug'].'.html"><h5 class="fs09">'.$cart['name'].'</h5></a>';
					echo $cart['qty'].' x '.formatPrice($cart['price']);
				echo '</div>';
				echo '<div class="col-2 pt-2">';
					echo '<i onclick="removeCartItemMenu('.$cart['id'].');" class="fa pointer fa-times"></i>';	
				echo '</div>';
			echo '</div>';
			
		}
		echo '<div class="p-3 text-center"><b>Tổng tiền:</b> <b class="fs13 main-color">'. formatPrice($this->cart->total()).'</b></div>';
		echo ' <div class="card-footer">
   			<a class="btn btn-warning" href="/gio-hang.html">Xem giỏ hàng</a>
   			<a class="btn btn-danger" href="/thanh-toan.html">Thanh toán</a>
  		</div>';
  		?>
  	
  	<?php	
	}else{
		echo '<input type="hidden" id="total-item" value="'.$this->cart->total_items().'" />';
		echo '<div class="alert m-0 alert-warning text-center">Giỏ hàng trống</div>';
	}
?>