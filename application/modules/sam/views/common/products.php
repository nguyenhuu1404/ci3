
<div class="full mb-3">
  <div class="container">
      <div class="row">
       <?php if(count($newProducts) > 0){ ?>
        <div class="col-12 col-md-3">
          <div class="bg-white box-shadow box-news p-3">
              <h3 class="title-new bd2 text-center fs09">Sản phẩm mới</h3>
              
              <?php foreach ($newProducts as $product) { ?>              
                <div class="row mb-2 ">
                   <div class="col-md-5 col-12">
                   <a href="/san-pham/<?=$product['alias'];?>.html">
                     <img title="<?=$product['name'];?>" alt="<?=$product['name'];?>" class="img-fluid" src="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
                   </a>
                   </div>
                   <div class="col-md-7 pl-0 col-12">
                     <h3 class="name m-0"><a href="/san-pham/<?=$product['alias'];?>.html"><?=$product['name'];?></a></h3>
                      <div class="xs-price"> 
                        <?php if($product['price_sale'] && $product['price']){ ?> 
                        <span class="price"> <?= formatPrice($product['price_sale']); ?> đ </span> 
                        <span class="price-before-discount"><?= formatPrice($product['price']); ?> đ</span>
                       <?php } else if($product['price']){
                            echo '<span class="price">'. formatPrice($product['price']) .' đ </span>'; 
                        }else{
                            echo '<span class="price">Giá liên hệ</span>';
                        } ?>  
                      </div>
                   </div>
                 </div> 

                <?php } ?>
            
          </div>
        </div>
        <?php } ?>

        <?php if(count($hotProducts) > 0){ ?>
         <div class="col-12 col-md-3">
          <div class="bg-white box-shadow box-news p-3">
              <h3 class="title-new bd2 text-center fs09">Sản bán chạy</h3>
                <?php foreach ($hotProducts as $product) { ?>              
                <div class="row mb-2 ">
                   <div class="col-md-5 col-12">
                   <a href="/san-pham/<?=$product['alias'];?>.html">
                     <img title="<?=$product['name'];?>" alt="<?=$product['name'];?>" class="img-fluid" src="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
                   </a>
                   </div>
                   <div class="col-md-7 pl-0 col-12">
                     <h3 class="name m-0"><a href="/san-pham/<?=$product['alias'];?>.html"><?=$product['name'];?></a></h3>
                      <div class="xs-price"> 
                        <?php if($product['price_sale'] && $product['price']){ ?> 
                        <span class="price"> <?= formatPrice($product['price_sale']); ?> đ </span> 
                        <span class="price-before-discount"><?= formatPrice($product['price']); ?> đ</span>
                       <?php } else if($product['price']){
                            echo '<span class="price">'. formatPrice($product['price']) .' đ </span>'; 
                        }else{
                            echo '<span class="price">Giá liên hệ</span>';
                        } ?>  
                      </div>
                   </div>
                 </div> 

                <?php } ?>

          </div>
        </div>
        <?php } ?>

        <?php if(count($saleProducts) > 0){ ?>
        <div class="col-12 col-md-3">
          <div class="bg-white box-shadow box-news p-3">
              <h3 class="title-new bd2 text-center fs09">Sản khuyến mại</h3>
              
              <?php foreach ($saleProducts as $product) { ?>              
                <div class="row mb-2 ">
                   <div class="col-md-5 col-12">
                   <a href="/san-pham/<?=$product['alias'];?>.html">
                     <img title="<?=$product['name'];?>" alt="<?=$product['name'];?>" class="img-fluid" src="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
                   </a>
                   </div>
                   <div class="col-md-7 pl-0 col-12">
                     <h3 class="name m-0"><a href="/san-pham/<?=$product['alias'];?>.html"><?=$product['name'];?></a></h3>
                      <div class="xs-price"> 
                        <?php if($product['price_sale'] && $product['price']){ ?> 
                        <span class="price"> <?= formatPrice($product['price_sale']); ?> đ </span> 
                        <span class="price-before-discount"><?= formatPrice($product['price']); ?> đ</span>
                       <?php } else if($product['price']){
                            echo '<span class="price">'. formatPrice($product['price']) .' đ </span>'; 
                        }else{
                            echo '<span class="price">Giá liên hệ</span>';
                        } ?>  
                      </div>
                   </div>
                 </div> 

                <?php } ?>

          </div>
        </div>
        <?php } ?>
        
        <?php if(count($recommendProducts) > 0){ ?>
        <div class="col-12 col-md-3">
          <div class="bg-white box-shadow box-news p-3">
              <h3 class="title-new bd2 text-center fs09">Sản phẩm khuyên dùng</h3>
              
              <?php foreach ($recommendProducts as $product) { ?>              
                <div class="row mb-2 ">
                   <div class="col-md-5 col-12">
                   <a href="/san-pham/<?=$product['alias'];?>.html">
                     <img title="<?=$product['name'];?>" alt="<?=$product['name'];?>" class="img-fluid" src="/assets/sam/images/products/thumb/<?=$product['image'];?>" />
                   </a>
                   </div>
                   <div class="col-md-7 pl-0 col-12">
                     <h3 class="name m-0"><a href="/san-pham/<?=$product['alias'];?>.html"><?=$product['name'];?></a></h3>
                      <div class="xs-price"> 
                        <?php if($product['price_sale'] && $product['price']){ ?> 
                        <span class="price"> <?= formatPrice($product['price_sale']); ?> đ </span> 
                        <span class="price-before-discount"><?= formatPrice($product['price']); ?> đ</span>
                       <?php } else if($product['price']){
                            echo '<span class="price">'. formatPrice($product['price']) .' đ </span>'; 
                        }else{
                            echo '<span class="price">Giá liên hệ</span>';
                        } ?>  
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