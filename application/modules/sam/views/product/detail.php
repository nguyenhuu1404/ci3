<?php

if($product['price_sale']){
	$price = $product['price_sale'].'000';
}else{
	if($product['price']){
		$price = $product['price'].'000';
	}else{
		$price = 0; 
	}
}
?>
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "<?=$product['name'];?>",
  "image": "<?php echo base_url('assets/sam/images/products/home/').$product['image']; ?>",
  "description": "<?=$product['description'];?>",
  "mpn": "925872",
  "brand": {
    "@type": "Thing",
    "name": "ACME"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "<?=$product['views'];?>"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VNĐ",
    "price": "<?=$price;?>",
    "itemCondition": "http://schema.org/UsedCondition",
    "availability": "http://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "Executive Objects"
    }
  }
}
</script>
<?php $dataUser = $this->session->userdata('userData'); ?>
<div class="full mb-3">
	<div class="container">
		<?php $this->load->view('common/breadcumbs'); ?>

		<div class="box-shadow bg-white p-3 mb-3">
			<div class="row">
				<div class="col-md-4">
					<div class="gallery mb-2">
						<img id="gallery-image" title="<?=$product['title'];?>" alt="<?=$product['title'];?>" class="w-100" src="<?=base_url()?>assets/sam/images/products/<?=$product['image'];?>" />
					</div>
					<?php if($galleries) { ?>
					<div class="gallery-item">
						<div class="full pl-2">
							<div class="w-25 pull-left pr-2">
								<img title="<?=$product['name'];?>" data="/assets/sam/images/products/<?=$product['image'];?>" alt="<?=$product['name'];?>" class="w-100 image-item pointer bdred" src="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
							</div>
							<?php foreach ($galleries as $gallery) { ?>
							<div class="w-25 pull-left pr-2">
								<img title="<?=$gallery['title'];?>"  alt="<?=$gallery['title'];?>" data="/assets/sam/images/products/galleries/<?=$gallery['url'];?>" class="w-100 image-item pull-left pointer" src="/assets/sam/images/products/galleries/thumb__<?=$gallery['url'];?>" />
							</div>
							<?php } ?>
							
						</div>
					</div>
					<script>
						$('.image-item').click(function(){
							var image = $(this).attr('data');
							$('#gallery-image').attr('src', image);
							$('.image-item').removeClass('bdred');
							$(this).addClass('bdred');
						});
					</script>
					<?php } ?>	
				</div>
				<div class="col-md-8">
					<h2><?=$product['name'];?></h2>
					 
					<?php if($product['outstock'] == 1){
						echo '<h5 class="main-color">Hết hàng</h5>';	
					} ?>
					<div class="mb-2">
						<?= $product['brief']; ?>
					</div>

					<?php if($product['outstock'] != 1) { ?>
					<div class="price-box mb-3">
                          <?php if($product['price_sale'] && $product['price']){ ?> 
                            <span class="price main-color"><?=formatPrice($product['price_sale']);?></span>
                            <span class="price-strike"><?= formatPrice($product['price']);?></span>
                           <?php } else if($product['price']){
                                echo '<span class="price main-color">'. formatPrice($product['price']) .'</span>'; 
                            }else{
                                echo '<span class="price main-color">Giá liên hệ</span>';
                              } ?>
						
					</div>

					<div class="quantity-container mb-2">
						<div class="row">
							<?php if($product['price'] || $product['price_sale']){ ?>
								<div class="col-sm-2">
									<b class="qty-span">Số lượng: </b>
								</div>
								
								<div class="col-sm-3 mb-2">
									<div class="quantity buttons_added">
										<span class="minus"></span> 
										<input type="number" id="quantity"  min="1" name="quantity" value="1" title="SL" size="4">
										<span class="plus"></span>
									</div> 
								</div>

								<div class="col-sm-3 mb-2">
									<button onclick="addCart(<?=$product['id'];?>);" class="btn  bgred btn-primary "><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
								</div>
								
							<?php } ?>

							
						</div><!-- /.row -->
					</div>
					
					<script>
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
						}
					</script>	

					<?php } ?>

					<div class="product_meta mb-3"> 
						<b class="mr-2">Tư vấn: </b>
							<a href="tel:0986654606" class="btn btn-warning"><i class="fa fa-phone"></i> 0986 654 606</a>
							<a href="tel:0988588197" class="btn btn-warning"><i class="fa fa-phone"></i> 0988 588 197</a>

							<button data-toggle="modal" data-target="#callme" class="btn btn-warning"><i class="fa fa-location-arrow"></i> Yêu cầu tư vấn</button>

							<!-- Modal -->
							<div class="modal fade" id="callme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header bg-info text-white">
							        <h5 class="modal-title text-uppercase" id="exampleModalLabel">Gọi cho tôi</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      		<input type="hidden" id="name-pr" value="<?=$product['name'];?>"  />
							      		<input type="hidden" id="tuvan-pr" value="<?=$product['id'];?>"  />
							        	<div class="form-group">
							            	<label for="tuvan-name" class="col-form-label">Họ tên(*)</label>
							            	<input type="text" class="form-control" value="<?php if(isset($dataUser['fullname'])){ echo $dataUser['fullname']; }?>" id="tuvan-name" />
							            	<div class="error-name text-danger mt-2"></div>
							          	</div>
							          	<div class="form-group">
							            	<label for="tuvan-phone" class="col-form-label">Số điện thoại(*)</label>
							            	<input type="text" value="<?php if(isset($dataUser['phone'])) { echo $dataUser['phone']; }?>" class="form-control" id="tuvan-phone" />
							            	<div class="error-phone text-danger mt-2"></div>
							          	</div>
							          	<div id="tv-success" class="text-success"></div>
							      </div>
							      
							       <button onclick="callMe();" type="button" class="btn w-25 mb-3 ml-3 btn-warning">Gửi</button>
							      <script>

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
							      	}
							      	function isPhone(phone) {
									  var phoneRe = /^(09)|(02)|(01[2689])[0-9]$/;
									  var digits = phone.replace(/\D/g, "");
									  return phoneRe.test(digits);
									}
							      </script>
							    </div>
							  </div>
							</div>
								
						
					</div>

					<?php if($tags){ ?>
					<div class="product_meta mb-3"> 
						<span class="tagged_as"><b>Từ khóa: </b>
							<?php 
							$i = 1;	
							foreach ($tags as $tag) { 
								if($i != 1){
									echo ',';
								}
								echo '<a href="/tu-khoa/'.$tag['slug'].'.html" rel="tag">'.$tag['name'].'</a>';

								$i++; 
							 } ?>
						</span>
					</div>
					<?php } ?>
					
					<div class="product-share  mb-2"> 
						<span class="share-title">Chia sẻ trên mạng xã hội</span>
						<ul class="menu-social-icons pull-right m-0">
							
							<li>
								<div id="fb-root"></div>
								<div class="fb-like" data-href="/san-pham/<?=$product['slug'];?>.html" data-layout="button_count"  data-size="small"  data-share="false"></div>
							</li>
							
							<li> 
								<a rel="nofollow" href="https://twitter.com/share?url=<?=site_url();?>san-pham/<?=$product['slug'];?>.html&amp;text=<?=urlencode($product['name']);?>" class="title-toolip" title="Twitter" target="_blank"> <i class="fa fa-twitter"></i> </a>
							</li>
							<li> 
								<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?=site_url();?>san-pham/<?=$product['slug'];?>.html&amp;images=<?=base_url();?>assets/sam/images/products/<?=$product['image'];?>" class="title-toolip" title="Facebook" target="_blank"> <i class="fa fa-facebook"></i> </a>
							</li>
							<li>
								<a rel="nofollow" href="http://pinterest.com/pin/create/button/?url=<?=site_url();?>san-pham/<?=$product['slug'];?>.html&amp;media=<?=base_url();?>assets/sam/images/products/<?=$product['image'];?>&amp;description=<?=urlencode($product['name']);?>" class="title-toolip" title="Pinterest" target="_blank"> <i class="fa fa-pinterest"></i> </a>
							</li>
							<li> 
								<a rel="nofollow" href="http://plus.google.com/share?url=<?=site_url();?>san-pham/<?=$product['slug'];?>.html" class="title-toolip" title="Google +" target="_blank"> <i class="fa fa-google-plus"></i> </a>
							</li>
							<li> 
								<a rel="nofollow" href="https://web.skype.com/share?url=<?=site_url();?>san-pham/<?=$product['slug'];?>.html" title="skype" target="_blank"> <i class="fa fa-skype"></i> </a>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>

		<div class="box-shadow bg-white p-3 mb-3">
			<div class="content">
				<?=$product['content'];?>
			</div>
			<div class="comment-facebook">
				
			</div>
		</div>
		<?php if($relateProducts){ ?>
		<div class="full mb-3 box-shadow bg-white">
          <h2 class="title">Sản phẩm liên quan</h2>
          <div class="row mx-0 mt-3 pb-3">
				<?php foreach ($relateProducts as $val) { ?>
					
                <div class="col-md-3 col-12 mb-3">
                    <div class="product-img text-center position-relative">
                      <a href="/san-pham/<?=$val['slug'];?>.html">
                        <img src="/assets/sam/images/blank.gif" class="img-fluid" data-echo="/assets/sam/images/products/category/<?=$val['image'] ?>" title="<?=$val['name'];?>" alt="<?=$val['name'];?>" />
                      </a>
                      <?php if($val['hot'] == 1){ ?>
                        <div class="tag hot"><span>hot</span></div>
                      <?php } ?>
                      <?php if($val['new'] == 1){ ?>
                        <div class="tag new"><span>new</span></div>
                      <?php } ?> 
                      <?php if($val['price_sale']){ ?>
                        <div class="tag sale"><span>sale</span></div>
                      <?php } ?>   
                    </div>
                    <h2 class="name"><a href="/san-pham/<?=$val['slug'];?>.html"><?=$val['name']?></a></h2>
                    <p class="mb-2"><?=$val['brief']?></p>
                    <div class="product-price">
                      <?php if($val['outstock'] == 1) { ?>
                      <span class="price">Hết hàng</span>
                      <?php } else { ?>
                          <?php if($val['price_sale'] && $val['price']){ ?> 
                            <span class="price"> <?= formatPrice($val['price_sale']); ?></span> 
                            <span class="price-before-discount"><?= formatPrice($val['price']); ?></span>
                           <?php } else if($val['price']){
                                echo '<span class="price">'. formatPrice($val['price']) .'</span>'; 
                            }else{
                                echo '<span class="price">Giá liên hệ</span>';
                              } ?>
                       <?php } ?>         
                    </div>
                    
                </div>

            	<?php } ?>
                           
          </div>
         
        </div>
        <?php }?>

	</div>
	
</div>

 <?php
		$this->load->view('common/products');
		?> 
