<?php
//incluye la clase Libro y CrudLibro
	require_once('./model/Crud_categorias.php');
	require_once('./model/Categoria.php');
	$crud= new CrudCategoria();
	$categoria=new Categoria();
	$obtener_id=$crud->mostrar();
	
	// si el elemento insertar no viene nulo llama al crud e inserta un libro
	if (isset($_POST['insertar'])) {
		$categoria->setCodigo_categoria($_POST['codigo_categoria']);
		$categoria->setNombre($_POST['nombre']);
		//llama a la función insertar definida en el crud
		$crud->insertar($categoria);
		header('Location: category-list.php');
	// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
	}elseif(isset($_POST['actualizar'])){
		$categoria->setCodigo_categoria($_POST['codigo_categoria']);
		$categoria->setNombre($_POST['nombre']);
		$crud->actualizar($categoria);
		header('Location: category-list.php');
	// si la variable accion enviada por GET es == 'e' llama al crud y elimina un libro
	}elseif (isset($_POST['eliminar'])) {
		$categoria=$crud->eliminar($_POST['codigo_categoria']);
		header('Location: category-list.php');		
	// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php 
	}
?>