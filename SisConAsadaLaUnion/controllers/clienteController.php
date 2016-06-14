<?php

include_once("../domain/cliente.php");
include_once("../domain/telefono.php");
include_once("../models/clienteData.php");
include_once("../models/telefonoData.php");

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
    $telefono1 = new telefono(0,$_POST['tipoTel1Cliente'],$_POST['numTel1Cliente']);
    $telefono2 = new telefono(0,$_POST['tipoTel2Cliente'],$_POST['numTel2Cliente']);
    $direccion = $_POST['direccionCliente'];
    $numeroPlano = $_POST['numPlanoCliente']; 

    $cliente = new cliente(0,$cedula,$nombre,$apellidos,$correoElectronico,$direccion,
    	                   0,$numeroPlano);
    
    $dataCliente = new clienteData();

    $dataTelefono = new telefonoData();

    $dataTelefono->setTelefonoALista($telefono1);
    $dataTelefono->setTelefonoALista($telefono2);

    $listaTelefonos = $dataTelefono->getListaTelefonos(); 
    
    $resultadoRegistroCliente = $dataCliente->registrarCliente($cliente,$listaTelefonos);

    if ($resultadoRegistroCliente) {
         
        echo "true";

    }else{

        echo "false";

    }
}

principal();

?>