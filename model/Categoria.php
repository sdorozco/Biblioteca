<?php
	class Categoria{
		private $codigo_categoria;
		private $nombre;

		function __construct(){}

		public function getCodigo_categoria(){
		return $this->codigo_categoria;
		}
		public function setCodigo_categoria($codigo_categoria){
			$this->codigo_categoria = $codigo_categoria;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
    }
?>    