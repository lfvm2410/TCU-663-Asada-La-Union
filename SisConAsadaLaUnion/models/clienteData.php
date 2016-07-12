<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes a la clase cliente
    */

    class clienteData extends modelo{

    	function __construct(){

    		parent::__construct();
    	}


        /*
        ** Metodo encargado de registrar un cliente en la base de datos
        */
        
        function registrarCliente($cliente, $listaTelefonos){

        $conexionBD = $this->baseDatos->getConexion();

        mysql_set_charset('utf8');

        $cedula = $cliente->getCedula();
        $nombre = $cliente->getNombre();
        $apellidos = $cliente->getApellidos();
        $correoElectronico = $cliente->getCorreoElectronico();
        $direccion = $cliente->getDireccion();
        $numeroPlano = $cliente->getNumeroPlano(); 

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

        $resultadoRegistroCliente = mysql_query("call SP_registrarCliente('$numeroPlano','$idPersona')", $conexionBD);

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
        
        function comprobarExistenciaNumeroPlano($numeroPlano){

        $conexionBD = $this->baseDatos->getConexion();

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

    }
    
?>