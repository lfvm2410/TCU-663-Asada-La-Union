<?php

  /*
  // Clase logica intermediaria entre el controlador y la data de la persona, tiene como objetivo validar
  // reglas de negocio y gestiona los llamados hacia la data
  */

	class personaLogic extends logica{

		private $personaData;
    private $personaValidation;
    private $telefonoValidation;

		public function __construct(){

			$this->personaData = new personaData();
      $this->personaValidation = new personaValidation();
      $this->telefonoValidation = new telefonoValidation();

		}

    /*
    // Método encargado de gestionar el registro de una persona como usuario, mediando entre controlador y data
    */

    public function registrarPersona(usuarioSistema $usuario, telefono $telefono1, telefono $telefono2){

          $patternTelefono = "/^[0-9]{8}$/";

          if ($this->personaValidation->validarTipoUsuario($usuario->getTipoUsuario()) &&
              $this->personaValidation->validarCedula($usuario->getCedula(),$this->personaData) &&
              $this->personaValidation->validarCamposTexto($usuario->getNombre(),30) &&
              $this->personaValidation->validarCamposTexto($usuario->getApellidos(),30) &&
              $this->personaValidation->validarFecha($usuario->getFechaNacimiento()) &&
              $this->personaValidation->validarCorreoElectronico($usuario->getCorreoElectronico(),$this->personaData) &&
              $this->personaValidation->validarNombreUsuario($usuario->getTipoUsuario(), $usuario->getNombreUsuario(),$this->personaData) &&
              $this->personaValidation->validarContrasenias($usuario->getTipoUsuario(), $usuario->getContrasenia(),$usuario->getConfirmarContrasenia()) &&
              $this->telefonoValidation->validarTipoTelefonoRequerido($telefono1->getTipo()) &&
              $this->telefonoValidation->validarCamposTextoRegex($telefono1->getNumero(),8,$patternTelefono) &&
              $this->personaValidation->validarCamposTexto($usuario->getDireccion(),300) &&
              $this->personaValidation->validarCamposTexto($usuario->getPuesto(),15) &&
              $this->personaValidation->validarCamposTexto($usuario->getDescripcionPuesto(),50)) {

              //Setear nombre de usuario y contraseña de acuerdo al perfil de la persona
              if (strcmp($usuario->getTipoUsuario(), "Administrador") == 0) {

                $usuario->setNombreUsuario("'".$usuario->getNombreUsuario()."'");
                $usuario->setContrasenia("'".password_hash($usuario->getContrasenia(), PASSWORD_DEFAULT)."'");
        
              } elseif (strcmp($usuario->getTipoUsuario(), "Colaborador") == 0) {

                $usuario->setNombreUsuario('NULL');
                $usuario->setContrasenia('NULL');
            
              }

              //Verificar si se incluye el telefono #2 a la lista
              $telefonoLogic = new telefonoLogic();

              $telefonoLogic->setTelefonoALista($telefono1);

              if ($this->telefonoValidation->validarTipoTelefonoRequerido($telefono2->getTipo()) &&
                  $this->telefonoValidation->validarCamposTextoRegex($telefono2->getNumero(),8,$patternTelefono)) {

                  $telefonoLogic->setTelefonoALista($telefono2);
                
              }

              $listaTelefonos = $telefonoLogic->getListaTelefonos();

              //Se registra la persona
              if($this->personaData->registrarPersona($usuario,$listaTelefonos)){

                echo "true";
                
              }else{

                echo "false";
              }
                
          }else{

            echo "false";

          }

    }

    /*
    // Método encargado de gestionar la comprobación de una cédula existente en la base de datos, mediando entre controlador y data
    */

		public function comprobarExistenciaCedula($cedula){

      $patternCedula = "/^[0-9]*$/";

      if ($this->personaValidation->validarCamposTextoRegex($cedula,16,$patternCedula)) {

         	if ($this->personaData->comprobarExistenciaCedula($cedula)) {

         		echo "<div id='msjCedula' class='alert alert-danger' data-cedula='false'>
               		  		<strong><span class='glyphicon glyphicon-remove'></span></strong> 
                   			La cédula digitada ya existe, debe cambiarla
             		 </div>";


         	}else{

         		 echo "<div id='msjCedula' class='alert alert-success' data-cedula='true'>
               				<strong><span class='glyphicon glyphicon-ok'></span></strong> 
                   	  Cédula disponible para ser registrada
              		</div>";

         	}

      }else{

        echo "<div id='msjCedula' class='alert alert-danger' data-cedula='false'>
                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                El contenido del campo correspondiente a cédula solo admite números (no más de 16) y no puede estar vacío
              </div>";

      }

		}

    /*
    // Método encargado de gestionar la comprobación de un correo electrónico existente en la base de datos, mediando entre controlador y data
    */

    public function comprobarExistenciaCorreoElectronico($correoElectronico){

      $patternCorreoElectronico = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

      if ($this->personaValidation->validarCamposTextoRegex($correoElectronico,30,$patternCorreoElectronico)) {

          if ($this->personaData->comprobarExistenciaCorreoElectronico($correoElectronico)) {

            echo "<div id='msjCorreo' class='alert alert-danger' data-correo='false'>
                        <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                        El correo electrónico digitado ya existe, debe cambiarlo
                 </div>";


          }else{

             echo "<div id='msjCorreo' class='alert alert-success' data-correo='true'>
                      <strong><span class='glyphicon glyphicon-ok'></span></strong> 
                          Correo electrónico disponible para ser registrado
                     </div>";

          }

      }else{

        echo "<div id='msjCorreo' class='alert alert-danger' data-correo='false'>
                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                El contenido del campo correspondiente a correo electrónico no puede estar vacío y no puede execederse de 30 caracteres
                <br>Formato: ejemplo@gmail.com
              </div>";

      }

    }

    /*
    // Método encargado de gestionar la comprobación de una cédula (en edición) existente en la base de datos, mediando entre controlador y data
    */

    public function comprobarExistenciaCedulaEnEdicion($cedulaActual,$cedulaNueva){

      $patternCedula = "/^[0-9]*$/";

      if ($this->personaValidation->validarCamposTextoRegex($cedulaActual,16,$patternCedula) &&
          $this->personaValidation->validarCamposTextoRegex($cedulaNueva,16,$patternCedula)) {

          if ($this->personaData->comprobarExistenciaCampoEnEdicion("tbPersona","cedula_Persona",$cedulaActual,$cedulaNueva)) {

            echo "<div id='msjCedula' class='alert alert-danger' data-cedula='false'>
                        <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                        La cédula digitada ya existe, debe cambiarla
                 </div>";


          }else{

             echo "<div id='msjCedula' class='alert alert-success' data-cedula='true'>
                      <strong><span class='glyphicon glyphicon-ok'></span></strong> 
                      Cédula disponible para ser registrada
                  </div>";

          }

      }else{

        echo "<div id='msjCedula' class='alert alert-danger' data-cedula='false'>
                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                El contenido del campo correspondiente a cédula solo admite números (no más de 16) y no puede estar vacío
              </div>";

      }

    }

    /*
    // Método encargado de gestionar la comprobación de un correo electrónico (en edición) existente en la base de datos, mediando entre controlador y data
    */

    public function comprobarExistenciaCorreoElectronicoEnEdicion($correoElectronicoActual,$correoElectronicoNuevo){

      $patternCorreoElectronico = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

      if ($this->personaValidation->validarCamposTextoRegex($correoElectronicoActual,30,$patternCorreoElectronico) &&
          $this->personaValidation->validarCamposTextoRegex($correoElectronicoNuevo,30,$patternCorreoElectronico)) {

          if ($this->personaData->comprobarExistenciaCampoEnEdicion("tbPersona","correoElectronico_Persona",$correoElectronicoActual,$correoElectronicoNuevo)) {

            echo "<div id='msjCorreo' class='alert alert-danger' data-correo='false'>
                        <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                        El correo electrónico digitado ya existe, debe cambiarlo
                 </div>";


          }else{

             echo "<div id='msjCorreo' class='alert alert-success' data-correo='true'>
                      <strong><span class='glyphicon glyphicon-ok'></span></strong> 
                          Correo electrónico disponible para ser registrado
                     </div>";

          }

      }else{

        echo "<div id='msjCorreo' class='alert alert-danger' data-correo='false'>
                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                El contenido del campo correspondiente a correo electrónico no puede estar vacío y no puede execederse de 30 caracteres
                <br>Formato: ejemplo@gmail.com
              </div>";

      }

    }

    /*
    // Método encargado de gestionar la comprobación de un nombre de usuario existente en la base de datos, 
    // mediando entre controlador y data
    */

    public function comprobarExistenciaNombreUsuario($nombreUsuario){

      if ($this->personaValidation->validarCamposTexto($nombreUsuario,15)) {

          if ($this->personaData->comprobarExistenciaNombreUsuario($nombreUsuario)) {

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