<?php

/*
** Clase dominio de LecturaMedidor
*/

class lecturaMedidor{

	private $idLectura;
	private $cantidadMetrosCubicos;
	private $fecha;
	private $idServicio;

	public function __construct($idLectura, $cantidadMetrosCubicos, $fecha, $idServicio){

		$this->idLectura = $idLectura;
		$this->cantidadMetrosCubicos = $cantidadMetrosCubicos;
		$this->fecha = $fecha;
		$this->idServicio = $idServicio;
	}

	public function setIdLectura($idLectura){

		$this->idLectura = $idLectura;
	}

	public function setCantidadMetrosCubicos($cantidadMetrosCubicos){

		$this->cantidadMetrosCubicos = $cantidadMetrosCubicos;
	}

	public function setFecha($fecha){

		$this->fecha = $fecha;
	}

	public function setIdServicio($idServicio){

		$this->idServicio = $idServicio;
	}

	public function getIdLectura(){

		return $this->idLectura;
	}

	public function getCantidadMetrosCubicos(){

		return $this->cantidadMetrosCubicos;
	}

	public function getFecha(){

		return $this->fecha;
	}

	public function getIdServicio(){

		return $this->idServicio;
	}
}

?>