<?php
/*
** Clase dominio de usuarioSistema
*/

class usuarioSistema extends persona{

	private $idUsuarioSistema;
	private $nombreUsuarioSistema;
	private $tipoUsuario;
	private $fechaNacimiento;
	private $puesto;
	private $descripcionPuesto;
	private $contrasenia;
	private $confirmarContrasenia;

	public function __construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,
		                 $direccion,$idUsuarioSistema, $nombreUsuarioSistema, $tipoUsuario, $fechaNacimiento, 
		                 $puesto, $descripcionPuesto, $contrasenia, $confirmarContrasenia){

		parent::__construct($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,$direccion);

		$this->idUsuarioSistema = $idUsuarioSistema;
		$this->nombreUsuarioSistema = $nombreUsuarioSistema;
		$this->tipoUsuario = $tipoUsuario;
		$this->fechaNacimiento = $fechaNacimiento;
		$this->puesto = $puesto;
		$this->descripcionPuesto = $descripcionPuesto;
		$this->contrasenia = $contrasenia;
		$this->confirmarContrasenia = $confirmarContrasenia;
	}

	public function setIdUsuarioSistema($idUsuarioSistema){

		$this->idUsuarioSistema = $idUsuarioSistema;
	}

	public function setNombreUsuario($nombreUsuarioSistema){

		$this->nombreUsuarioSistema = $nombreUsuarioSistema;
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

	public function setConfirmarContrasenia($confirmarContrasenia){

		$this->confirmarContrasenia = $confirmarContrasenia;
	}

	public function getIdUsuarioSistema(){

		return $this->idUsuarioSistema;
	}

	public function getNombreUsuario(){

		return $this->nombreUsuarioSistema;
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

	public function getConfirmarContrasenia(){

		return $this->confirmarContrasenia;
	}
}

?>