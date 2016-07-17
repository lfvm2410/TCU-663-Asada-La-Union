<?php

   /*
   // Clase logica intermediaria entre el controlador y la data del cliente, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

	class clienteLogic{

		private $clienteData;

		public function __construct(){

			$this->clienteData = new clienteData();
			
		}

		/*
        // Método encargado de gestionar el registro del cliente, mediando entre controlador y data
		*/

		public function registrarCliente(cliente $cliente, telefono $telefono1, telefono $telefono2){

			$telefonoLogic = new telefonoLogic();

	    	$telefonoLogic->setTelefonoALista($telefono1);

        	$telefonoLogic->setTelefonoALista($telefono2);

        	$listaTelefonos = $telefonoLogic->getListaTelefonos(); 

       		if($this->clienteData->registrarCliente($cliente,$listaTelefonos)){

       			echo "true";
       			
       		}else{

       			echo "false";
       		}

		}

	}

?>