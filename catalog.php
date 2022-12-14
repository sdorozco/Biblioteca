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

//incluye la clase Libro y CrudLibro
require_once('./model/Crud_libros.php');
require_once('./model/Libros.php');
require_once('./model/Categoria.php');
require_once('./model/Crud_categorias.php');
$crud=new CrudLibro();
$crudCat=new CrudCategoria();
$libro= new Libro();
$categorias=new Categoria();
//obtiene todos los libros con el método mostrar de la clase crud

$categorias_list=$crudCat->mostrar();
if($_GET != null){
	$listaLibros=$crud->mostrarSearchCat($_GET['buscar']);
}else{
	$listaLibros=$crud->mostrar();
}
$user = $crudUser->obtenerUsuario($_SESSION['id']);
$rol = $user->getRol();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Catalogo</title>
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
						<a  title="Salir del sistema" id="boton">
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
			  <h1 class="text-titles"><i class="zmdi zmdi-book-image zmdi-hc-fw"></i> CATALOGO</h1>
			</div>
			<p class="lead">Bienvenidos a la sección de catalogo de libros aqui se presenta todos los libros que han sido registrados en la aplicación</p>
		</div>
		<div class="container-fluid text-center">
			<div class="btn-group">
              <a href="javascript:void(0)" class="btn btn-default btn-raised">SELECCIONE UNA CATEGORÍA</a>
              <a href="javascript:void(0)" data-target="dropdown-menu" class="btn btn-default btn-raised dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<?php foreach ($categorias_list as $categoria){?>
                <li><a href="catalog.php?buscar=<?php echo $categoria->getNombre() ?>"><?php echo $categoria->getNombre() ?></a></li>
                <?php }?>
              </ul>
            </div>
		</div>
		
		<div class="container-fluid">
			<h2 class="text-titles text-center">Lista de libros</h2>
			<div class="row">
				<div class="col-xs-12">
				<?php foreach ($listaLibros as $libro) {?>
					<div class="list-group">
						<div class="list-group-item">
						<div class="row-picture">
								<img class="circle" src="assets/img/login_ie.png" alt="icon">
							</div>
							<div class="row-content">
							
								<h4 class="list-group-item-heading"><?php echo $libro->getTitulo() ?></h4>
								<p class="list-group-item-text">
									<strong>Autor: </strong><?php echo $libro->getAutor() ?><br>
									<a href="book-info.php?id=<?php echo $libro->getCodigo_libro()?>&accion=a"  class="btn btn-primary" title="Más información"><i class="zmdi zmdi-info"></i></a>
									<a href="/Biblioteca/assets/file/<?php echo $libro->getFile() ?>" target="_blank" class="btn btn-primary" title="Ver PDF"><i class="zmdi zmdi-file"></i></a>
									<a href="/Biblioteca/assets/file/<?php echo $libro->getFile() ?>" class="btn btn-primary" download="<?php echo $libro->getFile() ?>" title="Descargar PDF"><i class="zmdi zmdi-cloud-download"></i></a>
									<a href="book-config.php?id=<?php echo $libro->getCodigo_libro()?>&accion=a" class="btn btn-primary" title="Gestionar libro"><i class="zmdi zmdi-wrench"></i></a>
								</p>
							</div>
						</div>
						<div class="list-group-separator"></div>
						<?php }?>
					</div>
					<nav class="text-center">
						<ul class="pagination pagination-sm">
							<li class="disabled"><a href="javascript:void(0)">«</a></li>
							<li class="active"><a href="javascript:void(0)">1</a></li>
							<li><a href="javascript:void(0)">2</a></li>
							<li><a href="javascript:void(0)">3</a></li>
							<li><a href="javascript:void(0)">4</a></li>
							<li><a href="javascript:void(0)">5</a></li>
							<li><a href="javascript:void(0)">»</a></li>
						</ul>
					</nav>
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