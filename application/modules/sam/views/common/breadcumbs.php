<?php if(isset($breadcrumbs)){ ?>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-white box-shadow">
          <?php
            $i = 1; 
            foreach ($breadcrumbs as $breadcrumb) {
              
               
              if($i == count($breadcrumbs)) {
                echo '<li class="breadcrumb-item active" aria-current="page">'.$breadcrumb['name'].'</li>';
              }else{
                 echo '<li class="breadcrumb-item"><a href="'.$breadcrumb['url'].'">'.$breadcrumb['name'].'</a></li>';
              }
              $i++;
              
            }
          ?>
       </ol>
    </nav>
    <?php }?>