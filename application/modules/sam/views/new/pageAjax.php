<div class="card-columns">
	<?php if($news){
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
	}else{
		echo '<div class="alert alert-danger">Chưa có bài viết nào.</div>';
	} ?>
  
</div>

<?php echo $paginations; ?>
