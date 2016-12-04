<?php

   /*
   // Clase logica intermediaria entre el controlador y la data del producto, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

   class productoLogic extends productoValidation{

   		private $productoData;
    
		public function __construct(){

			$this->productoData = new productoData();
		}

		/*
    	// Método encargado de gestionar el registro del producto, mediando entre controlador y data
		*/

		public function registrarProducto(producto $producto){

          if ($this->validarCamposTexto($producto->getNombre(),30) &&
              $this->validarCamposTexto($producto->getDescripcion(),60) &&
              $this->validarCamposNumericosEnteros($producto->getCantidad())) {

              if($this->productoData->registrarProducto($producto)) {

                	echo "true";
                
              }else{

                	echo "false";
              }
                
          }else{

            echo "false";

          }

		}

	    /*
	    // Método encargado de calcular la totalidad de páginas de acuerdo a la cantidad de productos habidos en el sistema
	    */
	    
	    public function totalidadPaginasProductos($permisoConsultaTotalPaginas,$metodo,$busquedaNombre,$cantidadProductosAMostrar){

	      if (strcmp($permisoConsultaTotalPaginas,"true") == 0 && $this->validarMetodoBusquedaProductos($metodo) &&
	          $this->validarCamposTexto($busquedaNombre,30)) { //Validando parametros de entrada

	        if (strcmp($metodo, "obtenerProductos") == 0) { //Determina a cual lista de productos se le va a sacar la cantidad total de sus registros

	          $cantidadTotalProductos = $this->productoData->obtenerTotalProductos();
	          
	        }else{

	          $cantidadTotalProductos = $this->productoData->obtenerTotalProductosNombre($busquedaNombre);

	        }

	        $totalPaginas = ceil($cantidadTotalProductos/$cantidadProductosAMostrar); //Con la totalidad de productos habidos en X lista, se saca la totalidad de páginas

	        $paginasProductos = array("totalPaginas" => $totalPaginas);

	        print_r(json_encode($paginasProductos));
	        
	      }else{

	        $paginasProductos = array("totalPaginas" => "false");

	        print_r(json_encode($paginasProductos));

	      }

	    }		

		/*
    	// Método encargado de construir el formato que tendrán los registros sobre los productos
    	*/

	    public function formatoConsultarProductos($paginaActual,$metodo,$busquedaNombre,$cantidadProductosAMostrar){

	      if (intval($paginaActual) != 0 && $this->validarMetodoBusquedaProductos($metodo) &&
	          $this->validarCamposTexto($busquedaNombre,30)) { //Validando parametros de entrada
	        
	          $tablaProductos = "";

	          if($paginaActual <= 1){ //sacando el producto actual, donde se toma referencia para mostrar los demás registros
	            
	               $productoActual = 0;
	            
	          }else{
	            
	               $productoActual = $cantidadProductosAMostrar*($paginaActual-1);
	            
	          }

	          if (strcmp($metodo, "obtenerProductos") == 0) { //Determina a cual lista de productos llama

	          $listaProductos = $this->productoData->obtenerProductos($productoActual,$cantidadProductosAMostrar);
	          
	          }else{

	          $listaProductos = $this->productoData->obtenerProductosNombre($busquedaNombre,$productoActual,        
	 																	   $cantidadProductosAMostrar);

	          }

	          //Formateo de registros para redireccionar al controlador, que posteriormente lo enviará a la vista que lo solicite

	          //Validando si la lista viene con o sin registros

	          if ($this->validarArray($listaProductos)) { //Formateando resultados para la vista (Si pasa el filtro)

	                $dataProducto = "";

	                foreach ($listaProductos as $producto) {

	                    $tablaProductos = $tablaProductos."<tr>";

	                    foreach ($producto as $atributoProducto => $valorAtributo) {

	                       if ($atributoProducto == "idProducto") {

	                         $dataProducto = $valorAtributo;

	                         $tablaProductos = $tablaProductos."<td><select class='form-control acciones' data-producto='".$dataProducto."'>
	                                                                     <option value=''>Elegir</option>
	                                                                     <option value='Editar'>Editar</option>
	                                                                     <option value='Eliminar'>Eliminar</option>
	                                                             </select></td>";
	                       
	                       }else if ($atributoProducto == "fechaModificacion") {

	                         $fecha = date_create($valorAtributo);
	                       	
	                         $tablaProductos = $tablaProductos."<td>".date_format($fecha,'d/m/Y g:i:s A')."</td>";
	                       
	                       }else{

	                       	 $tablaProductos = $tablaProductos."<td>".$valorAtributo."</td>";

	                       }

	                    }

	                    $tablaProductos = $tablaProductos."</tr>";
	                }                 
	        
	          }else{

	              $tablaProductos = "<tr><td colspan='5' style='text-align:center;'>No se encontraron resultados</td></tr>";
	          }

	          $informacionProductos = array("tablaProductos" => $tablaProductos);

	          print_r(json_encode($informacionProductos));

	      }else{

	        $informacionProductos = array("tablaProductos" => "false");

	        print_r(json_encode($informacionProductos));
	      
	      }

	    }

	    /*
	    // Metodo encargado de obtener un producto por su id
	    */

	    public function obtenerProductoPorId($idProducto){

	      if ($this->validarCamposNumericosEnteros($idProducto)) {

		        $producto = $this->productoData->getProductoPorId($idProducto);

		        if ($this->validarArray($producto)) {
	      
		            print_r(json_encode($producto));
		              
		        }else{

		            print_r(json_encode("false"));

		        }

	      }else{

	           print_r(json_encode("false"));

	      }

		 }


		/*
    	// Método encargado de gestionar la edición de un producto seleccionado, mediando entre controlador y data
		*/

		public function editarProducto(producto $producto){

          if ($this->validarCamposNumericosEnteros($producto->getIdProducto()) &&
          	  $this->validarCamposTexto($producto->getNombre(),30) &&
              $this->validarCamposTexto($producto->getDescripcion(),60) &&
              $this->validarCamposNumericosEnteros($producto->getCantidad())) {

              if($this->productoData->editarProducto($producto)) {

                	echo "true";
                
              }else{

                	echo "false";
              }
                
          }else{

            echo "false";

          }

		}

		/*
	    // Metodo encargado de gestionar la eliminacion de un producto
	    */

	    public function eliminarProducto($idProducto){

	      if ($this->validarCamposNumericosEnteros($idProducto)) {

	        if ($this->productoData->eliminarProducto($idProducto)) {
	          
	          echo "true";

	        }else{

	          echo "false";

	        }

	      }else{

	        echo "false";

	      }

	    }

   }
?>