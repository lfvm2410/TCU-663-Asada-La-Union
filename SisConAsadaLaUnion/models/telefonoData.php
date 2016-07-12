<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes al modulo de mantenimiento de cliente
    */

    class telefonoData extends modelo{
    		
        private $listaTelefonos;

    	function __construct(){

            parent::__construct();
            
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

        /*
        ** Metodo encargado de comprobar si un teléfono existe dentro de la base de datos
        */
        
        function comprobarExistenciaTelefono($numeroTelefono){

        $conexionBD = $this->getConexionInstance()->getConexion();

        mysql_set_charset('utf8');

        $consultaTelefonoExistente = mysql_query("call SP_comprobarExistenciaTelefono('$numeroTelefono')",$conexionBD) or die("Error al tratar de verificar el número de teléfono ingresado en la base de datos");

        $telefonoExistente = false;

        if ($consultaTelefonoExistente) {
            
            if (mysql_num_rows($consultaTelefonoExistente) > 0) {

                $telefonoExistente = true;

            }
        }

        mysql_close($conexionBD);

        return $telefonoExistente;

        }

    }
?>