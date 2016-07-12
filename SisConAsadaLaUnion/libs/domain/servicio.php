<?php

/*
** Clase dominio de servicio
*/

class servicio
{
	
	private $idServicio;
	private $numeroNIS;
	private $estado;
	private $fechaModificacion;

	function __construct($idServicio, $numeroNIS, $estado, $fechaModificacion){

		$this->idServicio = $idServicio;
		$this->numeroNIS = $numeroNIS;
		$this->estado = $estado;
		$this->fechaModificacion = $fechaModificacion;
	}

	function setIdServicio($idServicio){

		$this->idServicio = $idServicio;
	}

	function setNumeroNIS($numeroNIS){

		$this->numeroNIS = $numeroNIS;
	}

	function setEstado($estado){

		$this->estado = $estado;
	}

	function setFechaModificacion($fechaModificacion){

	 	$this->fechaModificacion = $fechaModificacion;
	}

	function getIdServicio(){

		return $this->idServicio;
	}

	function getNumeroNIS(){

		return $this->numeroNIS;
	}

	function getEstado(){

		return $this->estado;
	}

	function getFechaModificacion(){

		return $this->fechaModificacion;
	}
}

?>