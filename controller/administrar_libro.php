<?php
//incluye la clase Libro y CrudLibro
	require_once('./model/Crud_libros.php');
	require_once('./model/Libros.php');
	$crud= new CrudLibro();
	$libro=new Libro();
	// si el elemento insertar no viene nulo llama al crud e inserta un libro
	if (isset($_POST['insertar'])) {
		$libro->setCodigo_libro($_POST['codigo_libro']);
		$libro->setNombre($_POST['titulo']);
		$libro->setAutor($_POST['autor']);
		$libro->setAnio_edicion($_POST['anio_edicion']);
		$libro->setPais($_POST['pais']);
		$libro->setEditorial($_POST['editorial']);
		$libro->setEdicion($_POST['edicion']);
		$libro->setCategoria($_POST['edicion']);
		$libro->setCategoria($_POST['categoria']);
		//llama a la función insertar definida en el crud
		$crud->insertar($libro);
		header('Location: catalog.php');
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
	}elseif ($_POST['eliminar']) {
		$libro=$crud->eliminar($_POST['codigo_libro']);
		header('Location: catalog.php');		
	// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php 
	}elseif($_GET['accion']=='a'){
		header('Location: book-config.php');
	}
?>