<?php 

include_once("conexionBaseDatos.php");
include_once("../domain/telefono.php");

/*
* Clase encargada de contener todas las operaciones de datos referentes al modulo de mantenimiento de cliente
*/

class clienteData{
		
    private $baseDatos;

	function __construct(){
	
		$this->baseDatos = new conexionBaseDatos("localhost","root","1234","BDASADA_LaUnion");
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

}

?>