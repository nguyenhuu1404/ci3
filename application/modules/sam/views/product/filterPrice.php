<div class="box-shadow bd-1 bg-white mb-3 p-3">
  <h5 class="title-new">Tìm theo khoảng giá</h5>
  
  <p id="amount"></p>
  <div id="slider-range"></div>

  <input type="hidden" id="minPrice">
  <input type="hidden" id="maxPrice">
  <button onclick="filterProduct();" class="btn btn-warning mt-3">Tìm ngay</button>
  
</div>  
<?php $name = $this->input->get('name');?>

<script>
  var minPrice = <?=$minPrice;?>;
  var maxPrice = <?=$maxPrice;?>;
  function filterProduct(page_num){
    page_num = page_num?page_num:0;
    var minPrice = $('#minPrice').val();
    var maxPrice = $('#maxPrice').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>sam/products/filterProduct/'+page_num,
      <?php if(isset($categoryId) && is_numeric($categoryId)){ ?>
        data: { page: page_num, minPrice: minPrice, maxPrice: maxPrice, categoryId: <?=$categoryId?>},
        <?php } else if(isset($tagId) && is_numeric($tagId)){ ?>
          data: { page: page_num, minPrice: minPrice, maxPrice: maxPrice, tagId: <?=$tagId?>},
          <?php } else if(isset($name) && $name != ''){ ?>
            data: { page: page_num, minPrice: minPrice, maxPrice: maxPrice, name: '<?=$name;?>'},
          <?php } else{ ?> 
            data: { page: page_num, minPrice: minPrice, maxPrice: maxPrice},
            <?php } ?>
            beforeSend: function () {
              $('.loading').show();
            },
            success: function (html) {
              $('#pageAjax').html(html);
              $('.loading').fadeOut("slow");
            }
          });
  }


  
</script>