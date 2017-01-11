<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase abonadoAsada
    */

    class abonadoAsadaData extends modelo{
    		
    	public function __construct(){

            parent::__construct();
    	
    	}

        /*
        // Metodo encargado de obtener todos los rangos de abonados de la asada
        */

        public function obtenerRangosAbonadosAsada(){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $rangosAbonadosAsada = mysql_query("call SP_obtenerRangosAbonadosAsada()",$conexionBD) or die("Error al tratar de obtener los rangos de abonados disponibles en la base de datos");

            $listaRangosAbonadosAsada = array();

            if ($rangosAbonadosAsada) {
                
                if (mysql_num_rows($rangosAbonadosAsada) > 0) {

                    while ($rangosAbonados = mysql_fetch_array($rangosAbonadosAsada)) {

                        $id = $rangosAbonados['id_AbonadoAsada'];
                        $rango = $rangosAbonados['rango_AbonadoAsada'];
            
                        $listaRangosAbonadosAsada[] = array('id'=>$id, 'rango'=>$rango);

                    }

                }

            }

            mysql_close($conexionBD);

            return $listaRangosAbonadosAsada;

        }
        
    }
    
?>