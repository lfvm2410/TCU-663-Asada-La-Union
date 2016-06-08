<?php 

include_once("conexionBaseDatos.php");

/*
* Clase encargada de contener todas las operaciones de datos referentes al modulo de mantenimiento de cliente
*/

class clienteData{
		
    private $baseDatos;

	function __construct(){
	
		$this->baseDatos = new conexionBaseDatos("mysql.hostinger.es","u932158522_ucr22","tcu663AsadaLaUnion","u932158522_asada");
	}


    /*
    ** Metodo encargado de registrar un cliente en la base de datos
    */
    
    function registrarCliente($cliente){

    $conexionBD = $this->baseDatos->getConexion();

    mysql_set_charset('utf8');

    $cedula = $cliente->getCedula();
    $nombre = $cliente->getNombre();
    $apellidos = $cliente->getApellidos();
    $correoElectronico = $cliente->getCorreoElectronico();
    $direccion = $cliente->getDireccion();
    $numeroPlano = $cliente->getNumeroPlano(); 

    $estadoTransaccion = false;

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

    if ($resultadoRegistroPersona && $consultaPersona && $resultadoRegistroCliente) {  // determina el commit y rollback dependiendo del estado de las transacciones
           
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