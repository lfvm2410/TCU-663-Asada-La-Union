<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a servicio
	*/
	
	class servicioValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();

		}
		
		/*
		//Metodo encargado de validar el tipo de servicio
		*/

		public function validarTipoServicio($tipoServicio){

			$estadoTipoServicio = false;

			if (strcmp($tipoServicio, "Domipre") == 0 || strcmp($tipoServicio, "Endomipre") == 0) {

				$estadoTipoServicio = true;
				
			}

			return $estadoTipoServicio;

		}

	}

?>