<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a usuarios
	*/

	class usuarioValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();

		}

		/*
        //Metodo encargado de validar el atributo nombre de usuario
		*/

		public function validarNombreUsuario($nombreUsuario, usuarioData $usuarioData){

			$estadoNombreUsuario = false;

			if ($this->validarCamposTexto($nombreUsuario,15)) {
				
				if (!$usuarioData->comprobarExistenciaNombreUsuario($nombreUsuario)) {

					$estadoNombreUsuario = true;
				
				}

			}
			
			return $estadoNombreUsuario;

		}

		/*
        //Metodo encargado de validar que la contraseña y confirmar contraseña sean iguales
		*/

		//A tomar en cuenta: no nulo, maximo 15 caracteres

		public function validarContrasenias($contrasenia, $confirmarContrasenia){

			$estadoContrasenias = false;

			if ($this->validarCamposTexto($contrasenia,15) && $this->validarCamposTexto($confirmarContrasenia,15)) {
				
				if (strcmp($contrasenia, $confirmarContrasenia) == 0) {

					$estadoContrasenias = true;
				
				}

			}
			
			return $estadoContrasenias;

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

	}

?>