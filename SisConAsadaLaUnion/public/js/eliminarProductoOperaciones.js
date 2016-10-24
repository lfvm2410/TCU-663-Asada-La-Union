  /*
  //Archivo .js encargado de contener las operaciones necesarias para eliminar un producto
  */

  /*
  // Metodo ajax para eliminar un producto
  */

  function eliminarProducto(idProductoSeleccionado,tablaProductos){

    $.ajax({
          url: "/SisConAsadaLaUnion/producto/eliminarProducto",
          type: "POST",
          data: "idProducto="+idProductoSeleccionado,
          success: function(respuesta){

           if (respuesta == "true") {

            //Recargar tabla de información sobre los productos

            if ($("#paginacion").html().length > 0) {

               $("#paginacion").twbsPagination('destroy');
              
            }

            var cantidadFilasTabla = $('#tablaProductos tr').length-2;

            var busquedaNombre = $("#buscarProducto").val().trim();

            if(cantidadFilasTabla == 0 && paginaActualGlb > 1){

              paginaActualGlb--;

            }

            if (busquedaNombre != "") {

              crearListaPaginasPaginacion(paginaActualGlb,"obtenerProductosNombre",busquedaNombre);

            }else{

              crearListaPaginasPaginacion(paginaActualGlb,"obtenerProductos","false");

            }

            alertify.success("Producto eliminado con éxito");

           }else{

            tablaProductos.closest('select').val("");

            alertify.error("Ha ocurrido un error al tratar de eliminar el producto seleccionado");            

           }
          
          },
          error: function(error){

            tablaProductos.closest('select').val("");

            alertify.error("Error de conexión al tratar de eliminar el producto seleccionado");

          }

        });

  }