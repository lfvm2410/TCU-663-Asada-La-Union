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

        /*
        // Método encargado de obtener el total registros para la paginacion de una consulta en la base de datos
        */

        public function obtenerTotalRegistrosPaginacion($idConsulta, $filtroBusqueda, $registrosActivos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaTotalRegistros = mysql_query("call SP_obtenerRegistrosPaginados($idConsulta, '$filtroBusqueda', 
            									  0, 0, '$registrosActivos')",$conexionBD) 
            									  or die("Error al tratar de obtener la cantidad total de registros en la base de datos");

            $totalRegistros = 0;

            if ($consultaTotalRegistros) {
                
                if (mysql_num_rows($consultaTotalRegistros) > 0) {

                    $regTotal = mysql_fetch_array($consultaTotalRegistros,MYSQL_NUM);

                    $totalRegistros = $regTotal[0];

                }

            }

            mysql_close($conexionBD);

            return $totalRegistros;
        }

        /*
        // Método encargado de obtener los registros paginados que se soliciten de una tabla en especifico
        */

        public function obtenerRegistrosPaginados($listaCampos, $idConsulta, $filtroBusqueda, $registroActual,
        										  $limiteRegistros, $registrosActivos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaRegistrosPaginados = mysql_query("call SP_obtenerRegistrosPaginados($idConsulta, '$filtroBusqueda', 
            										  $registroActual, $limiteRegistros, '$registrosActivos')", $conexionBD) 
            									      or die("Error al tratar de obtener los registros en la base de datos");

            $listaRegistrosPaginados = array();

            if ($consultaRegistrosPaginados) {
                
                if (mysql_num_rows($consultaRegistrosPaginados) > 0) {

                	$tamanioListaCampos = count($listaCampos);

                    while ($registro = mysql_fetch_array($consultaRegistrosPaginados)) {

                  		$registroActual = array();

						for($i=0; $i<$tamanioListaCampos; $i++){

                    		$valor = $registro[$listaCampos[$i]];

                    		$atributoTemporal = array($listaCampos[$i] => $valor);
					
							$registroActual = array_merge($registroActual, $atributoTemporal);
                    
                		}

                		$listaRegistrosPaginados[] = $registroActual;

                    }

                }

            }

            mysql_close($conexionBD);

            return $listaRegistrosPaginados;

        }
	}

?>