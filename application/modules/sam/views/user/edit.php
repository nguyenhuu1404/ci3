<?php 
	$userData = $this->session->userdata('userData');

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
			<div class="col-12  col-md-9">
				<div class="box-shadow bg-white p-3">
					<nav class="nav p-2 bg-light mb-3 nav-pills flex-column flex-sm-row">
					  <a class="flex-sm-fill text-sm-center nav-link " href="/my-account.html">Bảng điều khiển</a>
					  <a class="flex-sm-fill text-sm-center nav-link" href="/sam/users/orders">Đơn hàng</a>
					  <a class="flex-sm-fill text-sm-center nav-link active" href="/sam/users/edit">Trang cá nhân</a>
					  <a class="flex-sm-fill text-sm-center nav-link " href="/sam/users/logout">Đăng xuất</a>
					</nav>

					<h4 class="title-new mb-3">Thêm thông tin cá nhân</h4>
					<form class="register-form outer-top-xs" method="post" role="form">
						<div class="form-group">
					    	<label class="info-title" for="address_ship">Địa chỉ giao hàng</label>
					    	<input type="text" name="address_ship" value="<?=$address_ship;?>" class="form-control text-input" id="address_ship" />
					    	<small id="address_ship" class="form-text text-danger">
						    	<?php echo form_error('address_ship'); ?>
						    </small>
					  	</div>
				       
				        <div class="form-group">
						    <label class="info-title" for="oldpassword">Mật khẩu hiện tại</label>
						    <input type="password" name="oldpassword" class="form-control" value="<?=set_value('oldpassword');?>" id="oldpassword" />
						    <small id="oldpassword" class="form-text text-danger">
						    	<?php echo form_error('oldpassword'); ?>
						    </small>
						</div>

						 <div class="form-group">
						    <label class="info-title" for="password">Mật khẩu mới</label>
						    <input type="password" name="password" class="form-control" value="<?=set_value('password');?>" id="password" />
						    <small id="password" class="form-text text-danger">
						    	<?php echo form_error('password'); ?>
						    </small>
						</div>
				         <?php if(isset($success)){
				         		echo '<div class="alert alert-success">'.$success.'</div>';
				         	} ?>
				         	<?php if(isset($error)){
				         		echo '<div class="alert alert-danger">'.$error.'</div>';
				         	} ?>
					  	<button type="submit" name="signup" value="1" class="btn-upper btn btn-warning">Cập nhật</button>
					</form>
					
				</div>
				
			</div>
			<div class="col-md-3 col-12">
				<?php $this->load->view('common/support'); ?>
			</div>
		</div>
	</div>
</div>			