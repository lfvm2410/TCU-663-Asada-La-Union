<?php

/*
** Clase dominio de tarifa
*/

class tarifa{
	
	private $idTarifa;
	private $nombre;
	private $descripcion;
	private $tipoServicio;
	private $monto;
	private $fechaModificacion;
	private $idAbonadoAsada;

	public function __construct($idTarifa, $nombre, $descripcion, $tipoServicio, $monto, $fechaModificacion, $idAbonadoAsada){

		$this->idTarifa = $idTarifa;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->tipoServicio = $tipoServicio;
		$this->monto = $monto;
		$this->fechaModificacion = $fechaModificacion;
		$this->idAbonadoAsada = $idAbonadoAsada;		
	}

	public function setIdTarifa($idTarifa){

		$this->idTarifa = $idTarifa;
	}

	public function setNombre($nombre){

		$this->nombre = $nombre;
	}

	public function setDescripcion($descripcion){

		$this->descripcion = $descripcion;
	}

	public function setTipoServicio($tipoServicio){

		$this->tipoServicio = $tipoServicio;
	}

	public function setMonto ($monto){

		$this->monto = $monto;
	}

	public function setFechaModificacion($fechaModificacion){

		$this->fechaModificacion = $fechaModificacion;
	}

	public function setIdAbonadoAsada($idAbonadoAsada){

		$this->idAbonadoAsada = $idAbonadoAsada;
	}

	public function getIdTarifa(){

		return $this->idTarifa;
	}

	public function getNombre(){

		return $this->nombre;
	}

	public function getDescripcion(){

		return $this->descripcion;
	}

	public function getTipoServicio(){

		return $this->tipoServicio;
	}

	public function getMonto(){

		return $this->monto;
	}

	public function getFechaModificacion(){

		return $this->fechaModificacion;
	}

	public function getIdAbonadoAsada(){

		return $this->idAbonadoAsada;
	}
}

?>