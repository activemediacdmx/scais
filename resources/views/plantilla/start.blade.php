<!DOCTYPE html>
<html lang="es" >
	<head>
		<meta charset="utf-8" />
		<title>
			<?=env('APP_NAME')?>
		</title>
		<meta name="description" content="Framedev -  Framework para desarrolladores">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		@include('plantilla/scripts_css_top')
	</head>
	@include('plantilla/body')
</html>
