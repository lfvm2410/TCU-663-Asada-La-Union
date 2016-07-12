<?php
/*
** Clase dominio de persona
*/

class persona
{
	private $idPersona;
	private $cedula;
	private $nombre;
	private $apellidos;
	private $correoElectronico;
	private $direccion;

	function __construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,
		                 $direccion){

		$this->idPersona = $idPersona;
		$this->cedula = $cedula;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->correoElectronico = $correoElectronico;
		$this->direccion = $direccion;
		
	}

	function setIdPersona($idPersona){

     $this->idPersona = $idPersona;

	}

	function setCedula($cedula){

     $this->cedula = $cedula;

	}
	function setNombre($nombre){

     $this->nombre = $nombre;

	}
	function setApellidos($apellidos){

     $this->apellidos = $apellidos;

	}
	function setCorreoElectronico($correoElectronico){

     $this->correoElectronico = $correoElectronico;

	}
	function setDireccion($direccion){

     $this->direccion = $direccion;

	}

	function getIdPersona(){
     
    return $this->idPersona;

	}

	function getCedula(){
     
    return $this->cedula;

	}

	function getNombre(){
     
    return $this->nombre;

	}

	function getApellidos(){
     
    return $this->apellidos;

	}

	function getCorreoElectronico(){
     
    return $this->correoElectronico;

	}

	function getDireccion(){
     
    return $this->direccion;

	}

}

?>