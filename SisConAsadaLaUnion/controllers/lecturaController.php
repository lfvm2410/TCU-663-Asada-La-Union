<?php 
class lecturaController extends controlador{

   public function __construct(){

        parent::__construct();

   } 

   public function index(){

        if ($this->verificarSessionIniciada()) {

          //Temporal, mientras se define la vista principal del controlador

          header('Location: '.URL);

          exit;
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }

    }

   public function editarLectura()
   {

      if ($this->verificarSessionIniciada() && isset($_POST['idLecturaSeleccionado']) && isset($_POST['cantidadMetrosCubicos'])) {
        
        $idLectura = $_POST['idLecturaSeleccionado'];
        $cantMtosCub = $_POST['cantidadMetrosCubicos'];
        
        $this->logica->editarLectura($idLectura, $cantMtosCub);
      }
      else
      {
       $this->redireccionActividadNoAutorizada(); 
      }
   }

   public function registrarLecturaForm()
   {
      if ($this->verificarSessionIniciada() && isset($_GET['idServicio'])) {
        
        $_POST['idServicio'] = $_GET['idServicio'];
        $this->vista->render($this, 'registrarLectura', 'Registrar Lectura');
      
      }
      else
      {
       $this->redireccionActividadNoAutorizada(); 
      }
   }

   public function registrarLectura()
   {
      if ($this->verificarSessionIniciada() && isset($_POST['cantidadMetrosCubicos']) && isset($_POST['idServicioLec'])) {

        $idServicio = $_POST['idServicioLec'];
        $cantidadMetrosCubicos = $_POST['cantidadMetrosCubicos'];

        $lectura = new lecturaMedidor(0, $cantidadMetrosCubicos, null, null, $idServicio);

        $this->logica->registrarLectura($lectura);
      }
      else
      {
        $this->redireccionActividadNoAutorizada();
      }
   }

      /*
      // Metodo encargado de consultar la totalidad de páginas de clientes servicios en el sistema
      */

      public function consultarTotalidadPaginasLecturas()
      {

        header("Content-Type: application/json");

        if ($this->verificarSessionIniciada() && isset($_POST['permisoConsultaTotalPaginas'])){

          $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $this->logica->obtenertotalidadPaginas(TOTAL_LECTURAS, $permisoConsultaTotalPaginas, $filtroBusqueda, LIMITE_REGISTROS, "Si");
        
        }
        else
        {

          $this->redireccionActividadNoAutorizada();
         
        }

      }
      /*
      //Método encargado de consultar los servicios en el sistema.
      */

      public function consultarLecturas()
      {
        header("Content-Type: application/json");

        if($this->verificarSessionIniciada() &&  isset($_POST['paginaActual']) && isset($_POST['filtroBusqueda'])) {

          $paginaActual = trim($_POST['paginaActual']);
          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $cadenaAtributos = "id_LecturaMedidor,cantidadMetrosCubicos_LecturaMedidor,fechaCreacion_LecturaMedidor,fechaModificacion_LecturaMedidor";
          $cadenaAcciones = "Elegir,Editar";

          $this->logica->elaborarPaginacionRegistros($cadenaAtributos, $cadenaAcciones, false, PAGINACION_LECTURAS, $filtroBusqueda, $paginaActual, LIMITE_REGISTROS, "Si");
        }
        else 
        {
          $this->redireccionActividadNoAutorizada();
        }

      }
    }
?>