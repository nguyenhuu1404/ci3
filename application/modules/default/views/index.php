<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
<meta name="description" content=""/>
<meta name="author" content=""/>
<meta name="keywords" content="MediaCenter, Template, eCommerce"/>
<meta name="robots" content="all"/>
<title>Bigshop premium HTML5 & CSS3 Template</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="/assets/lib/bootstrap/css/bootstrap.min.css" />

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="/assets/default/css/font-awesome.css" />

<!-- Customizable CSS -->
<?php if(isset($css)){
	foreach($css as $val){
		echo '<link rel="stylesheet" href="/assets/'.$module.'/css/'.$val.'.css" />';
	}
} ?>




</head>
<body class="cnt-home">
	<?php $this->load->view('header');?>

	<?php $this->load->view($layout); ?>

	<?php $this->load->view('footer'); ?>

	<!-- JavaScripts placed at the end of the document so the pages load faster --> 
	<script src="/assets/default/js/jquery-3.2.1.min.js"></script> 
	<script src="/assets/default/js/bootstrap.min.js"></script> 
	<?php 
		if(isset($js)){
			foreach($js as $val){
				$defer = false;
				if(isset($val['defer'])){
					$defer = 'defer';
				}
				echo '<script '.$defer.' type="text/javascript" src="/assets/'.$module.'/js/'.$val['name'].'.js"></script>';
			}
		} 
	?>
	
</body>
</html>