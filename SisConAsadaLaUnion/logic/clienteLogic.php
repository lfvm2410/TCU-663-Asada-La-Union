<?php

   /*
   // Clase logica intermediaria entre el controlador y la data del cliente, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

	class clienteLogic{

		private $clienteData;
    private $personaData;
    private $clienteValidation;
    private $personaValidation;
    private $telefonoValidation;
    
		public function __construct(){

			$this->clienteData = new clienteData();
      $this->personaData = new personaData();
      $this->clienteValidation = new clienteValidation();
      $this->personaValidation = new personaValidation();
      $this->telefonoValidation = new telefonoValidation();

		}

		/*
    // Método encargado de gestionar el registro del cliente, mediando entre controlador y data
		*/

		public function registrarCliente(cliente $cliente, telefono $telefono1, telefono $telefono2){

          $patternTelefono = "/^[0-9]{8}$/";

          if ($this->personaValidation->validarCedula($cliente->getCedula(),$this->personaData) &&
              $this->clienteValidation->validarCamposTexto($cliente->getNombre(),30) &&
              $this->clienteValidation->validarCamposTexto($cliente->getApellidos(),30) &&
              $this->personaValidation->validarCorreoElectronico($cliente->getCorreoElectronico(),$this->personaData) &&
              $this->telefonoValidation->validarTipoTelefonoRequerido($telefono1->getTipo()) &&
              $this->telefonoValidation->validarCamposTextoRegex($telefono1->getNumero(),8,$patternTelefono) &&
              $this->clienteValidation->validarCamposTexto($cliente->getDireccion(),300) &&
              $this->clienteValidation->validarNumPlano($cliente->getNumeroPlano(),$this->clienteData)) {

              $telefonoLogic = new telefonoLogic();

              $telefonoLogic->setTelefonoALista($telefono1);

              if ($this->telefonoValidation->validarTipoTelefonoRequerido($telefono2->getTipo()) &&
                  $this->telefonoValidation->validarCamposTextoRegex($telefono2->getNumero(),8,$patternTelefono)) {

                  $telefonoLogic->setTelefonoALista($telefono2);
                
              }

              if ($this->clienteValidation->validarCamposTexto($cliente->getNumeroPlano(),16)) {
                
                  $cliente->setNumeroPlano("'".$cliente->getNumeroPlano()."'");

              }else{

                  $cliente->setNumeroPlano('NULL');
                  
              }

              $listaTelefonos = $telefonoLogic->getListaTelefonos(); 

              if($this->clienteData->registrarCliente($cliente,$listaTelefonos)){

                echo "true";
                
              }else{

                echo "false";
              }
                
          }else{

            echo "false";

          }

		}

		/*
   	// Método encargado de gestionar la comprobación de un número de plano existente en la base de datos, mediando entre controlador y data
    */

		public function comprobarExistenciaNumeroPlano($numeroPlano){

      if ($this->clienteValidation->validarCamposTexto($numeroPlano,16)) {

         	if ($this->clienteData->comprobarExistenciaNumeroPlano($numeroPlano)) {

         		echo "<div id='msjPlano' class='alert alert-danger' data-plano='false'>
               		  		<strong><span class='glyphicon glyphicon-remove'></span></strong> 
                   			El número de plano digitado ya existe, debe cambiarlo
             		 </div>";


         	}else{

         		 echo "<div id='msjPlano' class='alert alert-success' data-plano='true'>
               				<strong><span class='glyphicon glyphicon-ok'></span></strong> 
                   	    	Número de plano disponible para ser registrado
              		   </div>";

         	}

      }else{

        echo "<div id='msjPlano' class='alert alert-danger' data-plano='false'>
                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                Para verificar si un número de plano ya existe, es necesario que el contenido del campo correspondiente a él no este vacío y no se exceda de 16 caracteres
              </div>";

      }

		}

    /*
    // Método encargado de calcular la totalidad de páginas de acuerdo a la cantidad de clientes habidos en el sistema
    */
    
    public function totalidadPaginasClientes($permisoConsultaTotalPaginas,$metodo,$busqueda,$cantidadClientesAMostrar,$clientesActivos){

      if (strcmp($permisoConsultaTotalPaginas,"true") == 0 && $this->clienteValidation->validarMetodoBusquedaClientes($metodo) &&
          $this->clienteValidation->validarCamposTexto($busqueda,30)) { //Validando parametros de entrada

        if (strcmp($metodo, "obtenerClientes") == 0) { //Determina a cual lista de clientes se le va a sacar la cantidad total de sus registros

          $cantidadTotalClientes = $this->clienteData->obtenerTotalClientes($clientesActivos);
          
        }else{

          $patternCedula = "/^[0-9]*$/";

          //Determina si la cedula cumple con lo necesario para ser tomada en cuenta

          if ($this->clienteValidation->validarCamposTextoRegex($busqueda,16,$patternCedula)) {

            $cedula = $busqueda;
            
          }else{

            $cedula = "false";
          
          }

          $nombre = $busqueda; // Al haber pasado el primer filtro (if validacion entrada), entonces siempre será igual a la busqueda

          $cantidadTotalClientes = $this->clienteData->obtenerTotalClientesCedulaNombre($cedula,$nombre,$clientesActivos);

        }

        $totalPaginas = ceil($cantidadTotalClientes/$cantidadClientesAMostrar); //Con la totalidad de clientes habidos en X lista, se saca la totalidad de páginas

        $paginasClientes = array("totalPaginas" => $totalPaginas);

        print_r(json_encode($paginasClientes));
        
      }else{

        $paginasClientes = array("totalPaginas" => "false");

        print_r(json_encode($paginasClientes));

      }

    }

    /*
    // Método encargado de construir el formato que tendrán los registros sobre los clientes
    */

    public function formatoConsultarClientes($paginaActual,$metodo,$busqueda,$cantidadClientesAMostrar,$clientesActivos){

      if (intval($paginaActual) != 0 && $this->clienteValidation->validarMetodoBusquedaClientes($metodo) &&
          $this->clienteValidation->validarCamposTexto($busqueda,30)) { //Validando parametros de entrada
        
          $tablaClientes = "";

          if($paginaActual <= 1){ //sacando el cliente actual, donde se toma referencia para mostrar los demás registros
            
               $clienteActual = 0;
            
          }else{
            
               $clienteActual = $cantidadClientesAMostrar*($paginaActual-1);
            
          }

          if (strcmp($metodo, "obtenerClientes") == 0) { //Determina a cual lista de clientes llama

          $listaClientes = $this->clienteData->obtenerClientes($clienteActual,$cantidadClientesAMostrar,$clientesActivos);
          
          }else{

            $patternCedula = "/^[0-9]*$/";

            //Determina si la cédula cumple con lo necesario para ser tomada en cuenta

            if ($this->clienteValidation->validarCamposTextoRegex($busqueda,16,$patternCedula)) {

              $cedula = $busqueda;
              
            }else{

              $cedula = "false";
            
            }

            $nombre = $busqueda; // Al haber pasado el primer filtro (if validacion entrada), entonces siempre será igual a la busqueda

            $listaClientes = $this->clienteData->obtenerClientesCedulaNombre($cedula,$nombre,$clienteActual,$cantidadClientesAMostrar,$clientesActivos);

          }

          //Formateo de registros para redireccionar al controlador, que posteriormente lo enviará a la vista que lo solicite

          //Validando si la lista viene con o sin registros

          if ($this->clienteValidation->validarArray($listaClientes)) { //Formateando resultados para la vista (Si pasa el filtro)

                $dataCedula = "";

                foreach ($listaClientes as $cliente) {

                    $tablaClientes = $tablaClientes."<tr>";

                    foreach ($cliente as $atributoCliente => $valorAtributo) {

                       if ($atributoCliente == "cedula") {

                         $dataCedula = $valorAtributo;

                         $tablaClientes = $tablaClientes."<td><select class='form-control acciones' data-cedula='".$dataCedula."'>
                                                                     <option value=''>Elegir</option>
                                                                     <option value='Editar'>Editar</option>
                                                                     <option value='Anular'>Anular</option>
                                                             </select></td>";
                       }

                       $tablaClientes = $tablaClientes.
                                        "<td>".$valorAtributo."</td>";

                    }

                    $tablaClientes = $tablaClientes.
                                       "<td>
                                          <a href='#'><img class='img-telefono img-responsive center-block' data-cedula='".$dataCedula."' src='".URL."/public/assets/images/TelefonoLogo.png' width='32px'/></a>
                                        </td>
                                      </tr>";
                }                 
        
          }else{

              $tablaClientes = "<tr><td colspan='8' style='text-align:center;'>No se encontraron resultados</td></tr>";
          }

          $informacionClientes = array("tablaClientes" => $tablaClientes);

          print_r(json_encode($informacionClientes));

      }else{

        $informacionClientes = array("tablaClientes" => "false");

        print_r(json_encode($informacionClientes));
      
      }

    }

    /*
    // Metodo encargado de gestionar la activacion o anulacion de un cliente
    */

    public function actualizarEstadoCliente($cedulaCliente,$activoCliente){

      if ($this->personaValidation->validarCedulaExistente($cedulaCliente,$this->personaData)) {

        if ($this->clienteData->actualizarActivoCliente($cedulaCliente,$activoCliente)) {
          
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