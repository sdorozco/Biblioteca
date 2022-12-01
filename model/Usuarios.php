<?php

  class Usuario{
      private $codigo_user;
      private $nombre;
      private $apellido;
      private $email;
      private $telefono;
      private $direccion;
	  private $genero;
	  private $rol;

      function __construct(){}

		public function getCodigo_user(){
		return $this->codigo_user;
		}
		public function setCodigo_user($codigo_user){
			$this->codigo_user = $codigo_user;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getApellido(){
			return $this->apellido;
		}
		public function setApellido($apellido){
			$this->apellido = $apellido;
        }
        public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
        }
		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}
		public function getDireccion(){
			return $this->direccion;
		}
		public function setDireccion($direccion){
			$this->direccion = $direccion;
        }
        public function getGenero(){
			return $this->genero;
		}
		public function setGenero($genero){
			$this->genero = $genero;
		}
		public function getRol(){
			return $this->rol;
		}
		public function setRol($rol){
			$this->rol = $rol;
		}
  }

?>