<div class="full mb-3">
	<div class="container">
		<div class="row">
			<div class="col-12  col-md-9">
				<div class="box-shadow p-3 bg-white">
					
					<?php 
						switch ($order['order_status']) {
							case 'processing':
								echo '<div class="alert alert-info">Đơn hàng của bạn đang được xử lí.</div>';
								break;
							case 'completed':
								echo '<div class="alert alert-success">Giao hàng thành công.</div>';
								break;
							case 'cancelled':
								echo '<div class="alert alert-danger">Đơn hàng của bạn đã bị hủy.</div>';
								break;
							case 'refunded':
								echo '<div class="alert alert-warning">Đơn hàng của bạn đã hoàn lại tiền.</div>';
								break;
							case 'shipping':
								echo '<div class="alert alert-primary">Đơn hàng của bạn đang được vận chuyển.</div>';
								break;
							case 'on-hold':
								echo '<div class="alert alert-warning">Đơn hàng của bạn đang chờ thanh toán.</div>';
								break;				
							
							default:
								echo '<div class="alert alert-primary ">Cảm ơn bạn. Đơn hàng của bạn đã được đặt thành công.</div>';
								break;
						}
					?>
						
					
					
					<div class="card mb-3">
					  <h3 class="card-header fs13 text-white bg-info">Nội dung đơn hàng</h3>
					  <div class="card-body">
						
						<table class="table table-bordered">
							<tr>
								<td>Mã đơn hàng</td>
								<td><b class="main-color"><?=$order['id'];?></b></td>
							</tr>
							<tr>
								<td>Ngày đặt hàng:</td>
								<td><b><?=$order['created'];?></b></td>
							</tr>
							<tr>
								<td>Tổng tiền</td>
								<td><b class="main-color fs13"><?=formatPrice($order['total_price']);?></b></td>
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
					
					<div class="card mb-3">
					  <h3 class="card-header fs13 text-white bg-info">Chi tiết đơn hàng</h3>
					  	<div class="card-body">

					  		<div class="table-responsive">
								<table class="table-bordered table">

								<tr>
								        <th>Sản phẩm</th>
								        <th>Số lượng</th>
								        <th style="text-align:right">Giá</th>
								        <th style="text-align:right">Thành tiền</th>
								</tr>

								<?php foreach ($products as $items): ?>
								        <tr>
							                <td>
							                	<img src="/assets/sam/images/products/thumb/<?=$items['image'];?>" alt="<?= $items['name'];?>" title="<?= $items['name'];?>" />
							                    <?php echo '<a class="color-text main-hover" href="/san-pham/' .$items['slug']. '.html">'. $items['name']. '</a>'; ?>

							                </td>
							                <td><?=$items['qty'];?></td>
							                <td style="text-align:right"><?php echo formatPrice($items['price']); ?>
							                	
							                </td>

							                <td style="text-align:right">
							                <?php echo formatPrice($items['subtotal']); ?>
							                </td>
								        </tr>
								<?php endforeach; ?>
								<tr>
								        <td colspan="2"> </td>
								        <td class="text-right"><strong>Tổng tiền</strong></td>
								        <td class="text-right"><b class="main-color fs13"><?php echo formatPrice($order['total_price']); ?></b>
								        </td>
								</tr>

								</table>
							</div>	
							
						</div>
					</div>		
					
					<div class="card">
					  <h3 class="card-header fs13 text-white bg-info">Chi tiết khách hàng</h3>
					  	<div class="card-body">
						  	<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<td>Họ tên</td>
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
									
								</table>
							</div>	 
						</div>
					</div>		
						
				</div>
			</div>	

			<div class="col-12 col-md-3">
				<?php $this->load->view('common/support'); ?>
			</div>
			
		</div>
	</div>
</div>
