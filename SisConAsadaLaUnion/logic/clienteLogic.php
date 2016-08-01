<?php

   /*
   // Clase logica intermediaria entre el controlador y la data del cliente, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

	class clienteLogic{

		private $clienteData;
    private $personaData;
    private $clienteValidation;
    private $personaValidation;
    private $telefonoValidation;
    
		public function __construct(){

			$this->clienteData = new clienteData();
      $this->personaData = new personaData();
      $this->clienteValidation = new clienteValidation();
      $this->personaValidation = new personaValidation();
      $this->telefonoValidation = new telefonoValidation();

		}

		/*
    // Método encargado de gestionar el registro del cliente, mediando entre controlador y data
		*/

		public function registrarCliente(cliente $cliente, telefono $telefono1, telefono $telefono2){

          $patternTelefono = "/^[0-9]{8}$/";

          if ($this->personaValidation->validarCedula($cliente->getCedula(),$this->personaData) &&
              $this->clienteValidation->validarCamposTexto($cliente->getNombre(),30) &&
              $this->clienteValidation->validarCamposTexto($cliente->getApellidos(),30) &&
              $this->personaValidation->validarCorreoElectronico($cliente->getCorreoElectronico(),$this->personaData) &&
              $this->telefonoValidation->validarTipoTelefonoRequerido($telefono1->getTipo()) &&
              $this->telefonoValidation->validarCamposTextoRegex($telefono1->getNumero(),8,$patternTelefono) &&
              $this->clienteValidation->validarCamposTexto($cliente->getDireccion(),300) &&
              $this->clienteValidation->validarNumPlano($cliente->getNumeroPlano(),$this->clienteData)) {

              $telefonoLogic = new telefonoLogic();

              $telefonoLogic->setTelefonoALista($telefono1);

              if ($this->telefonoValidation->validarTipoTelefonoRequerido($telefono2->getTipo()) &&
                  $this->telefonoValidation->validarCamposTextoRegex($telefono2->getNumero(),8,$patternTelefono)) {

                  $telefonoLogic->setTelefonoALista($telefono2);
                
              }

              if ($this->clienteValidation->validarCamposTexto($cliente->getNumeroPlano(),16)) {
                
                  $cliente->setNumeroPlano("'".$cliente->getNumeroPlano()."'");

              }else{

                  $cliente->setNumeroPlano('NULL');
                  
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

      if ($this->clienteValidation->validarCamposTexto($numeroPlano,16)) {

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