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
					<?php if(count($orders) > 0) { ?>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>Mã đơn hàng</th>
								<th>Ngày đặt</th>
								<th>Tình trạng</th>
								<th>Tổng tiền</th>
								<th>Xem</th>
							</tr>
							<?php 
							foreach ($orders as $order) {
							?>
							<tr>
								<td><b class="main-color"><?=$order['id'];?></b></td>
								<td><?php $time = strtotime($order['created']); echo date('d/m/Y', $time);?></td>
								<td>
									<?php 
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
									?>
								</td>
								<td><b class="main-color"><?=formatPrice($order['total_price']);?></b></td>
								<td><a class="btn btn-warning" href="/sam/users/view/<?=$order['id'];?>">Chi tiết</a></td>
							</tr>
							<?php
							}
							?>
						</table>
					</div>
					<?php } else{
						echo '<div class="alert alert-danger">Bạn chưa có đơn hàng nào. Vào trang <a href="san-pham.html">sản phẩm</a> để mua hàng. </div>';
					} ?>
					
				</div>
				
			</div>
			<div class="col-md-3 col-12">
				<?php $this->load->view('common/rightcontent'); ?>
			</div>
		</div>
	</div>
</div>			