<?php

/*
** Clase dominio de detalleFactura
*/

class detalleFactura{
	
	private $idDetalle;
	private $desglosePago;
	private $monto;

	function __construct($idDetalle, $desglosePago, $monto){

		$this->idDetalle = $idDetalle;
		$this->desglosePago = $desglosePago;
		$this->monto = $monto;
	}

	function setIdDetalle($idDetalle){

		$this->idDetalle = $idDetalle;
	}

	function setDesglosePago($desglosePago){

		$this->desglosePago = $desglosePago;
	}

	function setMonto($monto){

		$this->monto = $monto;
	}
	
	function getIdDetalle(){

		return $this->idDetalle;
	}

	function getDesglosePago(){

		return $this->desglosePago;
	}
	function getMonto(){

		return $this->monto;
	}
}

?>