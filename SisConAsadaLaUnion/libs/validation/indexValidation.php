<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes al index
	*/
	
	class indexValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();

		}

		/*
		// Metodo encargado de validar un archivo adjunto
		*/

		public function validarArchivoAdjunto($archivo){

			$estadoArchivo = false;

			if ($archivo['error'] == 0 &&
				strcmp($archivo['type'], "application/pdf") == 0) {
				
				$estadoArchivo = true;

			}

			return $estadoArchivo;

		}		
		
	}

?>