<?php 

	/*
	* Clase encargada de contener todos los métodos necesarios para la validación de datos a nivel general que puedan
	* ser requeridos por varias entidades u objetos
	*/
	class generalValidation{
		
		public function __construct(){}

		/*
        //Metodo encargado de validar campos de texto de acuerdo a las condiciones: Máximo de N caracteres, no nulo
		*/

		public function validarCamposTexto($texto,$maximaCantidadCaracteres){

			$estadoCampo = false;

			if (strlen($texto) <= $maximaCantidadCaracteres && !is_null($texto) && !empty($texto)) {
				
				$estadoCampo = true;
			}

			return $estadoCampo;
		}

		/*
        //Metodo encargado de validar campos de texto de acuerdo a las condiciones: Máximo de N caracteres, no nulo, pattern
		*/

		public function validarCamposTextoRegex($texto,$maximaCantidadCaracteres,$patternRegex){

			$estadoCampo = false;

			if (strlen($texto) <= $maximaCantidadCaracteres && !is_null($texto) && !empty($texto) && 
				preg_match($patternRegex, $texto)) {

				$estadoCampo = true;
			
			}

			return $estadoCampo;
		}

	}

?>