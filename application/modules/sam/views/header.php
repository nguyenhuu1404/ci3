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
				<a class="float-right fs075 pr-3 text-uppercase" href="http://tuthuocnam.com/my-account" class="">Đăng nhập / Đăng kí </a>
				
			</div>
		</div>
	</div>
</div>

<div class="main-header bg-white full">
	<div class="container">
		<div class="d-flex flex-row align-items-center">
			<div class="p-2 d-none d-sm-block">
				<h1 class="text-hide logo">Sâm ngọc linh</h1>
			</div>
			<div class="p-2 ml-auto d-none d-sm-block">
				
				<i class="fa fa-paper-plane"></i> ha.vuvu25@gmail.com
		
				<a href="skype:huunv90" rel="nofollow"><i class="fa fa-skype" style="color: #00bfee;"></i> huunv90 </a> 

			</div>
			<div class="p-2"><i class="fa fa-phone" style="color: #f28705;"></i> 0988.588.197</div>
				
			<div class="ml-auto p-2">
				<div class="dropdown">
					<div id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="pointer" >
					 	<i class="fa fa-shopping-cart"></i>
					 	<span class="num-cart">0</span> 
					 	<span class="d-none d-sm-inline">Giỏ hàng</span>		
			 		</div>
				  
				  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
				    <button class="dropdown-item" type="button">Hướng dẫn mua hàng</button>
				    <button class="dropdown-item" type="button">hướng đẫn thanh toán</button>
				    <button class="dropdown-item" type="button">Something else here</button>
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
		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
		    </form>
		  </div>
		</nav>
	</div>
</div>