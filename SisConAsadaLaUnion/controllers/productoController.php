<?php

	/*
	// Clase controladora de las operaciones sobre un producto
	*/

	class productoController extends controlador{
		
		  public function __construct(){

        	parent::__construct();

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

      public function registrarProductoForm(){

        if (true) {

          $this->vista->render($this,'registrarProducto','Registrar producto');
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }
  
      }

      public function consultarInformacionProductos(){

        if (true) {

          $this->vista->render($this,'consultarInformacionProductos','Consultar información de productos');
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

    /*
    ** Metodo para registrar un producto
    */

      public function registrarProducto(){

         if (true && isset($_POST['nombreProducto']) && 
             isset($_POST['descripcionProducto']) && isset($_POST['cantidadProducto'])) {

        	$nombre = trim($_POST['nombreProducto']);
            $descripcion = trim($_POST['descripcionProducto']);
            $cantidad = trim($_POST['cantidadProducto']); 

            $producto = new producto(0,$nombre,$descripcion,$cantidad,"");

            $this->logica->registrarProducto($producto);

         }else{

            $this->redireccionActividadNoAutorizada();
         
         }

       }

    /*
    // Metodo encargado de consultar la totalidad de páginas de los productos en el sistema
    */

      public function consultarTotalidadPaginasProductos(){

        header("Content-Type: application/json");

        if (true && isset($_POST['permisoConsultaTotalPaginas']) && 
            isset($_POST['metodo']) && isset($_POST['busqueda'])) {

          $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);
          $metodo = trim($_POST['metodo']);
          $busqueda = trim($_POST['busqueda']);

          $this->logica->totalidadPaginasProductos($permisoConsultaTotalPaginas,$metodo,$busqueda,10);
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo encargado de consultar los productos habidos en el sistema
    */

      public function consultarProductos(){

        header("Content-Type: application/json");

        if (true && isset($_POST['paginaActual']) && 
            isset($_POST['metodo']) && isset($_POST['busqueda'])) {

          $paginaActual = trim($_POST['paginaActual']);
          $metodo = trim($_POST['metodo']);
          $busqueda = trim($_POST['busqueda']);

          $this->logica->formatoConsultarProductos($paginaActual,$metodo,$busqueda,10);
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo encargado de obtener un producto por su id
    */

    public function obtenerProductoPorId(){

        header("Content-Type: application/json");

        if (true && isset($_POST['idProducto'])) {

          $idProducto = trim($_POST['idProducto']);
          
          $this->logica->obtenerProductoPorId($idProducto);
          
        }else{

          $this->redireccionActividadNoAutorizada();

        }
    
    }

    /*
    ** Metodo para editar un producto
    */

      public function editarProducto(){

         if (true && isset($_POST['idProducto']) && 
             isset($_POST['nombreProducto']) && isset($_POST['descripcionProducto']) && 
             isset($_POST['cantidadProducto'])) {

         	$idProducto = $_POST['idProducto'];
        	$nombre = trim($_POST['nombreProducto']);
            $descripcion = trim($_POST['descripcionProducto']);
            $cantidad = trim($_POST['cantidadProducto']); 

            $producto = new producto($idProducto,$nombre,$descripcion,$cantidad,"");

            $this->logica->editarProducto($producto);

         }else{

            $this->redireccionActividadNoAutorizada();
         
         }

       }

    /*
    // Metodo encargado de eliminar un producto
    */

    public function eliminarProducto(){

        if (true && isset($_POST['idProducto'])) {

          $idProducto = trim($_POST['idProducto']);
          
          $this->logica->eliminarProducto($idProducto);
          
        }else{

          $this->redireccionActividadNoAutorizada();

        }
    
    }

	}

?>