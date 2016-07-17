<?php

/*
** Clase dominio de cliente
*/

class cliente extends persona{
	
	private $idCliente;
	private $numeroPlano;

	public function __construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,
		                 $direccion,$idCliente,$numeroPlano)
	{
		parent::__construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,$direccion);

		$this->idCliente = $idCliente;
		$this->numeroPlano = $numeroPlano;
		
	}

	public function setIdCliente($idCliente){

     $this->idCliente = $idCliente;

	}

	public function setNumeroPlano($numeroPlano){

     $this->numeroPlano = $numeroPlano;

	}

	public function getIdCliente(){
     
    return $this->idCliente;

	}

	public function getNumeroPlano(){
     
    return $this->numeroPlano;

	}

}

?>