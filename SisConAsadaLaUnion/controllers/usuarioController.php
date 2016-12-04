<?php

/*
// Clase controladora de las operaciones efectuadas sobre los usuarios del sistema
*/

	class usuarioController extends controlador{
		
		public function __construct(){

			parent::__construct();

			$this->personaLogic = new personaLogic();
			
		}

		/*
	    // Metodos para mostrar las vistas asociadas a este controlador
	    */

      	public function index(){

      	//Temporal, mientras se define la vista principal del controlador

        header('Location: '.URL);

        exit;

      	}

      	public function registrarUsuarioForm(){

      		$this->vista->render($this,'registrarUsuario','Registrar usuario');

      	}

      	/*
    	// Metodo para verificar si una cédula existe
    	*/

      	public function verificarCedulaExistente(){

        	if (isset($_POST['valor'])) {

          		$cedula = trim($_POST['valor']);

          		$this->personaLogic->comprobarExistenciaCedula($cedula);

        	}else{

         		$this->redireccionActividadNoAutorizada();
         
        	}
    
      	}

      	/*
    	// Metodo para verificar si un correo electrónico existe
    	*/

      	public function verificarCorreoElectronicoExistente(){

        	if (isset($_POST['valor'])) {

          		$correoElectronico = trim($_POST['valor']);

          		$this->personaLogic->comprobarExistenciaCorreoElectronico($correoElectronico);

        	}else{

          		$this->redireccionActividadNoAutorizada();
         
        	}

      	}

      	/*
    	// Metodo para verificar si un nombre de usuario existe
    	*/

      	public function verificarNombreUsuarioExistente(){

        	if (isset($_POST['valor'])) {

          		$nombreUsuario = trim($_POST['valor']);

          		$this->logica->comprobarExistenciaNombreUsuario($nombreUsuario);
          
        	}else{

          		$this->redireccionActividadNoAutorizada();
         
        	}

      	}

      	/*
    	** Metodo para registrar un usuario
    	*/

      	public function registrarUsuario(){

           if (isset($_POST['cedulaUsuario']) && isset($_POST['nombreUsuario']) && isset($_POST['apellidosUsuario']) &&
               isset($_POST['fechaNacimientoUsuario']) && isset($_POST['correoUsuario']) && isset($_POST['nombreUsuarioSistema'])&&
               isset($_POST['contraseniaUsuario']) && isset($_POST['confirmarContraseniaUsuario']) && 
               isset($_POST['tipoTel1Usuario']) && isset($_POST['numTel1Usuario']) && isset($_POST['tipoTel2Usuario']) &&
               isset($_POST['numTel2Usuario']) && isset($_POST['direccionUsuario']) && isset($_POST['puestoUsuario']) &&
               isset($_POST['descripcionPuestoUsuario'])) {

        	$cedula = trim($_POST['cedulaUsuario']);
            $nombre = trim($_POST['nombreUsuario']);
            $apellidos = trim($_POST['apellidosUsuario']);
            $fechaNacimiento = trim($_POST['fechaNacimientoUsuario']);
            $correoElectronico = trim($_POST['correoUsuario']);
            $nombreUsuarioSistema = trim($_POST['nombreUsuarioSistema']);
            $contrasenia = trim($_POST['contraseniaUsuario']);
            $confirmarContrasenia = trim($_POST['confirmarContraseniaUsuario']);
            $telefono1 = new telefono(0,trim($_POST['tipoTel1Usuario']),trim($_POST['numTel1Usuario']));
            $telefono2 = new telefono(0,trim($_POST['tipoTel2Usuario']),trim($_POST['numTel2Usuario']));
            $direccion = trim($_POST['direccionUsuario']);
            $puesto = trim($_POST['puestoUsuario']); 
            $descripcionPuesto = trim($_POST['descripcionPuestoUsuario']);

            $usuario = new usuarioSistema(0,$cedula,$nombre,$apellidos,$correoElectronico,
		                 $direccion, 0, $nombreUsuarioSistema, "Administrador", $fechaNacimiento, 
		                 $puesto, $descripcionPuesto, $contrasenia, $confirmarContrasenia);

            $this->logica->registrarUsuario($usuario,$telefono1,$telefono2);

         }else{

            $this->redireccionActividadNoAutorizada();
         
         }

       	}

	}

?>