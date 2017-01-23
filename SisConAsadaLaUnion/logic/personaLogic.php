<?php

  /*
  // Clase logica intermediaria entre el controlador y la data de la persona, tiene como objetivo validar
  // reglas de negocio y gestionar los llamados hacia la data
  */

	class personaLogic extends logica{

		private $personaData;
    private $telefonoData;
    private $personaValidation;
    private $telefonoValidation;

		public function __construct(){

			$this->personaData = new personaData();
      $this->telefonoData = new telefonoData();
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

    /*
    // Metodo encargado de obtener una persona por su id
    */

    public function obtenerPersonaPorId($idPersona, $tipoPersona){

      if ($this->personaValidation->validarCamposNumericosEnteros($idPersona) &&
          $this->personaValidation->validarTipoPersonaAConsultar($tipoPersona)) {

          $persona = $this->personaData->getPersonaPorId($idPersona, $tipoPersona);
          $telefonosPersona = $this->telefonoData->obtenerTelefonosPorIdPersona($idPersona);

          if ($this->personaValidation->validarArray($persona) && $this->personaValidation->validarArray($telefonosPersona)) {

              $personaResultante = array('persona' => $persona, 'telefonosPersona' => $telefonosPersona);
              
              print_r(json_encode($personaResultante));
                  
          }else{

              print_r(json_encode("false"));

          }

      }else{

          print_r(json_encode("false"));

      }

    }

    /*
    // Metodo encargado de gestionar la edicion de una persona como usuario, mediando entre controlador y data
    */

    public function editarPersona($cedulaActual, $correoElectronicoActual, usuarioSistema $usuario, 
                                  telefono $telefono1, telefono $telefono2){

          $patternTelefono = "/^[0-9]{8}$/";

          if ($this->personaValidation->validarCamposNumericosEnteros($usuario->getIdPersona()) &&
              $this->personaValidation->validarTipoUsuario($usuario->getTipoUsuario()) &&
              $this->personaValidation->validarCedulaEnEdicion($cedulaActual,$usuario->getCedula(),$this->personaData) &&
              $this->personaValidation->validarCamposTexto($usuario->getNombre(),30) &&
              $this->personaValidation->validarCamposTexto($usuario->getApellidos(),30) &&
              $this->personaValidation->validarFecha($usuario->getFechaNacimiento()) &&
              $this->personaValidation->validarCorreoElectronicoEnEdicion($correoElectronicoActual,$usuario->getCorreoElectronico(),$this->personaData) &&
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

              //Se edita la persona
              if($this->personaData->editarPersona($usuario,$listaTelefonos)){

                echo "true";
                
              }else{

                echo "false";
              }
                
          }else{

            echo "false";

          }

    }

    /*
    // Metodo encargado de gestionar la eliminacion de una persona
    */

    public function eliminarPersona($idPersona, $tipoPersona){

      if ($this->personaValidation->validarCamposNumericosEnteros($idPersona) &&
          $this->personaValidation->verificarPerfilPersonaAEliminar($idPersona, $tipoPersona, $this->personaData)) {

        if ($this->personaData->eliminarPersona($idPersona)) {
            
          echo "true";

        }else{

          echo "false";

        }

      }else{

        echo "false";

      }

    }

    /*
    //Metodo encargado de validar una solicitud para iniciar sesión en el sistema
    */

    public function validarLogin(usuarioSistema $usuario){

      if ($this->personaValidation->validarCamposTexto($usuario->getNombreUsuario(),15) &&
          $this->personaValidation->validarCamposTexto($usuario->getContrasenia(),15)) {
      
        $usuarioSistema = $this->personaData->obtenerUsuarioSistemaPorNombreUsuario($usuario->getNombreUsuario());
        
        if(!is_null($usuarioSistema)){

          if($this->personaValidation->validarInicioSesionSistema($usuarioSistema, $usuario->getNombreUsuario(), $usuario->getContrasenia())) {
          
              session::init();

              session::set("usuarioSistema",$usuarioSistema);

              echo "true";
          
          }else{
          
              echo "La contraseña para el usuario ingresado es incorrecta";
          
          }
        
        }else{
        
          echo "El usuario ingresado no se encuentra registrado en la base de datos";
        
        }

    }else{

      echo "Los campos referentes a usuario y contraseña no pueden estar vacíos. El contenido de estos campos no puede exceder los 15 caracteres";

    }

  }

    /*
    // Metodo encargado de cerrar la sesión del usuario activo
    */

    public function cerrarSession(){

      session::init();

      session::remove("usuarioSistema");

      session::destroy();

      header('Location: '.URL);

      exit;

    }

    /*
    // Metodo encargado de generar un link temporal para la recuperación de la contraseña
    */

    private function generarLinkTemporal($idUsuarioSistema, $nombreUsuarioSistema){
   
      // Se genera un token para validar el cambio de contraseña
      $token = sha1($idUsuarioSistema.$nombreUsuarioSistema.rand(1,9999999).date('d-m-y'));

      $recuperarContrasenia = new recuperarContrasenia(0, $token, "", $idUsuarioSistema);

      $enlace = null;

      if ($this->personaData->registrarTokenRecuperarContrasenia($recuperarContrasenia)) {
        
         //Se devuelve el link que se enviara al usuario
        $enlace = SERVER.URL.'login/solicitudRestablecerContrasenia/?idUsuarioSistema='.sha1($idUsuarioSistema).'&token='.$token;
      
      }

      return $enlace;

    }

    /*
    // Metodo encargado de enviar el link generado al correo electrónico correspondiente para la recuperación de contraseña
    */
 
    private function enviarCorreoElectronico($correoElectronico, $nombreUsuario, $link){

       $mensaje = '<html>
         <head>
            <title>Restablecer su contraseña</title>
         </head>
         <body>
           <p>Hemos recibido una petición para restablecer la contraseña de su cuenta.</p>
           <p>Si usted hizo esta petición, haga click en el siguiente enlace, de lo contrario por favor ignore este correo.</p>
           <p><strong>Nota recordatoria:</strong></p>
           <p>Su nombre de usuario es: <strong>'.$nombreUsuario.'</strong></p>
           <p><strong>Enlace para restablecer su contraseña:</strong></p>
           <p><a href="'.$link.'"> Restablecer contraseña </a></p>
         </body>
        </html>';
     
       $cabeceras = 'MIME-Version: 1.0' . "\r\n";
       $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $cabeceras .= 'From: Sistema de control ASADA La Unión <noreply@sisconasadalaunion.com>' . "\r\n";

       // Se envia el correo al usuario
       return mail($correoElectronico, utf8_decode("Recuperar contraseña"), utf8_decode($mensaje), $cabeceras);
    
    }

    /*
    // Metodo encargado de recibir una solicitud para la recuperación de la contraseña de una cuenta
    */

    public function solicitudRecuperarContrasenia($correoElectronico){

      $patternCorreoElectronico = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

      if ($this->personaValidation->validarCamposTextoRegex($correoElectronico,30,$patternCorreoElectronico)) {

        $usuarioSistema = $this->personaData->obtenerUsuarioSistemaPorCorreoElectronico($correoElectronico);

        if (!is_null($usuarioSistema)) {

          if ($this->personaValidation->validarTipoUsuarioAdministrativo($usuarioSistema->getTipoUsuario())) {

            $idUsuarioSistema = $usuarioSistema->getIdUsuarioSistema();
            $nombreUsuarioSistema = $usuarioSistema->getNombreUsuario();
            $linkTemporal = $this->generarLinkTemporal($idUsuarioSistema, $nombreUsuarioSistema);

            if (!is_null($linkTemporal)) {
                
                if ($this->enviarCorreoElectronico($correoElectronico, $usuarioSistema->getNombreUsuario(), $linkTemporal)) {
                  
                  echo "true";

                }else{

                  echo "Ha ocurrido un error al tratar de enviar el correo electrónico con las instrucciones para recuperar la contraseña, inténtelo de nuevo";

                }

            }else{

              echo "Ha ocurrido un error al tratar de generar el enlace para la recuperación de la contraseña, inténtelo de nuevo";

            }
            
          }else{

            echo "El correo ingresado no pertenece a ninguna de las cuentas administrativas registradas en el sistema, inténtelo de nuevo";

          }
          
        }else{

          echo "El correo ingresado no esta asociado a ninguna cuenta registrada en el sistema, inténtelo de nuevo";

        }


      }else{

        echo "El contenido del campo correspondiente a correo electrónico no puede estar vacío y no puede execederse de 30 caracteres. Formato: ejemplo@gmail.com";

      }

    }

    /*
    // Metodo encargado de procesar la solicitud para restablecer una contraseña
    */

    public function solicitudRestablecerContrasenia($idUsuarioSistema, $token){

      $estadoSolicitudRestablecerContrasenia = false;

      if ($this->personaValidation->validarCamposTextoRequeridos($idUsuarioSistema) &&
          $this->personaValidation->validarCamposTextoRequeridos($token)) {

          $usuarioSistema = $this->personaData->obtenerUsuarioSistemaPorToken($token);

          if (!is_null($usuarioSistema)) {

            if ($this->personaValidation->validarTipoUsuarioAdministrativo($usuarioSistema->getTipoUsuario())) {
              
              if ($this->personaValidation->verificarCadenasIguales(sha1($usuarioSistema->getIdUsuarioSistema()), $idUsuarioSistema)) {
                
                $estadoSolicitudRestablecerContrasenia = true;

              }

            }

          }

        }

      return $estadoSolicitudRestablecerContrasenia;

    }

    /*
    // Metodo encargado de restablecer la contraseña de un usuario
    */
    public function restablecerContrasenia($idUsuarioSistema, $token, $nuevaContrasenia, $confirmarNuevaContrasenia){

      if ($this->personaValidation->validarCamposTextoRequeridos($idUsuarioSistema) &&
          $this->personaValidation->validarCamposTextoRequeridos($token) &&
          $this->personaValidation->validarContrasenias("Administrador", $nuevaContrasenia, $confirmarNuevaContrasenia)) {

          $usuarioSistema = $this->personaData->obtenerUsuarioSistemaPorToken($token);

          if (!is_null($usuarioSistema)) {

            if ($this->personaValidation->validarTipoUsuarioAdministrativo($usuarioSistema->getTipoUsuario())) {
              
              if ($this->personaValidation->verificarCadenasIguales(sha1($usuarioSistema->getIdUsuarioSistema()), $idUsuarioSistema)) {
                
                $nuevaContrasenia = password_hash($nuevaContrasenia, PASSWORD_DEFAULT);

                if ($this->personaData->restablecerContraseniaUsuario(intval($usuarioSistema->getIdUsuarioSistema()), $nuevaContrasenia)) {

                  echo "true";
                                      
                }else{

                  echo "Ha ocurrido un error al tratar de restablecer su contraseña en la base de datos, inténtelo de nuevo";

                }

              }else{

                echo "Ha ocurrido un error al validar su usuario para el cambio de contraseña";

              }

            }else{

              echo "El cambio de contraseña solo aplica para usuarios que tengan el perfil administrativo";

            }

          }else{

            echo "El enlace para acceder al cambio de su contraseña ha caducado";

          }

      }else{

        echo "Es necesario que el contenido de todos los campos pertenecientes al formulario para restablecer su contraseña no esten vacíos";

      }

    }

	}

?>