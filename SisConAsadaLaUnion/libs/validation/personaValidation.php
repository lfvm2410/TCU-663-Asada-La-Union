<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a personas
	*/
	
	class personaValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();
		}

		/*
        // Metodo encargado de validar el atributo cédula
		*/

		// A tomar en cuenta: Máximo de 16 caracteres, solo números enteros, no nulo y unique

		public function validarCedula($cedula, personaData $personaData){

			$estadoCedula = false;

			$patternCedula = "/^[0-9]*$/";

			if ($this->validarCamposTextoRegex($cedula,16,$patternCedula)) {
				
				if (!$personaData->comprobarExistenciaCedula($cedula)) {

					$estadoCedula = true;
				}

			}

			return $estadoCedula;
		}

		/*
        // Metodo encargado de validar el atributo del correo electrónico para consulta select con ajax
		*/

		// A tomar en cuenta: Máximo de 30 caracteres, pattern de correo, no nulo y unique

		public function validarCorreoElectronico($correoElectronico, personaData $personaData){

			$estadoCorreoElectronico = false;

			$patternCorreoElectronico = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

			if ($this->validarCamposTextoRegex($correoElectronico,30,$patternCorreoElectronico)) {
				
				if (!$personaData->comprobarExistenciaCorreoElectronico($correoElectronico)) {

					$estadoCorreoElectronico = true;
				}

			}

			return $estadoCorreoElectronico;
		}

	}

?>