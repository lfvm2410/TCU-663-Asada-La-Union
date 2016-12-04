<?php

    /*
    // Clase base usada por todos los modelos, con el fin de implementar mvc
    */

	class modelo{

		private static $baseDatos;
		
		public function __construct(){

			self::setConexionInstance();
			
		}

		private static function setConexionInstance(){

			if (!isset(self::$baseDatos)) {

				self::$baseDatos = new conexionBaseDatos(DB_HOST,DB_USER,DB_PASS,DB_BASE);
			
			}
		}

		public function getConexionInstance(){

			return self::$baseDatos;

		}

		/*
        ** Metodo encargado de comprobar si el valor de un campo ya existe en una tabla de la base de datos
        ** Nota: El valor de retorno devuelve true si el valor a verificar ya existe y es diferente del valor 'actual'
        */
        
        public function comprobarExistenciaCampoEnEdicion($nombreTabla, $nombreAtributo, $valorActual, $valorNuevo){

           	$valorNuevoExistente = false;

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaExistenciaValorNuevo = mysql_query("call SP_verificarCampoExiste('$nombreTabla','$nombreAtributo','$valorActual','$valorNuevo',@existe)",$conexionBD) or die("Error al tratar de verificar la existencia del valor ingresado en la base de datos");

            $obtenerExistenciaValorNuevo = mysql_query("select @existe",$conexionBD);
            
            $retornoExistenciaValorNuevo = mysql_fetch_array($obtenerExistenciaValorNuevo);

            // Se captura el retorno del procedimiento almacenado
            
            $valorNuevoExistente = $retornoExistenciaValorNuevo['@existe'];

            mysql_close($conexionBD);

            return $valorNuevoExistente;

        }
	}

?>