<!DOCTYPE html>
<html ng-app>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?=base_url();?>assets/grocery_crud/js/jquery-1.11.1.min.js"></script>
	<script src="/3rdparty/tinymce/tinymce.min.js" type="text/javascript"></script>

	<link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/grocery_crud/themes/bootstrap/css/bootstrap/bootstrap.min.css" />
	
	<link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/admin/css/main.css" />
    <script type="text/javascript" src="<?=base_url();?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
	<style>
		body{font-family: 'Arial'}
		b{font-weight: bold; font-family: 'Arial' font-size: 15px;}
	</style>
</head>
<body>
	<div class="item">
	<?php $this->load->view('admin/menu'); ?>
		
	</div>
<div class="item">
	<div class="container">
		<div style="margin-top: 30px;" class="panel panel-info">
			<div class="panel-heading">
		  		Chi tiết khách hàng
			</div>
		  	<div class="panel-body">
			  	<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<td>Khách hàng</td>
							<td><b><?=$order['fullname'];?></b></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><b><?=$order['email'];?></b></td>
						</tr>
						<tr>
							<td>Điện thoại</td>
							<td><b><?=$order['phone'];?></b></td>
						</tr>
						<tr>
							<td>Địa chỉ giao hàng</td>
							<td><b><?=$order['address_ship'];?></b></td>
						</tr>
						<tr>
							<td>Phương thức thanh toán</td>
							<td><b><?php
							if($order['payment_method'] == 'bacs'){
								echo 'Chuyển khoản ngân hàng';
							}else if($order['payment_method'] == 'cod'){
								echo 'Thanh toán khi giao hàng';
							}
							?></b>
							</td>
						</tr>
					</table>
				</div>	 
			</div>
		</div>

		<?php if(count($orderItems) > 0) { ?>
		<div style="margin-top: 15px;" class="panel panel-info">
			<div class="panel-heading">
				Chi tiết đơn hàng
			</div>
		  	<div class="panel-body">	
			<div class="table-responsive">
					<table class="table-bordered table">
					<tr>
				        <th>Sản phẩm</th>
				        <th>Số lượng</th>
				        <th style="text-align:right">Giá</th>
				        <th style="text-align:right">Thành tiền</th>
					</tr>

					<?php foreach ($orderItems as $item): ?>
					        <tr>
				                <td>
				                	<img src="/assets/sam/images/products/thumb/<?=$item['image'];?>" alt="<?= $item['name'];?>" title="<?= $item['name'];?>" />
				                    <?php echo '<a class="color-text main-hover" href="/san-pham/' .$item['slug']. '.html">'. $item['name']. '</a>'; ?>

				                </td>
				                <td><?=$item['qty'];?></td>
				                <td style="text-align:right"><?php echo formatPrice($item['price']); ?>
				                	
				                </td>

				                <td style="text-align:right">
				                <?php echo formatPrice($item['subtotal']); ?>
				                </td>
					        </tr>
					<?php endforeach; ?>
					<tr>
				        <td colspan="2"> </td>
				        <td class="text-right"><strong>Tổng tiền</strong></td>
				        <td class="text-right"><b class="main-color"><?php echo formatPrice($order['total_price']); ?></b>
				        </td>
					</tr>

					</table>
				</div>
			</div>
		</div>		
		<?php } ?>

	</div>
</div>
</body>
</html>