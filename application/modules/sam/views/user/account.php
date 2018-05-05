<?php $user = $this->session->userdata('userData'); ?>
<div class="full mb-3">
	<div class="container">
		<div class="row">
			<div class="col-12  col-md-9">
				<div class="box-shadow bg-white p-3">
				<nav class="nav p-2 bg-light mb-3 nav-pills flex-column flex-sm-row">
				  <a class="flex-sm-fill text-sm-center nav-link active" href="/my-account.html">Bảng điều khiển</a>
				  <a class="flex-sm-fill text-sm-center nav-link" href="/sam/users/orders">Đơn hàng</a>
				  <a class="flex-sm-fill text-sm-center nav-link" href="/sam/users/edit">Trang cá nhân</a>
				  <a class="flex-sm-fill text-sm-center nav-link " href="/sam/users/logout">Đăng xuất</a>
				</nav>
					<p>Xin chào <strong><?=$user['fullname'];?></strong> (không phải <strong><?=$user['fullname'];?></strong>? <a href="/sam/users/logout">Đăng xuất</a>)</p>
					<p><a class="btn btn-warning" href="/sam/users/orders">Xem đơn hàng</a> 
					<a class="btn btn-info" href="/sam/users/edit">Sửa thông tin cá nhân</a>.</p>
				</div>
				
			</div>
			<div class="col-md-3 col-12">
				<?php $this->load->view('common/support'); ?>
			</div>
		</div>
	</div>
</div>			