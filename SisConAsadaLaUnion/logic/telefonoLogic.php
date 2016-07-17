<?php

    /*
   // Clase logica intermediaria entre el controlador y la data del telefono, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

	class telefonoLogic{

		private $telefonoData;

		public function __construct(){

			$this->telefonoData = new telefonoData();
			
		}

		/*
        // Método encargado de setear un telefono en una lista que gestiona la clase data
		*/

		public function setTelefonoALista(telefono $telefono){

			 $this->telefonoData->setTelefonoALista($telefono);

		}

        /*
        // Método encargado de obtener una lista de telefonos en memoria; gestionada por la clase data
        */

		public function getListaTelefonos(){

            return  $this->telefonoData->getListaTelefonos();
         
        }

	}

?>