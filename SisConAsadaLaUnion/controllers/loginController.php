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

      	/*
		// Metodo encargado de recibir una solicitud para recuperar la contraseña de una cuenta
      	*/

      	public function solicitudRecuperarContrasenia(){

      		if (isset($_POST['correoElectronico'])) {

	        	$correoElectronico = trim($_POST['correoElectronico']);
	            
	            $this->personaLogic->solicitudRecuperarContrasenia($correoElectronico);

	        }else{

	            $this->redireccionActividadNoAutorizada();
	         
	       	}
	         
      	}

      	/*
		// Metodo encargado de recibir una solicitud para restablecer la contraseña de una cuenta
      	*/
      	
      	public function solicitudRestablecerContrasenia(){

      		if (isset($_GET['idUsuarioSistema']) && isset($_GET['token'])) {

      			$idUsuarioSistema = $_GET['idUsuarioSistema'];
      			$token = $_GET['token'];

        		if ($this->personaLogic->solicitudRestablecerContrasenia($idUsuarioSistema, $token)) {

        			$this->vista->render($this,'restablecerContrasenia','Restablecer contraseña');

        		}else{

        			$this->redireccionActividadNoAutorizada();

      			}

	        }else{

	            $this->redireccionActividadNoAutorizada();
	         
	       	}

      	}

      	/*
		// Metodo encargado de restablecer la contraseña para un usuario
      	*/

      	public function restablecerContrasenia(){

      		if (isset($_POST['idUsuarioSistema']) && isset($_POST['token']) &&
      			isset($_POST['nuevaContrasenia']) && isset($_POST['confirmarNuevaContrasenia'])) {

      			$idUsuarioSistema = $_POST['idUsuarioSistema'];
      			$token = $_POST['token'];
      			$nuevaContrasenia = $_POST['nuevaContrasenia'];
      			$confirmarNuevaContrasenia = $_POST['confirmarNuevaContrasenia'];

      			$this->personaLogic->restablecerContrasenia($idUsuarioSistema, $token, $nuevaContrasenia, $confirmarNuevaContrasenia);

	        }else{

	            $this->redireccionActividadNoAutorizada();
	         
	       	}

      	}

	}

?>