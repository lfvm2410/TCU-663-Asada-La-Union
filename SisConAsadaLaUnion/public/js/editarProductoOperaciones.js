  /*
  //Archivo .js encargado de contener las validaciones y operaciones sobre el formulario de editar producto
  */

  /*
  // Metodo ajax para cargar un producto por su id
  */

  function cargarProductoPorId(idProductoSeleccionado){

    $.ajax({
          url: "/SisConAsadaLaUnion/producto/obtenerProductoPorId",
          type: "POST",
          data: { idProducto : idProductoSeleccionado },
          dataType: "json",
          success: function(respuesta){

           if (respuesta != "false") {

            var idProductoActual = respuesta.idProducto;

            $("#idNombreProducto").val(respuesta.nombre);
            $("#idDescripcionProducto").val(respuesta.descripcion);
            $("#idCantidadProducto").val(respuesta.cantidad);

            var idForm = $("#idEditarProductoForm");

            //Desasociar eventos de componentes
            idForm.unbind("submit");

            //Activar .submit del formulario
            activarEnvioDatos(idForm,idProductoActual);

            $("#editarProducto").dialog("open");
           
           }else{

            alertify.error("Ha ocurrido un error al tratar de cargar la información del producto seleccionado");            

           }
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de cargar la información del producto seleccionado");

          }

    });

  }

  /*
  //Metodo para limpiar campos de formulario
  */

  function limpiarCamposForm(idForm){

    idForm.each (function(){
      
      this.reset();

    });

  }

  /*
  //Metodo para enviar el formulario de producto, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioProducto(idForm,url,idProductoActual,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: "idProducto="+idProductoActual+"&"+datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("La información del producto seleccionado se ha editado correctamente");
             
              $("#editarProducto").dialog("close");
             
              limpiarCamposForm(idForm);

              //Se recarga la tabla de productos
              if ($("#paginacion").html().length > 0) {

                  $("#paginacion").twbsPagination('destroy');
              
                }

                var cantidadFilasTabla = $('#tablaProductos tr').length-1;
                
                var busquedaNombre = $("#buscarProducto").val().trim();
                
                if(cantidadFilasTabla == 0 && paginaActualGlb > 1){

                  paginaActualGlb--;

                }

                if (busquedaNombre != "") {

                  crearListaPaginasPaginacion(paginaActualGlb,"obtenerProductosNombre",busquedaNombre);

                }else{

                  crearListaPaginasPaginacion(paginaActualGlb,"obtenerProductos","false");

                }

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de editar la información del producto seleccionado, inténtelo de nuevo");

          }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de editar la información del producto seleccionado, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de edición del producto seleccionado
  */

  function activarEnvioDatos(idForm,idProducto){

    idForm.on('submit', function(e){

      e.preventDefault();

      if (confirmarTransaccion('¿Está seguro de proceder con la edición de información del producto seleccionado?')){
            
          var url = "/SisConAsadaLaUnion/producto/editarProducto";

          var datosFormulario = idForm.serialize();

          enviarFormularioProducto(idForm,url,idProducto,datosFormulario);

        }

    });

  }