<?php
// incluye la clase Db
require_once('./model/conexion/bd.php');
require_once('./model/user_sesion.php');
$sesion = new userSession();

	class CrudLogin{
		// constructor de la clase
		public function __construct(){}
		// método para mostrar todos los libros
		public function login($login){
			$db=Db::conectar();
			$select=$db->prepare("SELECT * FROM usuarios WHERE username=:UserName and userpass=:UserPass");
			$select->bindValue('UserName',$login->getUserName());
			$select->bindValue('UserPass',$login->getUserPass());
			$select->execute();
			
			if($select -> rowCount() > 0){		
				$sesion = new userSession();
                session_start();
				foreach($select->fetchAll() as $login){
					$id=$login['codigo_login'];
				}
				$sesion->setCurrentUser($id);
			header("Location: home.php");
			}else{
				echo '<script type="text/javascript">
            alert("Usuario o contraseña incorrectos");
            window.location.href="index.php";
            </script>';
			}
			return $select;
		}
		public function insertar($login){
			$db=Db::conectar();
			$insert=$db->prepare('INSERT INTO usuarios values(:codigo_login,:username,:userpass)');
			$pass = md5($login->getUserPass());
			$insert->bindValue('codigo_login',$login->getCodigo_login());
			$insert->bindValue('username',$login->getUserName());
			$insert->bindValue('userpass',$pass);
			$insert->execute();
		}
		public function obtenerUsuario($codigo_login){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM usuarios WHERE codigo_login=:codigo_login');
			$select->bindValue('codigo_login',$codigo_login);
			$select->execute();
			$usuarios=$select->fetch();
			$myUsuarios= new Login();
			$myUsuarios->setCodigo_login($usuarios['codigo_login']);
			$myUsuarios->setUserName($usuarios['username']);
			$myUsuarios->setUserPass($usuarios['userpass']);
			return $myUsuarios;
		}
		public function actualizar($login){
			$db=Db::conectar();
				$pass = md5($login->getUserPass());
			$actualizar=$db->prepare('UPDATE usuarios SET codigo_login=:codigo_login, username=:username, userpass=:userpass WHERE codigo_login=:codigo_login');
			$actualizar->bindValue('codigo_login',$login->getCodigo_login());
			$actualizar->bindValue('username',$login->getUserName());
			$actualizar->bindValue('userpass',$pass);
			$actualizar->execute();
			
		}
		public function eliminar($codigo_login){
			$db=Db::conectar();
			$eliminar=$db->prepare('DELETE FROM usuarios WHERE codigo_login=:codigo_login');
			$eliminar->bindValue('codigo_login',$codigo_login);
			$eliminar->execute();
		}

	}
?>