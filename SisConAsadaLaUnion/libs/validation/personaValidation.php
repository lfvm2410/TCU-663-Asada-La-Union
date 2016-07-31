<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a personas
	*/
	
	class personaValidation{

		private $personaData;
		
		public function __construct(){

			$this->personaData = new personaData();
		}

		/*
        // Metodo encargado de validar el atributo cédula
		*/

		// A tomar en cuenta: Máximo de 16 caracteres, solo números enteros, no nulo y unique

		public function validarCedula($cedula){

			$estadoCedula = false;

			if (strlen($cedula) <= 16 && !is_null($cedula) && !empty($cedula) && preg_match("/^[0-9]*$/", $cedula)) {
				
				if (!$this->personaData->comprobarExistenciaCedula($cedula)) {

					$estadoCedula = true;
				}

			}

			return $estadoCedula;
		}

		/*
        // Metodo encargado de validar el atributo cédula para consulta select con ajax
		*/

		// A tomar en cuenta: Máximo de 16 caracteres, solo números enteros, no nulo

		public function validarCedulaAjax($cedula){

			$estadoCedula = false;

			if (strlen($cedula) <= 16 && !is_null($cedula) && !empty($cedula) && preg_match("/^[0-9]*$/", $cedula)) {

				$estadoCedula = true;
				
			}

			return $estadoCedula;
		}

		/*
        //Metodo encargado de validar el atributo nombre y apellidos
		*/

		// A tomar en cuenta: Máximo de 30 caracteres, no nulo

		public function validarNombreApellidos($nombreApellidos){

			$estadoNombreApellidos = false;

			if (strlen($nombreApellidos) <= 30 && !is_null($nombreApellidos) && !empty($nombreApellidos)) {
				
				$estadoNombreApellidos = true;
			}

			return $estadoNombreApellidos;
		}

		/*
        // Metodo encargado de validar el atributo del correo electrónico
		*/

		// A tomar en cuenta: Máximo de 30 caracteres, pattern de correo, no nulo

		public function validarCorreoElectronicoAjax($correoElectronico){

			$estadoCorreoElectronico = false;

			if (strlen($correoElectronico) <= 30 && !is_null($correoElectronico) && !empty($correoElectronico) && 
				preg_match("/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $correoElectronico)) {

				$estadoCorreoElectronico = true;
			
			}

			return $estadoCorreoElectronico;
		}

		/*
        // Metodo encargado de validar el atributo del correo electrónico para consulta select con ajax
		*/

		// A tomar en cuenta: Máximo de 30 caracteres, pattern de correo, no nulo y unique

		public function validarCorreoElectronico($correoElectronico){

			$estadoCorreoElectronico = false;

			if (strlen($correoElectronico) <= 30 && !is_null($correoElectronico) && !empty($correoElectronico) && 
				preg_match("/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $correoElectronico)) {
				
				if (!$this->personaData->comprobarExistenciaCorreoElectronico($correoElectronico)) {

					$estadoCorreoElectronico = true;
				}

			}

			return $estadoCorreoElectronico;
		}

		/*
        // Metodo encargado de validar el atributo de dirección
		*/

		// A tomar en cuenta: Máximo 300 caracteres, no nulo

		public function validarDireccion($direccion){

			$estadoDireccion = false;

			if (strlen($direccion) <= 300 && !is_null($direccion) && !empty($direccion)) {
				
				$estadoDireccion = true;
			}

			return $estadoDireccion;
		}

	}

?>