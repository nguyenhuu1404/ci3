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
                    <div class="col-12 col-md-6">
                        <img class="img-fluid" src="/assets/sam/images/nam-linh-chi-do-han-quoc.png"/>
                    </div>
                    <div class="col-12 pl-0 col-md-6">
                      <h3 class="fs09 font-weight-bold">
                      <a href="<?=$new['slug'];?>.html"><?=$new['name'];?></a>
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
                  <div class="col-12 col-md-6">
                      <img class="img-fluid" src="/assets/sam/images/nam-linh-chi-do-han-quoc.png"/>
                  </div>
                  <div class="col-12 pl-0 col-md-6">
                    <h3 class="font-weight-bold fs09">
                    <a href="<?=$new['slug'];?>.html"><?=$new['name'];?></a>
                    </h3>
                    <span class="post-date"><?=$date; ?></span>
                  </div>
                </div>
                <?php } } ?>
            </div>
          </div>
        

</div>