<?php 

class servicioController extends controlador{

	private $clienteLogic;
	
	 public function __construct(){

        parent::__construct();

        $this->clienteLogic = new clienteLogic();

      } 

      public function index(){

        if ($this->verificarSessionIniciada()) {

          //Temporal, mientras se define la vista principal del controlador

          header('Location: '.URL.'index/inicio');

          exit;
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      public function editarServicio(){

        if($this->verificarSessionIniciada() && isset($_POST['idCliente']) && isset($_POST['tipoServicio']) && isset($_POST['cbEstado']) && isset($_POST['idnumNIS']) && isset($_POST['idServicio'])){

          $idServicio = $_POST['idServicio'];
          $idCliente = $_POST['idCliente'];
          $tipoServicio = $_POST['tipoServicio'];
          $estado = $_POST['cbEstado'];
          $numNIS = trim($_POST['idnumNIS']);

          $servicio = new servicio($idServicio, $numNIS, $estado, $tipoServicio, null);

          $this->logica->editarServicio($servicio); 
        }
        else
        {
          $this->redireccionActividadNoAutorizada();
        }
      }


      public function consultarInformacionServicio(){

        if ($this->verificarSessionIniciada()) {
          
          $this->vista->render($this,'consultarInformacionServicio','Consultar información de servicios');

        }else{

          $this->redireccionActividadNoAutorizada();

        }
  
      }

      public function registrarServicioForm(){

        if ($this->verificarSessionIniciada()) {
          
          $estadoCliente = "Si";
          $_POST['listaClientes'] = $this->clienteLogic->obtenerClientesSinFiltro($estadoCliente);
      
          $this->vista->render($this,'registrarServicio','Registrar Servicio');

        }else{

          $this->redireccionActividadNoAutorizada();

        }
  
      }

      public function registrarServicio(){

        if($this->verificarSessionIniciada() && isset($_POST['cbCliente']) && isset($_POST['tipoServicio']) && isset($_POST['cbEstado']) && isset($_POST['idnumNIS'])){
          
          $idCliente = $_POST['cbCliente'];
          $tipoServicio = $_POST['tipoServicio'];
          $estado = $_POST['cbEstado'];
          $numNIS = trim($_POST['idnumNIS']);

          $servicio = new servicio(0, $numNIS, $estado, $tipoServicio, null);

          $this->logica->registrarServicio($servicio, $idCliente);

        }else{

            $this->redireccionActividadNoAutorizada();
         
         }
      }

    /*
    // Metodo para verificar si un Número de NIS existe
    */

      public function verificarNumNISExistente(){

        if ($this->verificarSessionIniciada() && isset($_POST['valor'])) {

          $numNIS = trim($_POST['valor']);

          $this->logica->comprobarExistenciaNumeroNIS($numNIS);

        }else{

          $this->redireccionActividadNoAutorizada();
         
        }
    
      }

      /*
      // Metodo encargado de consultar la totalidad de páginas de clientes servicios en el sistema
      */

      public function consultarTotalidadPaginasServicios(){

        header("Content-Type: application/json");

        if ($this->verificarSessionIniciada() && isset($_POST['permisoConsultaTotalPaginas']) && isset($_POST['filtroBusqueda'])) {

          $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $this->logica->obtenertotalidadPaginas(TOTAL_SERVICIOS, $permisoConsultaTotalPaginas, $filtroBusqueda, LIMITE_REGISTROS, "Si");
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }
      /*
      //Método encargado de consultar los servicios en el sistema.
      */

      public function consultarServicios()
      {
        header("Content-Type: application/json");

        if($this->verificarSessionIniciada() && isset($_POST['paginaActual']) && isset($_POST['filtroBusqueda']))
        {
          $paginaActual = trim($_POST['paginaActual']);
          $filtroBusqueda = trim($_POST['filtroBusqueda']);
          $cadenaAtributos = "id_ServicioAgua,numeroNis_ServicioAgua,estado_ServicioAgua,tipo_ServicioAgua,fechaModificacion_ServicioAgua,nombreCliente";
          $cadenaAcciones = "Elegir,Editar,Lecturas";

          $this->logica->elaborarPaginacionRegistros($cadenaAtributos, $cadenaAcciones, false, PAGINACION_SERVICIOS, $filtroBusqueda, $paginaActual, LIMITE_REGISTROS, "Si");
        }
        else {
          $this->redireccionActividadNoAutorizada();
        }

      }

      public function obtenerServicioPorID()
      {
        header("Content-Type: application/json");

        if ($this->verificarSessionIniciada() && isset($_POST['idServicio'])) 
        {
          $codServicio = trim($_POST['idServicio']);

          $this->logica->obtenerServicioPorID($codServicio);
        }
        else
        {
         $this->redireccionActividadNoAutorizada();
        }
      }
}
?>