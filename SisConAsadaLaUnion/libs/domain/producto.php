<?php

/*
** Clase dominio de producto
*/

class producto
{

	private $idProducto;
	private $nombre;
	private $descripcion;
	private $cantidad;
	private $fechaModificacionCantidad;

	function __construct($idProducto, $nombre, $descripcion, $cantidad, $fechaModificacionCantidad){

		$this->idProducto = $idProducto;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->cantidad = $cantidad;
		$this->fechaModificacionCantidad = $fechaModificacionCantidad;
	}

	function setIdProducto($idProducto){

		$this->idProducto = $idProducto;
	}

	function setNombre($nombre){

		$this->nombre = $nombre;
	}

	function setDescripcion($descripcion){

		$this->descripcion = $descripcion;
	}

	function setCantidad($cantidad){

		$this->cantidad = $cantidad;
	}

	function setFechaModificacionCantidad($fechaModificacionCantidad){

		$this->fechaModificacionCantidad = $fechaModificacionCantidad;
	}

	function getIdProducto(){

		return $this->idProducto;
	}

	function getNombre(){

		return $this->nombre;
	}

	function getDescripcion(){

		return $this->descripcion;
	}

	function getCantidad(){

		return $this->cantidad;
	}

	function getFechaModificacionCantidad(){

		return $this->fechaModificacionCantidad;
	}
}
?>