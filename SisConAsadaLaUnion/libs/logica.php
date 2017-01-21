<?php 

	/*
	* Clase encargada de contener metodos en común para todas las demas que extiendan de ella.
	* Las clases que extienden de ella son las logicas
	*/
	class logica extends modelo{
			
		public function __construct(){}

		/*
	    // Método encargado de calcular la totalidad de páginas de acuerdo a la cantidad de registros habidos en el sistema
	    */
	    public function obtenertotalidadPaginas($idConsulta, $permisoConsultaTotalPaginas, $filtroBusqueda,
	    										$limiteRegistros, $registrosActivos){

		  $validacionGeneral = new generalValidation();

	      //Validando parametros de entrada
	      if (strcmp($permisoConsultaTotalPaginas,"true") == 0 && $validacionGeneral->validarLongitudCampoTexto($filtroBusqueda,1000)) {

	        $cantidadTotalRegistros = $this->obtenerTotalRegistrosPaginacion($idConsulta, $filtroBusqueda, $registrosActivos);
	      
	        //Con la totalidad de registros habidos en X lista, se saca la totalidad de páginas

	        $totalPaginas = ceil($cantidadTotalRegistros/$limiteRegistros);

	        $totalidadPaginas = array("totalPaginas" => $totalPaginas);

	        print_r(json_encode($totalidadPaginas));
	        
	      }else{

	        $totalidadPaginas = array("totalPaginas" => "false");

	        print_r(json_encode($totalidadPaginas));

	      }

	    }

		/*
	    // Método encargado de construir la paginación de registros de una tabla
	    */
	    public function elaborarPaginacionRegistros($cadenaAtributos, $cadenaAcciones, $agregarTelefonos, $idConsulta, 
	    											$filtroBusqueda, $paginaActual, $limiteRegistros, $registrosActivos){

	      $validacionGeneral = new generalValidation();

	      //Validando parametros de entrada
	      if ($validacionGeneral->validarLongitudCampoTexto($filtroBusqueda,1000) && intval($paginaActual) != 0) { 

	          $tablaRegistros = "";

	          if($paginaActual <= 1){ //sacando el registro actual, donde se toma referencia para mostrar los demás registros
	            
	               $registroActual = 0;
	            
	          }else{
	            
	               $registroActual = $limiteRegistros* ($paginaActual-1);
	            
	          }

	          
	          $listaCampos = explode(",", $cadenaAtributos);

	          $listaAcciones = explode(",", $cadenaAcciones);

	          $listaRegistros = $this->obtenerRegistrosPaginados($listaCampos, $idConsulta, $filtroBusqueda, $registroActual,
	        										  			  $limiteRegistros, $registrosActivos);

	          //Formateo de registros para redireccionar al controlador, que posteriormente lo enviará a la vista que lo solicite

	          //Validando si la lista viene con o sin registros

	          if ($validacionGeneral->validarArray($listaRegistros)) { //Formateando resultados para la vista (Si pasa el filtro)

	                $dataIdentificador = "";

	                foreach ($listaRegistros as $registro) {

	                	$contador = 0;
	                    $tablaRegistros = $tablaRegistros."<tr>";

	                    foreach ($registro as $atributo => $valorAtributo) {

	                       if ($contador == 0) {

	                         $dataIdentificador = $valorAtributo;

	                         $tamanioListaAcciones = count($listaAcciones);

	                         if (strcmp($listaAcciones[0],"") != 0) {

	                         	$tablaRegistros = $tablaRegistros."<td><select class='form-control acciones' data-identificador='".$dataIdentificador."'>";

	                         	for($i=0; $i<$tamanioListaAcciones; $i++){

	                         		if ($i == 0) {
	                         		
	                         			$tablaRegistros = $tablaRegistros."<option value=''>".$listaAcciones[$i]."</option>";

	                         		}else{

	                         			$tablaRegistros = $tablaRegistros."<option value='".$listaAcciones[$i]."'>".$listaAcciones[$i]."</option>";

	                         		}

	                			}

	                		 	$tablaRegistros = $tablaRegistros."</select></td>";
	                         	
	                         }else{

		                       	 $tablaRegistros = $tablaRegistros.
		                                        "<td>".$valorAtributo."</td>";

	                       	 }

	                       }else{

	                       	 $tablaRegistros = $tablaRegistros.
	                                        "<td>".$valorAtributo."</td>";

	                       }

	                    	$contador++;

	                    }

	                    if ($agregarTelefonos) {

	                    	$tablaRegistros = $tablaRegistros.
	                                       "<td>
	                                          <a href='#'><img class='img-telefono img-responsive center-block' data-identificador='".$dataIdentificador."' src='".URL."/public/assets/images/TelefonoLogo.png' width='32px'/></a>
	                                        </td>
	                                      </tr>";
	                    	
	                    }

	                }                 
	        
	          }else{

	          		$colspan = count($listaCampos);

	          	  	if (strcmp($listaAcciones[0],"") != 0) {
	          	  		
	          	  		$colspan++;

	          	  	}

	              	$tablaRegistros = "<tr><td colspan='".$colspan."' style='text-align:center;'>No se encontraron resultados</td></tr>";
	          }

	          $informacionRegistros = array("tablaRegistros" => $tablaRegistros);

	          print_r(json_encode($informacionRegistros));

	      }else{

	        $informacionRegistros = array("tablaRegistros" => "false");

	        print_r(json_encode($informacionRegistros));
	      
	      }

	    }

	    /*
		//Metodo encargado de retornar las opciones formateadas de un combobox
	    */

	    public function formatearOptionsCombobox($listaElementos){

        	$optionsList = "<option value=''>Seleccione</option>";

		    foreach ($listaElementos as $elemento) {

		    	$llavesElemento = array_keys($elemento);

		    	$optionsList .= "<option value='".$elemento[$llavesElemento[0]]."'>"
		    										  .$elemento[$llavesElemento[1]]."</option>";

		    }               
		        
          	print_r(json_encode(array("optionsList" => $optionsList)));

	    }

	}

?>