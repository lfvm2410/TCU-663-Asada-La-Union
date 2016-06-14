<?php 

/*
* Clase encargada de contener todas las operaciones de datos referentes al modulo de mantenimiento de cliente
*/

class telefonoData{
		
    private $listaTelefonos;

	function __construct(){

        $this->listaTelefonos = array();
	
	}

    /*
    ** Metodo encargado de agregar un telefono a una lista de telefonos, con el fin de asociarlos a una persona
    */

    function setTelefonoALista($telefono){

        $this->listaTelefonos[] = $telefono;

    }

    /*
    ** Metodo encargado de obtener la lista de telefonos
    */

    function getListaTelefonos(){

        return $this->listaTelefonos;
     
    }

}

?>