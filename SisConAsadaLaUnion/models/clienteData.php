<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase cliente
    */

    class clienteData extends modelo{

    	public function __construct(){

    		parent::__construct();
    	}


        /*
        ** Metodo encargado de registrar un cliente en la base de datos
        */
        
        public function registrarCliente(cliente $cliente, $listaTelefonos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $cedula = $cliente->getCedula();
            $nombre = $cliente->getNombre();
            $apellidos = $cliente->getApellidos();
            $correoElectronico = $cliente->getCorreoElectronico();
            $direccion = $cliente->getDireccion();
            $numeroPlano = $cliente->getNumeroPlano(); 
            $activo = $cliente->getActivo();

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

            // Se registra un cliente en la base de datos

            $resultadoRegistroCliente = mysql_query("call SP_registrarCliente($numeroPlano,'$activo',$idPersona)", $conexionBD);

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

            if ($resultadoRegistroPersona && $consultaPersona && $resultadoRegistroCliente && $contadorTransaccionesTel == 0) {  // determina el commit y rollback dependiendo del estado de las transacciones
                   
                mysql_query("COMMIT",$conexionBD);

                $estadoTransaccion = true;
                     
                }else{
                  
                mysql_query("ROLLBACK",$conexionBD);

                }
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        ** Metodo encargado de comprobar si un número de plano existe dentro de la base de datos
        */
        
        public function comprobarExistenciaNumeroPlano($numeroPlano){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaPlanoExistente = mysql_query("call SP_comprobarExistenciaNumeroPlano('$numeroPlano')",$conexionBD) or die("Error al tratar de verificar el número de plano ingresado en la base de datos");

            $planoExistente = false;

            if ($consultaPlanoExistente) {
                
                if (mysql_num_rows($consultaPlanoExistente) > 0) {

                    $planoExistente = true;

                }
            }

            mysql_close($conexionBD);

            return $planoExistente;

        }

        /*
        // Método encargado de obtener un cliente por su cédula
        */

        public function getClientePorCedula($cedulaCliente){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaCliente = mysql_query("call SP_obtenerClientePorCedula('$cedulaCliente')",$conexionBD);

            $cliente = array();

            if($consultaCliente != NULL){

                $cli = mysql_fetch_array($consultaCliente);
                
                if(mysql_num_rows($consultaCliente) > 0){

                    $cedula = $cli['cedula_Persona'];
                    $nombre = $cli['nombre_Persona'];
                    $apellidos = $cli['apellidos_Persona'];
                    $correo = $cli['correoElectronico_Persona'];
                    $direccion = $cli['direccion_Persona'];
                    $numeroPlano = $cli['numeroPlano_Cliente'];

                    $cliente = array('cedula' => $cedula, 'nombre' => $nombre, 'apellidos' => $apellidos, 'correo' => $correo, 
                                     'direccion' => $direccion, 'numeroPlano' => $numeroPlano);

                }
            }

            mysql_close($conexionBD);
            
            return $cliente;
        }

        /*
        // Método encargado de obtener los clientes a mostrar
        */

        public function obtenerClientes($clienteActual,$limiteClientes,$clientesActivos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaClientes = mysql_query("call SP_obtenerClientes($clienteActual,$limiteClientes,'$clientesActivos')",$conexionBD) or die("Error al tratar de obtener los clientes en la base de datos");

            $listaClientes = array();

            if ($consultaClientes) {
                
                if (mysql_num_rows($consultaClientes) > 0) {

                    while ($cli = mysql_fetch_array($consultaClientes)) {

                    $cedula = $cli['cedula_Persona'];
                    $nombre = $cli['nombre_Persona'];
                    $apellidos = $cli['apellidos_Persona'];
                    $correoElectronico = $cli['correoElectronico_Persona'];
                    $direccion = $cli['direccion_Persona'];
                    $numeroPlano = $cli['numeroPlano_Cliente'];
            
                    $listaClientes[] = array('cedula'=>$cedula, 'nombre'=>$nombre, 'apellidos'=>$apellidos, 
                        'correoElectronico'=>$correoElectronico,'direccion'=>$direccion, 'numeroPlano'=>$numeroPlano);

                    }

                }

            }

            mysql_close($conexionBD);

            return $listaClientes;

        }

        /*
        // Método encargado de obtener el total de clientes registrados en la base de datos
        */

        public function obtenerTotalClientes($clientesActivos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaTotalClientes = mysql_query("call SP_obtenerTotalClientes('$clientesActivos')",$conexionBD) or die("Error al tratar de obtener la cantidad total de clientes en la base de datos");

            $totalClientes = 0;

            if ($consultaTotalClientes) {
                
                if (mysql_num_rows($consultaTotalClientes) > 0) {

                    $cliTotal = mysql_fetch_array($consultaTotalClientes,MYSQL_NUM);

                    $totalClientes = $cliTotal[0];

                }

            }

            mysql_close($conexionBD);

            return $totalClientes;
        }

        /*
        // Método encargado de obtener los clientes a mostrar de acuerdo a la cédula o el nombre
        */

        public function obtenerClientesCedulaNombre($cedula,$nombre,$clienteActual,$limiteClientes,$clientesActivos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaClientesCedulaNombre = mysql_query("call SP_obtenerClientesCedulaNombre('$cedula','$nombre',$clienteActual,$limiteClientes,'$clientesActivos')",$conexionBD) or die("Error al tratar de obtener los clientes en la base de datos");

            $listaClientes = array();

            if ($consultaClientesCedulaNombre) {
                
                if (mysql_num_rows($consultaClientesCedulaNombre) > 0) {

                    while ($cli = mysql_fetch_array($consultaClientesCedulaNombre)) {

                    $cedula = $cli['cedula_Persona'];
                    $nombre = $cli['nombre_Persona'];
                    $apellidos = $cli['apellidos_Persona'];
                    $correoElectronico = $cli['correoElectronico_Persona'];
                    $direccion = $cli['direccion_Persona'];
                    $numeroPlano = $cli['numeroPlano_Cliente'];
            
                    $listaClientes[] = array('cedula'=>$cedula, 'nombre'=>$nombre, 'apellidos'=>$apellidos, 
                        'correoElectronico'=>$correoElectronico,'direccion'=>$direccion, 'numeroPlano'=>$numeroPlano);

                    }

                }

            }

            mysql_close($conexionBD);

            return $listaClientes;

        }

        /*
        // Método encargado de obtener el total de clientes de acuerdo a su cédula o nombre registrados en la base de datos
        */

        public function obtenerTotalClientesCedulaNombre($cedula,$nombre,$clientesActivos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaTotalClientesCedulaNombre = mysql_query("call SP_obtenerTotalClientesCedulaNombre('$cedula','$nombre','$clientesActivos')",$conexionBD) or die("Error al tratar de obtener la cantidad total de clientes en la base de datos");

            $totalClientesCedulaNombre = 0;

            if ($consultaTotalClientesCedulaNombre) {
                
                if (mysql_num_rows($consultaTotalClientesCedulaNombre) > 0) {

                    $cliTotal = mysql_fetch_array($consultaTotalClientesCedulaNombre,MYSQL_NUM);

                    $totalClientesCedulaNombre = $cliTotal[0];

                }

            }

            mysql_close($conexionBD);

            return $totalClientesCedulaNombre;
        }

        /*
        // Método encargado de activar o desactivar un cliente en la base de datos
        */

        public function actualizarActivoCliente($cedulaCliente,$activoCliente){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $estadoTransaccion = false;

            $activarAnularCliente = mysql_query("call SP_setActivoCliente('$cedulaCliente','$activoCliente')",$conexionBD) or die("Error al tratar de activar o anular el cliente en la base de datos");
            
            if ($activarAnularCliente) {
                
                $estadoTransaccion = true;

            }

            mysql_close($conexionBD);

            return $estadoTransaccion;
        }

        /*
        ** Metodo encargado de editar un cliente en la base de datos
        */
        
        public function editarCliente($cedulaActual, cliente $cliente, $listaTelefonos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $cedulaNueva = $cliente->getCedula();
            $nombre = $cliente->getNombre();
            $apellidos = $cliente->getApellidos();
            $correoElectronico = $cliente->getCorreoElectronico();
            $direccion = $cliente->getDireccion();
            $numeroPlano = $cliente->getNumeroPlano(); 
            $activo = $cliente->getActivo();

            $estadoTransaccion = false;
            $contadorTransaccionesTel = 0;

            mysql_query("SET AUTOCOMMIT=0",$conexionBD);  

            mysql_query("START TRANSACTION",$conexionBD);

            // Se edita una persona en la base de datos

            $resultadoEdicionPersona = mysql_query("call SP_editarPersona('$cedulaActual','$cedulaNueva','$nombre'
                    ,'$apellidos','$correoElectronico','$direccion',@idPersona)",$conexionBD);

            // Se toma la persona que fue editada

            $consultaPersona = mysql_query("select @idPersona",$conexionBD);
            
            $retornoEdicionPersona = mysql_fetch_array($consultaPersona);

            // Se captura la persona que se ha consultado
            
            $idPersona = $retornoEdicionPersona['@idPersona'];

            // Se edita el cliente en la base de datos

            $resultadoEdicionCliente = mysql_query("call SP_editarCliente($numeroPlano,$idPersona)", $conexionBD);

            //Se eliminan los telefonos asociados a la persona para registrarlos nuevamente

            $resultadoEliminacionTelefonos = mysql_query("call SP_eliminarTelefono($idPersona)", $conexionBD);

            // Se recorre la lista de telefonos para ingresarlos en la base de datos

            foreach ($listaTelefonos as $telefono) { 

                 $tipo = $telefono->getTipo();

                 $numero = $telefono->getNumero();

                 // Se registra cada telefono perteneciente a la persona

                 $registroTelefono = mysql_query("call SP_registrarTelefono('$tipo','$numero',$idPersona)", $conexionBD);   

                 if (!$registroTelefono) {

                    // Contador para controlar que cada uno de las inserciones se esta efectuando o no

                    $contadorTransaccionesTel++;
                                     
                  }
     
            }        

            if ($resultadoEdicionPersona && $consultaPersona && $resultadoEdicionCliente && $resultadoEliminacionTelefonos && $contadorTransaccionesTel == 0) {  // determina el commit y rollback dependiendo del estado de las transacciones
                   
                mysql_query("COMMIT",$conexionBD);

                $estadoTransaccion = true;
                     
                }else{
                  
                mysql_query("ROLLBACK",$conexionBD);

                }
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

    }
    
?>