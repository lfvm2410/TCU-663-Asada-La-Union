<?php

/*
// Clase controladora de las operaciones sobre el cliente
*/

    class clienteController extends controlador{

      private $personaLogic;
      private $telefonoLogic;
      
      public function __construct(){

        parent::__construct();

        $this->personaLogic = new personaLogic();
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

      public function registrarClienteForm(){

        if (true) {

          $this->vista->render($this,'registrarCliente','Registrar cliente');
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }
  
      }

      public function consultarInformacionClientes(){

        if (true) {

          $this->vista->render($this,'consultarInformacionClientes','Consultar información de clientes');

        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      public function activarClientes(){

        if (true) {

          $this->vista->render($this,'activarClientes','Activar clientes');

        }else{

          $this->redireccionActividadNoAutorizada();

        }
  
      }

    /*
    ** Metodo para registrar un cliente
    */

      public function registrarCliente(){

         if (true && isset($_POST['cedulaCliente']) && isset($_POST['nombreCliente']) && 
             isset($_POST['apellidosCliente']) && isset($_POST['correoCliente']) && isset($_POST['tipoTel1Cliente']) && 
             isset($_POST['numTel1Cliente']) && isset($_POST['tipoTel2Cliente']) && isset($_POST['numTel2Cliente']) && 
             isset($_POST['direccionCliente']) && isset($_POST['numPlanoCliente'])) {

        	  $cedula = trim($_POST['cedulaCliente']);
            $nombre = trim($_POST['nombreCliente']);
            $apellidos = trim($_POST['apellidosCliente']);
            $correoElectronico = trim($_POST['correoCliente']);
            $telefono1 = new telefono(0,trim($_POST['tipoTel1Cliente']),trim($_POST['numTel1Cliente']));
            $telefono2 = new telefono(0,trim($_POST['tipoTel2Cliente']),trim($_POST['numTel2Cliente']));
            $direccion = trim($_POST['direccionCliente']);
            $numeroPlano = trim($_POST['numPlanoCliente']); 

            $cliente = new cliente(0,$cedula,$nombre,$apellidos,$correoElectronico,$direccion,
          	                   0,$numeroPlano,"Si");

            $this->logica->registrarCliente($cliente,$telefono1,$telefono2);

         }else{

            $this->redireccionActividadNoAutorizada();
         
         }

       }

    /*
    ** Metodo para editar un cliente
    */

      public function editarCliente(){

         if (true && isset($_POST['cedulaActual']) && isset($_POST['correoElectronicoActual']) && 
             isset($_POST['numeroPlanoActual']) && isset($_POST['cedulaCliente']) && isset($_POST['nombreCliente']) && 
             isset($_POST['apellidosCliente']) && isset($_POST['correoCliente']) && isset($_POST['tipoTel1Cliente']) && 
             isset($_POST['numTel1Cliente']) && isset($_POST['tipoTel2Cliente']) && isset($_POST['numTel2Cliente']) && 
             isset($_POST['direccionCliente']) && isset($_POST['numPlanoCliente'])) {

            $cedulaActual = trim($_POST['cedulaActual']); 
            $correoElectronicoActual = trim($_POST['correoElectronicoActual']);
            $numeroPlanoActual = trim($_POST['numeroPlanoActual']);
            $cedula = trim($_POST['cedulaCliente']);
            $nombre = trim($_POST['nombreCliente']);
            $apellidos = trim($_POST['apellidosCliente']);
            $correoElectronico = trim($_POST['correoCliente']);
            $telefono1 = new telefono(0,trim($_POST['tipoTel1Cliente']),trim($_POST['numTel1Cliente']));
            $telefono2 = new telefono(0,trim($_POST['tipoTel2Cliente']),trim($_POST['numTel2Cliente']));
            $direccion = trim($_POST['direccionCliente']);
            $numeroPlano = trim($_POST['numPlanoCliente']); 

            $cliente = new cliente(0,$cedula,$nombre,$apellidos,$correoElectronico,$direccion,
                               0,$numeroPlano,"Si");

            $this->logica->editarCliente($cedulaActual,$correoElectronicoActual,$numeroPlanoActual,$cliente,$telefono1,$telefono2);

         }else{

            $this->redireccionActividadNoAutorizada();
         
         }

       }

    /*
    // Metodo para verificar si un número de plano existe
    */

      public function verificarNumeroPlanoExistente(){

        if (true && isset($_POST['valor'])) {

          $numeroPlano = trim($_POST['valor']);

          $this->logica->comprobarExistenciaNumeroPlano($numeroPlano);
          
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo para verificar si un número de plano (en edición) existe
    */

      public function verificarNumeroPlanoExistenteEditar(){

      if (true && isset($_POST['valorActual']) && isset($_POST['valorNuevo'])) {
          
          $numeroPlanoActual = trim($_POST['valorActual']);
          $numeroPlanoNuevo = trim($_POST['valorNuevo']);

          $this->logica->comprobarExistenciaNumeroPlanoEnEdicion($numeroPlanoActual,$numeroPlanoNuevo);
          
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo encargado de consultar la totalidad de páginas de clientes activos en el sistema
    */

      public function consultarTotalidadPaginasClientesActivos(){

        header("Content-Type: application/json");

        if (true && isset($_POST['permisoConsultaTotalPaginas']) && 
            isset($_POST['metodo']) && isset($_POST['busqueda'])) {

          $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

          $metodo = trim($_POST['metodo']);

          $busqueda = trim($_POST['busqueda']);

          $this->logica->totalidadPaginasClientes($permisoConsultaTotalPaginas,$metodo,$busqueda,10,"Si");
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo encargado de consultar los clientes activos en el sistema
    */

      public function consultarClientesActivos(){

        header("Content-Type: application/json");

        if (true && isset($_POST['paginaActual']) && 
            isset($_POST['metodo']) && isset($_POST['busqueda'])) {

          $paginaActual = trim($_POST['paginaActual']);

          $metodo = trim($_POST['metodo']);

          $busqueda = trim($_POST['busqueda']);

          $this->logica->formatoConsultarClientes($paginaActual,$metodo,$busqueda,10,"Si");
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo encargado de consultar la totalidad de páginas de clientes inactivos en el sistema
    */

      public function consultarTotalidadPaginasClientesInactivos(){

        header("Content-Type: application/json");

        if (true && isset($_POST['permisoConsultaTotalPaginas']) && 
            isset($_POST['metodo']) && isset($_POST['busqueda'])) {

          $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

          $metodo = trim($_POST['metodo']);

          $busqueda = trim($_POST['busqueda']);

          $this->logica->totalidadPaginasClientes($permisoConsultaTotalPaginas,$metodo,$busqueda,10,"No");
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo encargado de consultar los clientes inactivos en el sistema
    */

      public function consultarClientesInactivos(){

        header("Content-Type: application/json");

        if (true && isset($_POST['paginaActual']) && 
            isset($_POST['metodo']) && isset($_POST['busqueda'])) {

          $paginaActual = trim($_POST['paginaActual']);

          $metodo = trim($_POST['metodo']);

          $busqueda = trim($_POST['busqueda']);

          $this->logica->formatoConsultarClientesInactivos($paginaActual,$metodo,$busqueda,10,"No");
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo encargado de traer los telefonos de una persona por su cedula y redireccionarlos a la vista
    */

    public function consultarTelefonosClientePorCedula(){

        header("Content-Type: application/json");

        if (true && isset($_POST['cedulaCliente'])) {

          $cedulaCliente = trim($_POST['cedulaCliente']);

          $this->telefonoLogic->formatearTelefonosDePersonaPorCedula($cedulaCliente);
          
        }else{

          $this->redireccionActividadNoAutorizada();

        }
    
    }

    /*
    // Metodo encargado de anular un cliente
    */

    public function anularCliente(){

        if (true && isset($_POST['cedulaCliente'])) {

          $cedulaCliente = trim($_POST['cedulaCliente']);
          
          $this->logica->actualizarEstadoCliente($cedulaCliente,"No");
          
        }else{

          $this->redireccionActividadNoAutorizada();

        }
    
    }

    /*
    // Metodo encargado de activar un cliente
    */

    public function activarCliente(){

        if (true && isset($_POST['cedulaCliente'])) {

          $cedulaCliente = trim($_POST['cedulaCliente']);
          
          $this->logica->actualizarEstadoCliente($cedulaCliente,"Si");
          
        }else{

          $this->redireccionActividadNoAutorizada();

        }
    
    }

    /*
    // Metodo encargado de obtener un cliente por su numero de cedula
    */

    public function obtenerClientePorCedula(){

        header("Content-Type: application/json");

        if (true && isset($_POST['cedulaCliente'])) {

          $cedulaCliente = trim($_POST['cedulaCliente']);
          
          $this->logica->obtenerClientePorCedula($cedulaCliente);
          
        }else{

          $this->redireccionActividadNoAutorizada();

        }
    
    }

  }

?>