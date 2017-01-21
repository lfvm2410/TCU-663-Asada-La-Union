<?php

    /*
   // Clase logica intermediaria entre el controlador y la data de abonadoAsada, tiene como objetivo validar
   // reglas de negocio y gestionar los llamados hacia la data
   */

	class abonadoAsadaLogic extends logica{

		private $abonadoAsadaData;
		private $abonadoAsadaValidation;

		public function __construct(){

			$this->abonadoAsadaData = new abonadoAsadaData();
			$this->abonadoAsadaValidation = new abonadoAsadaValidation();
			
		}

		/*
	    // Metodo encargado de gestionar el registro de un abonado
	    */

	    public function registrarAbonado(abonadoAsada $abonadoAsada){

	      if ($this->abonadoAsadaValidation->validarRangoAbonados($abonadoAsada->getRango())) {

	        if ($this->abonadoAsadaData->registrarAbonado($abonadoAsada)) {

	          echo "true";
	          
	        }else{

	          echo "false";

	        }    

	      }else{

	        echo "false";

	      }

	    }

	    /*
	    // Metodo encargado de gestionar la edicion de un abonado
	    */

	    public function editarAbonado(abonadoAsada $abonadoAsada, $rangoAbonadosActual){

	      if ($this->abonadoAsadaValidation->validarIdAbonadoAsada($abonadoAsada->getIdAbonadoAsada()) &&
	      	  $this->abonadoAsadaValidation->validarRangoAbonadosEnEdicion($rangoAbonadosActual, $abonadoAsada->getRango())) {

	        if ($this->abonadoAsadaData->editarAbonado($abonadoAsada)) {

	          echo "true";
	          
	        }else{

	          echo "false";

	        }    

	      }else{

	        echo "false";

	      }

	    }

	    /*
		//Metodo encargado de comprobar la existencia de un rango de abonados
	    */

		public function comprobarExistenciaRangoAbonados($rangoAbonados){

			if ($this->abonadoAsadaValidation->validarCamposTexto($rangoAbonados, 16)) {

		        if ($this->abonadoAsadaData->comprobarExistenciaRangoAbonados($rangoAbonados)) {

		         	echo "<div id='msjRangoAbonados' class='alert alert-danger' data-rangoAbonados='false'>
		              	  	<strong><span class='glyphicon glyphicon-remove'></span></strong> 
		              	   	El rango de abonados digitado ya existe, debe cambiarlo
		            	  </div>";

		        }else{

		         	echo "<div id='msjRangoAbonados' class='alert alert-success' data-rangoAbonados='true'>
		               	  	<strong><span class='glyphicon glyphicon-ok'></span></strong> 
		                   	Rango de abonados disponible para ser registrado
		              	  </div>";

		        }

		      }else{

		        echo "<div id='msjRangoAbonados' class='alert alert-danger' data-rangoAbonados='false'>
		                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
		                El contenido del campo correspondiente a rango de abonados admite un máximo de 16 caracteres y no puede estar vacío
		              </div>";

		      }

		}

		/*
	    // Método encargado de gestionar la comprobación de un rango de abonados (en edición) existente en la base de datos
	    */

	    public function comprobarExistenciaRangoAbonadosEnEdicion($rangoAbonadosActual, $rangoAbonadosNuevo){

	      if ($this->abonadoAsadaValidation->validarCamposTexto($rangoAbonadosActual, 16) &&
	          $this->abonadoAsadaValidation->validarCamposTexto($rangoAbonadosNuevo, 16)) {

	          if ($this->abonadoAsadaData->comprobarExistenciaCampoEnEdicion("tbAbonadoAsada","rango_AbonadoAsada",$rangoAbonadosActual,$rangoAbonadosNuevo)) {

	            echo "<div id='msjRangoAbonados' class='alert alert-danger' data-rangoAbonados='false'>
			              	  	<strong><span class='glyphicon glyphicon-remove'></span></strong> 
			              	   	El rango de abonados digitado ya existe, debe cambiarlo
			            	  </div>";

	          }else{

	             echo "<div id='msjRangoAbonados' class='alert alert-success' data-rangoAbonados='true'>
			               	  	<strong><span class='glyphicon glyphicon-ok'></span></strong> 
			                   	Rango de abonados disponible para ser registrado
			              	  </div>";

	          }

	      }else{

	        echo "<div id='msjRangoAbonados' class='alert alert-danger' data-rangoAbonados='false'>
			                <strong><span class='glyphicon glyphicon-remove'></span></strong> 
			                El contenido del campo correspondiente a rango de abonados admite un máximo de 16 caracteres y no puede estar vacío
			              </div>";

	      }

	    }

	    /*
    	// Metodo encargado de obtener un abonado por su id
    	*/

	    public function obtenerAbonadoPorId($idAbonadoAsada){

	      if ($this->abonadoAsadaValidation->validarCamposNumericosEnteros($idAbonadoAsada)) {

	          $abonadoAsada = $this->abonadoAsadaData->obtenerAbonadoPorId($idAbonadoAsada);

	          if ($this->abonadoAsadaValidation->validarArray($abonadoAsada)) {
	              
	            print_r(json_encode($abonadoAsada));
	                  
	          }else{

	            print_r(json_encode("false"));

	          }

	      }else{

	          print_r(json_encode("false"));

	      }

	    }

	    /*
    	// Metodo encargado de formatear las opciones para el combobox de rango de abonados actual de la asada
   		*/
    	
    	public function formatearComboBoxRangoAbonadosActual(){

      		$listaAbonadosAsada = $this->abonadoAsadaData->obtenerRangosAbonadosAsada();

      		$abonadoAsadaActual = $this->abonadoAsadaData->obtenerIdAbonadoActualAsada();

      		$optionsList = "<option value=''>Seleccione</option>";

	        foreach ($listaAbonadosAsada as $abonadoAsada) {

	        	if (strcmp($abonadoAsadaActual, $abonadoAsada['id']) == 0) {

	        		$optionsList .= "<option value='".$abonadoAsada['id']."' selected>"
	                              .$abonadoAsada['rango']."</option>";
	        		
	        	}else{

	        		$optionsList .= "<option value='".$abonadoAsada['id']."'>"
	                              .$abonadoAsada['rango']."</option>";

	        	}

	        }               
            
      		print_r(json_encode(array("optionsList" => $optionsList)));

    	}

    	/*
		// Metodo encargado de guardar el rango de abonados actual de la asada
    	*/

    	public function guardarRangoAbonadosActualAsada($rangoAbonadosActualAsada){

    		if ($this->abonadoAsadaValidation->validarIdAbonadoAsada($rangoAbonadosActualAsada)) {

    			if ($this->abonadoAsadaData->guardarRangoAbonadosActualAsada($rangoAbonadosActualAsada)) {
    				
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