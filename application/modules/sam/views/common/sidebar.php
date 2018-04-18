<div class="sidebar">
    <div class="head">
      <i class="icon fa fa-align-justify fa-fw"></i> Danh mục
    </div>
    <ul class="sidebar-menu">
      <?php 
          $productCategories = buildTree($productCategories);
          productCategories($productCategories, array());
       ?>
    </ul>
</div>