<?php

/*
** Clase dominio de LecturaMedidor
*/

class lecturaMedidor
{
	private $idLectura;
	private $cantidadMetrosCubicos;
	private $fecha;
	private $idServicio;

	function __construct($idLectura, $cantidadMetrosCubicos, $fecha, $idServicio){

		$this->idLectura = $idLectura;
		$this->cantidadMetrosCubicos = $cantidadMetrosCubicos;
		$this->fecha = $fecha;
		$this->idServicio = $idServicio;
	}

	function setIdLectura($idLectura){

		$this->idLectura = $idLectura;
	}

	function setCantidadMetrosCubicos($cantidadMetrosCubicos){

		$this->cantidadMetrosCubicos = $cantidadMetrosCubicos;
	}

	function setFecha($fecha){

		$this->fecha = $fecha;
	}

	function setIdServicio($idServicio){

		$this->idServicio = $idServicio;
	}

	function getIdLectura(){

		return $this->idLectura;
	}

	function getCantidadMetrosCubicos(){

		return $this->cantidadMetrosCubicos;
	}

	function getFecha(){

		return $this->fecha;
	}

	function getIdServicio(){

		return $this->idServicio;
	}
}

?>