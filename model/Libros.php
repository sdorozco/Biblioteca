<?php
	class Libro{
		private $codigo_libro;
		private $titulo;
		private $autor;
		private $pais;
		private $anio_edicion;
		private $editorial;
		private $edicion;
		private $categoria;
		private $file;

		function __construct(){}

		public function getTitulo(){
		return $this->titulo;
		}
		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}
		public function getAutor(){
			return $this->autor;
		}
 
		public function setAutor($autor){
			$this->autor = $autor;
		}
 
		public function getAnio_edicion(){
		return $this->anio_edicion;
		}
 
		public function setAnio_edicion($anio_edicion){
			$this->anio_edicion = $anio_edicion;
		}
		public function getPais(){
		return $this->pais;
		}
 
		public function setPais($pais){
			$this->pais = $pais;
		}
		public function getEditorial(){
		return $this->editorial;
		}
 
		public function setEditorial($editorial){
			$this->editorial = $editorial;
		}
		public function getEdicion(){
		return $this->edicion;
		}
 
		public function setEdicion($edicion){
			$this->edicion = $edicion;
		}
		public function getCategoria(){
		return $this->categoria;
		}
 
		public function setCategoria($categoria){
			$this->categoria = $categoria;
		}
		public function getCodigo_libro(){
			return $this->codigo_libro;
		}
 
		public function setCodigo_libro($codigo_libro){
			$this->codigo_libro = $codigo_libro;
		}
		public function getFile(){
			return $this->file;
		}
		public function setFile($file){
			$this->file = $file;
		}
    }
?>    