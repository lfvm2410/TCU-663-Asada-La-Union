<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase telefono
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

        /*
        // Metodo encargado de obtener los telefonos correspondientes a una persona por su cédula
        */

        public function obtenerTelefonosPorCedulaPersona($cedula){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $telefonosPersona = mysql_query("call SP_obtenerTelefonosPorCedulaPersona('$cedula')",$conexionBD) or die("Error al tratar de obtener los teléfonos en la base de datos");

            $listaTelefonos = array();

            if ($telefonosPersona) {
                
                if (mysql_num_rows($telefonosPersona) > 0) {

                    while ($tel = mysql_fetch_array($telefonosPersona)) {

                        $tipo = $tel['tipo_Telefono'];
                        $numero = $tel['numero_Telefono'];
            
                        $listaTelefonos[] = array('tipo'=>$tipo, 'numero'=>$numero);

                    }

                }

            }

            mysql_close($conexionBD);

            return $listaTelefonos;

        }

        /*
        // Metodo encargado de obtener los telefonos correspondientes a una persona por su id
        */

        public function obtenerTelefonosPorIdPersona($idPersona){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $telefonosPersona = mysql_query("call SP_obtenerTelefonosPorIdPersona($idPersona)",$conexionBD) or die("Error al tratar de obtener los teléfonos en la base de datos");

            $listaTelefonos = array();

            if ($telefonosPersona) {
                
                if (mysql_num_rows($telefonosPersona) > 0) {

                    while ($tel = mysql_fetch_array($telefonosPersona)) {

                        $tipo = $tel['tipo_Telefono'];
                        $numero = $tel['numero_Telefono'];
            
                        $listaTelefonos[] = array('tipo'=>$tipo, 'numero'=>$numero);

                    }

                }

            }

            mysql_close($conexionBD);

            return $listaTelefonos;

        }
        
    }
    
?>