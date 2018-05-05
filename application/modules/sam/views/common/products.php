
<div class="full mb-3">
  <div class="container">
      <div class="row">
       <?php if(count($newProducts) > 0){ ?>
        <div class="col-12 col-md-3">
          <div class="bg-white box-shadow box-news  pt-3 pr-3 pl-3">
              <h3 class="title-new bd2 text-center fs09">Sản phẩm mới</h3>
              
              <?php foreach ($newProducts as $product) { ?>              
                <div class="row mb-2 pb-2 border-bottom">
                   <div class="col-md-5 text-center col-12">
                   <a href="/san-pham/<?=$product['slug'];?>.html">
                     <img src="/assets/sam/images/blank.gif" title="<?=$product['name'];?>" alt="<?=$product['name'];?>" class="img-fluid" data-echo="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
                   </a>
                   </div>
                   <div class="col-md-7 pl-0 col-12">
                     <h4 class="name center-xs m-0"><a href="/san-pham/<?=$product['slug'];?>.html"><?=$product['name'];?></a></h4>
                      <div class="xs-price center-xs">
                       <?php if($product['outstock'] == 1){
                          echo '<span class="price">Hết hàng</span>';
                        }else{
                          ?> 
                        <?php if($product['price_sale'] && $product['price']){ ?> 
                        <span class="price"> <?= formatPrice($product['price_sale']); ?> </span> 
                        <span class="price-before-discount"><?= formatPrice($product['price']); ?></span>
                       <?php } else if($product['price']){
                            echo '<span class="price">'. formatPrice($product['price']) .'</span>'; 
                        }else{
                            echo '<span class="price">Giá liên hệ</span>';
                        } } ?>  
                      </div>
                   </div>
                 </div> 

                <?php } ?>
            
          </div>
        </div>
        <?php } ?>

        <?php if(count($hotProducts) > 0){ ?>
         <div class="col-12 col-md-3">
          <div class="bg-white box-shadow box-news pt-3 pr-3 pl-3">
              <h3 class="title-new bd2 text-center fs09">Sản bán chạy</h3>
                <?php foreach ($hotProducts as $product) { ?>              
                <div class="row mb-2 pb-2 border-bottom">
                   <div class="col-md-5 text-center col-12">
                   <a href="/san-pham/<?=$product['slug'];?>.html">
                     <img src="/assets/sam/images/blank.gif" title="<?=$product['name'];?>" alt="<?=$product['name'];?>" class="img-fluid" data-echo="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
                   </a>
                   </div>
                   <div class="col-md-7 pl-0 col-12">
                     <h4 class="name center-xs m-0"><a href="/san-pham/<?=$product['slug'];?>.html"><?=$product['name'];?></a></h4>
                      <div class="xs-price center-xs"> 
                      <?php if($product['outstock'] == 1){
                          echo '<span class="price">Hết hàng</span>';
                        }else{
                          ?> 
                        <?php if($product['price_sale'] && $product['price']){ ?> 
                        <span class="price"> <?= formatPrice($product['price_sale']); ?></span> 
                        <span class="price-before-discount"><?= formatPrice($product['price']); ?></span>
                       <?php } else if($product['price']){
                            echo '<span class="price">'. formatPrice($product['price']) .'</span>'; 
                        }else{
                            echo '<span class="price">Giá liên hệ</span>';
                        } } ?>  
                      </div>
                   </div>
                 </div> 

                <?php } ?>

          </div>
        </div>
        <?php } ?>

        <?php if(count($viewProducts) > 0){ ?>
        <div class="col-12 col-md-3">
          <div class="bg-white box-shadow box-news pt-3 pr-3 pl-3">
              <h3 class="title-new bd2 text-center fs09">Sản phần xem nhiều</h3>
              
              <?php foreach ($viewProducts as $product) { ?>              
                <div class="row mb-2 pb-2 border-bottom">
                   <div class="col-md-5 text-center col-12">
                   <a href="/san-pham/<?=$product['slug'];?>.html">
                     <img src="/assets/sam/images/blank.gif" title="<?=$product['name'];?>" alt="<?=$product['name'];?>" class="img-fluid" data-echo="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
                   </a>
                   </div>
                   <div class="col-md-7  pl-0 col-12">
                     <h4 class="name m-0 center-xs"><a href="/san-pham/<?=$product['slug'];?>.html"><?=$product['name'];?></a></h4>
                      <div class="xs-price center-xs">
                      <?php if($product['outstock'] == 1){
                          echo '<span class="price">Hết hàng</span>';
                        }else{
                          ?>  
                        <?php if($product['price_sale'] && $product['price']){ ?> 
                        <span class="price"> <?= formatPrice($product['price_sale']); ?></span> 
                        <span class="price-before-discount"><?= formatPrice($product['price']); ?></span>
                       <?php } else if($product['price']){
                            echo '<span class="price">'. formatPrice($product['price']) .'</span>'; 
                        }else{
                            echo '<span class="price">Giá liên hệ</span>';
                        } } ?>  
                      </div>
                   </div>
                 </div> 

                <?php } ?>

          </div>
        </div>
        <?php } ?>
        
        <?php if(count($recommendProducts) > 0){ ?>
        <div class="col-12 col-md-3">
          <div class="bg-white box-shadow box-news pt-3 pr-3 pl-3">
              <h3 class="title-new bd2 text-center fs09">Sản phẩm khuyên dùng</h3>
              
              <?php foreach ($recommendProducts as $product) { ?>              
                <div class="row mb-2 pb-2 border-bottom">
                   <div class="col-md-5 text-center col-12">
                   <a href="/san-pham/<?=$product['slug'];?>.html">
                     <img src="/assets/sam/images/blank.gif" title="<?=$product['name'];?>" alt="<?=$product['name'];?>" class="img-fluid" data-echo="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
                   </a>
                   </div>
                   <div class="col-md-7 pl-0 col-12">
                     <h4 class="name center-xs m-0"><a href="/san-pham/<?=$product['slug'];?>.html"><?=$product['name'];?></a></h4>
                      <div class="xs-price center-xs">
                      <?php if($product['outstock'] == 1){
                          echo '<span class="price">Hết hàng</span>';
                        }else{
                          ?>  
                        <?php if($product['price_sale'] && $product['price']){ ?> 
                        <span class="price"> <?= formatPrice($product['price_sale']); ?></span> 
                        <span class="price-before-discount"><?= formatPrice($product['price']); ?></span>
                       <?php } else if($product['price']){
                            echo '<span class="price">'. formatPrice($product['price']) .' </span>'; 
                        }else{
                            echo '<span class="price">Giá liên hệ</span>';
                        } } ?>  
                      </div>
                   </div>
                 </div> 

                <?php } ?>

          </div>
        </div>
        <?php } ?>
      </div>
  </div>
</div>
<!--end box san pham-->