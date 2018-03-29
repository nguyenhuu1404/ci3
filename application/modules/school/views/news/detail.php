<!-- Page Banner Area Start -->
<div class="page-banner-area overlay section">
    <div class="container">
        <div class="row">
            <!-- Page Banner -->
            <div class="page-banner text-center col-xs-12">
                <h1><?=$new['title'];?></h1>
                <!-- Breadcrumb -->
                <ul class="breadcrumb">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/school/news/index">Tin tức</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Banner Area -->

<!-- News Area Start --> 
<div class="news-area bg-white section pt-120 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-xs-12 mb-20">
                <!-- Single News Details -->
               <div class="single-news-details">
                    <img src="/assets/uploads/images/<?=$new['image'];?>" alt="">  
                    <div class="content">
                        <h3 class="title"><?=$new['title'];?></h3> 
                        <div class="news-meta fix">
                           <span><i class="zmdi zmdi-calendar-check"></i>25 jun 2050</span>
                           <a href="#"><i class="zmdi zmdi-eye"></i>59</a>
                           <a href="#"><i class="zmdi zmdi-comments"></i>19</a>
                        </div>
                        <div>
							<?=$new['content'];?>
						</div>
                        
                        <div class="news-footer item">
                            <!--div class="related-tag">
                                <span>Tag:</span>
                                <div class="tag">
                                    <a href="#">design,</a>
                                    <a href="#">Photoshop,</a>
                                    <a href="#">Web Design,</a>
                                    <a href="#">print</a>
                                </div>
                            </div-->
                            <div class="share-links pull-right">
                                <span>Share:</span>
                                <div class="links">
                                    <a href="#"><i class="zmdi zmdi-facebook"></i></a>
                                    <a href="#"><i class="zmdi zmdi-twitter"></i></a>
                                    <a href="#"><i class="zmdi zmdi-google-old"></i></a>
                                    <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <!-- Comment -->
                <div class="comment-wrapper">
                    <h3>Comments</h3>
                    
                        
                </div>   
            </div>
            
            <!-- Sidebar Wrapper -->
            <div class="col-lg-3 col-md-4 col-xs-12 mb-50">
                <!-- Recent News -->
                <div class="single-sidebar">
                    <h4 class="title">Tin gần đây</h4>
                    <div class="recent-news">
					<?php if($recentNews){ 
							foreach($recentNews as $item){	
					?>
                        <div class="recent-news-item">
                            <a class="image" href="/school/news/detail/<?=$item['id'];?>"><img src="/assets/uploads/images/<?=$item['image'];?>" alt=""></a>
                            <div class="content">
                                <h5><a href="/school/news/detail/<?=$item['id'];?>"><?=$item['title'];?></a></h5>
                                <div class="meta fix">
                                    <a href="#"><i class="zmdi zmdi-eye"></i>59</a>
                                    <a href="#"><i class="zmdi zmdi-comments"></i>19</a>
                                </div>
                                
                            </div>
                        </div>
					<?php } } ?>   
                    </div>
                </div>
				<?php if($catNews){ ?>
                <!-- Category -->
                <div class="single-sidebar">
                    <h4>Category</h4>
                    <ul class="category">
						<?php foreach($catNews as $cat){ ?>
                        <li><a href="/school/news/category/<?=$cat['id'];?>"><?=$cat['name'];?></a></li>
                        <?php }?>
                    </ul>
                </div>
				<?php } ?>
                <!-- Tags -->
                <!--div class="single-sidebar">
                    <h4>Search by Tags</h4>
                    <div class="tags">
                        <a href="#">Photoshop</a>
                        <a href="#">Design</a>
                        <a href="#">Tutorial</a>
                        <a href="#">Courses</a>
                        <a href="#">Premium</a>
                        <a href="#">Design</a>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</div>
<!--End of News Area-->