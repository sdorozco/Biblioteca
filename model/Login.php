<?php
	class Login{
		private $codigo_login;
		private $username;
		private $userpass;

		function __construct(){}

		public function getUserName(){
		return $this->username;
		}
		public function setUserName($username){
			$this->username = $username;
		}
		public function getUserPass(){
			return $this->userpass;
		}
		public function setUserPass($userpass){
			$this->userpass = $userpass;
		}
		public function getCodigo_login(){
			return $this->codigo_login;
		}
		public function setCodigo_login($codigo_login){
			$this->codigo_login = $codigo_login;
		}
		
    }
?>    