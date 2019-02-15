<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title><?=env('APP_NAME')?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="Framedev"
            name="description" />
        <meta content="" name="author" />
        <link href="<?=env('APP_URL')?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>css/login/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=env('APP_URL')?>css/login/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>css/login/coming-soon.min.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="../assets/img/favicons/favicon-32x32.png" />
	</head>
    <body class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12 coming-soon-header">
                    <span style="font-size:3em; color:#FFF;"><?=env('APP_NAME')?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 coming-soon-content">
                    <h1>Se requiere cambio de contraseña</h1>
                    <p> Para continuar usando su cuenta es necesario que realice un cambio de contraseña, el cambio de contraseña le permitirá tener mayor seguridad al usar su cuenta y asegurarse que solo usted tiene acceso a ella. </p>
                    <br>
                    <form class="form-inline" id="chge_pass">
                        <div class="input-group input-group-lg">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-lock"></i></span>
								<input id="password1" name="password1" type="password" class="form-control" placeholder="Contraseña" aria-describedby="sizing-addon1">
							</div><br><br>
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-lock"></i></span>
								<input id="password2" name="password2" type="password" class="form-control" placeholder="Confirmar contraseña" aria-describedby="sizing-addon1">
							</div><br><br>
							<a href="javascript:;" onclick="cambiar_pass();" class="btn btn-lg green"> Cambiar </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 coming-soon-footer"> 2017 &copy; <?=env('APP_NAME')?> </div>
            </div>
        </div>
        <!--[if lt IE 9]>
<script src="<?=env('APP_URL')?>assets/plugins/respond.min.js"></script>
<script src="<?=env('APP_URL')?>assets/plugins/excanvas.min.js"></script>
<script src="<?=env('APP_URL')?>assets/plugins/ie8.fix.min.js"></script>
<![endif]-->
        <script src="<?=env('APP_URL')?>assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/countdown/jquery.countdown.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/pages/app.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/pages/coming-soon.min.js" type="text/javascript"></script>

		<script>
			var app_url = '<?=env('APP_URL')?>';
		</script>
		<script src="<?=env('APP_URL')?>assets/js/generales.js"></script>
		<script src="<?=env('APP_URL')?>assets/js/common.js"></script>
		<script src="<?=env('APP_URL')?>assets/js/usuario.js"></script>

    </body>

</html>
