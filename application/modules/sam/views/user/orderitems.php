<div class="full mb-3">
	<div class="container">
		<div class="row">
			<div class="col-12  col-md-9">
				<div class="box-shadow bg-white p-3">
					<nav class="nav p-2 bg-light mb-3 nav-pills flex-column flex-sm-row">
					  <a class="flex-sm-fill text-sm-center nav-link" href="/my-account.html">Bảng điều khiển</a>
					  <a class="flex-sm-fill text-sm-center nav-link active" href="/sam/users/orders">Đơn hàng</a>
					  <a class="flex-sm-fill text-sm-center nav-link" href="/sam/users/edit">Trang cá nhân</a>
					  <a class="flex-sm-fill text-sm-center nav-link " href="/sam/users/logout">Đăng xuất</a>
					</nav>
					<div class="alert alert-success">
						<?php $time = strtotime($order['created']); ?>
						Mã đơn hàng: <b class="main-color"><?=$order['id'];?></b>. Ngày đặt: <b><?php echo date('d/m/Y', $time);?></b>.Trạng thái: <b><?php 
										switch ($order['order_status']) {
											case 'processing':
												echo 'Đang xử lí.';
												break;
											case 'completed':
												echo 'Thành công.';
												break;
											case 'cancelled':
												echo 'Đã hủy.';
												break;
											case 'refunded':
												echo 'Đã hoàn tiền.';
												break;
											case 'shipping':
												echo 'Đang được chuyển.';
												break;
											case 'on-hold':
												echo 'Chờ thanh toán.';
												break;				
											
											default:
												echo '';
												break;
										}
									?></b>
					</div>
					<?php if(count($orderItems) > 0) { ?>
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
								        <td class="text-right"><b class="main-color fs13"><?php echo formatPrice($order['total_price']); ?></b>
								        </td>
								</tr>

								</table>
							</div>
						</div>
					</div>		
					<?php } ?>

					<div class="card">
					  <h3 class="card-header fs13 text-white bg-info">Chi tiết Thanh toán</h3>
					  	<div class="card-body">
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
					
				</div>
				
			</div>
			<div class="col-md-3 col-12">
				<?php $this->load->view('common/support'); ?>
			</div>
		</div>
	</div>
</div>			