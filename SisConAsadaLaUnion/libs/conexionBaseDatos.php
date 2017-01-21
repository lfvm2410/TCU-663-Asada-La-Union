<?php

    /*
    //Clase encargada de gestionar la conexion a la base de datos
    */

	class conexionBaseDatos{

		private $host;
		private $user; 
		private $pass;
		private $base;

		public function __construct($host,$user,$pass,$baseDatos){
		
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->base = $baseDatos;

		}

		public function setHost($host){

			$this->host = $host;

		}

		public function setUser($user){

			$this->user = $user;

		}

		public function setPass($pass){

			$this->pass = $pass;

		}

		public function setBase($base){

			$this->base = $base;

		}
	
		public function getHost(){

			return $this->host;
	
		}

		public function getUser(){

			return $this->user;
	
		}

		public function getPass(){

			return $this->pass;
		
		}

		public function getBase(){

			return $this->base;
	
		}

		/*
		// Metodo que realiza la conexion con la base de datos y la retorna
		*/

		public function getConexion(){

  		  	$conexion = @mysql_connect($this->getHost(),$this->getUser(),$this->getPass()) or die("Problemas al conectar con el servidor que aloja la base de datos del sistema");

  		 	@mysql_select_db($this->getBase(), $conexion) or die("Problemas al conectar con la base de datos del sistema");

    		return $conexion;

		}

	}

?>