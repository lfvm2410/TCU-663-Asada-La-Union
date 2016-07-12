<?php
/*
** Clase dominio de facturaEncabezado
*/

class facturaEncabezado
{
	private $idFacturaEncabezado;
	private $codigo;
	private $estado;
	private $lecturaAnterior;
	private $vencimiento;
	private $mesAlCobro;
	private $fechaDesde;
	private $fechaHasta;
	private $fechaPago;
	private $tipoPago;
	private $pagoTotal;

	function __construct($idFacturaEncabezado, $codigo, $estado, $lecturaAnterior, $vencimiento, $mesAlCobro, $fechaDesde, $fechaHasta, $fechaPago, $tipoPago, $pagoTotal){

		$this->idFacturaEncabezado = $idFacturaEncabezado;
		$this->codigo = $codigo;
		$this->estado = $estado;
		$this->lecturaAnterior = $lecturaAnterior
		$this->vencimiento = $vencimiento;
		$this->mesAlCobro = $mesAlCobro;
		$this->fechaDesde = $fechaDesde;
		$this->fechaHasta = $fechaHasta;
		$this->fechaPago = $fechaPago;
		$this->tipoPago = $tipoPago;
		$this->pagoTotal = $pagoTotal;
	}

	function setIdFacturaEncabezado($idFacturaEncabezado){

		$this->idFacturaEncabezado = $idFacturaEncabezado;
	}

	function setCodigo($codigo){

		$this->codigo = $codigo;
	}
	function setEstado($estado){

		$this->estado = $estado;
	}

	function setLecturaAnterior($lecturaAnterior){

		$this->lecturaAnterior = $lecturaAnterior;
	}

	function setVencimiento($vencimiento){

		$this->vencimiento = $vencimiento;
	}

	function setMesAlCobro($mesAlCobro){

		$this->mesAlCobro = $mesAlCobro;
	}

	function setFechaDesde($fechaDesde){

		$this->fechaDesde = $fechaDesde;
	}

	function setFechaHasta($fechaHasta){

		$this->fechaHasta = $fechaHasta;
	}

	function setFechaPago($fechaPago){

		$this->fechaPago = $fechaPago;
	}
	
	function setTipoPago($tipoPago){

		$this->tipoPago = $tipoPago;
	}
	
	function setPagoTotal($pagoTotal){

		$this->pagoTotal = $pagoTotal;
	}

	function getIdFacturaEncabezado(){

		return $this->idFacturaEncabezado;
	}

	function getCodigo(){

		return $this->codigo;
	}

	function getEstado(){

		return $this->estado;
	}

	function getLecturaAnterior(){

		return $this->lecturaAnterior;
	}

	function getVencimiento(){

		return $this->vencimiento;
	}

	function getMesAlCobro(){

		return $this->mesAlCobro;
	}

	function getFechaDesde(){

		return $this->fechaDesde;
	}

	function getFechaHasta(){

		return $this->fechaHasta;
	}

	function getFechaPago(){

		return $this->fechaPago;
	}

	function getTipoPago(){

		return $this->tipoPago;
	}

	function getPagoTotal(){

		return $this->pagoTotal
	}

}

?>