<div class="body-content outer-top-xs" id="top-banner-and-menu">
	  <div class="container">
		<div class="row"> 
		  <!-- ============================================== SIDEBAR ============================================== -->
		  <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
			
			<?php $this->load->view('common/navigation'); ?>

			<div class="promo-banner"><img src="/assets/default/images/banners/promo-banner.jpg" alt=""></div>
			 <!-- ================================== promo-banner : END ================================== --> 
			
			
			<?php $this->load->view('product/hotdeal'); ?>
			
			<?php $this->load->view('product/special_offer');?>
			
			<?php $this->load->view('product/tag'); ?>
			<?php $this->load->view('product/special_deal');?>
			
			<?php $this->load->view('home/newsletter'); ?>
			
			<?php $this->load->view('home/testmonial');?>
			
			<div class="home-banner"> <img src="/assets/default/images/banners/LHS-banner.jpg" alt="Image"> </div>
		  </div>
		  <!-- /.sidemenu-holder --> 
		  <!-- ============================================== SIDEBAR : END ============================================== --> 
		  
		  <!-- ============================================== CONTENT ============================================== -->
		  <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
		  
		   <?php $this->load->view('common/slider'); ?>
		   <?php $this->load->view('home/box_info'); ?>
		   
		   <?php $this->load->view('product/new');?>
		   <?php $this->load->view('home/banner1');?>
		   <?php $this->load->view('product/feature');?> 
		   <?php $this->load->view('home/banner2');?>
		   <?php $this->load->view('product/bestseller');?>
			
		   <?php $this->load->view('news/new');?> 
			
		   <?php $this->load->view('product/categories');?> 
			
		  </div>
		  <!-- /.homebanner-holder --> 
		  <!-- ============================================== CONTENT : END ============================================== --> 
		</div>
		<!-- /.row --> 
		<?php $this->load->view('common/brand');?>
	  </div>
	  <!-- /.container --> 
	</div>
	<!-- /#top-banner-and-menu --> 