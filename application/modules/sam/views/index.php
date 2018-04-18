<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
	<meta name="robots" content="noodp,index,follow" />
    <title><?=$title;?></title>
    <meta name="description" content="<?=$description;?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<link rel="author" href="https://plus.google.com/u/0/+NguyenHuu1404" />
	<link rel="shortcut icon" type="image/x-icon" href="/assets/school/img/favicon.ico"/>	
    <link rel="stylesheet" href="/assets/sam/css/bootstrap.min.css"/> 
    <link rel="stylesheet" href="/assets/sam/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/assets/sam/css/style.css"/>
	<?php if(isset($css)){
		foreach($css as $val){
			echo '<link rel="stylesheet" href="/assets/'.$module.'/css/'.$val.'.css" />';
		}
	} ?>
	<style type="text/css">
		.logo{background-image: url('/assets/sam/images/logo.png'); width: 200px; height: 58px;}
		
	</style>
	<!--script type="text/javascript">
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-104094493-1', 'auto');
	  ga('send', 'pageview');

	</script-->
</head>
<body>
<?php $this->load->view('header'); ?>
<?php $this->load->view($layout); ?>
<?php $this->load->view('footer'); ?>
<script defer src="/assets/sam/js/jquery.min.js"></script>
<script defer src="/assets/sam/js/popper.min.js"></script>		
<script defer src="/assets/sam/js/bootstrap.min.js"></script>
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