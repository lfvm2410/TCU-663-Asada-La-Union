<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a personas
	*/
	
	class personaValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();
		}

		/*
		//Metodo encargado de validar el tipo de usuario
		*/

		public function validarTipoUsuario($tipoUsuario){

			$estadoTipoUsuario = false;

			if (strcmp($tipoUsuario, "Administrador") == 0 || strcmp($tipoUsuario, "Colaborador") == 0) {

				$estadoTipoUsuario = true;
				
			}

			return $estadoTipoUsuario;

		}

		/*
        //Metodo encargado de validar el atributo nombre de usuario
		*/

		public function validarNombreUsuario($tipoUsuario, $nombreUsuario, personaData $personaData){

			$estadoNombreUsuario = false;

			if (strcmp($tipoUsuario, "Colaborador") == 0) {

				$estadoNombreUsuario = true;
				
			}elseif (strcmp($tipoUsuario, "Administrador") == 0 && 
					 $this->validarCamposTexto($nombreUsuario,15)) {
				
				if (!$personaData->comprobarExistenciaNombreUsuario($nombreUsuario)) {

				  	$estadoNombreUsuario = true;
				
				}

			}
			
			return $estadoNombreUsuario;

		}

		/*
        //Metodo encargado de validar que la contraseña y confirmar contraseña sean iguales
		*/

		//A tomar en cuenta: no nulo, maximo 15 caracteres

		public function validarContrasenias($tipoUsuario, $contrasenia, $confirmarContrasenia){

			$estadoContrasenias = false;

			if (strcmp($tipoUsuario, "Colaborador") == 0) {

				$estadoContrasenias = true;
				
			}elseif (strcmp($tipoUsuario, "Administrador") == 0 && 
					 $this->validarCamposTexto($contrasenia,15) && 
					 $this->validarCamposTexto($confirmarContrasenia,15)) {

				if (strcmp($contrasenia, $confirmarContrasenia) == 0) {

					$estadoContrasenias = true;
				
				}
			
			}
			
			return $estadoContrasenias;

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
        // Metodo encargado de validar el atributo cédula que se encuentra en edición
		*/

		// A tomar en cuenta: Máximo de 16 caracteres, solo números enteros, no nulo y unique

		public function validarCedulaEnEdicion($cedulaActual, $cedulaNueva, personaData $personaData){

			$estadoCedula = false;

			$patternCedula = "/^[0-9]*$/";

			if ($this->validarCamposTextoRegex($cedulaActual,16,$patternCedula) &&
				$this->validarCamposTextoRegex($cedulaNueva,16,$patternCedula)) {
				
				if (!$personaData->comprobarExistenciaCampoEnEdicion("tbPersona","cedula_Persona",$cedulaActual,$cedulaNueva)) {

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

		/*
        // Metodo encargado de validar el atributo del correo electrónico (que se encuentra en edición) para consulta select con ajax
		*/

		// A tomar en cuenta: Máximo de 30 caracteres, pattern de correo, no nulo y unique

		public function validarCorreoElectronicoEnEdicion($correoElectronicoActual,$correoElectronicoNuevo, personaData $personaData){

			$estadoCorreoElectronico = false;

			$patternCorreoElectronico = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

			if ($this->validarCamposTextoRegex($correoElectronicoActual,30,$patternCorreoElectronico) &&
				$this->validarCamposTextoRegex($correoElectronicoNuevo,30,$patternCorreoElectronico)) {
				
				if (!$personaData->comprobarExistenciaCampoEnEdicion("tbPersona","correoElectronico_Persona",$correoElectronicoActual,$correoElectronicoNuevo)) {

					$estadoCorreoElectronico = true;
				}

			}

			return $estadoCorreoElectronico;
		}

		/*
        // Metodo encargado de validar el atributo cédula cuando se necesite activar o anular
		*/

		// A tomar en cuenta: Máximo de 16 caracteres, solo números enteros, no nulo y unique

		public function validarCedulaExistente($cedula, personaData $personaData){

			$estadoCedula = false;

			$patternCedula = "/^[0-9]*$/";

			if ($this->validarCamposTextoRegex($cedula,16,$patternCedula)) {
				
				if ($personaData->comprobarExistenciaCedula($cedula)) {

					$estadoCedula = true;
				}

			}

			return $estadoCedula;
		}

		/*
		// Metodo encargado de validar el tipo de persona a consultar
		*/

		public function validarTipoPersonaAConsultar($tipoPersona){

			$estadoTipoPersona = false;

			if (strcmp($tipoPersona, "Administrador") == 0 || strcmp($tipoPersona, "Colaborador") == 0) {

				$estadoTipoPersona = true;
				
			}

			return $estadoTipoPersona;

		}

		/*
		// Metodo encargado de verificar si la persona a eliminar es del perfil que se solicita
		*/

		public function verificarPerfilPersonaAEliminar($idPersona, $tipoPersona, personaData $personaData){

			$estadoPerfilPersona = false;

			$persona = $personaData->getPersonaPorId($idPersona, $tipoPersona);

			if ($this->validarArray($persona)) {
				
				$estadoPerfilPersona = true;

			}

			return $estadoPerfilPersona;

		}

	}

?>