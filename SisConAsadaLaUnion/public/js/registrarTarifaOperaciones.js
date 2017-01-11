  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    llenarComboboxRangoAbonados();

    activarEnvioDatos($("#idRegistrarTarifaForm"));

   });

  /*
  //Metodo para enviar el formulario de tarifa, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioTarifa(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("Tarifa registrada con éxito");

              limpiarCamposForm(idForm);

              llenarComboboxRangoAbonados();

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de registrar la tarifa, inténtelo de nuevo");

          }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de registrar la tarifa, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de registro de la tarifa
  */

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      if (confirmarTransaccion('¿Está seguro de proceder con el registro de la tarifa?')){
            
          var url = "/SisConAsadaLaUnion/tarifa/registrarTarifa";

          var datosFormulario = idForm.serialize();

          enviarFormularioTarifa(idForm,url,datosFormulario);

        }

    });

  }