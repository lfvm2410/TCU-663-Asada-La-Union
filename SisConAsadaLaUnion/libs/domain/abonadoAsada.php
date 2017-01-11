<?php

/*
** Clase dominio de AbonadoAsada
*/

class abonadoAsada{
	
	private $idAbonadoAsada;
	private $rango;
	private $fechaModificacion;

	public function __construct($idAbonadoAsada, $rango, $fechaModificacion){

		$this->idAbonadoAsada = $idAbonadoAsada;
		$this->rango = $rango;
		$this->fechaModificacion = $fechaModificacion;
	}

	public function setIdAbonadoAsada($idAbonadoAsada){

		$this->idAbonadoAsada = $idAbonadoAsada;
	}

	public function setRango($rango){

		$this->rango = $rango;
	}

	public function setFechaModificacion($fechaModificacion){

	 	$this->fechaModificacion = $fechaModificacion;
	}

	public function getIdAbonadoAsada(){

		return $this->idAbonadoAsada;
	}

	public function getRango(){

		return $this->rango;
	}

	public function getFechaModificacion(){

		return $this->fechaModificacion;
	}
}

?>