<?php

	/*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase lectura
    */


    class lecturaData extends modelo{

    	public function __construct(){

    	parent::__construct();

    }

    public function registrarLectura(lecturaMedidor $lectura)
    {
    	$conexionBD = $this->getConexionInstance()->getConexion();

        mysql_set_charset('utf8');

        $cantMtosCub = $lectura->getCantidadMetrosCubicos();
        $idServicio = $lectura->getIdServicio();

        $result = mysql_query("call SP_registrarLectura($cantMtosCub, $idServicio)", $conexionBD) or die(mysql_error());

        mysql_close($conexionBD);

        return $result;
    }

    public function editarLectura($idLectura, $cantMtosCub)
    {
        $conexionBD = $this->getConexionInstance()->getConexion();
        $resultado = false;

        mysql_set_charset('utf8');

        $resultadoEdicion = mysql_query("call SP_editarLectura('$cantMtosCub', $idLectura)", $conexionBD) or die("Error al editar la lectura");

        if($resultadoEdicion){

            $resultado = true;
        }

        mysql_close($conexionBD);
        
        return $resultado;
    }
}
?>