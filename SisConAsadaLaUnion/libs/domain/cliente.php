<?php

/*
** Clase dominio de cliente
*/

class cliente extends persona{
	
	private $idCliente;
	private $numeroPlano;
	private $activo;

	public function __construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,
		                 $direccion,$idCliente,$numeroPlano,$activo)
	{
		parent::__construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,$direccion);

		$this->idCliente = $idCliente;
		$this->numeroPlano = $numeroPlano;
		$this->activo = $activo;
		
	}

	public function setIdCliente($idCliente){

     	$this->idCliente = $idCliente;

	}

	public function setNumeroPlano($numeroPlano){

     	$this->numeroPlano = $numeroPlano;

	}

	public function setActivo($activo){

     	$this->activo = $activo;

	}

	public function getIdCliente(){
     
    	return $this->idCliente;

	}

	public function getNumeroPlano(){
     
    	return $this->numeroPlano;

	}

	public function getActivo(){
     
    	return $this->activo;

	}

}

?>