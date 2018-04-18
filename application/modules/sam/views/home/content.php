<div class="full mb-3">
    <div class="container">
      <div class="row">
          <div class="col-md-3 col-12">
            <?php $this->load->view('common/sidebar'); ?>
          </div>
          <div class="col-md-9 d-none d-sm-block col-12">
              <div id="carouselExampleControls" class="carousel full slide mb-2" data-ride="carousel">
                  <div class="carousel-inner">
                      <div class="carousel-item active">
                      <img class="d-block w-100" src="/assets/sam/images/slider.jpg" alt="First slide">
                      </div>
                  
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>


            <div class="info-boxes-inner bd bg-white full">
              <div class="row m-0">
               <div class="col-md-3 ibox-symbol text-center">
                    <i class="fa fa-check-square-o"></i>
                    <p>Sản phẩm uy tín</p>
                </div>
                
                <div class="col-md-3 ibox-symbol text-center">
                 <i class="fa fa-bullhorn"></i>
                  <p>Tư vấn tận tâm</p>
                </div>
                <div class="col-md-3 ibox-symbol text-center">
                  <i class="fa fa-money"></i>
                  <p>Thanh toán dễ dàng</p>
                </div>
                <div class="col-md-3 ibox-symbol text-center">
                  <i class="fa fa-car"></i>
                  <p>Giao hàng miễn phí</p>
                </div>
                
              </div>
              <!-- /.row --> 
            </div>

          </div>
      </div>
    </div>
  
</div>
<!--end slider-->

<div class="full">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-12">
        <?php if(count($products) > 0){
            foreach ($products as $product) {
            
         ?>
        <div class="full mb-3 box-shadow bg-white">
          <h2 class="title"><?=$product['title'];?></h2>
          <div class="row mx-0 mt-3 pb-3">
              <?php if(count($product['products']) > 0){
                  foreach ($product['products'] as $val) {
                  
               ?>
              <div class="col-12 col-md-3">
                  <div class="product-img position-relative">
                    <a href="/san-pham/<?=$val['alias'];?>.html">
                      <img class="img-fluid" src="/assets/sam/images/products/home/<?=$val['image'] ?>" title="<?=$val['name'];?>" alt="<?=$val['name'];?>" />
                    </a>
                    <?php if($val['hot'] == 1){ ?>
                      <div class="tag hot"><span>hot</span></div>
                    <?php } ?>
                    <?php if($val['new'] == 1){ ?>
                      <div class="tag new"><span>new</span></div>
                    <?php } ?> 
                    <?php if($val['price']){ ?>
                      <div class="tag sale"><span>sale</span></div>
                    <?php } ?>   
                  </div>
                  <h2 class="name"><a href="/san-pham/<?=$val['alias'];?>.html"><?=$val['name']?></a></h2>
                  <p class="mb-2"><?=$val['brief']?></p>
                  <div class="product-price">
                    <?php if($val['price_sale'] && $val['price']){ ?> 
                      <span class="price"> <?= formatPrice($val['price_sale']); ?> đ </span> 
                      <span class="price-before-discount"><?= formatPrice($val['price']); ?> đ</span>
                     <?php } else if($val['price']){
                          echo '<span class="price">'. formatPrice($val['price']) .' đ </span>'; 
                      }else{
                          echo '<span class="price">Giá liên hệ</span>';
                        } ?>  
                  </div>
                  
              </div>
              <?php } } ?>
             
          </div>
         
        </div>
        <?php } }?>
        <!--end box cate product-->
      </div>
      <!--end product cate-->
      <div class="col-md-3 col-12">
        
        <?php $this->load->view('common/news'); ?>
        <!--end box new-->

        <div class="box-shadow box-news bg-white mb-3 p-3">
          <h3 class="title-new">Ý kiến khách hàng</h3>

          <div id="tesmonial" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
              <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                 <div class="card">
                  <img class="w-50 mx-auto mt-3 rounded-circle" src="/assets/sam/images/thao-chi.jpg" alt="Vũ Thị Thanh Thảo">
                  <div class="card-body">
                    
                    <p class="card-text text-center">Tủ thuốc nam là sự lựa chọn uy tín, tôi rất hài lòng với các sản phẩm ở đây. Các sản phẩm của tủ thuốc nam rất tốt cho sức khỏe của tôi.</p>
                    <h5 class="card-title text-center">Vũ Thị Thanh Thảo</h5>
                    
                  </div>
                </div>

              </div>
              <div class="carousel-item">
                  <div class="card">
                    <img class="w-50 mx-auto mt-3 rounded-circle" src="/assets/sam/images/tran-van-hieu.jpg" alt="Khách hàng mua sâm ngọc linh">
                    <div class="card-body">
                      
                      <p class="card-text text-center">Tôi đã sử dụng sâm ngọc linh trong nhiều năm nay. Sâm giúp chứng huyết áp của tôi dần cải thiện và sức khỏe tôi phục hồi nhanh chóng.</p>
                      <h5 class="card-title text-center">Trần Văn Hiếu</h5>
                      
                    </div>
                  </div>
              </div>
              <div class="carousel-item">
                  <div class="card">
                    <img class="w-50 mx-auto mt-3 rounded-circle" src="/assets/sam/images/lai-thi-my-dung.jpg" alt="Lại Thị Mỹ Dung">
                    <div class="card-body">
                      
                      <p class="card-text text-center">Tôi rất hài lòng khi mua Sâm ngọc linh tại tủ thuốc nam. Từ khi sử dụng sâm ngọc linh ngâm mật ong cơ thể đã có nhiều chuyển biến tốt.</p>
                      <h5 class="card-title text-center">Lại Thị Mỹ Dung</h5>
                      
                    </div>
                  </div>
              </div>
            </div>

          </div>
          

         
        </div>

        
      </div>
      <!-- end right content-->
    </div>
  </div>
</div>
<!-- end home content -->

<?php
$this->load->view('common/products');
?>

