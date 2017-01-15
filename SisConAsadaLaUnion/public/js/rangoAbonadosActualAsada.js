  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    llenarCombobox($("#idRangoAbonadosActualAsada"),"abonadoAsada/llenarComboRangoAbonadosActualAsada","la lista desplegable de rango de abonados");

    activarEnvioDatos($("#idRegistrarRangoAbonadosActualAsadaForm"));

   });

  /*
  //Metodo para enviar el formulario de rango de abonados actual de la asada, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioRangoAbonadosActualAsada(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("Rango de abonados actual de la ASADA guardado con éxito");

              limpiarCamposForm(idForm);

              llenarCombobox($("#idRangoAbonadosActualAsada"),"abonadoAsada/llenarComboRangoAbonadosActualAsada","la lista desplegable de rango de abonados");

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de guardar el rango de abonados actual de la ASADA, inténtelo de nuevo");

          }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de guardar el rango de abonados actual de la ASADA, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de guardar el rango de abonados actual de la asada
  */

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();
            
      var url = "/SisConAsadaLaUnion/abonadoAsada/guardarRangoAbonadosActualAsada";

      var datosFormulario = idForm.serialize();

      enviarFormularioRangoAbonadosActualAsada(idForm,url,datosFormulario);

    });

  }