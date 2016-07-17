<?php
/*
** Clase dominio de facturaEncabezado
*/

class facturaEncabezado{

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

	public function __construct($idFacturaEncabezado, $codigo, $estado, $lecturaAnterior, $vencimiento, $mesAlCobro, $fechaDesde, $fechaHasta, $fechaPago, $tipoPago, $pagoTotal){

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

	public function setIdFacturaEncabezado($idFacturaEncabezado){

		$this->idFacturaEncabezado = $idFacturaEncabezado;
	}

	public function setCodigo($codigo){

		$this->codigo = $codigo;
	}

	public function setEstado($estado){

		$this->estado = $estado;
	}

	public function setLecturaAnterior($lecturaAnterior){

		$this->lecturaAnterior = $lecturaAnterior;
	}

	public function setVencimiento($vencimiento){

		$this->vencimiento = $vencimiento;
	}

	public function setMesAlCobro($mesAlCobro){

		$this->mesAlCobro = $mesAlCobro;
	}

	public function setFechaDesde($fechaDesde){

		$this->fechaDesde = $fechaDesde;
	}

	public function setFechaHasta($fechaHasta){

		$this->fechaHasta = $fechaHasta;
	}

	public function setFechaPago($fechaPago){

		$this->fechaPago = $fechaPago;
	}
	
	public function setTipoPago($tipoPago){

		$this->tipoPago = $tipoPago;
	}
	
	public function setPagoTotal($pagoTotal){

		$this->pagoTotal = $pagoTotal;
	}

	public function getIdFacturaEncabezado(){

		return $this->idFacturaEncabezado;
	}

	public function getCodigo(){

		return $this->codigo;
	}

	public function getEstado(){

		return $this->estado;
	}

	public function getLecturaAnterior(){

		return $this->lecturaAnterior;
	}

	public function getVencimiento(){

		return $this->vencimiento;
	}

	public function getMesAlCobro(){

		return $this->mesAlCobro;
	}

	public function getFechaDesde(){

		return $this->fechaDesde;
	}

	public function getFechaHasta(){

		return $this->fechaHasta;
	}

	public function getFechaPago(){

		return $this->fechaPago;
	}

	public function getTipoPago(){

		return $this->tipoPago;
	}

	public function getPagoTotal(){

		return $this->pagoTotal
	}

}

?>