<div class="card-columns">
	<?php if($news){
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
	}else{
		echo '<div class="alert alert-danger">Chưa có bài viết nào.</div>';
	} ?>
  
</div>

<?php echo $this->ajax_pagination->create_links(); ?>
