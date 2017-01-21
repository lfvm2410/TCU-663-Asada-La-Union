  /*
  //Archivo .js encargado de contener las operaciones necesarias para anular un cliente
  */

  /*
  // Metodo ajax para anular un cliente
  */

  function anularCliente(cedulaClienteSeleccionado,tablaClientes){

    $.ajax({
          url: "/SisConAsadaLaUnion/cliente/anularCliente",
          type: "POST",
          data: "cedulaCliente="+cedulaClienteSeleccionado,
          success: function(respuesta){

           if (respuesta == "true") {

            //Recargar tabla de información sobre clientes

            if ($("#paginacion").html().length > 0) {

               $("#paginacion").twbsPagination('destroy');
              
            }

            var cantidadFilasTabla = $('#tablaClientes tr').length-2;

            var cedulaNombre = $("#buscarCliente").val().trim();

            if(cantidadFilasTabla == 0 && paginaActualGlb > 1){

              paginaActualGlb--;

            }

            if (cedulaNombre != "") {

              crearListaPaginasPaginacion(paginaActualGlb,"obtenerClientesCedulaNombre",cedulaNombre);

            }else{

              crearListaPaginasPaginacion(paginaActualGlb,"obtenerClientes","false");

            }

            alertify.success("Cliente anulado con éxito");

           }else{

            tablaClientes.closest('select').val("");

            alertify.error("Ha ocurrido un error al tratar de anular el cliente seleccionado");            

           }
          
          },
          error: function(error){

            tablaClientes.closest('select').val("");

            alertify.error("Error de conexión al tratar de anular el cliente seleccionado");

          }

        });

  }