<div id="menu" class="item" >
	<ul class="drop">
		<li style="background: #337ab7;"><a style="background: #337ab7;" href="/" onclick="return false;"><img style="max-width: 70px;" src="<?=base_url();?>assets/school/img/logo/logo.png" alt="Logo" /></a></li>
    </ul>
    <?php
    $items = buildTree($menus);
    showAdminMenu($items, $parents);
    ?>
	<ul class="drop" style="float: right;">
		<li><a href="#"><?=$this->session->userdata("username");?> </a></li>
		<li> <a style="float: right;" href="/admin/logout"><b>(Thoát)</b></a></li>
	</ul>
</div>
