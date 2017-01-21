  $(document).on("ready", function () {

    var idForm = $("#idRegistrarServicioForm");

    var idnumNIS = $("#idnumNIS");

    blurCampos(idnumNIS,"verificarNumNISExistente","del Número de NIS ingresadO",$('#mensajeVerificacionNumNIS'));
    
    activarEnvioDatos(idForm);

  });

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault(); 

      var verificarNumNIS = $("#msjNumNIS").attr("data-numNIS");

      if (verificarNumNIS == "true") {

        if (confirmarTransaccion('¿Está seguro de proceder con el registro del servicio?')) 
            {
            
                var url = "/SisConAsadaLaUnion/servicio/registrarServicio";

                var datosFormulario = idForm.serialize();

                enviarFormularioServicio(idForm,url,datosFormulario);

            }

      }

    });

  }

  /*
  //Metodo para enviar el formulario de cliente, usa ajax para la comunicacion del servidor
  */

    function enviarFormularioServicio(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("Servicio registrado con éxito");

              limpiarCamposForm(idForm);

              $('#mensajeVerificacionNumNIS').html("");

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de registrar el Servicio, inténtelo de nuevo");

      }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de registrar el Servicio, inténtelo de nuevo");

      }

    });
    }

  /*
  //Metodo para activar evento blur en el campo que se necesite
  */

    function blurCampos(idCampo,metodoNombre,mensajeError,idDivMensaje){

        idCampo.blur(function(){

            var datosEnvio = idCampo.val().trim();

            if (datosEnvio!="") {

                if(metodoNombre == "verificarNumNISExistente"){

                    if (!datosEnvio.match("^[0-9]*$")) {

                      idDivMensaje.html("<div class='alert alert-danger'>"+
                                "<strong><span class='glyphicon glyphicon-remove'></span></strong>"+
                                " El contenido del campo correspondiente a Número de NIS solo puede admitir números</div>");

                    }else{

                      verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError,idDivMensaje);
                    
                    }
                }

            }
        });
    }


  /*
  //Metodo ajax que permite verificar la existencia de varios campos del formulario en la base de datos
  */

  function verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError,idDivMensaje){

        $.ajax({
          url: "/SisConAsadaLaUnion/servicio/"+metodoNombre,
          type: "POST",
          data: "valor="+datosEnvio,
          beforeSend: function(){

            idDivMensaje.fadeIn(1000).html('<img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/>');

          },
          success: function(respuesta){

            idDivMensaje.fadeIn(1000).html(respuesta);
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de verificar la disponibilidad "+mensajeError);

          }

        });

  }

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