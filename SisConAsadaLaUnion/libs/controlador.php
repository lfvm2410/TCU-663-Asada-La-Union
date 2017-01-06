<?php

    /*
    // Clase base usada por todos los controladores, con el fin de implementar mvc
    */

	class controlador{

		public function __construct(){

			$this->vista = new vista();
			
			$this->cargarLogica();

		}

		private function cargarLogica(){

			$logica = str_replace("Controller", "Logic", get_class($this));
			
			$path = LOGIC.$logica.".php";

			if (file_exists($path)) {

				require_once $path;
				
				$this->logica = new $logica();
			
			}

		}

		/*
        //Método encargado de redirigir a página de error a solicitudes no autorizadas por la url
		*/

		public function redireccionActividadNoAutorizada(){

			header('Location: '.URL.'error/forbidden');

        	exit;
        	
		}

		/*
		// Metodo encargado de verificar si existe un usuario logueado en el sistema.
		// Ademas comprueba si el usuario aun existe en la base de datos y si tiene el perfil administrativo
		// Nota: Este metodo se llama en cada metodo de los controladores protegidos
		*/

		public function verificarSessionIniciada(){

	    	$estadoSession = false;

	    	session::init();

	    	$sessionActual = session::get("usuarioSistema");

	    	if($sessionActual != false){

	     		$usuarioSistemaActual = (object) $sessionActual;

	     		$personaData = new personaData();

	     		$usuarioSistema = $personaData->obtenerUsuarioSistemaPorNombreUsuario($usuarioSistemaActual->getNombreUsuario());

	     		if (!is_null($usuarioSistema)) {

	     			if (strcmp($usuarioSistema->getTipoUsuario(), "Administrador") == 0) {
	        
	         			$estadoSession = true;

	        		}
	     			
	     		}
	        	
	    	}

	    	return $estadoSession;

		}

	}
?>