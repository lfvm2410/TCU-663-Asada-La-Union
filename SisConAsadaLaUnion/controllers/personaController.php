<?php

/*
// Clase controladora de las operaciones efectuadas sobre las personas del sistema
*/

	class personaController extends controlador{

        private $telefonoLogic;
		
  		  public function __construct(){

  			 parent::__construct();

         $this->telefonoLogic = new telefonoLogic();
  			
  		  }

		    /*
	      // Metodos para mostrar las vistas asociadas a este controlador
	      */

      	public function index(){

          if (true) {

            //Temporal, mientras se define la vista principal del controlador

            header('Location: '.URL);

            exit;
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }

      	}

      	public function registrarPersonaForm(){

          if (true) {

            $this->vista->render($this,'registrarPersona','Registrar persona');
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }

      	}

        public function consultarInformacionPersonas(){

          if (true) {

            $this->vista->render($this,'consultarInformacionPersonas','Consultar información de personas');
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }

        }


      	/*
    	  // Metodo para verificar si una cédula existe
    	  */

      	public function verificarCedulaExistente(){

        	if (true && isset($_POST['valor'])) {

          		$cedula = trim($_POST['valor']);

          		$this->logica->comprobarExistenciaCedula($cedula);

        	}else{

         		  $this->redireccionActividadNoAutorizada();
         
        	}
    
      	}

        /*
        // Metodo para verificar si una cédula (en edición) existe
        */

        public function verificarCedulaExistenteEditar(){

          if (true && isset($_POST['valorActual']) && isset($_POST['valorNuevo'])) {

            $cedulaActual = trim($_POST['valorActual']);
            $cedulaNueva = trim($_POST['valorNuevo']);

            $this->logica->comprobarExistenciaCedulaEnEdicion($cedulaActual,$cedulaNueva);

          }else{

            $this->redireccionActividadNoAutorizada();
           
          }
      
        }

      	/*
    	  // Metodo para verificar si un correo electrónico existe
    	  */

      	public function verificarCorreoElectronicoExistente(){

        	if (true && isset($_POST['valor'])) {

          		$correoElectronico = trim($_POST['valor']);

          		$this->logica->comprobarExistenciaCorreoElectronico($correoElectronico);

        	}else{

          		$this->redireccionActividadNoAutorizada();
         
        	}

      	}

      /*
      // Metodo para verificar si un correo electrónico (en edición) existe
      */

        public function verificarCorreoElectronicoExistenteEditar(){

           if (true && isset($_POST['valorActual']) && isset($_POST['valorNuevo'])) {

            $correoElectronicoActual = trim($_POST['valorActual']);
            $correoElectronicoNuevo = trim($_POST['valorNuevo']);

            $this->logica->comprobarExistenciaCorreoElectronicoEnEdicion($correoElectronicoActual,$correoElectronicoNuevo);

          }else{

            $this->redireccionActividadNoAutorizada();
           
          }

        }

      	/*
    	  // Metodo para verificar si un nombre de usuario existe
    	  */

      	public function verificarNombreUsuarioExistente(){

        	if (true && isset($_POST['valor'])) {

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

           if (true && isset($_POST['perfilPersona']) && isset($_POST['cedulaPersona']) && 
               isset($_POST['nombrePersona']) && isset($_POST['apellidosPersona']) && isset($_POST['fechaNacimientoPersona']) && 
               isset($_POST['correoPersona']) && isset($_POST['nombreUsuarioPersona'])&& isset($_POST['contraseniaPersona']) && 
               isset($_POST['confirmarContraseniaPersona']) && isset($_POST['tipoTel1Persona']) && isset($_POST['numTel1Persona']) && 
               isset($_POST['tipoTel2Persona']) && isset($_POST['numTel2Persona']) && isset($_POST['direccionPersona']) && 
               isset($_POST['puestoPersona']) && isset($_POST['descripcionPuestoPersona'])) {

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
        ** Metodo para editar una persona con el perfil de colaborador
        */

        public function editarPersonaTipoColaborador(){

           if (true && isset($_POST['idPersona']) && isset($_POST['cedulaActual']) && 
               isset($_POST['correoElectronicoActual']) && isset($_POST['cedulaPersona']) && isset($_POST['nombrePersona']) && 
               isset($_POST['apellidosPersona']) && isset($_POST['fechaNacimientoPersona']) && isset($_POST['correoPersona']) &&
               isset($_POST['tipoTel1Persona']) && isset($_POST['numTel1Persona']) && isset($_POST['tipoTel2Persona']) &&
               isset($_POST['numTel2Persona']) && isset($_POST['direccionPersona']) && isset($_POST['puestoPersona']) &&
               isset($_POST['descripcionPuestoPersona'])) {

            $idPersona = trim($_POST['idPersona']);
            $perfil = "Colaborador";
            $cedulaActual = trim($_POST['cedulaActual']);
            $cedula = trim($_POST['cedulaPersona']);
            $nombre = trim($_POST['nombrePersona']);
            $apellidos = trim($_POST['apellidosPersona']);
            $fechaNacimiento = trim($_POST['fechaNacimientoPersona']);
            $correoElectronicoActual = trim($_POST['correoElectronicoActual']);
            $correoElectronico = trim($_POST['correoPersona']);
            $nombreUsuarioSistema = "";
            $contrasenia = "";
            $confirmarContrasenia = "";
            $telefono1 = new telefono(0,trim($_POST['tipoTel1Persona']),trim($_POST['numTel1Persona']));
            $telefono2 = new telefono(0,trim($_POST['tipoTel2Persona']),trim($_POST['numTel2Persona']));
            $direccion = trim($_POST['direccionPersona']);
            $puesto = trim($_POST['puestoPersona']); 
            $descripcionPuesto = trim($_POST['descripcionPuestoPersona']);

            $usuario = new usuarioSistema($idPersona,$cedula,$nombre,$apellidos,$correoElectronico,
                     $direccion, 0, $nombreUsuarioSistema, $perfil, $fechaNacimiento, 
                     $puesto, $descripcionPuesto, $contrasenia, $confirmarContrasenia);

            $this->logica->editarPersona($cedulaActual,$correoElectronicoActual,$usuario,$telefono1,$telefono2);

          }else{

            $this->redireccionActividadNoAutorizada();
         
          }

        }

        /*
        // Metodo encargado de consultar la totalidad de páginas sobre las personas que son 'usuarios' en el sistema
        */

        public function consultarTotalidadPaginasPersonas(){

        header("Content-Type: application/json");

        if (true && isset($_POST['permisoConsultaTotalPaginas']) && 
            isset($_POST['filtroBusqueda'])) {

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

        if (true && isset($_POST['paginaActual']) && 
            isset($_POST['filtroBusqueda'])) {

          $paginaActual = trim($_POST['paginaActual']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $cadenaAtributos = "id_Persona,cedula_Persona,nombre_Persona,apellidos_Persona,correoElectronico_Persona,direccion_Persona,puesto_UsuarioSistema,descripcionPuesto_UsuarioSistema";
          
          $cadenaAcciones = "Elegir,Editar,Eliminar";

          $this->logica->elaborarPaginacionRegistros($cadenaAtributos, $cadenaAcciones, true, PAGINACION_USUARIOS, 
                            $filtroBusqueda, $paginaActual, LIMITE_REGISTROS, "Si");
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

      /*
      // Metodo encargado de traer los telefonos de una persona por su id y redireccionarlos a la vista
      */

      public function consultarTelefonosPersonaPorId(){

          header("Content-Type: application/json");

          if (true && isset($_POST['idPersona'])) {

            $idPersona = trim($_POST['idPersona']);

            $this->telefonoLogic->formatearTelefonosDePersonaPorId($idPersona);
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }
      
      }


      /*
      // Metodo encargado de obtener una persona por su id
      */

      public function obtenerPersonaPorId(){

          header("Content-Type: application/json");

          if (true && isset($_POST['idPersona']) && isset($_POST['tipoPersona'])) {

            $idPersona = trim($_POST['idPersona']);
            $tipoPersona = trim($_POST['tipoPersona']);
            
            $this->logica->obtenerPersonaPorId($idPersona,$tipoPersona);
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }
      
      }

      /*
      // Metodo encargado de eliminar una persona con el perfil de colaborador
      */

      public function eliminarPersonaPerfilColaborador(){

          if (true && isset($_POST['idPersona'])) {

            $idPersona = trim($_POST['idPersona']);
            
            $this->logica->eliminarPersona($idPersona,"Colaborador");
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }
      
      }

	}

?>