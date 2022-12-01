<?php
session_start();
	require_once('./model/Login.php');
	require_once('./model/Crud_login.php');
	require_once('./model/Usuarios.php');
	require_once('./model/Crud_Usuarios.php');
	require_once('./model/Crud_libros.php');
	require_once('./model/Libros.php');
	require_once('./model/Categoria.php');
	require_once('./model/Crud_categorias.php');
	if($_SESSION == null){
		header('Location: index.php');
	}
	$login = new Login();
	$crudUser = new CrudLogin();
	$user = new Usuario();
	$crudUsuario = new CrudUsuarios();
	$crud= new CrudLibro();
	$crudCat=new CrudCategoria();
	$libro=new Libro();
	$categorias=new Categoria();
	$login = $crudUser->obtenerUsuario($_SESSION['id']);
//incluye la clase Libro y CrudLibro

	//busca el libro utilizando el id, que es enviado por GET desde la vista mostrar.php
	$libro=$crud->obtenerLibro($_GET['id']);
	$categorias_list=$crudCat->mostrar();
	$user = $crudUsuario->obtenerUsuario($_SESSION['id']);
    $rol = $user->getRol();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Configuracion del libro</title>
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
						<a title="Salir del sistemasss" id="botonSalir">
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
					<a href="#!" class="btn-menu-dashboard"><i class="zmdizmdi-menu"></i></a>
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
			  <h1 class="text-titles"><i class="zmdi zmdi-wrench zmdi-hc-fw"></i> GESTIÓN DE LIBRO</small></h1>
			</div>
			<p class="lead">Bienvenido a la sección de actualizacion de los datos del libro</p>
		</div>
		
		<!-- Tabla de adjuntos -->
		<!--
		<div class="container-fluid">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="zmdi zmdi-attachment-alt"></i> &nbsp; GESTIONAR ADJUNTOS</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th class="text-center">Nombre</th>
									<th class="text-center">Tipo</th>
									<th class="text-center">Eliminar</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">Nombre Archivo</td>
									<td class="text-center">Tipo Archivo</td>
									<td>
										<form action="">
											<input type="hidden" name="adjunto-tipo" value="">
											<input type="hidden" name="adjunto-nombre" value="">
											<p class="text-center">
												<button class="btn btn-raised btn-danger btn-xs"><i class="zmdi zmdi-delete"></i></button>
											</p>
										</form>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
        -->
		<!-- Panel actualizar libro -->
		<div class="container-fluid"  id="base">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div  class="row">
					<div class="col-xs-12 col-sm-6">
						<h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; ACTUALIZAR LIBRO</h3>
					</div>
					<div class="col-xs-12 col-sm-6" align="right">
						<a  href="index.php" title="Editar Libro" class="panel-title" id="btn_base">
							<i class="zmdi zmdi-library"> EDITAR</i>
				    </a>
					</div>
					</div>
				</div>
				<div class="panel-body">
					<form action="administrar_libro.php" method='post'>
						<fieldset>
							<legend><i class="zmdi zmdi-library"></i> &nbsp; Información básica</legend>
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Codigo Libro *</label>
										  	<input pattern="[a-zA-Z0-9-]{1,30}" class="form-control" type="text" name="codigo_libro" required="" maxlength="30" value="<?php echo $libro->getCodigo_libro()?>" readonly="readonly">
										</div>
				    				</div>
									<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Titulo *</label>
										  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="titulo" required="" maxlength="30" value="<?php echo $libro->getTitulo()?>" readonly="readonly">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Autor *</label>
										  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="autor" required="" maxlength="30" 
										  	value="<?php echo $libro->getAutor()?>" readonly="readonly">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">País</label>
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="pais" maxlength="30" value="<?php echo $libro->getPais()?>" readonly="readonly">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Año</label>
										  	<input pattern="[0-9]{1,4}" class="form-control" type="text" name="anio_edicion" maxlength="4" value="<?php echo $libro->getAnio_edicion()?>" readonly="readonly">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Editorial</label>
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="editorial" maxlength="30" 
										  	value="<?php echo $libro->getEditorial()?>" readonly="readonly">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Edición</label>
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="edicion" maxlength="30" 
										  	value="<?php echo $libro->getEdicion()?>" readonly="readonly">
										</div>
				    				</div>
								</div>
							</div>
						</fieldset>
						<br>
						<fieldset>
							<legend><i class="zmdi zmdi-labels"></i> &nbsp; Categoría
							<div class="container-fluid">
								<div class="row">
				    				<div class="col-xs-12 col-sm-6">
								        <div class="form-group label-floating">
										  	<label class="control-label">Categorial Actual</label>
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" maxlength="30"
										  	value="<?php echo $libro->getCategoria()?>" readonly="readonly"> 
							           	</div>
							        </div>
								</div>
							</div>
						</fieldset>
						<br>
						<!--	<legend><i class="zmdi zmdi-attachment-alt"></i> &nbsp; Imágen y archivo PDF</legend>
							<div class="col-xs-12">
		    					<div class="form-group">
		    						<span class="control-label">Imágen</span>
									<input type="file" name="imagen-up" accept=".jpg, .png, .jpeg">
									<div class="input-group">
										<input type="text" readonly="" class="form-control" placeholder="Elija la imágen...">
										<span class="input-group-btn input-group-sm">
											<button type="button" class="btn btn-fab btn-fab-mini">
												<i class="zmdi zmdi-attachment-alt"></i>
											</button>
										</span>
									</div>
									<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos imágenes: PNG, JPEG y JPG</small></span>
								</div>
		    				</div>
		    				<div class="col-xs-12">
		    					<div class="form-group">
		    						<span class="control-label">PDF</span>
									<input type="file" name="pdf-up" accept=".pdf">
									<div class="input-group">
										<input type="text" readonly="" class="form-control" placeholder="Elija el PDF...">
										<span class="input-group-btn input-group-sm">
											<button type="button" class="btn btn-fab btn-fab-mini">
												<i class="zmdi zmdi-attachment-alt"></i>
											</button>
										</span>
									</div>
									<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos: documentos PDF</small></span>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="control-label">¿El archivo PDF será descargable para los clientes?</label>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsPDF" id="optionsRadios1" value="Si" checked="">
											<i class="zmdi zmdi-cloud-download"></i> &nbsp; Si, PDF descargable
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsPDF" id="optionsRadios2" value="No">
											<i class="zmdi zmdi-cloud-off"></i> &nbsp; No, PDF no descargable
										</label>
									</div>
								</div>
		    				</div>
						</fieldset> -->
						<input type='hidden' name='actualizar' value='actualizar'>
						<p class="text-center" style="margin-top: 20px;">
					    	<button type="submit" class="btn btn-info btn-raised btn-sm" disabled="disabled"><i class="zmdi zmdi-floppy"></i> Guardar</button>
					    </p>
					</form>
				</div>
			</div>
		</div>
		<!-- Panel editar libro -->
		<div class="container-fluid" id="editar" style="display: none">
		<div class="panel panel-success">
				<div class="panel-heading">
					<div  class="row">
					<div class="col-xs-12 col-sm-6">
						<h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; ACTUALIZAR LIBRO</h3>
					</div>
					</div>
				</div>
				<div class="panel-body">
					<form action="administrar_libro.php" method='post'>
						<fieldset>
							<legend><i class="zmdi zmdi-library"></i> &nbsp; Información básica</legend>
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Codigo Libro *</label>
										  	<input pattern="[a-zA-Z0-9-]{1,30}" class="form-control" type="text" name="codigo_libro" required="true"
											   maxlength="30" value="<?php echo $libro->getCodigo_libro()?>" readonly="readonly">
										</div>
				    				</div>
									<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Titulo *</label>
										  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="titulo" required="true" maxlength="30" value="<?php echo $libro->getTitulo()?>">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Autor *</label>
										  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="autor" required="true" maxlength="30" 
										  	value="<?php echo $libro->getAutor()?>">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">País*</label>
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" require="true" name="pais" maxlength="30" value="<?php echo $libro->getPais()?>">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Año</label>
										  	<input pattern="[0-9]{1,4}" class="form-control" type="text"  name="anio_edicion" maxlength="4" value="<?php echo $libro->getAnio_edicion()?>">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Editorial</label>
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="editorial" maxlength="30" 
										  	value="<?php echo $libro->getEditorial()?>">
										</div>
				    				</div>
				    				<div class="col-xs-12 col-sm-6">
								    	<div class="form-group label-floating">
										  	<label class="control-label">Edición</label>
										  	<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="edicion" maxlength="30" 
										  	value="<?php echo $libro->getEdicion()?>">
										</div>
				    				</div>
								</div>
							</div>
						</fieldset>
						<br>
						<fieldset>
							<legend><i class="zmdi zmdi-labels"></i> &nbsp; Categoría
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group label-floating">
										  	<label class="control-label">Categorias</label>
										  	<select class="form-control" name="categoria">
										  		<?php foreach ($categorias_list as $categoria){?>
									          	<option><?php echo $categoria->getNombre() ?></option>
									          	<?php }?>
									        </select>
										</div>
				    				</div>
								</div>
							</div>
						</fieldset>
						<br>
						<!--	<legend><i class="zmdi zmdi-attachment-alt"></i> &nbsp; Imágen y archivo PDF</legend>
							<div class="col-xs-12">
		    					<div class="form-group">
		    						<span class="control-label">Imágen</span>
									<input type="file" name="imagen-up" accept=".jpg, .png, .jpeg">
									<div class="input-group">
										<input type="text" readonly="" class="form-control" placeholder="Elija la imágen...">
										<span class="input-group-btn input-group-sm">
											<button type="button" class="btn btn-fab btn-fab-mini">
												<i class="zmdi zmdi-attachment-alt"></i>
											</button>
										</span>
									</div>
									<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos imágenes: PNG, JPEG y JPG</small></span>
								</div>
		    				</div>
		    				<div class="col-xs-12">
		    					<div class="form-group">
		    						<span class="control-label">PDF</span>
									<input type="file" name="pdf-up" accept=".pdf">
									<div class="input-group">
										<input type="text" readonly="" class="form-control" placeholder="Elija el PDF...">
										<span class="input-group-btn input-group-sm">
											<button type="button" class="btn btn-fab btn-fab-mini">
												<i class="zmdi zmdi-attachment-alt"></i>
											</button>
										</span>
									</div>
									<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos: documentos PDF</small></span>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="control-label">¿El archivo PDF será descargable para los clientes?</label>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsPDF" id="optionsRadios1" value="Si" checked="">
											<i class="zmdi zmdi-cloud-download"></i> &nbsp; Si, PDF descargable
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsPDF" id="optionsRadios2" value="No">
											<i class="zmdi zmdi-cloud-off"></i> &nbsp; No, PDF no descargable
										</label>
									</div>
								</div>
		    				</div>
						</fieldset> -->
						<input type='hidden' name='actualizar' value='actualizar'>
						<p class="text-center" style="margin-top: 20px;">
					    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
					    </p>
					</form>
				</div>
			</div>
		</div>
		</div>
		<!-- Panel eliminar libro -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="zmdi zmdi-delete"></i> &nbsp; ELIMINAR LIBRO</h3>
						</div>
						<div class="panel-body">
							<p class="lead">
								En esta sección puedes eliminar el libro, en caso de que no desees conservarlo en la plataforma.
							</p>
							<form>
								<input type="hidden" value="<?php echo $libro->getCodigo_libro()?>" name="codigo_libro">
								<input type="hidden" value="eliminar" name="eliminar">
								<p class="text-center">
									<a type="submit" class="btn btn-raised btn-danger" id="boton">
										<i class="zmdi zmdi-delete"></i> &nbsp; ELIMINAR
									</a>
								</p>
							</form>
						</div>
					</div>
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
	var boton = document.getElementById("botonSalir");
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
	<script language="JavaScript" type="text/javascript">
	var boton = document.getElementById("boton");
// cuando se pulsa en el enlace
      boton.onclick = function(e) {
		e.preventDefault();
		swal({
		  	title: 'Estas seguro?',
		  	text: "Deseas eliminar este libro",
		  	type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#03A9F4',
		  	cancelButtonColor: '#F44336',
		  	confirmButtonText: '<i class="zmdi zmdi-close-circle"></i> Si, Eliminar!',
		  	cancelButtonText: '<i class="zmdi zmdi-run"></i> No, Cancelar!'
		}).then(function () {
			window.location.href="administrar_libro.php?id=<?php echo $libro->getCodigo_libro()?>&accion=e";
		});
	}
	</script>
	<script language="JavaScript" type="text/javascript">
	var btn = document.getElementById("btn_base");
// cuando se pulsa en el enlace
    btn.onclick = function(e) {
		e.preventDefault();
	$("#base").hide();
	$("#editar").show();
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