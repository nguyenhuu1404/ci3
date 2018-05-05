<script type="application/ld+json">
{ "@context": "http://schema.org", 
 "@type": "TechArticle",
 "headline": "Sâm ngọc linh",
 "proficiencyLevel": "Expert",
 "alternativeHeadline": "This article is also about robots and stuff",
 "image": "<?php echo base_url('assets/sam/images/news/category/').$new['image']; ?>",
 "author": "Sâm ngọc linh",  
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
 "articleBody": "<?=$title;?>"
 }
</script>
<div class="full mb-3">
  	<div class="container">
  		<?php $this->load->view('common/breadcumbs'); ?>
	    <div class="row">
	    	<div class="col-md-9 col-12">
				<div class="box-shadow p-3 mb-3 bg-white">
					<h2><?=$new['name']?></h2>
					<div class="content">
						<?=$new['content'];?>
					</div>
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
			                    <p class="mb-2"><?=$val['brief']?></p>
			                    
			                    
			                </div>

			            	<?php } ?>
			                           
			          </div>
			         
			        </div>
			        <?php }?>

	        </div>
	        <div class="col-md-3 col-12">
				<?php $this->load->view('common/support'); ?>
				<?php if($newCategories){ ?>
					<div class="box-shadow box-news bg-white mb-3 p-3">
						<h5 class="title-new">Danh mục tin tức</h5>
						<ul class="new-category p-0">
						<?php foreach ($newCategories as $cate) {
							echo '<li>
									<a href="/'.$cate['alias'].'.html">'.$cate['name'].'</a>
								</li>';
						} ?>
						</ul>

					</div>
				<?php } ?>

				<?php $this->load->view('common/news'); ?>		
	        </div>
	    </div>
 	</div>
</div>

<?php
$this->load->view('common/products');
?>          