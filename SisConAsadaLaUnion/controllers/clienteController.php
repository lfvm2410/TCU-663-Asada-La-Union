<?php

include_once("../domain/cliente.php");
include_once("../models/clienteData.php");

/*
** Metodo principal
*/

function principal(){

    if (isset($_POST['metodo']) && !empty($_POST['metodo'])) {

           $_POST['metodo']();

       }
}

/*
** Metodo para registrar un cliente
*/

function registrarCliente(){
	
	$cedula = $_POST['cedulaCliente'];
    $nombre = $_POST['nombreCliente'];
    $apellidos = $_POST['apellidosCliente'];
    $correoElectronico = $_POST['correoCliente'];
    $direccion = $_POST['direccionCliente'];
    $numeroPlano = $_POST['numPlanoCliente']; 

    $cliente = new cliente(0,$cedula,$nombre,$apellidos,$correoElectronico,$direccion,
    	                   0,$numeroPlano);
    
    $dataCliente = new clienteData();
    
    $resultadoRegistroCliente = $dataCliente->registrarCliente($cliente);

    if ($resultadoRegistroCliente) {
         
        echo "true";

    }else{

        echo "false";

    }
}

principal();

?>