<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type" : "WebSite",
  "name": "Tủ thuốc nam",
  "url": "<?=site_url();?>",
  "description": "<?=$description;?>",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4,9",
    "reviewCount": "12"
  },
  "potentialAction" : {
    "@type" : "SearchAction",
    "target" : "http://tuthuocnam.com/sam/proudcts/search?name={search_term}",
    "query-input" : "required name=search_term"
  }  
}

</script>
<div class="full mb-3">
  	<div class="container">
	    <div class="row">
	    	<div id="pageAjax" class="col-md-9 col-12">
				<?php if($news){
					echo '<div class="card-columns">';
					
						foreach ($news as $new) {
							echo '<div class="card">
								<a href="/'.$new['slug'].'.html">
							    <img class="card-img-top" src="/assets/sam/images/news/category/'.$new['image'].'" alt="'.$new['title'].'" title="'.$new['title'].'" />
							    </a>
							    <div class="card-body">
								  						    
							      <h2 class="fs13  card-title">
							      <a class="color-text" href="/'.$new['slug'].'.html">	'.$new['name'].'</a>
							      </h2>
							      
							      <p class="card-text">'.$new['brief'].'</p>
							    </div>
						  	</div>';
						}
					echo '</div>';	
					}else{
						echo '<div class="alert alert-danger">Chưa có bài viết nào.</div>';
					} ?>
				  
				

	            <?php echo $this->ajax_pagination->create_links(); ?>
	            
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