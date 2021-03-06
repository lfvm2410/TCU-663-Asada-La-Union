  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    activarEnvioDatos($("#idRegistrarProductoForm"));

   });

  /*
  //Metodo para que el usuario confirme la transaccion
  */

  function confirmarTransaccion(mensaje) {

   return confirm(mensaje);

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

  function enviarFormularioProducto(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("Producto registrado con éxito");

              limpiarCamposForm(idForm);

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de registrar el producto, inténtelo de nuevo");

          }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de registrar el producto, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de registro de producto
  */

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      if (confirmarTransaccion('¿Está seguro de proceder con el registro del producto?')){
            
          var url = "/SisConAsadaLaUnion/producto/registrarProducto";

          var datosFormulario = idForm.serialize();

          enviarFormularioProducto(idForm,url,datosFormulario);

        }

    });

  }