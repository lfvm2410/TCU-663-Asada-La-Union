<?php

	/*
    // Clase controladora de las operaciones sobre los errores
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
	
			$this->vista->render($this,'400','Bad Request');

		}

		public function unauthorized(){ 
	
			$this->vista->render($this,'401','Unauthorized');

		}

		public function forbidden(){ 
	
			$this->vista->render($this,'403','Forbidden');

		}

		public function notFound(){ 
	
			$this->vista->render($this,'404','Not Found');

		}

		public function internalServerError(){ 
	
			$this->vista->render($this,'500','Internal Server Error');

		}

	}

?>