<div class="full  top-header bg_main white">
	<div class="container">
		<div class="row">
			<div class="col-12 d-none d-sm-block col-md-6">
				Sản phẩm vì sức khỏe cộng đồng!
			</div>
			<div class="col-12 col-md-6">
				<div class="float-right social">
					<a rel="nofollow" href="https://www.facebook.com/tuthuocnam158" class="follow-facebook" target="_blank"><i class="fa fa-facebook"></i></a>
					<a rel="nofollow" href="https://twitter.com/tuthuocnam" class="follow-twitter" target="_blank"><i class="fa fa-twitter"></i></a>
					<a rel="nofollow" href="https://plus.google.com/100710732944860905712" class="follow-google" target="_blank"><i class="fa fa-google"></i></a>
					<a rel="nofollow" href="https://www.pinterest.com/tuthuocnam158/" class="follow-pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>
				</div>
				<?php if(!$this->session->userdata('userData')){ ?>
					<a class="float-right text-white fs075 pr-3 text-uppercase" href="/my-account.html">Đăng nhập / Đăng kí </a>
				<?php } else{
					echo '<div class="dropdown show">
					  <a class="btn mt-1 text-white pull-right dropdown-toggle" href="#" role="button" id="account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Tài khoản
					  </a>

					  <div class="dropdown-menu account" aria-labelledby="account">
					    <a class="dropdown-item" href="/my-account.html">Bảng điều khiển</a>
					    <a class="dropdown-item" href="/sam/users/orders">Đơn hàng</a>
					     <a class="dropdown-item" href="/sam/users/edit">Trang cá nhân</a>
					    <a class="dropdown-item" href="/sam/users/logout">Đăng xuất</a>
					  </div>
					</div>'	;
				} ?>	
				
			</div>
		</div>
	</div>
</div>

<div class="main-header bg-white full">
	<div class="container">
		<div class="d-flex flex-row align-items-center">
			<div class="p-2 d-none d-sm-block">
				<a href="/"><h1 class="text-hide logo"><?php if(isset($name)){ echo $name; }else{ echo 'Sâm ngọc linh'; }?></h1></a>
			</div>
			<div class="p-2 ml-auto d-none d-sm-block">
				
				<i class="fa fa-paper-plane text-info"></i> tuthuocnam158@gmail.com &nbsp; &nbsp;
		
				<a href="skype:huunv90" rel="nofollow"><i class="fa cl-skype fa-skype" ></i> huunv90 </a> 

			</div>
			<div class="p-2"><i class="fa text-warning fa-phone"></i> 0986.654.606</div>
				
			<div class="ml-auto p-2">
				<div class="dropdown">
					<button  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-warning" >
					 	<i class="fa fa-shopping-cart"></i>
					 	<span id="num-cart" class="num-cart"><?=$this->cart->total_items();?></span> 
					 	<span class="d-none d-sm-inline">Giỏ hàng</span>		
			 		</button >
				  
				  	<div id="box-cart" class="dropdown-menu m-0 p-0 box-shadow dropdown-menu-right" aria-labelledby="dropdownMenu2">
				    	<?php $this->load->view('cart/cart'); ?>
				  	</div>
				</div>

				
			</div>
		</div>
	</div>
	
</div>

<div class="navigation mb-3  bg-white full">
	<div class="container">
		<nav class="navbar px-0 bg-none navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand d-block d-sm-none m-0" href="/"><i class="fa fa-home main-color"></i></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">

		    	
		     <?php
				$items = buildTree($categories);
				showHomeMenuBs($items, $parents);
			?>
		      
		    </ul>
		    <form method="get" action="/sam/products/search" class="form-inline my-2 my-lg-0">
				<div class="input-group">
			  		<input name="name" class="form-control" type="search" placeholder="Tìm kiếm..." aria-label="Search">
			  		<div class="input-group-append">
			    		<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
			  		</div>
				</div>

		    </form>
		  </div>
		</nav>
	</div>
</div>