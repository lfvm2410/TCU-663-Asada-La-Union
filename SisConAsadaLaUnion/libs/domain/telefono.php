<?php
/*
** Clase dominio de telefono
*/

class telefono{
	
	private $idTelefono;
	private $tipo;
	private $numero;
	
	public function __construct($idTelefono,$tipo,$numero){

		$this->idTelefono = $idTelefono;
		$this->tipo = $tipo;
		$this->numero = $numero;
	}

	public function setIdTelefono($idTelefono){

     $this->idTelefono = $idTelefono;

	}

	public function setTipo($tipo){

     $this->tipo = $tipo;

	}

	public function setNumero($numero){

     $this->numero = $numero;

	}

	public function getIdTelefono(){
     
    return $this->idTelefono;

	}

	public function getTipo(){
     
    return $this->tipo;

	}

	public function getNumero(){
     
    return $this->numero;

	}
}

?>