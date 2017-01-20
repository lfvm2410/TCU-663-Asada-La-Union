  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    validarVisualizarImagenesSubidas($("#idImagenesPantallaPresentacion"), $("#idVistaPrevia"));

    activarEnvioDatosPaginaPresentacion($("#idActualizarPaginaPresentacionForm"));

  });

  /*
  // Metodo encargado de validar las imagenes subidas por el usuario
  // Nota: El metodo visualiza las imagenes que cumplan con las validaciones estipuladas
  */

  function validarVisualizarImagenesSubidas(idInputImagenes, idVistaPrevia){

    idInputImagenes.change(function() {

      idVistaPrevia.attr("class", "row");
      idVistaPrevia.attr("data-validacion", "");
      idVistaPrevia.empty();

      var imagenes = $(this).get(0).files
      var navegador = window.URL || window.webkitURL;
      var cantidadImagenesCargadas = 0;

      if (imagenes.length > 0) {

        if (imagenes.length <= 4 ) {

          for (i = 0; i < imagenes.length; i++) {

            var tamanio = imagenes[i].size;
            var tipo = imagenes[i].type;
            var nombre = imagenes[i].name;

            if (tamanio > 1024*(1024*2)) {

              idVistaPrevia.attr("class", "row alert alert-danger");
              idVistaPrevia.attr("data-validacion", "false");
              idVistaPrevia.append("<strong><span class='glyphicon glyphicon-remove'></span></strong> El archivo "+nombre+" supera los 2 MB de tamaño permitido<br>");

            }else if (tipo != "image/jpg" && tipo != "image/jpeg" && tipo != "image/png") {

              idVistaPrevia.attr("class", "row alert alert-danger");
              idVistaPrevia.attr("data-validacion", "false");
              idVistaPrevia.append("<strong><span class='glyphicon glyphicon-remove'></span></strong> El archivo "+nombre+" no es del tipo de imagen permitido<br>");
            
            }else{

              var objetoUrl = navegador.createObjectURL(imagenes[i]);

              idVistaPrevia.append("<img src="+objetoUrl+" width='150' height='150' style='margin-left:2%; margin-bottom:4%;'><br>");
              cantidadImagenesCargadas++;

            }
            
          }

          if (cantidadImagenesCargadas == imagenes.length) {

            idVistaPrevia.attr("class", "row alert alert-success");
            idVistaPrevia.attr("data-validacion", "true");

          }

        }else{

          idVistaPrevia.attr("class", "row alert alert-danger");
          idVistaPrevia.attr("data-validacion", "false");
          idVistaPrevia.append("<strong><span class='glyphicon glyphicon-remove'></span></strong> El máximo de imágenes permitidas es 4<br>");

        }

      }

    });

  }

  /*
  //Metodo para enviar el formulario que contiene la información para la página de presentación, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioPaginaPresentacion(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      contentType: false,
      processData: false,
      async: true,
      beforeSend: function(){

        $("#idMensajeEspera").html('<img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/>');

      },
      success: function(respuesta){

        $("#idMensajeEspera").empty();

        if (respuesta == "true") {

          alertify.success("La información para la página de presentación se ha guardado correctamente en el servidor");

          limpiarCamposForm(idForm);

          $("#idVistaPrevia").attr("class", "row");
          
          $("#idVistaPrevia").attr("data-validacion", "");
          
          $("#idVistaPrevia").empty();

        }else{

          alertify.error("Ha ocurrido un error al tratar de guardar la información para la página de presentación, inténtelo de nuevo");

        }
        
      },
      error: function(error){

        $("#idMensajeEspera").empty();

        alertify.error("Error de conexión al tratar de enviar la información para la página de presentación, inténtelo de nuevo");

      }

    });



  }

  /*
  //Metodo encargado de enviar el formulario con la información para la página de presentación
  */

  function activarEnvioDatosPaginaPresentacion(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      var verificarImagenesSubidas = $("#idVistaPrevia").attr("data-validacion");

      if (verificarImagenesSubidas  != "false") {

        if(confirmarTransaccion("¿Está seguro de proceder con la edición de la información para la pagina de presentación?")) {

        var url = "/SisConAsadaLaUnion/index/guardarInformacionPaginaPresentacion";

        var datosFormulario = new FormData(document.getElementById("idActualizarPaginaPresentacionForm"));

        enviarFormularioPaginaPresentacion(idForm,url,datosFormulario);

        }

      }
      
    });  

  }