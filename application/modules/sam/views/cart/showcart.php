<div class="full mb-3">
  	<div class="container">
    	<div class="row">
        	<div class="col-md-9 col-12">
        		<div class="box-shadow bg-white p-2">
        			<?php if($this->cart->total_items() > 0){ ?>
					<?php echo form_open('sam/cart/update'); ?>
					<div class="table-responsive">
						<table class="table-bordered table">

						<tr>
						        <th>Sản phẩm</th>
						        <th>Số lượng</th>
						        <th style="text-align:right">Giá</th>
						        <th style="text-align:right">Thành tiền</th>
						</tr>

						<?php $i = 1; ?>

						<?php foreach ($this->cart->contents() as $items): ?>

						        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

						        <tr>
						                
					                <td>
					                	<img src="/assets/sam/images/products/thumb/<?=$items['image'];?>" alt="<?= $items['name'];?>" title="<?= $items['name'];?>" />
					                    <?php echo '<a class="color-text main-hover" href="/san-pham/' .$items['slug']. '.html">'. $items['name']. '</a>'; ?>

					                </td>
					                <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
					                <td style="text-align:right"><?php echo formatPrice($items['price']); ?>
					                	
					                </td>

					                <td style="text-align:right">
					                <?php echo formatPrice($items['subtotal']); ?>
					                <span onclick="removeCartItemMenu(<?=$items['id'];?>, 'cart');" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></span>	
					                </td>
						        </tr>

						<?php $i++; ?>

						<?php endforeach; ?>

						<tr>
						        <td colspan="2"> </td>
						        <td class="text-right"><strong>Tổng tiền</strong></td>
						        <td class="text-right"><b class="main-color fs13"><?php echo formatPrice($this->cart->total()); ?></b></td>
						</tr>

						</table>
					</div>	

					<p>
						<?php echo form_submit('', 'Cập nhật', "class='btn btn-warning'"); ?>
						<a class="btn btn-danger" href="/thanh-toan.html">Thanh toán</a>
						
					</p>
					<?php
						} else { 
						echo '<div class="alert m-0 alert-warning">Giỏ hàng trống! Trở lại trang <a href="/san-pham.html" class="alert-link">sản phẩm</a> để mua hàng!</div>';
						}
					?>
				</div>	
        	</div>

        	<div class="col-md-3 col-12">

        	</div>
    	</div>
   </div>
</div>        