<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a telefonos
	*/
	
	class telefonoValidation{
		
		public function __construct(){}


		/*
        //Método encargado de validar el atributo tipo telefono requerido
		*/

		//A tomar en cuenta: no nulo, solo valores Fijo y Móvil

		public function validarTipoTelefonoRequerido(telefono $telefono){

			$estadoTipoRequerido = false;

			$telefonoTipo = $telefono->getTipo();

			if (!is_null($telefonoTipo) && !empty($telefonoTipo) && (strcmp($telefonoTipo, "Fijo") == 0 || 
				strcmp($telefonoTipo, "Móvil") == 0)) {

				$estadoTipoRequerido = true;
				
			}

			return $estadoTipoRequerido;
		}

		/*
        //Método encargado de validar el atributo numero telefono requerido
		*/

		//A tomar en cuenta: no nulo, solo numeros enteros, estrictamente de 8 caracteres

		public function validarNumTelefonoRequerido(telefono $telefono){

			$estadoNumeroRequerido = false;

			$telefonoNum = $telefono->getNumero();

			if (strlen($telefonoNum) == 8 && !is_null($telefonoNum) && !empty($telefonoNum) && preg_match("/^[0-9]{8}$/", $telefonoNum)) {
				
				$estadoNumeroRequerido = true;

			}

			return $estadoNumeroRequerido;
			
		}

	}

?>