<?php
/*
** Clase dominio de telefono
*/

class telefono
{
	private $idTelefono;
	private $tipo;
	private $numero;
	
	function __construct($idTelefono,$tipo,$numero){

		$this->idTelefono = $idTelefono;
		$this->tipo = $tipo;
		$this->numero = $numero;
	}

	function setIdTelefono($idTelefono){

     $this->idTelefono = $idTelefono;

	}

	function setTipo($tipo){

     $this->tipo = $tipo;

	}
	function setNumero($numero){

     $this->numero = $numero;

	}

	function getIdTelefono(){
     
    return $this->idTelefono;

	}

	function getTipo(){
     
    return $this->tipo;

	}

	function getNumero(){
     
    return $this->numero;

	}
}

?>