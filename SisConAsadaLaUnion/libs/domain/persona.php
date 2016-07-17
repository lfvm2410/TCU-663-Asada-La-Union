<?php
/*
** Clase dominio de persona
*/

class persona{

	private $idPersona;
	private $cedula;
	private $nombre;
	private $apellidos;
	private $correoElectronico;
	private $direccion;

	public function __construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,
		                 $direccion){

		$this->idPersona = $idPersona;
		$this->cedula = $cedula;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->correoElectronico = $correoElectronico;
		$this->direccion = $direccion;
		
	}

	public function setIdPersona($idPersona){

     $this->idPersona = $idPersona;

	}

	public function setCedula($cedula){

     $this->cedula = $cedula;

	}

	public function setNombre($nombre){

     $this->nombre = $nombre;

	}

	public function setApellidos($apellidos){

     $this->apellidos = $apellidos;

	}

	public function setCorreoElectronico($correoElectronico){

     $this->correoElectronico = $correoElectronico;

	}
	
	public function setDireccion($direccion){

     $this->direccion = $direccion;

	}

	public function getIdPersona(){
     
    return $this->idPersona;

	}

	public function getCedula(){
     
    return $this->cedula;

	}

	public function getNombre(){
     
    return $this->nombre;

	}

	public function getApellidos(){
     
    return $this->apellidos;

	}

	public function getCorreoElectronico(){
     
    return $this->correoElectronico;

	}

	public function getDireccion(){
     
    return $this->direccion;

	}

}

?>