<?php
// incluye la clase Db
require_once('./model/conexion/bd.php');

	class CrudLibro{
		// constructor de la clase
		public function __construct(){}

		// método para insertar, recibe como parámetro un objeto de tipo libro
		public function insertar($libro){
			$db=Db::conectar();
			$insert=$db->prepare('INSERT INTO libros values(:codigo_libro,:titulo,:autor,:anio_edicion,:pais,:editorial,:edicion,:categoria)');
			$insert->bindValue('codigo_libro',$libro->getCodigo_libro());
			$insert->bindValue('titulo',$libro->getTitulo());
			$insert->bindValue('autor',$libro->getAutor());
			$insert->bindValue('anio_edicion',$libro->getAnio_edicion());
			$insert->bindValue('pais',$libro->getPais());
			$insert->bindValue('editorial',$libro->getEditorial());
			$insert->bindValue('edicion',$libro->getEdicion());
			$insert->bindValue('categoria',$libro->getCategoria());
			$insert->execute();

		}
		// método para mostrar todos los libros
		public function mostrar(){
			$db=Db::conectar();
			$listaLibros=[];
			$select=$db->query('SELECT * FROM libros');

			foreach($select->fetchAll() as $libro){
				$myLibro= new Libro();
				$myLibro->setCodigo_libro($libro['codigo_libro']);
				$myLibro->setTitulo($libro['titulo']);
				$myLibro->setAutor($libro['autor']);
				$myLibro->setAnio_edicion($libro['anio_edicion']);
				$myLibro->setPais($libro['pais']);
				$myLibro->setEditorial($libro['editorial']);
				$myLibro->setEdicion($libro['editorial']);
				$myLibro->setCategoria($libro['categoria']);
				$listaLibros[]=$myLibro;
			}
			return $listaLibros;
		}

		// método para eliminar un libro, recibe como parámetro el id del libro
		public function eliminar($codigo_libro){
			$db=Db::conectar();
			$eliminar=$db->prepare('DELETE FROM libros WHERE codigo_libro=:codigo_libro');
			$eliminar->bindValue('codigo_libro',$codigo_libro);
			$eliminar->execute();
		}

		// método para buscar un libro, recibe como parámetro el id del libro
		public function obtenerLibro($codigo_libro){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM libros WHERE codigo_libro=:codigo_libro');
			$select->bindValue('codigo_libro',$codigo_libro);
			$select->execute();
			$libro=$select->fetch();
			$myLibro= new Libro();
			$myLibro->setCodigo_libro($libro['codigo_libro']);
			$myLibro->setTitulo($libro['titulo']);
			$myLibro->setAutor($libro['autor']);
			$myLibro->setAnio_edicion($libro['anio_edicion']);
			$myLibro->setPais($libro['pais']);
			$myLibro->setEditorial($libro['editorial']);
			$myLibro->setEdicion($libro['edicion']);
			$myLibro->setCategoria($libro['categoria']);
			return $myLibro;
		}

		// método para actualizar un libro, recibe como parámetro el libro
		public function actualizar($libro){
			$db=Db::conectar();
			$actualizar=$db->prepare('UPDATE libros SET titulo=:titulo, autor=:autor,anio_edicion=:anio_edicion, pais=:pais, editorial=:editorial, edicion=:edicion, categoria=:categoria WHERE codigo_libro=:codigo_libro');
			$actualizar->bindValue('codigo_libro',$libro->getCodigo_libro());
			$actualizar->bindValue('titulo',$libro->getTitulo());
			$actualizar->bindValue('autor',$libro->getAutor());
			$actualizar->bindValue('anio_edicion',$libro->getAnio_edicion());
			$actualizar->bindValue('pais',$libro->getPais());
			$actualizar->bindValue('editorial',$libro->getEditorial());
			$actualizar->bindValue('edicion',$libro->getEdicion());
			$actualizar->bindValue('categoria',$libro->getCategoria());
			$actualizar->execute();
		}
	}
?>