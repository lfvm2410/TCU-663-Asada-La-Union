<?php

/*
** Clase dominio de AbonadoAsada
*/

class abonadoAsada
{
	private $idAbonadoAsada;
	private $rango;
	private $fechaModificacion;

	function __construct($idAbonadoAsada, $rango, $fechaModificacion){

		$this->idAbonadoAsada = $idAbonadoAsada;
		$this->rango = $rango;
		$this->fechaModificacion = $fechaModificacion;
	}

	function setIdAbonadoAsada($idAbonadoAsada){

		$this->idAbonadoAsada = $idAbonadoAsada;
	}

	function setRango($rango){

		$this->rango = $rango;
	}

	function setFechaModificacion($fechaModificacion){

	 	$this->fechaModificacion = $fechaModificacion;
	}

	function getIdAbonadoAsada(){

		return $this->idAbonadoAsada
	}

	function getRango(){

		return $this->rango;
	}

	function getFechaModificacion(){

		return $this->fechaModificacion;
	}
}

?>