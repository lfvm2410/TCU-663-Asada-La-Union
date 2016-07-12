<?php

class conexionBaseDatos{

private $host;
private $user; 
private $pass;
private $base;

function __construct($host,$user,$pass,$baseDatos){
		
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->base = $baseDatos;

	}

function setHost($host){

	$this->host = $host;

}

function setUser($user){

	$this->user = $user;

}

function setPass($pass){

	$this->pass = $pass;

}

function setBase($base){

	$this->base = $base;

}

function getHost(){

	return $this->host;
	
}

function getUser(){

	return $this->user;
	
}

function getPass(){

	return $this->pass;
	
}

function getBase(){

	return $this->base;
	
}

/*
// Metodo que realiza la conexion con la base de datos y la retorna
*/

function getConexion(){

    $conexion = mysql_connect($this->getHost(),$this->getUser(),$this->getPass()) or die("Problemas al conectar.");

    mysql_select_db($this->getBase(), $conexion) or die("Problemas al conectar con la base de datos.");

    return $conexion;
}

}

?>