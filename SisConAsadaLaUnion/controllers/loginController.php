<?php


/*
// Clase controladora de las operaciones sobre el login al sistema de control
*/

	class loginController extends controlador{
		
		public function __construct(){

			parent::__construct();
			
		}

	/*
    // Metodos para mostrar las vistas asociadas a este controlador
    */

      	public function index(){

      		$this->vista->render($this,'loginForm','Iniciar sesión');

      	}

      	public function loginForm(){

      		$this->vista->render($this,'loginForm','Iniciar sesión');

      	}

	}

?>