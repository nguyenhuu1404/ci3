          <div class="card-header bg-white">
            <div class="pull-right">
               <?php 
                 
                  echo $paginations;
               ?>
            </div>
            
          </div>
          <div class="card-body">
              
              <div class="row">

                <?php if($products){
                  foreach ($products as $val) {
                  
               ?>
              <div class="col-md-4 col-12 mt-3">
                  <div class="product-img position-relative">
                    <a href="/san-pham/<?=$val['slug'];?>.html">
                      <img class="img-fluid" src="/assets/sam/images/products/category/<?=$val['image'] ?>" title="<?=$val['name'];?>" alt="<?=$val['name'];?>" />
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
                  <h2 class="name"><a href="/san-pham/<?=$val['slug'];?>.html"><?=$val['name']?></a></h2>
                  <p class="mb-2"><?=$val['brief']?></p>
                  <div class="product-price">
                    <?php if($val['outstock'] == 1) { ?>
                      <span class="price">Hết hàng</span>
                      <?php } else { ?>
                          <?php if($val['price_sale'] && $val['price']){ ?> 
                            <span class="price"> <?= formatPrice($val['price_sale']); ?></span> 
                            <span class="price-before-discount"><?= formatPrice($val['price']); ?></span>
                           <?php } else if($val['price']){
                                echo '<span class="price">'. formatPrice($val['price']) .'</span>'; 
                            }else{
                                echo '<span class="price">Giá liên hệ</span>';
                              } ?>
                       <?php } ?>   
                  </div>
                  
              </div>
              <?php } } else{ ?>

                  <div class="alert alert-warning full">Không thấy sản phẩm nào!</div>

                <?php } ?>
                
              </div>


          </div>

          <div class="card-footer text-muted bg-white">

              <?php echo $paginations; ?>

          </div>