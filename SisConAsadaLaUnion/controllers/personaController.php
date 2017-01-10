<?php

/*
// Clase controladora de las operaciones efectuadas sobre las personas del sistema
*/

	class personaController extends controlador{
		
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

      	public function registrarPersonaForm(){

      		$this->vista->render($this,'registrarPersona','Registrar persona');

      	}

        public function consultarInformacionPersonas(){

          $this->vista->render($this,'consultarInformacionPersonas','Consultar información de personas');

        }


      	/*
    	  // Metodo para verificar si una cédula existe
    	  */

      	public function verificarCedulaExistente(){

        	if (isset($_POST['valor'])) {

          		$cedula = trim($_POST['valor']);

          		$this->logica->comprobarExistenciaCedula($cedula);

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

          		$this->logica->comprobarExistenciaCorreoElectronico($correoElectronico);

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
    	  ** Metodo para registrar una persona
    	  */

      	public function registrarPersona(){

           if (isset($_POST['perfilPersona']) && isset($_POST['cedulaPersona']) && isset($_POST['nombrePersona']) &&
               isset($_POST['apellidosPersona']) && isset($_POST['fechaNacimientoPersona']) && isset($_POST['correoPersona']) && 
               isset($_POST['nombreUsuarioPersona'])&& isset($_POST['contraseniaPersona']) && isset($_POST['confirmarContraseniaPersona']) && 
               isset($_POST['tipoTel1Persona']) && isset($_POST['numTel1Persona']) && isset($_POST['tipoTel2Persona']) &&
               isset($_POST['numTel2Persona']) && isset($_POST['direccionPersona']) && isset($_POST['puestoPersona']) &&
               isset($_POST['descripcionPuestoPersona'])) {

        	  $perfil = trim($_POST['perfilPersona']);
            $cedula = trim($_POST['cedulaPersona']);
            $nombre = trim($_POST['nombrePersona']);
            $apellidos = trim($_POST['apellidosPersona']);
            $fechaNacimiento = trim($_POST['fechaNacimientoPersona']);
            $correoElectronico = trim($_POST['correoPersona']);
            $nombreUsuarioSistema = trim($_POST['nombreUsuarioPersona']);
            $contrasenia = trim($_POST['contraseniaPersona']);
            $confirmarContrasenia = trim($_POST['confirmarContraseniaPersona']);
            $telefono1 = new telefono(0,trim($_POST['tipoTel1Persona']),trim($_POST['numTel1Persona']));
            $telefono2 = new telefono(0,trim($_POST['tipoTel2Persona']),trim($_POST['numTel2Persona']));
            $direccion = trim($_POST['direccionPersona']);
            $puesto = trim($_POST['puestoPersona']); 
            $descripcionPuesto = trim($_POST['descripcionPuestoPersona']);

            $usuario = new usuarioSistema(0,$cedula,$nombre,$apellidos,$correoElectronico,
		                 $direccion, 0, $nombreUsuarioSistema, $perfil, $fechaNacimiento, 
		                 $puesto, $descripcionPuesto, $contrasenia, $confirmarContrasenia);

            $this->logica->registrarPersona($usuario,$telefono1,$telefono2);

          }else{

            $this->redireccionActividadNoAutorizada();
         
          }

       	}

        /*
        // Metodo encargado de consultar la totalidad de páginas sobre las personas que son 'usuarios' en el sistema
        */

        public function consultarTotalidadPaginasPersonas(){

        header("Content-Type: application/json");

        if (isset($_POST['permisoConsultaTotalPaginas']) && isset($_POST['filtroBusqueda'])) {

          $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $this->logica->obtenertotalidadPaginas(TOTAL_USUARIOS, $permisoConsultaTotalPaginas, $filtroBusqueda, LIMITE_REGISTROS, "Si");

        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

      /*
      // Metodo encargado de consultar las personas que son usuarios en el sistema
      */

      public function consultarPersonas(){

        header("Content-Type: application/json");

        if (isset($_POST['paginaActual']) && isset($_POST['filtroBusqueda'])) {

          $paginaActual = trim($_POST['paginaActual']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $cadenaAtributos = "id_Persona,cedula_Persona,nombre_Persona,apellidos_Persona,correoElectronico_Persona,direccion_Persona,puesto_UsuarioSistema,descripcionPuesto_UsuarioSistema";
          
          $cadenaAcciones = "Elegir,Editar,Anular";

          $this->logica->elaborarPaginacionRegistros($cadenaAtributos, $cadenaAcciones, true, PAGINACION_USUARIOS, 
                            $filtroBusqueda, $paginaActual, LIMITE_REGISTROS, "Si");
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

	}

?>