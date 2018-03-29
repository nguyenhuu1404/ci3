<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=$title;?></title>
    <meta name="description" content="<?=$description;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- favicon -->		
    <link rel="shortcut icon" type="image/x-icon" href="/assets/school/img/favicon.ico">
    
    <!-- Bootstrap CSS -->		
    <link rel="stylesheet" href="/assets/school/css/bootstrap.min.css">
    
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/assets/school/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/school/css/material-design-iconic-font.min.css">
    
    <!-- Style CSS -->
    <link rel="stylesheet" href="/assets/school/style.css">
	
	<!-- jquery -->		
	<script src="/assets/school/js/vendor/jquery-1.12.4.min.js"></script>
	
	<!-- Customizable CSS -->
	<?php if(isset($css)){
		foreach($css as $val){
			echo '<link rel="stylesheet" href="/assets/'.$module.'/css/'.$val.'.css" />';
		}
	} ?>

    
</head>
<body>

<?php $this->load->view('header'); ?>

<?php $this->load->view($layout); ?>

<?php $this->load->view('footer'); ?>

<!-- Modernizr JS -->		
<script src="/assets/school/js/vendor/modernizr-2.8.3.min.js"></script>



<!-- bootstrap JS -->		
<script src="/assets/school/js/bootstrap.min.js"></script>

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

<!-- main JS
============================================ -->		
<script src="/assets/lib/huunv/js/common.js"></script>
</body>
</html>