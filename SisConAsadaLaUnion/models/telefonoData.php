<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes al modulo de mantenimiento de cliente
    */

    class telefonoData extends modelo{
    		
        private $listaTelefonos;

    	public function __construct(){

            parent::__construct();
            
            $this->listaTelefonos = array();
    	
    	}

        /*
        ** Metodo encargado de agregar un telefono a una lista de telefonos, con el fin de asociarlos a una persona
        */

        public function setTelefonoALista(telefono $telefono){

            $this->listaTelefonos[] = $telefono;

        }

        /*
        ** Metodo encargado de obtener la lista de telefonos
        */

        public function getListaTelefonos(){

            return $this->listaTelefonos;
         
        }
        
    }
    
?>