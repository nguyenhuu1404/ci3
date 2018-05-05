<div class="box-shadow box-news bg-white mb-3 p-3">
          <h3 class="title-new">Kiến thức</h3>
            
          <!-- Nav tabs -->
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#news">Tin mới</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#popular">Đọc nhiều</a>
            </li>
            
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active container bd pt-3 border-top-0" id="news">
                
                <?php if($newNews){
                    foreach ($newNews as $new) {
                     $date = date('d-m-Y', strtotime($new['created']));
                 ?>
                  <div class="row mb-2">
                    <div class="col-12 pl-2 pr-0 mb-1 col-md-5">
                      <a href="/<?=$new['slug'];?>.html">
                        <img src="/assets/sam/images/blank.gif" title="<?=$new['title']?>;" alt="<?=$new['title'];?>" class="img-fluid" data-echo="/assets/sam/images/news/thumb/<?=$new['image'];?>"/>
                      </a>  
                    </div>
                    <div class="col-12 pl-2 pr-0 col-md-7">
                      <h3 class="fs09 m-0">
                      <a href="/<?=$new['slug'];?>.html"><?=$new['name'];?></a>
                      </h3>
                      <span class="post-date"><?=$date; ?></span>
                    </div>
                  </div>
                <?php } } ?>
                 
            </div>
            <div class="tab-pane container bd border-top-0 pt-3" id="popular">
                <?php if($topNews){
                    foreach ($topNews as $new) {
                    $date = date('d-m-Y', strtotime($new['created']));
                    
                 ?>
                <div class="row mb-2">
                  <div class="col-12 pl-2 pr-0 mb-1 col-md-5">
                    <a href="/<?=$new['slug'];?>.html">
                      <img src="/assets/sam/images/blank.gif" title="<?=$new['title']?>;" alt="<?=$new['title'];?>" class="img-fluid" data-echo="/assets/sam/images/news/thumb/<?=$new['image'];?>"/>
                     </a> 
                  </div>
                  <div class="col-12 pl-2 pr-0 col-md-7">
                    <h3 class="m-0 fs09">
                    <a href="/<?=$new['slug'];?>.html"><?=$new['name'];?></a>
                    </h3>
                    <span class="post-date"><?=$date; ?></span>
                  </div>
                </div>
                <?php } } ?>
            </div>
          </div>
        

</div>