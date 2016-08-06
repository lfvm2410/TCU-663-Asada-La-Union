<?php

    /*
   // Clase logica intermediaria entre el controlador y la data del telefono, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

	class telefonoLogic{

		private $telefonoData;
		private $generalValidation;

		public function __construct(){

			$this->telefonoData = new telefonoData();
			$this->generalValidation = new generalValidation();
			
		}

		/*
        // Método encargado de setear un telefono en una lista que gestiona la clase data
		*/

		public function setTelefonoALista(telefono $telefono){

			 $this->telefonoData->setTelefonoALista($telefono);

		}

        /*
        // Método encargado de obtener una lista de telefonos en memoria; gestionada por la clase data
        */

		public function getListaTelefonos(){

            return  $this->telefonoData->getListaTelefonos();
         
        }

        /*
        // Método encargado de obtener los telefonos de una persona por su cedula y formatearlos para que el controlador los envie a la vista
        */

        public function formatearTelefonosDePersona($cedula){

        	$patternCedula = "/^[0-9]*$/";
        	
        	if ($this->generalValidation->validarCamposTextoRegex($cedula,16,$patternCedula)) {

        		$telefonosPersona = $this->telefonoData->obtenerTelefonosPorCedulaPersona($cedula);

		        $tablaTelefonos = "<table id='tablaTelefonos' class='table table-striped table-condensed table-bordered table-hover'>
										<thead>
											<tr class='info'>
											    <th>Tipo de teléfono</th>
											    <th>Número de teléfono</th>
											</tr>
										</thead>
										<tbody id='cuerpoTablaTelefonos'>";

        		  //Validando si la lista viene con o sin registros

		          if ($this->generalValidation->validarArray($telefonosPersona)) { //Formateando resultados para la vista (Si pasa el filtro)

		                foreach ($telefonosPersona as $telefono) {

		                 $tablaTelefonos = $tablaTelefonos."<tr>";

			                foreach ($telefono as $atributoTelefono => $valorAtributo) {

			                   $tablaTelefonos = $tablaTelefonos.
			                                    "<td>".$valorAtributo."</td>";

			                }

		                }                
		        
		          }else{

		              $tablaTelefonos = $tablaTelefonos."<tr><td colspan='7' style='text-align:center;'>No se encontraron teléfonos para esta persona</td></tr>";
		          }


		          $tablaTelefonos = $tablaTelefonos."</tbody>
										</table>";

				  $informacionTelefonosPersona = array("tablaTelefonos" => $tablaTelefonos);

          		  print_r(json_encode($informacionTelefonosPersona));

        	}else{

        		$informacionTelefonosPersona = array("tablaTelefonos" => "false");

          		print_r(json_encode($informacionTelefonosPersona));

        	}

        }

	}

?>