<script type="application/ld+json">
{ "@context": "http://schema.org", 
 "@type": "Article",
 "headline": "Sâm ngọc linh",
 "alternativeHeadline": "Sản phẩm vì sức khỏe cộng đồng!",
 "image": "<?php echo base_url('assets/sam/images/news/category/').$new['image']; ?>",
 "author": "huunv90", 
 "award": "Best article ever written",
 "editor": "Craig Mount", 
 "genre": "search engine optimization", 
 "keywords": "<?=$new['name']; ?>", 
 "publisher": "tuthuocnam1508",
 "url": "<?=current_url();?>",
 "datePublished": "<?php $tam = strtotime($new['created']); echo date('Y-m-d', $tam);?>",
 "dateCreated": "<?php $tam = strtotime($new['created']); echo date('Y-m-d', $tam);?>",
 <?php if($new['modified']){
 	$tam = strtotime($new['created']); $modified = date('Y-m-d', $tam);
 	echo '"dateModified": "'.$modified.'",';
 } ?>
 "description": "<?=$description;?>",
 "articleBody": "<?=$new['brief'];?>"
 }
</script>

<div class="full mb-3">
  	<div class="container">
  		<?php $this->load->view('common/breadcumbs'); ?>
	    <div class="row">
	    	<div class="col-md-9 col-12">
				<div class="box-shadow p-3 mb-3 bg-white">
					<h2 class="text-uppercase mb-0"><?=$new['name']?></h2>
					<div class="mb-4 fs09">
					<span class="post-date fs09 main-color"><?=date('d-m-Y', $tam);?></span> &nbsp;/ &nbsp;
					<span class="views-count main-color fs09"><?=$new['views'];?></span>
					</div>
					<div class="content">
						<?=$new['content'];?>
					</div>

					<?php if($tags){ ?>
					<div class="tagged_as mb-2"><b>Từ khóa: </b>
						<?php foreach ($tags as $key => $tag) {
							echo '<a href="/tag/'.$tag['slug'].'.html" rel="tag">'.$tag['name'].'</a>';
						} ?>
						
					</div>
					<?php } ?>	

					<div class="product-share  mb-2"> 
						<span class="share-title">Chia sẻ trên mạng xã hội</span>
						<ul class="menu-social-icons pull-right m-0">
							
							
							<li> 
								<a rel="nofollow" href="https://twitter.com/share?url=<?=site_url();?><?=$new['slug'];?>.html&amp;text=<?=urlencode($new['name']);?>" class="title-toolip" title="Twitter" target="_blank"> <i class="fa fa-twitter"></i> </a>
							</li>
							<li> 
								<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?=site_url();?><?=$new['slug'];?>.html&amp;images=<?=base_url();?>assets/sam/images/news/<?=$new['image'];?>" class="title-toolip" title="Facebook" target="_blank"> <i class="fa fa-facebook"></i> </a>
							</li>
							<li>
								<a rel="nofollow" href="http://pinterest.com/pin/create/button/?url=<?=site_url();?><?=$new['slug'];?>.html&amp;media=<?=base_url();?>assets/sam/images/news/<?=$new['image'];?>&amp;description=<?=urlencode($new['name']);?>" class="title-toolip" title="Pinterest" target="_blank"> <i class="fa fa-pinterest"></i> </a>
							</li>
							<li> 
								<a rel="nofollow" href="http://plus.google.com/share?url=<?=site_url();?><?=$new['slug'];?>.html" class="title-toolip" title="Google +" target="_blank"> <i class="fa fa-google-plus"></i> </a>
							</li>
							<li> 
								<a rel="nofollow" href="https://web.skype.com/share?url=<?=site_url();?><?=$new['slug'];?>.html" title="skype" target="_blank"> <i class="fa fa-skype"></i> </a>
							</li>
						</ul>
					</div>

					<?php $this->load->view('common/comment'); ?>

				</div>

				<?php if($relateNews){ ?>
					<div class="full mb-3 box-shadow bg-white">
			          <h2 class="title">Tin liên quan</h2>
			          <div class="row mx-0 mt-3 pb-3">
							<?php foreach ($relateNews as $val) { ?>
								
			                <div class="col-md-3 col-12 mb-3">
			                    <div class="product-img text-center">
			                      <a href="/<?=$val['slug'];?>.html">
			                        <img src="/assets/sam/images/blank.gif" class="img-fluid" data-echo="/assets/sam/images/news/category/<?=$val['image'] ?>" title="<?=$val['name'];?>" alt="<?=$val['name'];?>" />
			                      </a>
			                      
			                    </div>
			                    <h3 class="name"><a href="/san-pham/<?=$val['slug'];?>.html"><?=$val['name']?></a></h3>

			                    <div class="mb-2 fs09">
									<span class="post-date fs09 main-color"><?=date('d-m-Y', strtotime($new['created']));?></span> &nbsp;/ &nbsp;
									<span class="views-count main-color fs09"><?=$new['views'];?></span>
								  </div>
			                    <p class="mb-2"><?=$val['brief']?></p>
			                    
			                    
			                </div>

			            	<?php } ?>
			                           
			          </div>
			         
			        </div>
			        <?php }?>

	        </div>
	        <div class="col-md-3 col-12">
				<?php $this->load->view('common/rightcontent'); ?>	
	        </div>
	    </div>
 	</div>
</div>

<?php
$this->load->view('common/products');
?>          