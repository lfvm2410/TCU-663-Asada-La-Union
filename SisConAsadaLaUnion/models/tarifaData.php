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
            $descripcion = $tarifa->getDescripcion();
            $tipoServicio = $tarifa->getTipoServicio();
            $monto = $tarifa->getMonto();
            $idAbonadoAsada = intval($tarifa->getIdAbonadoAsada());

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_registrarTarifa('$nombre', '$descripcion', '$tipoServicio', $monto, $idAbonadoAsada)",$conexionBD) or die("Error al tratar de registrar la tarifa en la base de datos");
               
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
            $descripcion = $tarifa->getDescripcion();
            $tipoServicio = $tarifa->getTipoServicio();
            $monto = $tarifa->getMonto();
            $idAbonadoAsada = intval($tarifa->getIdAbonadoAsada());

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_editarTarifa($idTarifa, '$nombre', '$descripcion', '$tipoServicio', $monto, $idAbonadoAsada)",$conexionBD) or die("Error al tratar de editar la tarifa en la base de datos");
               
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
                        $descripcion = $tarifa['descripcion_Tarifa'];
                        $tipoServicio = $tarifa['tipoServicio_Tarifa'];
                        $monto = $tarifa['monto_Tarifa'];
                        $idAbonadoAsada = $tarifa['tbAbonadoAsada_id_AbonadoAsada'];

                        $tarifaSeleccionada = array('idTarifa'=>$idTarifa, 'nombre'=>$nombre, 
                                                    'descripcion'=>$descripcion, 'tipoServicio'=>$tipoServicio, 
                                                    'monto'=>$monto, 'idAbonadoAsada'=>$idAbonadoAsada);

                    }

                }

            }

            mysql_close($conexionBD);

            return $tarifaSeleccionada;

        }

        /*
        // Metodo encargado de obtener las descripciones disponibles para las tarifas
        */

        public function obtenerDescripcionesTarifas(){

            $listaDescripciones = array('Tarifa base', '1 a 10', '11 a 30', '31 a 60', 
                                        'Más de 60', 'Tarifa fija', 'Ley hidrantes (con medidor)', 
                                        'Ley hidrantes (sin medidor)');

            return $listaDescripciones;

        }

        /*
        ** Metodo encargado de comprobar si una descripcion existe para un abonado determinado
        */
        
        public function comprobarExistenciaDescripcionPorAbonado($idRangoAbonado, $descripcion){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $idRangoAbonado = intval($idRangoAbonado);

            $consultaDescripcionExistente = mysql_query("call SP_comprobarExistenciaDescripcionPorAbonado($idRangoAbonado, '$descripcion')",$conexionBD) or die("Error al tratar de verificar la descripción ingresada para el rango de abonados seleccionado en la base de datos");

            $descripcionExistente = false;

            if ($consultaDescripcionExistente) {
                
                if (mysql_num_rows($consultaDescripcionExistente) > 0) {

                    $descripcionExistente = true;

                }
            }

            mysql_close($conexionBD);

            return $descripcionExistente;

        }

        /*
        ** Metodo encargado de comprobar si una descripcion existe para un abonado determinado, al momento de editar una
        ** tarifa
        */
        public function comprobarExistenciaDescripcionPorAbonadoEnEdicion($idAbonadoAsada, $descripcionActual, $descripcionNueva){

            $descripcionNuevaExistente = false;

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $idAbonadoAsada = intval($idAbonadoAsada);

            $consultaDescripcion = mysql_query("call SP_comprobarExistenciaDescripcionPorAbonadoEnEdicion($idAbonadoAsada,'$descripcionActual','$descripcionNueva',@existe)",$conexionBD) or die("Error al tratar de verificar la descripción ingresada para el rango de abonados seleccionado en la base de datos");

            $obtenerExistenciaDescripcion = mysql_query("select @existe",$conexionBD);
            
            $retornoExistenciaDescripcion = mysql_fetch_array($obtenerExistenciaDescripcion);

            // Se captura el retorno del procedimiento almacenado
            
            $descripcionNuevaExistente = $retornoExistenciaDescripcion['@existe'];

            mysql_close($conexionBD);

            return $descripcionNuevaExistente;

        }
        
    }
    
?>