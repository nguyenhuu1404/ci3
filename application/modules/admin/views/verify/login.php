<html>
<head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/lib/bootstrap/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/lib/bootstrap/css/bootstrap-theme.min.css" />
    <script type="text/javascript" src="<?=base_url();?>assets/lib/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
<div style="margin-top: 100px;" class="container">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Đăng nhập</h3>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" action="" method="post" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" />
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me" /> Remember Me
                                </label>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" />
                        </fieldset>
                        <?php if(isset($error)){ 
							echo $error;
						}?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>