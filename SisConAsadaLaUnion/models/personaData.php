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

            $resultadoRegistroUsuario = mysql_query("call SP_registrarUsuario($nombreUsuario,'$tipoUsuario','$fechaNacimiento','$puesto','$descripcionPuesto',$contrasenia,$idPersona)", $conexionBD);

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

        /*
        // Método encargado de obtener una persona por id
        */

        public function getPersonaPorId($idPersona, $tipoPersona){

            $idPersona = intval($idPersona);

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaPersona = mysql_query("call SP_obtenerPersonaPorId($idPersona,'$tipoPersona')",$conexionBD) or die("Error al tratar de obtener la información de la persona seleccionada en la base de datos");

            $personaSeleccionada = array();

            if ($consultaPersona) {
                
                if (mysql_num_rows($consultaPersona) > 0) {

                    while ($persona = mysql_fetch_array($consultaPersona)) {

                        if (strcmp($tipoPersona,"Administrador") == 0) {

                            $idPersona = $persona['id_Persona'];
                            $cedula = $persona['cedula_Persona'];
                            $nombre = $persona['nombre_Persona'];
                            $apellidos = $persona['apellidos_Persona'];
                            $fechaNacimientoTemp = date_create($persona['fechaNacimiento_UsuarioSistema']);                           
                            $fechaNacimiento = date_format($fechaNacimientoTemp,'d/m/Y');
                            $correoElectronico = $persona['correoElectronico_Persona'];
                            $nombreUsuario = $persona['nombre_UsuarioSistema'];
                            $contrasenia = $persona['contrasenia_UsuarioSistema'];
                            $direccion = $persona['direccion_Persona'];
                            $puesto = $persona['puesto_UsuarioSistema'];
                            $descripcionPuesto = $persona['descripcionPuesto_UsuarioSistema'];

                            $personaSeleccionada = array('idPersona'=>$idPersona, 'cedula'=>$cedula, 'nombre'=>$nombre, 
                                                           'apellidos'=>$apellidos, 'fechaNacimiento'=>$fechaNacimiento, 
                                                           'correoElectronico'=>$correoElectronico,
                                                           'nombreUsuario'=>$nombreUsuario, 'contrasenia'=>$contrasenia, 
                                                           'direccion'=>$direccion, 'puesto'=>$puesto, 
                                                           'descripcionPuesto'=>$descripcionPuesto);

                        }elseif (strcmp($tipoPersona,"Colaborador") == 0) {

                            $idPersona = $persona['id_Persona'];
                            $cedula = $persona['cedula_Persona'];
                            $nombre = $persona['nombre_Persona'];
                            $apellidos = $persona['apellidos_Persona'];
                            $fechaNacimientoTemp = date_create($persona['fechaNacimiento_UsuarioSistema']);                           
                            $fechaNacimiento = date_format($fechaNacimientoTemp,'d/m/Y');
                            $correoElectronico = $persona['correoElectronico_Persona'];
                            $direccion = $persona['direccion_Persona'];
                            $puesto = $persona['puesto_UsuarioSistema'];
                            $descripcionPuesto = $persona['descripcionPuesto_UsuarioSistema'];

                            $personaSeleccionada = array('idPersona'=>$idPersona, 'cedula'=>$cedula, 'nombre'=>$nombre, 
                                                           'apellidos'=>$apellidos, 'fechaNacimiento'=>$fechaNacimiento, 
                                                           'correoElectronico'=>$correoElectronico, 'direccion'=>$direccion, 
                                                           'puesto'=>$puesto, 'descripcionPuesto'=>$descripcionPuesto);
                            
                        }

                    }

                }

            }

            mysql_close($conexionBD);

            return $personaSeleccionada;

        }

        /*
        ** Metodo encargado de editar la información de una persona como usuario en la base de datos
        */
        
        public function editarPersona(usuarioSistema $usuario, $listaTelefonos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $idPersona = $usuario->getIdPersona();
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

            // Se edita una persona en la base de datos

            $resultadoEdicionPersona = mysql_query("call SP_editarPersonaPorId($idPersona,'$cedula','$nombre'
                    ,'$apellidos','$correoElectronico','$direccion')",$conexionBD);

            // Se edita un usuario en la base de datos

            $resultadoEdicionUsuario = mysql_query("call SP_editarUsuario($nombreUsuario,'$tipoUsuario','$fechaNacimiento','$puesto','$descripcionPuesto',$contrasenia,$idPersona)", $conexionBD);

            //Se eliminan los telefonos asociados a la persona para registrarlos nuevamente

            $resultadoEliminacionTelefonos = mysql_query("call SP_eliminarTelefono($idPersona)", $conexionBD);

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

            if ($resultadoEdicionPersona && $resultadoEdicionUsuario && $resultadoEliminacionTelefonos && $contadorTransaccionesTel == 0) {  // determina el commit y rollback dependiendo del estado de las transacciones
                   
                mysql_query("COMMIT",$conexionBD);

                $estadoTransaccion = true;
                     
            }else{
                  
                mysql_query("ROLLBACK",$conexionBD);

            }
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Método encargado de eliminar una persona en la base de datos
        */

        public function eliminarPersona($idPersona){

            $idPersona = intval($idPersona);

            $estadoTransaccion = false;

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            mysql_query("SET AUTOCOMMIT=0",$conexionBD);  

            mysql_query("START TRANSACTION",$conexionBD);

            // Se eliminan los telefonos de la persona en la base de datos

            $resultadoEliminarTelefonos = mysql_query("call SP_eliminarTelefono($idPersona)", $conexionBD); 

            //Se elimina el usuario en la base de datos
           
            $resultadoEliminarUsuario = mysql_query("call SP_eliminarUsuario($idPersona)", $conexionBD);

            // Se elimina la persona en la base de datos

            $resultadoEliminarPersona = mysql_query("call SP_eliminarPersona($idPersona)",$conexionBD);

            //Determina el commit y rollback dependiendo del estado de las transacciones
            
            if ($resultadoEliminarTelefonos && $resultadoEliminarUsuario && $resultadoEliminarPersona) {  

                mysql_query("COMMIT",$conexionBD);

                $estadoTransaccion = true;
                     
            }else{
                  
                mysql_query("ROLLBACK",$conexionBD);

            }
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Metodo encargado de obtener un usuario del sistema a partir de su nombre de usuario 
        */

        public function obtenerUsuarioSistemaPorNombreUsuario($nombreUsuario){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaUsuarioSistema = mysql_query("call SP_obtenerUsuarioSistemaPorNombreUsuario('$nombreUsuario')",$conexionBD) or die("Error al tratar de obtener el usuario del sistema en la base de datos");

            $usuarioSistema = null;

            if($consultaUsuarioSistema){
                
                if(mysql_num_rows($consultaUsuarioSistema) > 0){

                    while ($usuario = mysql_fetch_array($consultaUsuarioSistema)) {

                        $idPersona = $usuario['id_Persona'];
                        $cedula = $usuario['cedula_Persona'];
                        $nombre = $usuario['nombre_Persona'];
                        $apellidos = $usuario['apellidos_Persona'];
                        $correoElectronico = $usuario['correoElectronico_Persona'];
                        $direccion = $usuario['direccion_Persona'];
                        $idUsuarioSistema = $usuario['id_UsuarioSistema'];
                        $nombreUsuarioSistema = $usuario['nombre_UsuarioSistema'];
                        $tipoUsuario = $usuario['tipo_UsuarioSistema'];
                        $fechaNacimientoTemp = date_create($usuario['fechaNacimiento_UsuarioSistema']);                           
                        $fechaNacimiento = date_format($fechaNacimientoTemp,'d/m/Y');
                        $puesto = $usuario['puesto_UsuarioSistema'];
                        $descripcionPuesto = $usuario['descripcionPuesto_UsuarioSistema'];
                        $contrasenia = $usuario['contrasenia_UsuarioSistema'];
     
                        $usuarioSistema = new usuarioSistema($idPersona, $cedula, $nombre, $apellidos, $correoElectronico,
                                                             $direccion, $idUsuarioSistema, $nombreUsuarioSistema, $tipoUsuario, 
                                                             $fechaNacimiento, $puesto, $descripcionPuesto, $contrasenia, $contrasenia);

                    }

                }

            }

            mysql_close($conexionBD);

            return $usuarioSistema;

        }

        /*
        // Metodo encargado de obtener un usuario del sistema a partir de su correo electronico 
        */

        public function obtenerUsuarioSistemaPorCorreoElectronico($correoElectronico){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaUsuarioSistema = mysql_query("call SP_obtenerUsuarioSistemaPorCorreoElectronico('$correoElectronico')",$conexionBD) or die("Error al tratar de obtener el usuario del sistema en la base de datos");

            $usuarioSistema = null;

            if($consultaUsuarioSistema){
                
                if(mysql_num_rows($consultaUsuarioSistema) > 0){

                    while ($usuario = mysql_fetch_array($consultaUsuarioSistema)) {

                        $idPersona = $usuario['id_Persona'];
                        $cedula = $usuario['cedula_Persona'];
                        $nombre = $usuario['nombre_Persona'];
                        $apellidos = $usuario['apellidos_Persona'];
                        $correoElectronico = $usuario['correoElectronico_Persona'];
                        $direccion = $usuario['direccion_Persona'];
                        $idUsuarioSistema = $usuario['id_UsuarioSistema'];
                        $nombreUsuarioSistema = $usuario['nombre_UsuarioSistema'];
                        $tipoUsuario = $usuario['tipo_UsuarioSistema'];
                        $fechaNacimientoTemp = date_create($usuario['fechaNacimiento_UsuarioSistema']);                           
                        $fechaNacimiento = date_format($fechaNacimientoTemp,'d/m/Y');
                        $puesto = $usuario['puesto_UsuarioSistema'];
                        $descripcionPuesto = $usuario['descripcionPuesto_UsuarioSistema'];
                        $contrasenia = $usuario['contrasenia_UsuarioSistema'];
     
                        $usuarioSistema = new usuarioSistema($idPersona, $cedula, $nombre, $apellidos, $correoElectronico,
                                                             $direccion, $idUsuarioSistema, $nombreUsuarioSistema, $tipoUsuario, 
                                                             $fechaNacimiento, $puesto, $descripcionPuesto, $contrasenia, $contrasenia);

                    }

                }

            }

            mysql_close($conexionBD);

            return $usuarioSistema;

        }

        /*
        // Metodo encargado de obtener un usuario del sistema a partir de su token de recuperar contraseña 
        */

        public function obtenerUsuarioSistemaPorToken($token){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaUsuarioSistema = mysql_query("call SP_obtenerUsuarioSistemaPorToken('$token')",$conexionBD) or die("Error al tratar de obtener el usuario del sistema en la base de datos");

            $usuarioSistema = null;

            if($consultaUsuarioSistema){
                
                if(mysql_num_rows($consultaUsuarioSistema) > 0){

                    while ($usuario = mysql_fetch_array($consultaUsuarioSistema)) {

                        $idPersona = $usuario['id_Persona'];
                        $cedula = $usuario['cedula_Persona'];
                        $nombre = $usuario['nombre_Persona'];
                        $apellidos = $usuario['apellidos_Persona'];
                        $correoElectronico = $usuario['correoElectronico_Persona'];
                        $direccion = $usuario['direccion_Persona'];
                        $idUsuarioSistema = $usuario['id_UsuarioSistema'];
                        $nombreUsuarioSistema = $usuario['nombre_UsuarioSistema'];
                        $tipoUsuario = $usuario['tipo_UsuarioSistema'];
                        $fechaNacimientoTemp = date_create($usuario['fechaNacimiento_UsuarioSistema']);                           
                        $fechaNacimiento = date_format($fechaNacimientoTemp,'d/m/Y');
                        $puesto = $usuario['puesto_UsuarioSistema'];
                        $descripcionPuesto = $usuario['descripcionPuesto_UsuarioSistema'];
                        $contrasenia = $usuario['contrasenia_UsuarioSistema'];
     
                        $usuarioSistema = new usuarioSistema($idPersona, $cedula, $nombre, $apellidos, $correoElectronico,
                                                             $direccion, $idUsuarioSistema, $nombreUsuarioSistema, $tipoUsuario, 
                                                             $fechaNacimiento, $puesto, $descripcionPuesto, $contrasenia, $contrasenia);

                    }

                }

            }

            mysql_close($conexionBD);

            return $usuarioSistema;

        }

        /*
        // Metodo encargado de registrar un token en la base de datos para la recuperación de una contraseña
        */

        public function registrarTokenRecuperarContrasenia(recuperarContrasenia $recuperarContrasenia){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $token = $recuperarContrasenia->getToken();
            $idUsuarioSistema = intval($recuperarContrasenia->getIdUsuarioSistema());

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_registrarTokenRecuperarContrasenia('$token', $idUsuarioSistema)",$conexionBD)  or die("Error al tratar de registrar el permiso de acceso a la recuperación de contraseña en la base de datos");
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Metodo encargado de restablecer la contraseña de un usuario en la base de datos
        */

        public function restablecerContraseniaUsuario($idUsuarioSistema, $contrasenia){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_restablecerContraseniaUsuario($idUsuarioSistema, '$contrasenia')",$conexionBD)  or die("Error al tratar de establecer la nueva contraseña en la base de datos");
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Metodo encargado de obtener el personal de la asada
        */

        public function obtenerPersonalAsada(){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaPersonalAsada = mysql_query("call SP_obtenerPersonalAsada()",$conexionBD) or die("Error al tratar de obtener la lista del personal de la ASADA en la base de datos");

            $listaPersonalAsada = array();

            if($consultaPersonalAsada){
                
                if(mysql_num_rows($consultaPersonalAsada) > 0){

                    while ($persona = mysql_fetch_array($consultaPersonalAsada)) {

                        $idPersona = $persona['id_Persona'];
                        $nombreCompleto = $persona['nombreCompleto_Persona'];
                        $tipo = $persona['tipo_UsuarioSistema'];
                        $puesto = $persona['puesto_UsuarioSistema'];
                        $descripcionPuesto = $persona['descripcionPuesto_UsuarioSistema'];
                        $correoElectronico = $persona['correoElectronico_Persona'];

                        $listaPersonalAsada[] = array('idPersona' => $idPersona, 'nombreCompleto' => $nombreCompleto,
                                                      'tipo' => $tipo, 'puesto' => $puesto, 'descripcionPuesto' => $descripcionPuesto,
                                                      'correoElectronico' => $correoElectronico);
     
                    }

                }

            }

            mysql_close($conexionBD);

            return $listaPersonalAsada;

        }

        /*
        // Metodo encargado de obtener los correos electronicos de acuerdo al tipo de usuario
        */

        public function obtenerCorreoElectronicoPorTipoUsuario($tipoUsuario){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaCorreosElectronicos = mysql_query("call SP_obtenerCorreoElectronicoPorTipoUsuario('$tipoUsuario')",$conexionBD) or die("Error al tratar de obtener la lista de correos electrónicos del personal de la ASADA en la base de datos");

            $listaCorreosElectronicos = array();

            if($consultaCorreosElectronicos){
                
                if(mysql_num_rows($consultaCorreosElectronicos) > 0){

                    while ($persona = mysql_fetch_array($consultaCorreosElectronicos)) {

                        $correoElectronico = $persona['correoElectronico_Persona'];

                        $listaCorreosElectronicos[] = array('correoElectronico' => $correoElectronico);
     
                    }

                }

            }

            mysql_close($conexionBD);

            return $listaCorreosElectronicos;

        }

    }
    
?>