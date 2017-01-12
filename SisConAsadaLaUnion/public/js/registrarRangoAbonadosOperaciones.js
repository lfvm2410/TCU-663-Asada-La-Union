  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    blurCamposGenerico($("#idRangoAbonados"),"abonadoAsada/verificarRangoAbonadosExistente","del rango de abonados ingresado",$("#mensajeVerificacionRangoAbonados"));
    
    activarEnvioDatos($("#idRegistrarRangoAbonadosForm"));

   });

  /*
  //Metodo para enviar el formulario de rango de abonados, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioRangoAbonados(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("Rango de abonados registrado con éxito");

              limpiarCamposForm(idForm);

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de registrar el rango de abonados, inténtelo de nuevo");

          }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de registrar el rango de abonados, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de registro del rango de abonados
  */

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      var verificarRangoAbonados = $("#msjRangoAbonados").attr("data-rangoAbonados");

      if (verificarRangoAbonados == "true") {
        
        if (confirmarTransaccion('¿Está seguro de proceder con el registro del rango de abonados?')){
            
          var url = "/SisConAsadaLaUnion/abonadoAsada/registrarAbonado";

          var datosFormulario = idForm.serialize();

          enviarFormularioRangoAbonados(idForm,url,datosFormulario);

        }

      }

    });

  }