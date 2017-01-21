<?php

	/*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase servicio
    */

    class servicioData extends modelo{

    	public function __construct(){

    	parent::__construct();

    }

        /*
        ** Metodo encargado de comprobar si un Número de NIS existe dentro de la base de datos
        */
        
        public function comprobarExistenciaNumeroNIS($numNIS){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaNumeroNISExistente = mysql_query("call SP_comprobarExistenciaNumeroNIS('$numNIS')",$conexionBD) or die("Error al tratar de verificar la cédula ingresada en la base de datos");

            $numeroNISExistente = false;

            if ($consultaNumeroNISExistente) {
                
                if (mysql_num_rows($consultaNumeroNISExistente) > 0) {

                    $numeroNISExistente = true;

                }
            }

            mysql_close($conexionBD);

            return $numeroNISExistente;

        }

    /*
    ** Metodo encargado de registrar un servicio en la base de datos
    */

    public function registrarServicio(servicio $servicio, $idCliente){

    	$conexionBD = $this->getConexionInstance()->getConexion();

        mysql_set_charset('utf8');

        $numeroNIS = $servicio->getNumeroNIS();
        $estado = $servicio->getEstado();
        $tipoServicio = $servicio->getTipoServicio();

        $result = mysql_query("call SP_registrarServicio('$numeroNIS', '$tipoServicio', '$estado', '$idCliente')", $conexionBD) or die (mysql_error());

        mysql_close($conexionBD);

        return $result;
    }

    /*
    // Método encargado de obtener los servicios a mostrar
    */

    public function obtenerServicios($servicioActual, $limiteServicio, $serviciosActivos){

        $conexionBD = $this->getConexionInstance()->getConexion();

        $mysql_set_charset('utf8');

        $consultaServicios = mysql_query("call SP_consultarServicio($servicioActual, $limiteServicio, '$serviciosActivos')", $conexionBD) or die("Error al tratar de obtener los servicios en la base de datos");

        $listaServicios = array();

        if($consultaServicios){

            if(mysql_num_rows($consultaServicios) > 0){

                while($ser = mysql_fetch_array($consultaServicios)
                    ){

                    $idServicio = $ser['id_ServicioAgua'];
                    $numeroNIS = $ser['numeroNis_ServicioAgua'];
                    $estado = $ser['estado_ServicioAgua'];
                    $tipoServicio = $ser['tipo_ServicioAgua'];
                    $fechaModificacion = $ser['fechaModificacion_ServicioAgua'];
                    $cliente = $ser['nombreCliente'];

                    $listaServicios[] = array('idServicio' => $idServicio, 'numeroNIS' => $numeroNIS, 'estado'=> $estado, 'tipoServicio' => $tipoServicio, 'fechaModificacion' => $fechaModificacion);
                }
            }
        }

        mysql_close($conexionBD);

        return $listaServicios;

    }

    /*
    ** Metodo encargado de editar un servicio en la base de datos
    */

    public function editarServicio(servicio $servicio){

        $conexionBD = $this->getConexionInstance()->getConexion();
        $resultado = false;

        mysql_set_charset('utf8');

        $estado = $servicio->getEstado();
        $tipo = $servicio->getTipoServicio();
        $id = $servicio->getIdServicio();

        $resultadoEdicion = mysql_query("call SP_editarServicio('$estado', '$tipo', $id)", $conexionBD) or die("Error al editar el servicio");

        if($resultadoEdicion){

            $resultado = true;
        }

        mysql_close($conexionBD);
        
        return $resultado;
    }

    /*
    // Método encargado de obtener el total de servicios registrados en la base de datos
    */

    public function obtenerTotalServicios($serviciosActivos){

        $conexionBD = $this->getConexionInstance()->getConexion();

        mysql_set_charset('utf8');

        $consultaTotalServicios = mysql_query("call SP_obtenerTotalServicios('$serviciosActivos')", $conexionBD) or die("Error al tratar de obtener la cantidad total de servicios en la base de datos");

        $totalServicios = 0;

        if ($consultaTotalServicios) {
            
            if (mysql_num_rows($consultaTotalServicios) > 0) {
                $serTotal = mysql_fetch_array($consultaTotalServicios, MYSQL_NUM);

                $totalServicios = $serTotal[0];
            }
        }

        mysql_close($conexionBD);

        return $totalServicios;
    }
    
    /*
    // Método encargado de activar o desactivar un cliente en la base de datos
    */

    public function actualizarEstadoServicio($idServicio, $activoServicio){

        $conexionBD = $this->getConexionInstance()->getConexion();

        mysql_set_charset('utf8');

        $estadoTransaccion = false;

        $activarAnularServicio = mysql_query("call SP_actualizarEstadoServicio('$idServicio', '$activoServicio')", $conexionBD) or die("Error al tratar de activar o anular el servicio en la base de datos");

        if($activoServicio){

            $estadoTransaccion = true;
        }

        mysql_close($conexionBD);

        return $estadoTransaccion;
    }

    /*
    // Método encargado de obtener un servicio por su id
    */

    public function getServicio($idServicio){

        $conexionBD = $this->getConexionInstance()->getConexion();

        mysql_set_charset('utf8');

        $consultaServicio = mysql_query("call SP_obtenerServicio($idServicio)", $conexionBD);

        $servicio = array();

        if ($consultaServicio) {

            if (mysql_num_rows($consultaServicio) > 0) {

                $ser = mysql_fetch_array($consultaServicio);
                
                $idServicio = $ser['id_ServicioAgua'];
                $numeroNIS = $ser['numeroNis_ServicioAgua'];
                $estado = $ser['estado_ServicioAgua'];
                $tipoServicio = $ser['tipo_ServicioAgua'];
                $fechaModificacion = $ser['fechaModificacion_ServicioAgua'];
                $cliente = $ser['nombreCliente'];

                $servicio = array('idServicio' => $idServicio, 'numeroNIS' => $numeroNIS, 'estado'=> $estado, 'tipoServicio' => $tipoServicio, 'fechaModificacion' => $fechaModificacion, 'cliente' => $cliente);
            }
        }

        mysql_close($conexionBD);

        return $servicio;
    }
}
?>