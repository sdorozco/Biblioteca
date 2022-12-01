<?php
//incluye la clase Libro y CrudLibro
	require_once('./model/Crud_libros.php');
	require_once('./model/Libros.php');
	$crud= new CrudLibro();
	$libro=new Libro();
	// si el elemento insertar no viene nulo llama al crud e inserta un libro
	if (isset($_POST['insertar'])) {
		if($_FILES != null){
			$nombre_archivo=$_FILES['file']['name'];
			$tipo_file=$_FILES['file']['type'];
			$tamagno_file=$_FILES['file']['size'];
			$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] . '/Biblioteca/assets/file/';
			move_uploaded_file($_FILES['file']['tmp_name'], $carpeta_destino.$nombre_archivo);
		$libro->setCodigo_libro($_POST['codigo_libro']);
		$libro->setTitulo($_POST['titulo']);
		$libro->setAutor($_POST['autor']);
		$libro->setAnio_edicion($_POST['anio_edicion']);
		$libro->setPais($_POST['pais']);
		$libro->setEditorial($_POST['editorial']);
		$libro->setEdicion($_POST['edicion']);
		$libro->setCategoria($_POST['categoria']);
		$libro->setFile($nombre_archivo);
		//llama a la función insertar definida en el crud
		$crud->insertar($libro);
		header('Location: catalog.php');
		}
	// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
	}elseif(isset($_POST['actualizar'])){
		$libro->setCodigo_libro($_POST['codigo_libro']);
		$libro->setTitulo($_POST['titulo']);
		$libro->setAutor($_POST['autor']);
		$libro->setAnio_edicion($_POST['anio_edicion']);
		$libro->setPais($_POST['pais']);
		$libro->setEditorial($_POST['editorial']);
		$libro->setEdicion($_POST['edicion']);
		$libro->setCategoria($_POST['categoria']);
		$crud->actualizar($libro);
		header('Location: catalog.php');
	// si la variable accion enviada por GET es == 'e' llama al crud y elimina un libro
	}elseif($_GET != null){
	if ($_GET['accion'] == 'e') {
		$libro=$crud->eliminar($_GET['id']);
		header('Location: catalog.php');		
	// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php 
	}elseif($_GET['accion']=='a'){
		header('Location: book-config.php');
	}
}elseif(isset($_POST['buscar'])){
    $buscar=$_POST['search'];
    header("Location: search.php?buscar=$buscar");
}
?>