<?php
//incluye la clase Libro y CrudLibro
	require_once('./model/Crud_login.php');
	require_once('./model/Login.php');
	require_once('./model/conexion/bd.php');
	require_once('./model/user_sesion.php');
	$crud=new Crudlogin();
	$login=new Login();
	$user = new userSession();
	session_start();
	
	 if(isset($_POST['login'])){
		$login->setUserName($_POST['UserName']);
		$login->setUserPass($_POST['UserPass']);
		$crud->login($login);
		}
	if($_GET['id'] == 'salir'){
		$user->closedSession();
		header('Location: index.php');
	}
?>
