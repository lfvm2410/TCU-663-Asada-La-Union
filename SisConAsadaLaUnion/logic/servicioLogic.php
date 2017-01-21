<?php

   /*
   // Clase logica intermediaria entre el controlador y la data del servicio, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

   class servicioLogic extends logica{

   	private $servicioData;
   	private $servicioValidation;

   	public function __construct(){

		$this->servicioData  = new servicioData();
		$this->servicioValidation = new servicioValidation();
	}

   	public function registrarServicio(servicio $servicio, $idCliente){

   		if($this->servicioData->registrarServicio($servicio, $idCliente)){
   			echo "true";
   		}else{
   			echo "false";
   		}
   	}

    /*
    // Método encargado de gestionar la comprobación de un Número de NIS existente en la base de datos, mediando entre controlador y data
    */

	public function comprobarExistenciaNumeroNIS($numNIS){

      $patternNumNIS = "/^[0-9]*$/";

      if ($this->servicioValidation->validarCamposTextoRegex($numNIS,16,$patternNumNIS)) { //Ver esto

         	if ($this->servicioData->comprobarExistenciaNumeroNIS($numNIS)) {

         		echo "<div id='msjNumNIS' class='alert alert-danger' data-numNIS='false'>
               		  		<strong><span class='glyphicon glyphicon-remove'></span></strong> 
                   			El Número de NIS digitado ya existe, debe cambiarlo
             		 </div>";


         	}else{

         		 echo "<div id='msjNumNIS' class='alert alert-success' data-numNIS='true'>
               				<strong><span class='glyphicon glyphicon-ok'></span></strong> 
                   	  Número de NIS disponible para ser registrado
              		</div>";

         	}

      }else{

        echo "<div id='msjNumNIS' class='alert alert-danger' data-numNIS='false'>
                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                El contenido del campo correspondiente a Número de NIS solo admite números (no más de 16) y no puede estar vacío
              </div>";

      }

		}

    /*
    // Método encargado de construir el formato que tendrán los registros sobre los clientes
    

    public function obtenerServicios($paginaActual, $cantidadServiciosMostrar, $servicioEstado){

      $tablaServicios = "";

      if($paginaActual <= 1){ //sacando el producto actual, donde se toma referencia para mostrar los demás registros
              
        $productoActual = 0;
              
      }else{
              
        $productoActual = $servicioEstado*($paginaActual-1);
              
      }

      $listaServicios = $this->servicioData->obtenerServicios($productoActual,$servicioEstado);

      if($this->servicioValidation->validarArray($listaServicios)){

        $idServicio = "";

        foreach ($listaServicios as $servicio) {
          
          $tablaServicios = $tablaServicios."<tr>";

          foreach ($servicio as $atributoServicio => $valorAtributo) {
            
            if ($atributoServicio == "idServicio") {
               $idServicio = $valorAtributo;

               $tablaServicios = $tablaServicios."<td><select class='form-control acciones' data-cedula='".$dataCedula."'>
                                                                     <option value=''>Elegir</option>
                                                                     <option value='Editar'>Editar</option>
                                                                     <option value='Anular'>Anular</option>
                                                             </select></td>";
            }

            $tablaServicios = $tablaServicios."<td>".$valorAtributo."</td>";
          }

          $tablaServicios = $tablaServicios
        }
      }else{

        $tablaServicios = "<tr><td colspan='8' style='text-align:center;'>No se encontraron resultados</td></tr>";
      }

      $informacionServicios = array("tablaServicios" => $tablaServicios);

      print_r(json_encode($informacionServicios));

    }else{
      $informacionServicios = array("tablaServicios" => "false");

      print_r(json_encode($informacionServicios));
    }
  }
*/
  public function obtenerServicioPorID($idServicio){

    $servicio = $this->servicioData->getServicio($idServicio);

    if ($this->servicioValidation->validarArray($servicio)) {
      //$servicioResultado = array('servicio' => $servicio);

      print_r(json_encode($servicio));
    }else{

      print_r(json_encode("false"));
    }

  }



  public function editarServicio(servicio $servicio){

    if($this->servicioData->editarServicio($servicio)){
        echo "true";
      }else{
        echo "false";
      }
  }

  
}
?>