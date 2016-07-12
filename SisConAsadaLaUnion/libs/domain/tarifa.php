<?php

/*
** Clase dominio de tarifa
*/

class tarifa
{
	private $idTarifa;
	private $nombre;
	private $tipoServicio;
	private $monto;
	private $fechaModificacion;
	private $idAbonadoAsada;

	function __construct($idTarifa, $nombre, $tipoServicio, $monto, $fechaModificacion, $idAbonadoAsada){

		$this->idTarifa = $idTarifa;
		$this->nombre = $nombre;
		$this->tipoServicio = $tipoServicio;
		$this->monto = $monto;
		$this->fechaModificacion = $fechaModificacion;
		$this->idAbonadoAsada = $idAbonadoAsada;		
	}

	function setIdTarifa($idTarifa){

		$this->idTarifa = $idTarifa;
	}

	function setNombre($nombre){

		$this->nombre = $nombre;
	}

	function setTipoServicio($tipoServicio){

		$this->tipoServicio = $tipoServicio;
	}

	function setMonto ($monto){

		$this->monto = $monto;
	}

	function setFechaModificacion($fechaModificacion){

		$this->fechaModificacion = $fechaModificacion;
	}

	function setIdAbonadoAsada($idAbonadoAsada){

		$this->idAbonadoAsada = $idAbonadoAsada;
	}

	function getIdTarifa(){

		return $this->idTarifa;
	}

	function getNombre(){

		return $this->nombre;
	}

	function getTipoServicio(){

		return $this->tipoServicio;
	}

	function getMonto(){

		return $this->monto;
	}

	function getFechaModificacion(){

		return $this->fechaModificacion;
	}

	function getIdAbonadoAsada(){

		return $this->idAbonadoAsada;
	}
}

?>