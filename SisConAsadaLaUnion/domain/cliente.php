<?php 

/*
** Clase dominio de cliente
*/

include_once("persona.php");

class cliente extends persona
{
	private $idCliente;
	private $numeroPlano;

	function __construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,
		                 $direccion,$idCliente,$numeroPlano)
	{
		parent::__construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,$direccion);

		$this->idCliente = $idCliente;
		$this->numeroPlano = $numeroPlano;
		
	}

	function setIdCliente($idCliente){

     $this->idCliente = $idCliente;

	}

	function setNumeroPlano($numeroPlano){

     $this->numeroPlano = $numeroPlano;

	}

	function getIdCliente(){
     
    return $this->idCliente;

	}

	function getNumeroPlano(){
     
    return $this->numeroPlano;

	}

}

?>