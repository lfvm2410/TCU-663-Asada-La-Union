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
        //Metodo encargado de validar campos de texto de acuerdo a la condición: No nulo
		*/

		public function validarCamposTextoRequeridos($texto){

			$estadoCampo = false;

			if (!is_null($texto) && !empty($texto)) {
				
				$estadoCampo = true;
			}

			return $estadoCampo;
		}

		/*
	    //Metodo encargado de validar solamente la longitud de un campo de texto
		*/

		public function validarLongitudCampoTexto($texto,$maximaCantidadCaracteres){

			$estadoCampo = false;

			if (strlen($texto) <= $maximaCantidadCaracteres) {
				
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

		/*
        //Metodo encargado de validar si un array esta vacio
		*/

		public function validarArray($array){

			$estadoArray = false;

			if (!empty($array) && !is_null($array)) {
				
				$estadoArray = true;
			
			}

			return $estadoArray;

		}

		/*
        //Metodo encargado de validar campos numericos (numericos enteros) de acuerdo a las condiciones: Máximo de 2147483647, no nulo
		*/

		public function validarCamposNumericosEnteros($numero){

			$estadoCampo = false;

			if (intval($numero) > 0 && $numero <= 2147483647 && !is_null($numero) && !empty($numero)) {
				
				$estadoCampo = true;
			}
			
			return $estadoCampo;
		}

		/*
		//Metodo encargado de validar si una fecha es correcta
		*/

		public function validarFecha($fecha){

			$estadoFecha = false;

			if (!is_null($fecha) && !empty($fecha)) {

                $fechaDividida = explode ("/", $fecha);

                $dia = $fechaDividida[0]; 
                $mes = $fechaDividida[1]; 
                $anio = $fechaDividida[2];

                if(checkdate($mes,$dia,$anio)){ 
                
                	$estadoFecha = true;

                }
				
			}
			
			return $estadoFecha;
		}

		/*
		//Metodo encargado de verificar si 2 cadenas son iguales
		*/

		public function verificarCadenasIguales($cadena1, $cadena2){

			$cadenasIguales = false;

			if (strcmp($cadena1, $cadena2) == 0) {

				$cadenasIguales = true;
				
			}

			return $cadenasIguales;

		}

	}

?>