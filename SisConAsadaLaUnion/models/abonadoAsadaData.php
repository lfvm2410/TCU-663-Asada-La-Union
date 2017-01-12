<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase abonadoAsada
    */

    class abonadoAsadaData extends modelo{
    		
    	public function __construct(){

            parent::__construct();
    	
    	}

        /*
        // Metodo encargado de registrar un abonado en la base de datos
        */

        public function registrarAbonado(abonadoAsada $abonadoAsada){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');
  
            $rango = $abonadoAsada->getRango();

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_registrarAbonadoAsada('$rango')",$conexionBD) or die("Error al tratar de registrar el rango de abonados en la base de datos");
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Metodo encargado de editar un abonado en la base de datos
        */

        public function editarAbonado(abonadoAsada $abonadoAsada){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');
            
            $idAbonadoAsada = intval($abonadoAsada->getIdAbonadoAsada());
            $rango = $abonadoAsada->getRango();

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_editarAbonadoAsada($idAbonadoAsada, '$rango')",$conexionBD) or die("Error al tratar de editar el rango de abonados en la base de datos");
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        ** Metodo encargado de comprobar si un rango de abonados existe dentro de la base de datos
        */
        
        public function comprobarExistenciaRangoAbonados($rangosAbonados){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaRangoAbonadosExistente = mysql_query("call SP_comprobarExistenciaRangoAbonados('$rangosAbonados')",$conexionBD) or die("Error al tratar de verificar el rango de abonados ingresado en la base de datos");

            $rangoAbonadosExistente = false;

            if ($consultaRangoAbonadosExistente) {
                
                if (mysql_num_rows($consultaRangoAbonadosExistente) > 0) {

                    $rangoAbonadosExistente = true;

                }
            }

            mysql_close($conexionBD);

            return $rangoAbonadosExistente;

        }

        /*
        // Método encargado de obtener un abonado por id
        */

        public function obtenerAbonadoPorId($idAbonadoAsada){

            $idAbonadoAsada = intval($idAbonadoAsada);

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaAbonado = mysql_query("call SP_obtenerAbonadoPorId($idAbonadoAsada)",$conexionBD) or die("Error al tratar de obtener la información del rango de abonados seleccionado en la base de datos");

            $abonadoSeleccionado = array();

            if ($consultaAbonado) {
                
                if (mysql_num_rows($consultaAbonado) > 0) {

                    while ($abonado = mysql_fetch_array($consultaAbonado)) {

                        $idAbonadoAsada = $abonado['id_AbonadoAsada'];
                        $rango = $abonado['rango_AbonadoAsada'];

                        $abonadoSeleccionado = array('idAbonadoAsada'=>$idAbonadoAsada, 'rango'=>$rango);

                    }

                }

            }

            mysql_close($conexionBD);

            return $abonadoSeleccionado;

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