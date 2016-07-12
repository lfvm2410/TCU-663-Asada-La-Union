<?php
    
    /*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase persona
    */

    class personaData extends modelo{

    	function __construct(){
    	
    		parent::__construct();
    	}

        /*
        ** Metodo encargado de comprobar si una cédula existe dentro de la base de datos
        */
        
        function comprobarExistenciaCedula($cedula){

        $conexionBD = $this->baseDatos->getConexion();

        mysql_set_charset('utf8');

        $consultaCedulaExistente = mysql_query("call SP_comprobarExistenciaCedula('$cedula')",$conexionBD) or die("Error al tratar de verificar la cédula ingresada en la base de datos");

        $cedulaExistente = false;

        if ($consultaCedulaExistente) {
            
            if (mysql_num_rows($consultaCedulaExistente) > 0) {

                $cedulaExistente = true;

            }
        }

        mysql_close($conexionBD);

        return $cedulaExistente;

        }

        /*
        ** Metodo encargado de comprobar si un correo electrónico existe dentro de la base de datos
        */
        
        function comprobarExistenciaCorreoElectronico($correoElectronico){

        $conexionBD = $this->baseDatos->getConexion();

        mysql_set_charset('utf8');

        $consultaCorreoElectronico = mysql_query("call SP_comprobarExistenciaCorreoElectronico('$correoElectronico')",$conexionBD) or die("Error al tratar de verificar el correo electrónico ingresado en la base de datos");

        $correoElectronicoExistente = false;

        if ($consultaCorreoElectronico) {
            
            if (mysql_num_rows($consultaCorreoElectronico) > 0) {

                $correoElectronicoExistente = true;

            }
        }

        mysql_close($conexionBD);

        return $correoElectronicoExistente;

        }

    }
?>