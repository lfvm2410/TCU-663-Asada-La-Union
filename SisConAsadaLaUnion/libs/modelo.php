<?php

    /*
    // Clase base usada por todos los modelos, con el fin de implementar mvc
    */

	class modelo{

		private static $baseDatos;
		
		public function __construct(){

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