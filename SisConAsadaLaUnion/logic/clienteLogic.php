<?php

   /*
   // Clase logica intermediaria entre el controlador y la data del cliente, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

	class clienteLogic{

		private $clienteData;
    private $personaValidation;
    private $telefonoValidation;
    private $clienteValidation;

		public function __construct(){

			$this->clienteData = new clienteData();
      $this->personaValidation = new personaValidation();
      $this->telefonoValidation = new telefonoValidation();
      $this->clienteValidation = new clienteValidation();
			
		}

		/*
    // Método encargado de gestionar el registro del cliente, mediando entre controlador y data
		*/

		public function registrarCliente(cliente $cliente, telefono $telefono1, telefono $telefono2){

          if ($this->personaValidation->validarCedula($cliente->getCedula()) &&
              $this->personaValidation->validarNombreApellidos($cliente->getNombre()) &&
              $this->personaValidation->validarNombreApellidos($cliente->getApellidos()) &&
              $this->personaValidation->validarCorreoElectronico($cliente->getCorreoElectronico()) &&
              $this->telefonoValidation->validarTipoTelefonoRequerido($telefono1) &&
              $this->telefonoValidation->validarNumTelefonoRequerido($telefono1) &&
              $this->personaValidation->validarDireccion($cliente->getDireccion())) {

              $telefonoLogic = new telefonoLogic();

              $telefonoLogic->setTelefonoALista($telefono1);

              if ($this->telefonoValidation->validarTipoTelefonoRequerido($telefono2) &&
                  $this->telefonoValidation->validarNumTelefonoRequerido($telefono2)) {

                  $telefonoLogic->setTelefonoALista($telefono2);
                
              }

              if (!$this->clienteValidation->validarNumPlano($cliente->getNumeroPlano(),$this->clienteData)) {
                
                  $cliente->setNumeroPlano('NULL');

              }else{

                  $cliente->setNumeroPlano("'".$cliente->getNumeroPlano()."'");
                  
              }

              $listaTelefonos = $telefonoLogic->getListaTelefonos(); 

              if($this->clienteData->registrarCliente($cliente,$listaTelefonos)){

                echo "true";
                
              }else{

                echo "false";
              }
                
          }else{

            echo "false";

          }

		}

		/*
   	// Método encargado de gestionar la comprobación de un número de plano existente en la base de datos, mediando entre controlador y data
    */

		public function comprobarExistenciaNumeroPlano($numeroPlano){

      if ($this->clienteValidation->validarNumPlanoAjax($numeroPlano)) {

         	if ($this->clienteData->comprobarExistenciaNumeroPlano($numeroPlano)) {

         		echo "<div id='msjPlano' class='alert alert-danger' data-plano='false'>
               		  		<strong><span class='glyphicon glyphicon-remove'></span></strong> 
                   			El número de plano digitado ya existe, debe cambiarlo
             		 </div>";


         	}else{

         		 echo "<div id='msjPlano' class='alert alert-success' data-plano='true'>
               				<strong><span class='glyphicon glyphicon-ok'></span></strong> 
                   	    	Número de plano disponible para ser registrado
              		   </div>";

         	}

      }else{

        echo "<div id='msjPlano' class='alert alert-danger' data-plano='false'>
                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                El contenido del campo correspondiente a número de plano no puede estar vacío y no puede excederse de 16 caracteres
              </div>";

      }

		}


	}

?>