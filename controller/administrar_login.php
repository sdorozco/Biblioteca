<?php
//incluye la clase Libro y CrudLibro
	require_once('./model/Crud_login.php');
	require_once('./model/Login.php');
	$crud=new CrudLogin();
	$login=new Login();

	if(isset($_POST['Iniciar sesión'])){
		$login->setUserName($_POST['username']);
		$login->setUserPass($_POST['userpass']);
		$crud->login($login);
		if($crud != null){
			echo "Bienvenido";
			header('Location: home.php');
		}else{
			header('Location: index.php');
			echo "Usuario o Contraseña estan incorrectos";
		}
	}
	
?>