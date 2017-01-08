<?php 

   /*
   * Clase encargada de contener todas las operaciones de datos referentes a la clase producto
   */

    class productoData extends modelo{

    	public function __construct(){

    		parent::__construct();
    	}

    	/*
		// Metodo encargado de registrar un producto en la base de datos
    	*/

    	public function registrarProducto(producto $producto){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $nombre = $producto->getNombre();
            $descripcion = $producto->getDescripcion();
            $cantidad = intval($producto->getCantidad());

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_registrarProducto('$nombre','$descripcion',$cantidad)",$conexionBD) or die("Error al tratar de registrar el producto en la base de datos");
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Método encargado de obtener los productos a mostrar
        */

        public function obtenerProductos($productoActual,$limiteProductos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaProductos = mysql_query("call SP_obtenerProductos($productoActual,$limiteProductos)",$conexionBD) or die("Error al tratar de obtener los productos en la base de datos");

            $listaProductos = array();

            if ($consultaProductos) {
                
                if (mysql_num_rows($consultaProductos) > 0) {

                    while ($producto = mysql_fetch_array($consultaProductos)) {

                    $idProducto = $producto['id_Producto'];
                    $nombre = $producto['nombre_Producto'];
                    $descripcion = $producto['descripcion_Producto'];
                    $cantidad = $producto['cantidad_Producto'];
                    $fechaModificacion = $producto['fechaModificacionCantidad_Producto'];
            
                    $listaProductos[] = array('idProducto'=>$idProducto, 'nombre'=>$nombre, 'descripcion'=>$descripcion, 
                        'cantidad'=>$cantidad,'fechaModificacion'=>$fechaModificacion);

                    }

                }

            }

            mysql_close($conexionBD);

            return $listaProductos;

        }

        /*
        // Método encargado de obtener el total de productos registrados en la base de datos
        */

        public function obtenerTotalProductos(){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaTotalProductos = mysql_query("call SP_obtenerTotalProductos()",$conexionBD) or die("Error al tratar de obtener la cantidad total de productos en la base de datos");

            $totalProductos = 0;

            if ($consultaTotalProductos) {
                
                if (mysql_num_rows($consultaTotalProductos) > 0) {

                    $productoTotal = mysql_fetch_array($consultaTotalProductos,MYSQL_NUM);

                    $totalProductos = $productoTotal[0];

                }

            }

            mysql_close($conexionBD);

            return $totalProductos;
        }

        /*
        // Método encargado de obtener los productos a mostrar de acuerdo a el nombre
        */

        public function obtenerProductosNombre($nombre,$productoActual,$limiteProductos){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaProductosNombre = mysql_query("call SP_obtenerProductosNombre('$nombre',$productoActual,$limiteProductos)",$conexionBD) or die("Error al tratar de obtener los productos en la base de datos");

            $listaProductos = array();

            if ($consultaProductosNombre) {
                
                if (mysql_num_rows($consultaProductosNombre) > 0) {

                    while ($producto = mysql_fetch_array($consultaProductosNombre)) {

                    $idProducto = $producto['id_Producto'];
                    $nombre = $producto['nombre_Producto'];
                    $descripcion = $producto['descripcion_Producto'];
                    $cantidad = $producto['cantidad_Producto'];
                    $fechaModificacion = $producto['fechaModificacionCantidad_Producto'];
            
                    $listaProductos[] = array('idProducto'=>$idProducto, 'nombre'=>$nombre, 'descripcion'=>$descripcion, 
                        'cantidad'=>$cantidad,'fechaModificacion'=>$fechaModificacion);

                    }

                }

            }

            mysql_close($conexionBD);

            return $listaProductos;

        }

        /*
        // Método encargado de obtener el total de productos de acuerdo a su nombre registrado en la base de datos
        */

        public function obtenerTotalProductosNombre($nombre){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaTotalProductosNombre = mysql_query("call SP_obtenerTotalProductosNombre('$nombre')",$conexionBD) or die("Error al tratar de obtener la cantidad total de productos en la base de datos");

            $totalProductosNombre = 0;

            if ($consultaTotalProductosNombre) {
                
                if (mysql_num_rows($consultaTotalProductosNombre) > 0) {

                    $productoTotal = mysql_fetch_array($consultaTotalProductosNombre,MYSQL_NUM);

                    $totalProductosNombre = $productoTotal[0];

                }

            }

            mysql_close($conexionBD);

            return $totalProductosNombre;
        }

        /*
        // Método encargado de obtener un producto por id
        */

        public function getProductoPorId($idProducto){

        	$idProducto = intval($idProducto);

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $consultaProducto = mysql_query("call SP_obtenerProductoPorId($idProducto)",$conexionBD) or die("Error al tratar de obtener la información del producto seleccionado en la base de datos");

            $productoSeleccionado = array();

            if ($consultaProducto) {
                
                if (mysql_num_rows($consultaProducto) > 0) {

                    while ($producto = mysql_fetch_array($consultaProducto)) {

                    $idProducto = $producto['id_Producto'];
                    $nombre = $producto['nombre_Producto'];
                    $descripcion = $producto['descripcion_Producto'];
                    $cantidad = $producto['cantidad_Producto'];
                    $fechaModificacion = $producto['fechaModificacionCantidad_Producto'];
            
                    $productoSeleccionado[] = array('idProducto'=>$idProducto, 'nombre'=>$nombre, 'descripcion'=>$descripcion, 
                        'cantidad'=>$cantidad);

                    }

                }

            }

            mysql_close($conexionBD);

            return $productoSeleccionado;

        }

        /*
		// Metodo encargado de editar un producto en la base de datos
    	*/

    	public function editarProducto(producto $producto){

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $idProducto = intval($producto->getIdProducto());
            $nombre = $producto->getNombre();
            $descripcion = $producto->getDescripcion();
            $cantidad = intval($producto->getCantidad());

            $estadoTransaccion = false;

            $estadoTransaccion = mysql_query("call SP_editarProducto($idProducto,'$nombre','$descripcion',$cantidad)",$conexionBD);
               
            mysql_close($conexionBD);     

            return $estadoTransaccion;
            
        }

        /*
        // Método encargado de eliminar un producto en la base de datos
        */

        public function eliminarProducto($idProducto){

        	$idProducto = intval($idProducto);

            $conexionBD = $this->getConexionInstance()->getConexion();

            mysql_set_charset('utf8');

            $estadoTransaccion = false;

            $eliminarProducto = mysql_query("call SP_eliminarProducto($idProducto)",$conexionBD) or die("Error al tratar de eliminar el producto seleccionado en la base de datos");
            
            if ($eliminarProducto) {
                
                $estadoTransaccion = true;

            }

            mysql_close($conexionBD);

            return $estadoTransaccion;
        }

    }   

?>