<?php

/*
** Clase dominio de servicio
*/

class servicio{
	
	private $idServicio;
	private $numeroNIS;
	private $estado;
	private $fechaModificacion;
	private $tipoServicio;

	public function __construct($idServicio, $numeroNIS, $estado, $tipoServicio,$fechaModificacion){

		$this->idServicio = $idServicio;
		$this->numeroNIS = $numeroNIS;
		$this->estado = $estado;
		$this->tipoServicio = $tipoServicio;
		$this->fechaModificacion = $fechaModificacion;
	}

	public function setIdServicio($idServicio){

		$this->idServicio = $idServicio;
	}

	public function setNumeroNIS($numeroNIS){

		$this->numeroNIS = $numeroNIS;
	}

	public function setEstado($estado){

		$this->estado = $estado;
	}

	public function setTipoServicio($tipoServicio){

		$this->tipoServicio = $tipoServicio;
	}

	public function setFechaModificacion($fechaModificacion){

	 	$this->fechaModificacion = $fechaModificacion;
	}

	public function getIdServicio(){

		return $this->idServicio;
	}

	public function getNumeroNIS(){

		return $this->numeroNIS;
	}

	public function getEstado(){

		return $this->estado;
	}

	public function getTipoServicio(){

		return $this->tipoServicio;
	}

	public function getFechaModificacion(){

		return $this->fechaModificacion;
	}
}

?>