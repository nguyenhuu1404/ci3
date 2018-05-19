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
    "target" : "http://tuthuocnam.com/sam/proudcts/search?s={search_term}",
    "query-input" : "required name=search_term"
  }  
}

</script>
<?php if($paginations){ ?>
<script>
	function filterNew(page_num){
    page_num = page_num?page_num:0;
    
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>sam/news/ajaxPagination/'+page_num,
      <?php if(isset($categoryId) && is_numeric($categoryId)){ ?>
        data: { page: page_num, categoryId: <?=$categoryId?>},
        <?php } else if(isset($tagId) && is_numeric($tagId)){ ?>
          data: { page: page_num, tagId: <?=$tagId?>},
          <?php } else{ ?> 
            data: { page: page_num},
            <?php } ?>
            beforeSend: function () {
              $('.loading').show();
            },
            success: function (html) {
              $('#pageAjax').html(html);
              $('.loading').fadeOut("slow");
            }
          });
  }
</script>
<?php } ?>
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
								  						    
							      <h2 class="fs13 mb-2 card-title">
							      <a class="color-text" href="/'.$new['slug'].'.html">	'.$new['name'].'</a>
							      </h2>
							      <div class="mb-2 fs09">
									<span class="post-date fs09 main-color">'.date('d-m-Y', strtotime($new['created'])).'</span> &nbsp;/ &nbsp;
									<span class="views-count main-color fs09">'.$new['views'].'</span>
								  </div>
							      
							      <p class="card-text">'.$new['brief'].'</p>
							    </div>
						  	</div>';
						}
					echo '</div>';	
					}else{
						echo '<div class="alert alert-danger">Chưa có bài viết nào.</div>';
					} ?>
				  
				

	            <?php echo $paginations; ?>
	            
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