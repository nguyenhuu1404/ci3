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

?>
<div class="full mb-3">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-12">
				<div class="box-shadow bg-white p-3">
					<form method="post" role="form">
						<div class="row">
							<div class="col-md-12 mb-3">
								<h4 class="mt-4">LIÊN HỆ VỚI CHÚNG TÔI</h4>
								<p class="mb-3">
									Bạn đang cần mua các thảo dược tự nhiên: sâm ngọc linh, nấm linh chi, nấm chaga, đông trùng hạ thảo… Liên hệ ngay với chúng tôi. Chúng tôi luôn sẵn sàng tư vấn cho bạn về các vấn đề sức khỏe cũng như các sản phẩm điều trị và bồi bổ sức khỏe. Hãy để chúng tôi bảo vệ sức khỏe vàng của bạn!
								</p>
							</div>
							
							<div class="col-md-4 ">
								<div class="form-group">
									<label class="info-title" for="fullname">Họ tên <span>*</span></label>
									<input type="text" class="form-control" value="<?=$fullname;?>" name="fullname" id="fullname" placeholder="Họ tên" />
									<small id="fullname" class="form-text text-danger">
								    	<?php echo form_error('fullname'); ?>
								    </small>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="info-title" for="email">Email <span>*</span></label>
									<input type="email" value="<?=$email;?>" name="email" class="form-control" id="email" placeholder="Email" />
									<small id="email" class="form-text text-danger">
								    	<?php echo form_error('email'); ?>
								    </small>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="info-title" for="phone">Số điện thoại <span>*</span></label>
									<input type="text" value="<?=$phone;?>" name="phone" class="form-control" id="phone" placeholder="Số điện thoại" />
									<small id="phone" class="form-text text-danger">
								    	<?php echo form_error('phone'); ?>
								    </small>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="info-title" for="content">Nội dung</label>
									<textarea name="content" class="form-control" id="content"><?=set_value('content');?></textarea>
								</div>
							</div>
							<div class="col-md-12 outer-bottom-small m-t-20">
								<button type="submit" class="btn-upper btn btn btn-warning">Liên hệ</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-3 col-12">
				<?php $this->load->view('common/support'); ?>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('common/products');
?>    	