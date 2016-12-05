<?php
    
    /*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase persona
    */

    class personaData extends modelo{

    	public function __construct(){
    	
    		parent::__construct();
    	}

        /*
        ** Metodo encargado de registrar una persona como usuario en la base de datos
        */
        
        public function registrarPersona(usuarioSistema $usuario, $listaTelefonos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $cedula = $usuario->getCedula();
            $nombre = $usuario->getNombre();
            $apellidos = $usuario->getApellidos();
            $correoElectronico = $usuario->getCorreoElectronico();
            $direccion = $usuario->getDireccion();
            $nombreUsuario = $usuario->getNombreUsuario(); 
            $tipoUsuario = $usuario->getTipoUsuario();
            
            $fechaNacimientoTemp = strtr($usuario->getFechaNacimiento(), '/', '-');
            $fechaNacimiento =  date("Y-m-d",strtotime($fechaNacimientoTemp));
            
            $puesto = $usuario->getPuesto();
            $descripcionPuesto = $usuario->getDescripcionPuesto();
            $contrasenia = $usuario->getContrasenia();

            $estadoTransaccion = false;
            $contadorTransaccionesTel = 0;

            mysql_query("SET AUTOCOMMIT=0",$conexionBD);  

            mysql_query("START TRANSACTION",$conexionBD);

            // Se registra una persona en la base de datos

            $resultadoRegistroPersona = mysql_query("call SP_registrarPersona('$cedula','$nombre'
                    ,'$apellidos','$correoElectronico','$direccion',@idPersona)",$conexionBD);

            // Se toma la ultima persona que ha sido ingresada a la base de datos

            $consultaPersona = mysql_query("select @idPersona",$conexionBD);
            
            $retornoRegistroPersona = mysql_fetch_array($consultaPersona);

            // Se captura la persona que se ha consultado
            
            $idPersona = $retornoRegistroPersona['@idPersona'];

            // Se registra un usuario en la base de datos

            $resultadoRegistroUsuario = mysql_query("call SP_registrarUsuario($nombreUsuario,'$tipoUsuario','$fechaNacimiento','$puesto','$descripcionPuesto',$contrasenia,$idPersona)", $conexionBD) or die(mysql_error());

            // Se recorre la lista de telefonos para insertar en la base de datos

            foreach ($listaTelefonos as $telefono) { 

                 $tipo = $telefono->getTipo();

                 $numero = $telefono->getNumero();

                 // Se registra cada telefono perteneciente a la persona

                 $registroTelefono = mysql_query("call SP_registrarTelefono('$tipo','$numero',$idPersona)", $conexionBD);   

                 if (!$registroTelefono) {

                    // Contador para controlar que cada uno de los registros se esta efectuando o no

                    $contadorTransaccionesTel++;
                                     
                  }
     
            }        

            if ($resultadoRegistroPersona && $consultaPersona && $resultadoRegistroUsuario && $contadorTransaccionesTel == 0) {  // determina el commit y rollback dependiendo del estado de las transacciones
                   
                mysql_query("COMMIT",$conexionBD);

                $estadoTransaccion = true;
                     
            }else{
                  
                mysql_query("ROLLBACK",$conexionBD);

            }
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        ** Metodo encargado de comprobar si un nombre de usuario existe dentro de la base de datos
        */
        
        public function comprobarExistenciaNombreUsuario($nombreUsuario){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaNombreUsuarioExistente = mysql_query("call SP_comprobarExistenciaNombreUsuario('$nombreUsuario')",$conexionBD) or die("Error al tratar de verificar el nombre de usuario ingresado en la base de datos");

            $nombreUsuarioExistente = false;

            if ($consultaNombreUsuarioExistente) {
                
                if (mysql_num_rows($consultaNombreUsuarioExistente) > 0) {

                    $nombreUsuarioExistente = true;

                }
            }

            mysql_close($conexionBD);

            return $nombreUsuarioExistente;

        }

        /*
        ** Metodo encargado de comprobar si una cédula existe dentro de la base de datos
        */
        
        public function comprobarExistenciaCedula($cedula){

            $conexionBD = $this->getConexionInstance()->getConexion();

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
        
        public function comprobarExistenciaCorreoElectronico($correoElectronico){

            $conexionBD = $this->getConexionInstance()->getConexion();

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