<!-- Page Banner Area Start -->
<div class="page-banner-area overlay section">
    <div class="container">
        <div class="row">
            <!-- Page Banner -->
            <div class="page-banner text-center col-xs-12">
                <!-- Breadcrumb -->
                <ul class="breadcrumb">
                    <li><a href="/">Trang chủ</a></li>
					<?php if(isset($cateNew)){ ?>
					 <li><a href="/school/news/index"> Tin tức</a></li>
					 <li><a href="/school/news/category/<?=$cateNew['id'];?>"> <?=$cateNew['name'];?></a></li>
					<?php }else {?>
                    <li><a> Tin tức</a></li>
					<?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Banner Area -->

<!-- News Area Start --> 
<div class="news-area bg-white section pt-120 pb-90">
    <div class="container">
        <div class="row">
            <!-- News Item -->
			<?php if($news){
				foreach($news as $new){
			?>
            <div class="col-md-4 col-sm-6 col-xs-12 mb-30">
                <div class="news-item">
                    <a href="/school/news/detail/<?=$new['id'];?>" class="image"><img src="/assets/uploads/images/<?=$new['image'];?>" alt=""></a>
                    <div class="content">
                        <h3><a href="/school/news/detail/<?=$new['id'];?>">
						<?=$new['title'];?>
						</a></h3>
                        <div class="news-meta fix">
                           <span><i class="zmdi zmdi-calendar-check"></i>25 jun 2050</span>
                           <a href="#"><i class="zmdi zmdi-eye"></i>59</a>
                           <a href="#"><i class="zmdi zmdi-comments"></i>19</a>
                       </div>
                       <p><?=$new['brief'];?></p>
                       <a href="/school/news/detail/<?=$new['id'];?>">Chi tiết</a>
                    </div>
                </div>
            </div>
            <?php } } else{ ?>
			<div class="alert alert-danger">Đang cập nhật</div>
			<?php } ?>
        </div>
    </div>
</div>
<!-- End of Latest News Area -->