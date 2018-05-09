<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
	<meta name="robots" content="noodp,index,follow" />
    <title><?=$title;?></title>
    <meta name="description" content="<?=$description;?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	
	<meta property="og:locale" content="vi_VN" />
	<?php if(isset($seoType)){ echo '<meta property="og:type" content="'.$seoType.'" />'; } ?>
	<meta property="og:title" content="<?=$title;?>" />
	<meta property="og:description" content="<?=$description;?>" />
	<meta property="og:url" content="<?=current_url();?>" />
	<meta property="og:site_name" content="Sâm ngọc linh" />
	<meta property="fb:app_id" content="1909967479329282" />
	<?php if(isset($seoImage)){ echo '<meta property="og:image" content="'.$seoImage.'" />';}?>
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:description" content="<?=$description;?>" />
	<meta name="twitter:title" content="<?=$title;?>" />
	<meta name="twitter:site" content="@tuthuocnam" />
	<?php if(isset($seoImage)){ echo '<meta name="twitter:image" content="'.$seoImage.'" />'; } ?>
	<meta name="twitter:creator" content="@tuthuocnam" />
	
	<link rel="author" href="https://plus.google.com/u/0/+NguyenHuu1404" />
	<link rel="shortcut icon" type="image/x-icon" href="/assets/sam/images/favicon.ico"/>
	<link rel="canonical" href="<?=current_url();?>" />	
    
    
	<style>
		<?php $this->load->view('common/css'); ?>
		.logo{background-image: url('/assets/sam/images/logo.png'); width: 200px; height: 58px;}
		
	</style>
	<script src="/assets/sam/js/jquery.min.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-104094493-1', 'auto');
	  ga('send', 'pageview');
	</script>
</head>
<body>
<?php $this->load->view('header'); ?>
<?php $this->load->view($layout); ?>
<?php $this->load->view('footer'); ?>

<script defer src="/assets/sam/js/popper.min.js"></script>		
<script defer src="/assets/sam/js/bootstrap.min.js"></script>
<?php 
		if(isset($js)){
			foreach($js as $val){
				$defer = false;
				if(isset($val['defer'])){
					$defer = 'defer';
				}
				echo '<script '.$defer.' src="/assets/'.$module.'/js/'.$val['name'].'.js"></script>';
			}
		} 
	?>	
<script src="/assets/sam/js/echo.min.js"></script>
<script>
$(document).ready(function(){
    echo.init({
        offset: 250,
		throttle: 50,
		unload: false,
		
    });
});
</script>
</body>
</html>