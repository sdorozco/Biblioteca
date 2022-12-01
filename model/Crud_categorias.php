<?php
// incluye la clase Db
require_once('./model/conexion/bd.php');

	class CrudCategoria{
		// constructor de la clase
		public function __construct(){}

		// método para insertar, recibe como parámetro un objeto de tipo categoria
		public function insertar($categorias){
			$db=Db::conectar();
			$insert=$db->prepare('INSERT INTO categorias values(:codigo_categoria,:nombre)');
			$insert->bindValue('codigo_categoria',$categorias->getCodigo_categoria());
			$insert->bindValue('nombre',$categorias->getNombre());
			$insert->execute();
		}
		public function count(){
			$db=Db::conectar();
			$listar_categorias=[];
			$select=$db->query('SELECT COUNT(*) codigo_categoria FROM categorias');
			$fila = $select->fetchColumn();

			return $fila+1;
		}
		// método para mostrar todos los categoria
		public function mostrar(){
			$db=Db::conectar();
			$listar_categorias=[];
			$select=$db->query('SELECT * FROM categorias');


			foreach($select->fetchAll() as $categorias){
				$mycategoria= new Categoria();
				$mycategoria->setCodigo_categoria($categorias['codigo_categoria']);
				$mycategoria->setNombre($categorias['nombre']);
				$listar_categorias[]=$mycategoria;
			}
			return $listar_categorias;
		}

		// método para eliminar un categoria, recibe como parámetro el id del categoria
		public function eliminar($codigo_categoria){
			$db=Db::conectar();
			$eliminar=$db->prepare('DELETE FROM categorias WHERE codigo_categoria=:codigo_categoria');
			$eliminar->bindValue('codigo_categoria',$codigo_categoria);
			$eliminar->execute();
		}

		// método para buscar un categoria, recibe como parámetro el id del categoria
		public function obtenerLibro($codigo_categoria){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM categorias WHERE codigo_categoria=:codigo_categoria');
			$select->bindValue('codigo_categoria',$codigo_categoria);
			$select->execute();
			$categoria=$select->fetch();
			$mycategoria= new Categoria();
			$mycategoria->setCodigo_categoria($categoria['codigo_categoria']);
			$mycategoria->setNombre($categoria['nombre']);
			return $mycategoria;
		}

		// método para actualizar un categoria, recibe como parámetro el categoria
		public function actualizar($categorias){
			$db=Db::conectar();
			$actualizar=$db->prepare('UPDATE categorias SET nombre=:nombre WHERE codigo_categoria=:codigo_categoria');
			$actualizar->bindValue('codigo_categoria',$categorias->getCodigo_categoria());
			$actualizar->bindValue('nombre',$categorias->getNombre());
			$actualizar->execute();
		}
	}
?>