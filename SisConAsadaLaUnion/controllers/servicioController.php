<?php 

include_once("../models/clienteData.php");

$cedula = '702150004';



	$dataCliente = new clienteData();

	print_r($dataCliente->getClientePorCédula($cedula));



?>