<?php

  /*
  // Clase logica intermediaria entre el controlador y la data de la persona, tiene como objetivo validar
  // reglas de negocio y gestiona los llamados hacia la data
  */

	class personaLogic{

		private $personaData;
    private $personaValidation;

		public function __construct(){

			$this->personaData = new personaData();
      $this->personaValidation = new personaValidation();

		}

    /*
    // Método encargado de gestionar la comprobación de una cédula existente en la base de datos, mediando entre controlador y data
    */

		public function comprobarExistenciaCedula($cedula){

      if ($this->personaValidation->validarCedulaAjax($cedula)) {

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

      if ($this->personaValidation->validarCorreoElectronicoAjax($correoElectronico)) {

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

	}

?>