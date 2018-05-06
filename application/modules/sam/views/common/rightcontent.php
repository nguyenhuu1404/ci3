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