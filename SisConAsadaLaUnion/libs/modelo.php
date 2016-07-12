<?php

	class modelo{

		private static $baseDatos;
		
		function __construct(){

			self::setConexionInstance();
			
		}

		private static function setConexionInstance(){

			if (!isset(self::$baseDatos)) {

				self::$baseDatos = new conexionBaseDatos(DB_HOST,DB_USER,DB_PASS,DB_BASE);
			
			}
		}

		public function getConexionInstance(){

			return self::$baseDatos;

		}
	}

?>