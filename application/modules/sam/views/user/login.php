<div class="full mb-3">
	<div class="container">
		<div class="box-shadow bg-white p-3 mb-3">
			<div class="row">
				<!-- Sign-in -->			
				<div class="col-md-6 col-12 mb-3">
					<h4 class="title-new mb-3">Đăng nhập</h4>
					
					<div class="social-sign-in outer-top-xs mb-3">
						<a href="<?=$authURL;?>" class="facebook-sign-in"><i class="fa fa-facebook"></i> Đăng nhập bằng Facebook</a>
						
					</div>
					<form class="register-form outer-top-xs" method="post" role="form">
						<div class="form-group">
						    <label class="info-title" for="in_email">Email <span>*</span></label>
						    <input type="email" name="in_email" class="form-control" id="in_email" >
						</div>
					  	<div class="form-group">
						    <label class="info-title" for="in_password">Password <span>*</span></label>
						    <input type="password" name ="in_password" class="form-control" id="in_password" >
						</div>
						<div class="radio outer-xs">
						  	<label>
						    	<input class="mr-2" type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Nhớ mật khẩu.
						  	</label>
						  	<a href="#" class="forgot-password pull-right">Quên mật khẩu?</a>
						</div>
						<?php 
							if(isset($in_errors) && count($in_errors) > 0){ 
								foreach($in_errors as $error){
									echo '<div class="alert alert-danger">'.$error.'</div>';
								}
							} 
						?>
					  	<button type="submit" name="signin" value="1" class="btn-upper btn btn-warning">Đăng nhập</button>
					</form>					
				</div>
				<!-- Sign-in -->

				<!-- create a new account -->
				<div class="col-md-6 col-12 mb-3">
					<h4 class="title-new mb-3">Đăng kí</h4>
					<form class="register-form outer-top-xs" method="post" role="form">
						<div class="form-group">
						    <label class="info-title" for="fullname">Họ tên <span>*</span></label>
						    <input type="text" name="fullname" value="<?=set_value('fullname');?>" class="form-control text-input" id="fullname" />
						    <small id="fullname" class="form-text text-danger">
						    	<?php echo form_error('fullname'); ?>
						    </small>
						</div>
						<div class="form-group">
					    	<label class="info-title" for="email">Email <span>*</span></label>
					    	<input type="email" name="email" value="<?=set_value('email');?>" class="form-control text-input" id="email" />
					    	<small id="email" class="form-text text-danger">
						    	<?php echo form_error('email'); ?>
						    </small>
					  	</div>
				        <div class="form-group">
						    <label class="info-title" for="phone">Điện thoại <span>*</span></label>
						    <input type="text" name="phone" value="<?=set_value('phone');?>" class="form-control" id="phone" />
						    <small id="phone" class="form-text text-danger">
						    	<?php echo form_error('phone'); ?>
						    </small>
						</div>
				        <div class="form-group">
						    <label class="info-title" for="password">Password <span>*</span></label>
						    <input type="password" name="password" class="form-control" value="<?=set_value('password');?>" id="password" />
						    <small id="password" class="form-text text-danger">
						    	<?php echo form_error('password'); ?>
						    </small>
						</div>
				         
					  	<button type="submit" name="signup" value="1" class="btn-upper btn btn-warning">Đăng kí</button>
					</form>
					
					
				</div>	
				<!-- create a new account -->			
			</div><!-- /.row -->
		</div>
	</div>
</div>			