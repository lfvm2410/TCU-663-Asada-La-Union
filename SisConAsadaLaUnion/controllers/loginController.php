<?php


/*
// Clase controladora de las operaciones sobre el login al sistema de control
*/

	class loginController extends controlador{

		private $usuarioLogic;
		
		public function __construct(){

			parent::__construct();
			$this->usuarioLogic = new usuarioLogic();
			
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

      	public function validarLogin(){

      		if (isset($_POST['nombreUsuario']) && isset($_POST['contraseniaUsuario'])) {

	        	$user = trim($_POST['nombreUsuario']);
	            $pass = trim($_POST['contraseniaUsuario']);
	            

	            $usuario = new usuarioSistema(null,null,null,null,null,
		                 null,null, $user, null, null, 
		                 null, null, $pass, null);

	            $this->usuarioLogic->validarLogin($usuario);

	         }else{

	            $this->redireccionActividadNoAutorizada();
	         
	         }
      	}

	}

?>