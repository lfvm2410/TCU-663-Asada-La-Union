<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase tarifa
    */

    class tarifaData extends modelo{
    		
    	public function __construct(){

            parent::__construct();
    	
    	}

        /*
        // Metodo encargado de registrar una tarifa en la base de datos
        */

        public function registrarTarifa(tarifa $tarifa){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');
  
            $nombre = $tarifa->getNombre();
            $tipoServicio = $tarifa->getTipoServicio();
            $monto = $tarifa->getMonto();
            $idAbonadoAsada = intval($tarifa->getIdAbonadoAsada());

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_registrarTarifa('$nombre', '$tipoServicio', $monto, $idAbonadoAsada)",$conexionBD) or die("Error al tratar de registrar la tarifa en la base de datos");
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Metodo encargado de editar una tarifa en la base de datos
        */

        public function editarTarifa(tarifa $tarifa){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');
            
            $idTarifa = intval($tarifa->getIdTarifa());
            $nombre = $tarifa->getNombre();
            $tipoServicio = $tarifa->getTipoServicio();
            $monto = $tarifa->getMonto();
            $idAbonadoAsada = intval($tarifa->getIdAbonadoAsada());

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_editarTarifa($idTarifa, '$nombre', '$tipoServicio', $monto, $idAbonadoAsada)",$conexionBD) or die("Error al tratar de editar la tarifa en la base de datos");
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Método encargado de obtener una tarifa por id
        */

        public function obtenerTarifaPorId($idTarifa){

            $idTarifa = intval($idTarifa);

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaTarifa = mysql_query("call SP_obtenerTarifaPorId($idTarifa)",$conexionBD) or die("Error al tratar de obtener la información de la tarifa seleccionada en la base de datos");

            $tarifaSeleccionada = array();

            if ($consultaTarifa) {
                
                if (mysql_num_rows($consultaTarifa) > 0) {

                    while ($tarifa = mysql_fetch_array($consultaTarifa)) {

                        $idTarifa = $tarifa['id_Tarifa'];
                        $nombre = $tarifa['nombre_Tarifa'];
                        $tipoServicio = $tarifa['tipoServicio_Tarifa'];
                        $monto = $tarifa['monto_Tarifa'];
                        $idAbonadoAsada = $tarifa['tbAbonadoAsada_id_AbonadoAsada'];

                        $tarifaSeleccionada = array('idTarifa'=>$idTarifa, 'nombre'=>$nombre, 'tipoServicio'=>$tipoServicio, 
                                                     'monto'=>$monto, 'idAbonadoAsada'=>$idAbonadoAsada);

                    }

                }

            }

            mysql_close($conexionBD);

            return $tarifaSeleccionada;

        }
        
    }
    
?>