<?php
require_once('./model/Login.php');
require_once('./model/Crud_login.php');
$login =new Login();
$crud = new CrudLogin();
session_start();
	if($_SESSION != null){
		$login=$crud->obtenerUsuario($_SESSION['id']);
		if($login != null){
			header('Location: home.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
</head>
<body>
	<div class="full-box login-container cover">
		<form action="administrar_login.php" method="post" autocomplete="off" class="logInForm" style="background-color: #444486;">
			<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
			<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
			<div class="form-group label-floating">
			  <label class="control-label" for="UserName" >Usuario</label>
			  <input class="form-control"  type="text" name="UserName" required="true" style="color: white;">
			  <p class="help-block">Escribe tú nombre de usuario</p>
			</div>
			<div class="form-group label-floating">
			  <label class="control-label" for="UserPass">Contraseña</label>
			  <input class="form-control" type="password" name="UserPass" required="true" style="color: white;">
			  <p class="help-block">Escribe tú contraseña</p>
			</div>
			<input type="hidden" name="login" value="login">
			<div class="form-group text-center">
				<button type="submit" class="btn btn-info" style="color: #FFF;">Iniciar sesión</button>
			</div>
		</form>
	</div>
	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>