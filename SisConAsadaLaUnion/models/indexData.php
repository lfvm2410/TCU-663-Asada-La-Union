<?php

    /*
    * Clase encargada de contener todas las operaciones de datos referentes a index
    */

    class indexData extends modelo{
    		
    	public function __construct(){

            parent::__construct();
    	
    	}

        /*
        // Metodo encargado de eliminar las imagenes adjuntas para ser visualizadas en la página de presentación
        */

        private function eliminarImagenesPaginaPresentacion($listaImagenes){

          if(file_exists($listaImagenes['tmp_name'][0]) || is_uploaded_file($listaImagenes['tmp_name'][0])) {
               
            $imagenes = glob(RUTA_IMAGENES_PAGINA_PRESENTACION."*");

            foreach ($imagenes as $imagen) {

              if (is_file($imagen)) {

                $borrarImagen = unlink($imagen);

                if(!$borrarImagen){

                  return false;

                }
              
              }

            }

            return true;

          }else{

            return true;

          }

        }

        /*
        // Metodo encargado de guardar las imagenes adjuntas para ser visualizadas en la página de presentación
        */

        private function guardarImagenesPaginaPresentacion($listaImagenes){

          if(file_exists($listaImagenes['tmp_name'][0]) || is_uploaded_file($listaImagenes['tmp_name'][0])) {

            $cantidadImagenes = count($listaImagenes['name']);

            for($i = 0; $i < $cantidadImagenes; $i++) {

              $pathImagen = $listaImagenes['name'][$i];
              $extensionImagen = pathinfo($pathImagen, PATHINFO_EXTENSION);

              $crearImagen = move_uploaded_file($listaImagenes['tmp_name'][$i], 
                                                RUTA_IMAGENES_PAGINA_PRESENTACION."image".($i+1).".".$extensionImagen);

              if (!$crearImagen){

                return false;

              } 

            }

            return true;

          }else{

            return true;

          }

        }

        
        /*
        // Metodo encargado de obtener el id del abonado actual de la asada
        */

        public function obtenerInformacionPaginaPresentacion(){

            $infoPaginaPresentacion = array();

            $paginaPresentacion = simplexml_load_file(XML."paginaPresentacion.xml");

            $quienesSomos = $paginaPresentacion[0]->quienesSomos;
            $mision = $paginaPresentacion[0]->mision;
            $vision = $paginaPresentacion[0]->vision;
            $valores = $paginaPresentacion[0]->valores;

            $infoPaginaPresentacion = array('quienesSomos' => $quienesSomos, 
                             'mision' => $mision, 
                             'vision' => $vision, 
                             'valores' => $valores);
            
            return $infoPaginaPresentacion;

        }

        /*
        // Metodo encargado de guardar la información para la página de presentación
        */

        public function guardarInformacionPaginaPresentacion($quienesSomos, $mision, $vision, $valores, $listaImagenes){

            $paginaPresentacion = simplexml_load_file(XML."paginaPresentacion.xml");
                
            $paginaPresentacion[0]->quienesSomos = $quienesSomos;
            $paginaPresentacion[0]->mision = $mision;
            $paginaPresentacion[0]->vision = $vision;
            $paginaPresentacion[0]->valores = $valores;

            $paginaPresentacion->asXML(XML."paginaPresentacion.xml");

            if ($this->eliminarImagenesPaginaPresentacion($listaImagenes) &&
                $this->guardarImagenesPaginaPresentacion($listaImagenes)) {
                
                return true;

            }else{

                return false;

            }

        }
        
    }
    
?>