<?php


/*
// Clase controladora de las operaciones sobre el login al sistema de control
*/

	class loginController extends controlador{

		private $personaLogic;
		
		public function __construct(){

			parent::__construct();
			$this->personaLogic = new personaLogic();
			
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

      	/*
		// Metodo encargado de recibir una solicitud de inicio de sesión al sistema
      	*/

      	public function validarLogin(){

      		if (isset($_POST['nombreUsuario']) && isset($_POST['contraseniaUsuario'])) {

	        	$nombreUsuario = trim($_POST['nombreUsuario']);
	            $contraseniaUsuario = trim($_POST['contraseniaUsuario']);
	            
	            $usuario = new usuarioSistema(null, null, null, null, null,
		                 null, null, $nombreUsuario, null, null, 
		                 null, null, $contraseniaUsuario, null);

	            $this->personaLogic->validarLogin($usuario);

	         }else{

	            $this->redireccionActividadNoAutorizada();
	         
	         }
	         
      	}

      	/*
		// Metodo encargado de recibir una solicitud para el cierre de la sesión actual
      	*/

      	public function cerrarSession(){

      	   $this->personaLogic->cerrarSession();

      	}

	}

?>