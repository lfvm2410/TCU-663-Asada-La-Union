<?php

   /*
   // Clase logica intermediaria entre el controlador y la data del usuario, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

	class usuarioLogic{

		private $usuarioData;
    private $personaData;
    private $usuarioValidation;
    private $personaValidation;
    private $telefonoValidation;
    
		public function __construct(){

			$this->usuarioData = new usuarioData();
      $this->personaData = new personaData();
      $this->usuarioValidation = new usuarioValidation();
      $this->personaValidation = new personaValidation();
      $this->telefonoValidation = new telefonoValidation();

		}

		/*
    // Método encargado de gestionar el registro del usuario, mediando entre controlador y data
		*/

		public function registrarUsuario(usuarioSistema $usuario, telefono $telefono1, telefono $telefono2){

          $patternTelefono = "/^[0-9]{8}$/";

          if ($this->personaValidation->validarCedula($usuario->getCedula(),$this->personaData) &&
              $this->usuarioValidation->validarCamposTexto($usuario->getNombre(),30) &&
              $this->usuarioValidation->validarCamposTexto($usuario->getApellidos(),30) &&
              $this->usuarioValidation->validarFecha($usuario->getFechaNacimiento()) &&
              $this->personaValidation->validarCorreoElectronico($usuario->getCorreoElectronico(),$this->personaData) &&
              $this->usuarioValidation->validarNombreUsuario($usuario->getNombreUsuario(),$this->usuarioData) &&
              $this->usuarioValidation->validarTipoUsuario($usuario->getTipoUsuario()) &&
              $this->usuarioValidation->validarContrasenias($usuario->getContrasenia(),$usuario->getConfirmarContrasenia()) &&
              $this->telefonoValidation->validarTipoTelefonoRequerido($telefono1->getTipo()) &&
              $this->telefonoValidation->validarCamposTextoRegex($telefono1->getNumero(),8,$patternTelefono) &&
              $this->usuarioValidation->validarCamposTexto($usuario->getDireccion(),300) &&
              $this->usuarioValidation->validarCamposTexto($usuario->getPuesto(),15) &&
              $this->usuarioValidation->validarCamposTexto($usuario->getDescripcionPuesto(),50)) {

              $telefonoLogic = new telefonoLogic();

              $telefonoLogic->setTelefonoALista($telefono1);

              if ($this->telefonoValidation->validarTipoTelefonoRequerido($telefono2->getTipo()) &&
                  $this->telefonoValidation->validarCamposTextoRegex($telefono2->getNumero(),8,$patternTelefono)) {

                  $telefonoLogic->setTelefonoALista($telefono2);
                
              }

              $listaTelefonos = $telefonoLogic->getListaTelefonos(); 

              if($this->usuarioData->registrarUsuario($usuario,$listaTelefonos)){

                echo "true";
                
              }else{

                echo "false";
              }
                
          }else{

            echo "false";

          }

		}

		/*
   	// Método encargado de gestionar la comprobación de un nombre de usuario existente en la base de datos, mediando entre controlador y data
    */

		public function comprobarExistenciaNombreUsuario($nombreUsuario){

      if ($this->usuarioValidation->validarCamposTexto($nombreUsuario,15)) {

         	if ($this->usuarioData->comprobarExistenciaNombreUsuario($nombreUsuario)) {

         		echo "<div id='msjNombreUsuario' class='alert alert-danger' data-nombreUsuario='false'>
               		  		<strong><span class='glyphicon glyphicon-remove'></span></strong> 
                   			El nombre de usuario digitado ya existe, debe cambiarlo
             		 </div>";


         	}else{

         		 echo "<div id='msjNombreUsuario' class='alert alert-success' data-nombreUsuario='true'>
               				<strong><span class='glyphicon glyphicon-ok'></span></strong> 
                   	    	Nombre de usuario disponible para ser registrado
              		 </div>";

         	}

      }else{

        echo "<div id='msjNombreUsuario' class='alert alert-danger' data-nombreUsuario='false'>
                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                Para verificar si un nombre de usuario ya existe, es necesario que el contenido del campo correspondiente a él no este vacío y no se exceda de 15 caracteres
              </div>";

      }

		}

  }

?>