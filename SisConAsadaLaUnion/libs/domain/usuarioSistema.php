<?php
/*
** Clase dominio de usuarioSistema
*/

class usuarioSistema{

	private $idUsuarioSistema;
	private $nombre;
	private $tipoUsuario;
	private $fechaNacimiento;
	private $puesto;
	private $descripcionPuesto;
	private $contrasenia;

	public function __construct($idUsuarioSistema, $nombre, $tipoUsuario, $fechaNacimiento, $puesto, $descripcionPuesto, $contrasenia){

		$this->idUsuarioSistema = $idUsuarioSistema;
		$this->nombre = $nombre;
		$this->tipoUsuario = $tipoUsuario;
		$this->fechaNacimiento = $fechaNacimiento;
		$this->puesto = $puesto;
		$this->descripcionPuesto = $descripcionPuesto;
		$this->contrasenia = $contrasenia;
	}

	public function setIdUsuarioSistema($idUsuarioSistema){

		$this->idUsuarioSistema = $idUsuarioSistema;
	}

	public function setNombre($nombre){

		$this->nombre = $nombre;
	}

	public function setTipoUsuario($tipoUsuario){

		$this->tipoUsuario = $tipoUsuario;
	}

	public function setFechaNacimiento($fechaNacimiento){

		$this->fechaNacimiento = $fechaNacimiento;
	}

	public function setPuesto($puesto){

		$this->puesto = $puesto;
	}

	public function setDescripcionPuesto($descripcionPuesto){

		$this->descripcionPuesto = $descripcionPuesto;
	}

	public function setContrasenia($contrasenia){

		$this->contrasenia = $contrasenia;
	}

	public function getIdUsuarioSistema(){

		return $this->idUsuarioSistema;
	}

	public function getNombre(){

		return $this->nombre;
	}

	public function getTipoUsuario(){

		return $this->tipoUsuario;
	}

	public function getFechaNacimiento(){

		return $this->fechaNacimiento;
	}

	public function getPuesto(){

		return $this->puesto;
	}

	public function getDescripcionPuesto(){

		return $this->descripcionPuesto;
	}

	public function getContrasenia(){

		return $this->contrasenia;
	}
}

?>