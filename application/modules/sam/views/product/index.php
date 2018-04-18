<div class="full mb-3">
  <div class="container">
    <div class="row">
        <div class="col-md-3 col-12">
            <?php $this->load->view('common/sidebar'); ?>
        </div>
        <div class="col-12 col-md-9">


          <div id="pageAjax" class="card  box-shadow ">
            <div class="card-header bg-white">

             <div class="row">
                <div class="col-md-4 col-12">
                  
                  
                    <select class="form-control">
                      <option>Sắp xếp</option>
                      <option>Giá tăng dần</option>
                      <option>Giá giảm dần</option>
                      <option>Tên sản phầm</option>
                    </select>
                  
                
                </div>
                <div class="col-md-8 col-12">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination pull-right m-0">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                          <span class="sr-only">Next</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>

              </div>
            </div>
          <div class="card-body">
              
              <div class="row">

                <?php if($products){
                  foreach ($products as $val) {
                  
               ?>
              <div class="col-md-4 col-12">
                  <div class="product-img position-relative">
                    <a href="/san-pham/<?=$val['alias'];?>.html">
                      <img class="img-fluid" src="/assets/sam/images/products/category/<?=$val['image'] ?>" title="<?=$val['name'];?>" alt="<?=$val['name'];?>" />
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

          <div class="card-footer text-muted bg-white">

              <?php echo $this->ajax_pagination->create_links(); ?>

              <nav aria-label="Page navigation example">
                  <ul class="pagination m-0">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>

          </div>
        </div>

        </div>
    </div>
  </div>
</div>       