<?php 

/*
** Clase dominio de usuarioSistema
*/

class usuarioSistema
{

	private $idUsuarioSistema;
	private $nombre;
	private $tipoUsuario;
	private $fechaNacimiento;
	private $puesto;
	private $descripcionPuesto;
	private $contrasenia;

	function __construct($idUsuarioSistema, $nombre, $tipoUsuario, $fechaNacimiento, $puesto, $descripcionPuesto, $contrasenia){

		$this->idUsuarioSistema = $idUsuarioSistema;
		$this->nombre = $nombre;
		$this->tipoUsuario = $tipoUsuario;
		$this->fechaNacimiento = $fechaNacimiento;
		$this->puesto = $puesto;
		$this->descripcionPuesto = $descripcionPuesto;
		$this->contrasenia = $contrasenia;
	}

	function setIdUsuarioSistema($idUsuarioSistema){

		$this->idUsuarioSistema = $idUsuarioSistema;
	}

	function setNombre($nombre){

		$this->nombre = $nombre;
	}

	function setTipoUsuario($tipoUsuario){

		$this->tipoUsuario = $tipoUsuario;
	}

	function setFechaNacimiento($fechaNacimiento){

		$this->fechaNacimiento = $fechaNacimiento;
	}

	function setPuesto($puesto){

		$this->puesto = $puesto;
	}

	function setDescripcionPuesto($descripcionPuesto){

		$this->descripcionPuesto = $descripcionPuesto;
	}

	function setContrasenia($contrasenia){

		$this->contrasenia = $contrasenia;
	}

	function getIdUsuarioSistema(){

		return $this->idUsuarioSistema;
	}

	function getNombre(){

		return $this->nombre;
	}

	function getTipoUsuario(){

		return $this->tipoUsuario;
	}

	function getFechaNacimiento(){

		return $this->fechaNacimiento;
	}

	function getPuesto(){

		return $this->puesto;
	}

	function getDescripcionPuesto(){

		return $this->descripcionPuesto;
	}

	function getContrasenia(){

		return $this->contrasenia;
	}
}
?>