<?php

/*
** Clase dominio de LecturaMedidor
*/

class lecturaMedidor{

	private $idLectura;
	private $cantidadMetrosCubicos;
	private $fechaCreacion;
	private $fechaModificacion;
	private $idServicio;

	public function __construct($idLectura, $cantidadMetrosCubicos, $fechaCreacion, $fechaModificacion, $idServicio){

		$this->idLectura = $idLectura;
		$this->cantidadMetrosCubicos = $cantidadMetrosCubicos;
		$this->fechaCreacion = $fechaCreacion;
		$this->fechaModificacion = $fechaModificacion;
		$this->idServicio = $idServicio;
	}

	public function setIdLectura($idLectura){

		$this->idLectura = $idLectura;
	}

	public function setCantidadMetrosCubicos($cantidadMetrosCubicos){

		$this->cantidadMetrosCubicos = $cantidadMetrosCubicos;
	}

	public function setFechaCreacion($fechaCreacion){

		$this->fechaCreacion = $fechaCreacion;
	}

	public function setFechaModificacion($fechaModificacion){

		$this->fechaModificacion = $fechaModificacion;
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

	public function getFechaCreacion(){

		return $this->fechaCreacion;
	}

	public function getFechaModificacion(){

		return $this->fechaModificacion;
	}

	public function getIdServicio(){

		return $this->idServicio;
	}
}

?>