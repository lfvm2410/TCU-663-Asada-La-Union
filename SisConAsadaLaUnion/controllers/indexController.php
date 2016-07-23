<?php

    /*
    // Clase para controladora de las operaciones sobre la página principal del sitio web
    */

	class indexController extends controlador{

		public function __construct(){

			parent::__construct();
		}

		/*
        // Metodo(s) encargado(s) de gestionar las posibles vistas de la página principal del sitio web
		*/

		public function index(){ 
	
			$this->vista->render($this,'index','ASADA La Unión');

		}

	}

?>