<?php 
	$userData = $this->session->userdata('userData');
	$fullname = $email = $phone = $address_ship = '';
	if(isset($userData['fullname'])){
		$fullname = $userData['fullname'];
	}
	if(set_value('fullname')){
		$fullname = set_value('fullname');
	}

	if(isset($userData['email'])){
		$email = $userData['email'];
	}
	if(set_value('email')){
		$email = set_value('email');
	} 

	if(isset($userData['phone'])){
		$phone = $userData['phone'];
	}
	if(set_value('phone')){
		$phone = set_value('phone');
	}

	if(isset($userData['address_ship'])){
		$address_ship = $userData['address_ship'];
	}
	if(set_value('address_ship')){
		$address_ship = set_value('address_ship');
	}    
?>
<div class="full mb-3">
  	<div class="container">
    	<div class="row">
        	<div class="col-md-9 col-12">
        	<?php if(!$this->session->userdata('userData')){ ?>
			<div class="alert alert-info" role="alert">
			  Đăng nhập để thanh toán? <a href="/my-account.html?payment=1" class="alert-link">Ấn vào đây</a>. 
			</div>
			<?php } ?>

        	<form id="checkout" method="post">
        		<div class="card-deck">
        			
    				<div class="card box-shadow bg-white">
    					<div class="card-header bg-transparent" >
    						<h3 class="fs13 m-0">Thông tin thanh toán</h3>
    					</div>
    					<div class="card-body">
    						<div class="form-group">
							    <label for="fullname">Họ tên *</label>
							    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Họ tên" value="<?= $fullname; ?>" />
							     <small id="fullname" class="form-text text-danger">
							    	<?php echo form_error('fullname'); ?>
							    </small>
							    
							 </div>

							 <div class="form-group">
							    <label for="email">Email *</label>
							    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" value="<?=$email; ?>" />
							    <small id="emailHelp" class="form-text text-danger">
							    	<?php echo form_error('email'); ?>
							    </small>
							 </div>

							 <div class="form-group">
							    <label for="phone">Điện thoại *</label>
							    <input name="phone" type="text" class="form-control" id="phone" aria-describedby="phone" placeholder="Điện thoại" value="<?=$phone; ?>" />
							    <small id="phone" class="form-text text-danger">
							    	<?php echo form_error('phone'); ?>
							    </small>
							 </div>
							 <div class="form-group">
							    <label for="address_ship">Địa chỉ giao hàng</label>
							    <input type="text" class="form-control" id="address_ship" name="address_ship" aria-describedby="address_ship" placeholder="Địa chỉ giao hàng" value="<?=$address_ship; ?>" />
							    
							 </div>
							 <div class="form-group">
							    <label for="note">Ghi chú</label>
							    <textarea class="form-control" id="note" name="note" rows="3"><?php echo set_value('note'); ?></textarea>
							 </div>
    					</div>		
    				</div>	

    				<div class="card box-shadow bg-white">
    					<div class="card-header bg-transparent" >
	        				<h3 class="fs13 m-0">Đơn hàng của bạn</h3>
	        			</div>	
						
						<div class="card-body">
							<table class="table-bordered table">

								<tr>
							        <th>Sản phẩm</th>
							        <th style="text-align:right">Thành tiền</th>
								</tr>

								<?php foreach ($this->cart->contents() as $items): ?>
							        <tr>
						                <td>
						                    <?php echo $items['name'].' × '.$items['qty']; ?>
						                </td>
						                <td style="text-align:right">
						                <?php echo formatPrice($items['subtotal']); ?>
						                	
						                </td>
							        </tr>
								<?php endforeach; ?>
								<tr>
							        <td class="text-right"><strong>Tổng tiền</strong></td>
							        <td class="text-right"><b class="main-color fs13"><?php echo formatPrice($this->cart->total()); ?></b>
							        </td>
								</tr>
							</table>
							
							<h3 class="fs13">Phương thức thanh toán</h3>
							<hr/>
							<ul class="payment_methods p-0">
								<li>
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" />

									<label for="payment_method_bacs">
									Chuyển khoản ngân hàng 	</label>
									<div class="payment_method_bacs" style="display: none;">
										<p>Chuyển khoản cho chúng tôi theo thông tin tài khoản ghi trong đơn hàng. Trong phần nội dung chuyển tiền ghi rõ mã đơn hàng. Đơn hàng của bạn sẽ không được vận chuyển cho đến khi tiền được gửi vào tài khoản của chúng tôi.</p>
									</div>
								</li>
								<li>
									<input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" checked="checked" />

									<label for="payment_method_cod">
										Thanh toán khi giao hàng 	</label>
									<div class="payment_method_cod" style="display: block;">
									<p>Trả tiền mặt khi giao hàng</p>
									</div>
								</li>
							</ul>

							
							<input id="dathang" type="submit" value="Đặt hàng" class="btn btn-lg w-100 btn-danger" />
							
							<script type="text/javascript">
							$('#dathang').click(function(){
								$('#checkout').submit();
								$(this).attr("disabled", true);
							});
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
							</script>
						</div>	
	
					</div>

        		</div>
        		</form>
        			
        	</div>

        	<div class="col-md-3 col-12">
				<?php $this->load->view('common/rightcontent'); ?>
        	</div>
    	</div>
   </div>
</div>        