<!-- Page Banner Area Start -->
<div class="page-banner-area overlay section">
    <div class="container">
        <div class="row">
            <!-- Page Banner -->
            <div class="page-banner text-center col-xs-12">
                <h1>Latest News</h1>
                <!-- Breadcrumb -->
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Latest News</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Banner Area -->
<?php if($lessions){ 
	foreach($lessions as $lession){
?>
	<div class="container">
		<div class="item content-lt">
		<div class="col-xs-12">
			<a class="btn mg10" href="/school/practice/showQuestion/<?=$lession['id'];?>"><?=$lession['name'];?></a>
		</div>
		</div>
	</div>	
<?php }
	}else{ ?>
	<div class="container">
		<div class="alert alert-danger item mgt15"> Dữ liệu đang được cập nhật...</div>
	</div>	
<?php } ?>