<script type="application/ld+json">
 { "@context": "http://schema.org",
 "@type": "Organization",
 "name": "Sâm ngọc linh",
 "legalName" : "Tủ thuốc nam Llc",
 "url": "<?=site_url();?>",
 "logo": "<?php echo base_url('assets/sam/images/logo.png'); ?>",
 "foundingDate": "2017",
 "founders": [
 {
 "@type": "Person",
 "name": "Huunv"
 }
 ],
 "address": {
 "@type": "PostalAddress",
 "streetAddress": "Nhà số 6, ngõ 115, Nguyễn khang",
 "addressRegion": "FL",
 "postalCode": "1000",
 "addressCountry": "VN"
 },
 "contactPoint": {
 "@type": "ContactPoint",
 "contactType": "customer support",
 "telephone": "+84973537381",
 "email": "tuthuocnam1508@gmail.com"
 },
 "sameAs": [ 
 "http://www.facebook.com/tuthuocnam1508",
 "http://www.twitter.com/tuthuocnam",
 "http://pinterest.com/tuthuocnam1508/",
 "https://plus.google.com/100710732944860905712"
 ]}
</script>

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
                      <img class="d-block w-100" src="/assets/sam/images/slider.jpg" alt="An cung ngưu hoàng hoàn" title="An cung ngưu hoàng hoàn" />
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
                  <div class="product-img text-center position-relative">
                    <a href="/san-pham/<?=$val['slug'];?>.html">
                      <img class="img-fluid" src="/assets/sam/images/blank.gif" data-echo="assets/sam/images/products/home/<?=$val['image']; ?>" title="<?=$val['name'];?>" alt="<?=$val['name'];?>" />
                    </a>
                    <?php if($val['hot'] == 1){ ?>
                      <div class="tag hot"><span>hot</span></div>
                    <?php } ?>
                    <?php if($val['new'] == 1){ ?>
                      <div class="tag new"><span>new</span></div>
                    <?php } ?> 
                    <?php if($val['price_sale']){ ?>
                      <div class="tag sale"><span>sale</span></div>
                    <?php } ?>   
                  </div>
                  <h3 class="name"><a href="/san-pham/<?=$val['slug'];?>.html"><?=$val['name']?></a></h3>
                  <p class="mb-2"><?=$val['brief']?></p>
                  <div class="product-price">
                  <?php if($val['outstock'] == 1){
                    echo '<span class="price">Hết hàng</span>';
                  }else{
                    ?>
                    <?php if($val['price_sale'] && $val['price']){ ?> 
                      <span class="price"> <?= formatPrice($val['price_sale']); ?> </span> 
                      <span class="price-before-discount"><?= formatPrice($val['price']); ?></span>
                     <?php } else if($val['price']){
                          echo '<span class="price">'. formatPrice($val['price']) .' </span>'; 
                      }else{
                          echo '<span class="price">Giá liên hệ</span>';
                        } }?>  
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
        <?php $this->load->view('common/support'); ?>
        <?php $this->load->view('common/customer'); ?>
        
        <?php //$this->load->view('common/fanpage'); ?>
        
      </div>
      <!-- end right content-->
    </div>
  </div>
</div>
<!-- end home content -->

<?php
$this->load->view('common/products');
?>

