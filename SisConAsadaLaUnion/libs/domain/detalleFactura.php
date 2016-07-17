<?php

/*
** Clase dominio de detalleFactura
*/

class detalleFactura{
	
	private $idDetalle;
	private $desglosePago;
	private $monto;

	public function __construct($idDetalle, $desglosePago, $monto){

		$this->idDetalle = $idDetalle;
		$this->desglosePago = $desglosePago;
		$this->monto = $monto;
	}

	public function setIdDetalle($idDetalle){

		$this->idDetalle = $idDetalle;
	}

	public function setDesglosePago($desglosePago){

		$this->desglosePago = $desglosePago;
	}

	public function setMonto($monto){

		$this->monto = $monto;
	}
	
	public function getIdDetalle(){

		return $this->idDetalle;
	}

	public function getDesglosePago(){

		return $this->desglosePago;
	}
	
	public function getMonto(){

		return $this->monto;
	}
}

?>