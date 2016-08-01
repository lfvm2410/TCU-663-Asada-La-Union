<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a telefonos
	*/
	
	class telefonoValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();

		}

		/*
        //Método encargado de validar el atributo tipo telefono requerido
		*/

		//A tomar en cuenta: no nulo, solo valores Fijo y Móvil

		public function validarTipoTelefonoRequerido($telefonoTipo){

			$estadoTipoRequerido = false;

			if (!is_null($telefonoTipo) && !empty($telefonoTipo) && (strcmp($telefonoTipo, "Fijo") == 0 || 
				strcmp($telefonoTipo, "Móvil") == 0)) {

				$estadoTipoRequerido = true;
				
			}

			return $estadoTipoRequerido;
		}

	}

?>