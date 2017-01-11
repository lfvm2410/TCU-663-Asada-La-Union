<?php

/*
** Clase dominio de recuperar contraseña
*/

class recuperarContrasenia{

	private $idRecuperarContrasenia;
	private $token;
	private $creado;
	private $idUsuarioSistema;

	public function __construct($idRecuperarContrasenia, $token, $creado, $idUsuarioSistema){

		$this->idRecuperarContrasenia = $idRecuperarContrasenia;
		$this->token = $token;
		$this->creado = $creado;
		$this->idUsuarioSistema = $idUsuarioSistema;

	}

	public function setIdRecuperarContrasenia($idRecuperarContrasenia){

		$this->idRecuperarContrasenia = $idRecuperarContrasenia;
	}

	public function setToken($token){

		$this->token = $token;
	}

	public function setCreado($creado){

		$this->creado = $creado;
	}

	public function setIdUsuarioSistema($idUsuarioSistema){

		$this->idUsuarioSistema = $idUsuarioSistema;
	}

	public function getIdRecuperarContrasenia(){

		return $this->idRecuperarContrasenia;
	}

	public function getToken(){

		return $this->token;
	}

	public function getCreado(){

		return $this->creado;
	}

	public function getIdUsuarioSistema(){

		return $this->idUsuarioSistema;
	}

}

?>