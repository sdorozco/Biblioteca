<?php
session_start();
require_once('./model/Login.php');
require_once('./model/Crud_login.php');
require_once('./model/Usuarios.php');
require_once('./model/Crud_Usuarios.php');
if($_SESSION == null){
	header('Location: index.php');
}
$login = new Login();
$crudlogin = new CrudLogin();
$user = new Usuario();
$crudUser = new CrudUsuarios();
$login = $crudlogin->obtenerUsuario($_SESSION['id']);
require_once('./model/Crud_libros.php');
require_once('./model/Libros.php');
$crud=new CrudLibro();
$libro= new Libro();
//obtiene todos los libros con el método mostrar de la clase crud
$libro=$crud->obtenerLibro($_GET['id']);
$user = $crudUser->obtenerUsuario($_SESSION['id']);
$rol = $user->getRol();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Info Libro</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				I. E. SAN ANTONIO <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/login_ie.png" alt="UserIcon">
					<figcaption class="text-center text-titles"><?php echo $login->getUserName() ?></figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="my-data.php" title="Mis datos">
							<i class="zmdi zmdi-account-circle"></i>
						</a>
					</li>
					<li>
						<a href="my-account.php" title="Mi cuenta">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a title="Salir del sistema" id="boton">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="home.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
					</a>
				</li>
				<li id="administrar" style="display: block">
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="category.php"><i class="zmdi zmdi-labels zmdi-hc-fw"></i> Categorías</a>
						</li>
						<!--<li>
							<a href="provider.php"><i class="zmdi zmdi-truck zmdi-hc-fw"></i> Proveedores</a>
						</li>-->
						<li>
							<a href="book.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Nuevo libro</a>
						</li>
					</ul>
				</li>
				<li id="usuarios" style="display: block"> 
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="admin.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Profesores</a>
						</li>
						<li>
							<a href="client.php"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Estudiantes</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="catalog.php">
						<i class="zmdi zmdi-book-image zmdi-hc-fw"></i> Catalogo
					</a>
				</li>
			</ul>
		</div>
	</section>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-menu"></i></a>
				</li>
				<li>
					<a href="search.php" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
			</ul>
		</nav>
		
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> INFORMACIÓN LIBRO</small></h1>
			</div>
			<p class="lead">En esta sección se presenta la información detallada de cada libro en la plataforma</p>
		</div>
		
		<!-- Panel info libro -->
		<div class="container-fluid">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="zmdi zmdi-info"></i> &nbsp; NOMBRE LIBRO</h3>
				</div>
				<div class="panel-body">
					<fieldset>
						<legend><i class="zmdi zmdi-library"></i> &nbsp; Información básica</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12">
							    	<div class="form-group label-floating">
									  	<span>Título</span>
									  	<input class="form-control" readonly="" value="<?php echo $libro->getTitulo()?>">
									</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6">
							    	<img src="assets/book/book.jpg" alt="book" class="img-responsive">
			    				</div>
			    				<div class="col-xs-12 col-sm-6">
							    	<div class="container-fluid">
							    		<div class="row">
						    				<div class="col-xs-12">
										    	<div class="form-group label-floating">
												  	<span>Autor</span>
												  	<input class="form-control" readonly="" value="<?php echo $libro->getAutor()?>">
												</div>
						    				</div>
						    				<div class="col-xs-12 col-sm-6">
										    	<div class="form-group label-floating">
												  	<span>País</span>
												  	<input class="form-control" readonly="" value="<?php echo $libro->getPais()?>">
												</div>
						    				</div>
						    				<div class="col-xs-12 col-sm-6">
										    	<div class="form-group label-floating">
												  	<span>Año</span>
												  	<input class="form-control" readonly="" value="<?php echo $libro->getAnio_edicion()?>">
												</div>
						    				</div>
						    				<div class="col-xs-12 col-sm-6">
										    	<div class="form-group label-floating">
												  	<span>Editorial</span>
												  	<input class="form-control" readonly="" value="<?php echo $libro->getEditorial()?>">
												</div>
						    				</div>
						    				<div class="col-xs-12 col-sm-6">
										    	<div class="form-group label-floating">
												  	<span>Edición</span>
												  	<input class="form-control" readonly="" value="<?php echo $libro->getEdicion()?>">
												</div>
						    				</div>
							    		</div>
							    	</div>
			    				</div>
							</div>
						</div>
					</fieldset>
					<br>
					<!--<fieldset>
						<legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Resumen del libro</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group label-floating">
									  	<span>Resumen</span>
									  	<textarea readonly="" class="form-control" rows="3"></textarea>
									</div>
			    				</div>
							</div>
						</div>
					</fieldset>
					<br>
					<fieldset>
						<legend><i class="zmdi zmdi-download"></i> &nbsp; Descargar archivo PDF</legend>
						<p class="text-center">
							<a href="javascript:void(0)" class="btn btn-raised btn-primary">
							<i class="zmdi zmdi-cloud-download"></i> &nbsp; DESCARGAR PDF
							</a>
						</p>
					</fieldset>-->
				</div>
			</div>
		</div>

	</section>
	<script language="JavaScript" type="text/javascript">
	var lista1 = document.getElementById("usuarios");
	var lista2 = document.getElementById("administrar");
	<?php if($rol == 'estudiante'){ ?>
	lista1.style.display = 'none';
	lista2.style.display = 'none';
	<?php }?>
	</script>
	<script language="JavaScript" type="text/javascript">
	var boton = document.getElementById("boton");
// cuando se pulsa en el enlace
      boton.onclick = function(e) {
		e.preventDefault();
		swal({
		  	title: 'Estas seguro?',
		  	text: "Deseas cerrar sesion",
		  	type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#03A9F4',
		  	cancelButtonColor: '#F44336',
		  	confirmButtonText: '<i class="zmdi zmdi-close-circle"></i> Si, Salir!',
		  	cancelButtonText: '<i class="zmdi zmdi-run"></i> No, Cancelar!'
		}).then(function () {
			window.location.href="administrar_login.php?id=salir";
		});
	}
	</script>
	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>