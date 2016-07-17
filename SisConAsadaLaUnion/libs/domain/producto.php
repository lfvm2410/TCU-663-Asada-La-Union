<?php

/*
** Clase dominio de producto
*/

class producto{

	private $idProducto;
	private $nombre;
	private $descripcion;
	private $cantidad;
	private $fechaModificacionCantidad;

	public function __construct($idProducto, $nombre, $descripcion, $cantidad, $fechaModificacionCantidad){

		$this->idProducto = $idProducto;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->cantidad = $cantidad;
		$this->fechaModificacionCantidad = $fechaModificacionCantidad;
	}

	public function setIdProducto($idProducto){

		$this->idProducto = $idProducto;
	}

	public function setNombre($nombre){

		$this->nombre = $nombre;
	}

	public function setDescripcion($descripcion){

		$this->descripcion = $descripcion;
	}

	public function setCantidad($cantidad){

		$this->cantidad = $cantidad;
	}

	public function setFechaModificacionCantidad($fechaModificacionCantidad){

		$this->fechaModificacionCantidad = $fechaModificacionCantidad;
	}

	public function getIdProducto(){

		return $this->idProducto;
	}

	public function getNombre(){

		return $this->nombre;
	}

	public function getDescripcion(){

		return $this->descripcion;
	}

	public function getCantidad(){

		return $this->cantidad;
	}

	public function getFechaModificacionCantidad(){

		return $this->fechaModificacionCantidad;
	}
}

?>