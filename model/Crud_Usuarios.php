<?php
// incluye la clase Db
require_once('./model/conexion/bd.php');

class CrudUsuarios{
    // constructor de la clase
    public function __construct(){}

    public function insertar($usuarios){
        $db=Db::conectar();
        $insert=$db->prepare('INSERT INTO info_personal values(:codigo_user,:nombre,:apellido,:email,:telefono,:direccion,:genero,:rol)');
        $insert->bindValue('codigo_user',$usuarios->getCodigo_user());
        $insert->bindValue('nombre',$usuarios->getNombre());
        $insert->bindValue('apellido',$usuarios->getApellido());
        $insert->bindValue('email',$usuarios->getEmail());
        $insert->bindValue('telefono',$usuarios->getTelefono());
        $insert->bindValue('direccion',$usuarios->getDireccion());
        $insert->bindValue('genero',$usuarios->getGenero());
        $insert->bindValue('rol',$usuarios->getRol());
        $insert->execute();
    }
   
    // método para mostrar todos los usuarios
    public function mostrar(){
        $db=Db::conectar();
        $listaUsuarios=[];
        $select=$db->query('SELECT * FROM info_personal');

        foreach($select->fetchAll() as $usuarios){
            $myUsuarios= new Usuario();
            $myUsuarios->setCodigo_user($usuarios['codigo_user']);
            $myUsuarios->setNombre($usuarios['nombre']);
            $myUsuarios->setApellido($usuarios['apellido']);
            $myUsuarios->setEmail($usuarios['email']);
            $myUsuarios->setTelefono($usuarios['telefono']);
            $myUsuarios->setDireccion($usuarios['direccion']);
            $myUsuarios->setGenero($usuarios['genero']);
            $myUsuarios->setRol($usuarios['rol']);
            $listaUsuarios[]=$myUsuarios;
        }
        return $listaUsuarios;
    }
    public function mostrarSearch($search){
        $db=Db::conectar();
        $listaUsuarios=[];
        $select=$db->query("SELECT * FROM info_personal WHERE nombre LIKE '%$search%'");
        foreach($select->fetchAll() as $usuarios){
            $myUsuarios= new Usuario();
            $myUsuarios->setCodigo_user($usuarios['codigo_user']);
            $myUsuarios->setNombre($usuarios['nombre']);
            $myUsuarios->setApellido($usuarios['apellido']);
            $myUsuarios->setEmail($usuarios['email']);
            $myUsuarios->setTelefono($usuarios['telefono']);
            $myUsuarios->setDireccion($usuarios['direccion']);
            $myUsuarios->setGenero($usuarios['genero']);
            $myUsuarios->setRol($usuarios['rol']);
            $listaUsuarios[]=$myUsuarios;
        }
        return $listaUsuarios;
    }
    public function count(){
        $db=Db::conectar();
        $select=$db->query("SELECT COUNT(*) codigo_libro FROM info_personal WHERE rol='administrador'");
        $fila = $select->fetchColumn();

        return $fila;
    }
    public function countStudent(){
        $db=Db::conectar();
        $select=$db->query("SELECT COUNT(*) codigo_libro FROM info_personal WHERE rol='estudiante'");
        $fila = $select->fetchColumn();

        return $fila;
    }
    // método para eliminar un libro, recibe como parámetro el id del usuario
    public function eliminar($codigo_user){
        $db=Db::conectar();
        $eliminar=$db->prepare('DELETE FROM info_personal WHERE codigo_user=:codigo_user');
        $eliminar->bindValue('codigo_user',$codigo_user);
        $eliminar->execute();
    }

    // método para buscar un libro, recibe como parámetro el id del usuario
    public function obtenerUsuario($codigo_user){
        $db=Db::conectar();
        $select=$db->prepare('SELECT * FROM info_personal WHERE codigo_user=:codigo_user');
        $select->bindValue('codigo_user',$codigo_user);
        $select->execute();
        $usuarios=$select->fetch();
        $myUsuarios= new Usuario();
        $myUsuarios->setCodigo_user($usuarios['codigo_user']);
        $myUsuarios->setNombre($usuarios['nombre']);
        $myUsuarios->setApellido($usuarios['apellido']);
        $myUsuarios->setEmail($usuarios['email']);
        $myUsuarios->setTelefono($usuarios['telefono']);
        $myUsuarios->setDireccion($usuarios['direccion']);
        $myUsuarios->setGenero($usuarios['genero']);
        $myUsuarios->setRol($usuarios['rol']);
        return $myUsuarios;
    }

    // método para actualizar un usuario, recibe como parámetro el usuario
    public function actualizar($usuarios){
        $db=Db::conectar();
        $actualizar=$db->prepare('UPDATE info_personal SET codigo_user=:codigo_user, nombre=:nombre, apellido=:apellido,email=:email,telefono=:telefono, direccion=:direccion,
         genero=null WHERE codigo_user=:codigo_user');
        $actualizar->bindValue('codigo_user',$usuarios->getCodigo_user());
        $actualizar->bindValue('nombre',$usuarios->getNombre());
        $actualizar->bindValue('apellido',$usuarios->getApellido());
        $actualizar->bindValue('email',$usuarios->getEmail());
        $actualizar->bindValue('telefono',$usuarios->getTelefono());
        $actualizar->bindValue('direccion',$usuarios->getDireccion());
        $actualizar->execute();
    }
}
?>