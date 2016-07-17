<?php

	/*
    // Clase para controladora de las operaciones sobre los errores
	*/

	class errorController extends controlador{

		public function __construct(){

			parent::__construct();
		}

		 /*
         // Metodos para mostrar las vistas asociadas a este controlador
         */

		public function index(){ 
	
		 	//Temporal, mientras se define la vista principal del controlador

      		header('Location: '.URL);

      		exit;

		}

		public function badRequest(){ 
	
			$this->vista->render($this,'400');

		}

		public function unauthorized(){ 
	
			$this->vista->render($this,'401');

		}

		public function forbidden(){ 
	
			$this->vista->render($this,'403');

		}

		public function notFound(){ 
	
			$this->vista->render($this,'404');

		}

		public function internalServerError(){ 
	
			$this->vista->render($this,'500');

		}

	}

?>