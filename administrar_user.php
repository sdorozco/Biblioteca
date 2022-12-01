<?php
require_once('./model/Crud_Usuarios.php');
require_once('./model/Crud_login.php');
require_once('./model/Usuarios.php');
require_once('./model/Login.php');
$crud=new CrudUsuarios();
$crud_login=new CrudLogin();
$usuarios= new Usuario();
$login = new Login();
//obtiene todos los usurios con el método mostrar de la clase crud
if (isset($_POST['insertar'])) {
    $rol=$_POST['rol'];
    $id=$_POST['codigo_user'];
    
    $usuarios->setCodigo_user($id);
    $usuarios->setNombre($_POST['nombre']);
    $usuarios->setApellido($_POST['apellido']);
    $usuarios->setEmail($_POST['email']);
    $usuarios->setTelefono($_POST['telefono']);
    $usuarios->setDireccion($_POST['direccion']);
    $usuarios->setGenero($_POST['genero']);
    $usuarios->setRol($_POST['rol']);
    
    //llama a la función insertar definida en el crud
    $crud->insertar($usuarios);

    $login->setCodigo_login($id);
    $login->setUserName($_POST['user_name']);
    $login->setUserPass($_POST['userpass']);
    $crud_login->insertar($login);
    if($rol != 'estudiante'){
    header("Location: admin-list.php?rol=$rol");
    }else{
    header("Location: client-list.php?rol=$rol");
    }
// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el usuario
}elseif(isset($_POST['actualizar'])){
    $newpass=$_POST['newpass'];
    $id=$_POST['codigo_user'];
    if($_POST['userpass'] == $newpass){
    $usuarios->setCodigo_user($id);
    $usuarios->setNombre($_POST['nombre']);
    $usuarios->setApellido($_POST['apellido']);
    $usuarios->setEmail($_POST['email']);
    $usuarios->setTelefono($_POST['telefono']);
    $usuarios->setDireccion($_POST['direccion']);

    //llama a la función insertar definida en el crud
    $crud->actualizar($usuarios);

    $login->setCodigo_login($id);
    $login->setUserName($_POST['user_name']);
    $login->setUserPass($_POST['userpass']);
    $crud_login->actualizar($login);
    header('Location: home.php');
    }
// si la variable accion enviada por GET es == 'e' llama al crud y elimina un usuario
}elseif(isset($_POST['actualizar_datos'])){
    $id=$_POST['codigo_user'];
    $usuarios->setCodigo_user($id);
    $usuarios->setNombre($_POST['nombre']);
    $usuarios->setApellido($_POST['apellido']);
    $usuarios->setEmail($_POST['email']);
    $usuarios->setTelefono($_POST['telefono']);
    $usuarios->setDireccion($_POST['direccion']);

    //llama a la función insertar definida en el crud
    $crud->actualizar($usuarios);

    $login->setCodigo_login($id);
    $login->setUserName($_POST['user_name']);
    $login->setUserPass($_POST['userpass']);
    $crud_login->actualizar($login);
    header('Location: home.php');
// si la variable accion enviada por GET es == 'e' llama al crud y elimina un usuario
}elseif($_GET != null){
if ($_GET['accion'] == 'e' && $_GET['rol'] == 'estudiante') {
    $usuarios=$crud->eliminar($_GET['id']);
    $login=$crud_login->eliminar($_GET['id']);
    header('Location: client-list.php');		
}elseif ($_GET['accion'] == 'e' && $_GET['rol'] == 'administrador') {
    $usuarios=$crud->eliminar($_GET['id']);
    $login=$crud_login->eliminar($_GET['id']);
    header('Location: admin-list.php');		
}
}
elseif(isset($_POST['buscar'])){
    $buscar=$_POST['search'];
    header("Location: admin-search.php?buscar=$buscar");
}
?>