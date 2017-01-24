  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    cargarPersonalAsada();

    crearVentanaModal($("#verNumsTel"),500,180,"true");

    crearVentanaModal($("#idEnviarSugerenciaModal"),800,420,"false");

    levantarVentanaModalTelefonos($("#verNumsTel"));

    levantarVentanaModalEnviarSugerencia();

    activarEnvioDatosSugerencia($("#idEnviarSugerenciaForm"));

  });

  /*
  //Metodo encargado de cargar la informacion del personal de la asada
  */

  function cargarPersonalAsada(){

    $.ajax({
      url: "/SisConAsadaLaUnion/index/obtenerPersonalAsada",
      type: "POST",
      success: function(respuesta){

        $("#tablaPersonalAsada").empty();

        $(respuesta).each(function(index) {
        
          $("#tablaPersonalAsada").append("<tr>"+
                                              "<td><strong class='glyphicon glyphicon-chevron-right'></strong> "+respuesta[index].nombreCompleto+"</td>"+
                                              "<td>"+respuesta[index].tipo+"</td>"+
                                              "<td>"+respuesta[index].puesto+"</td>"+
                                              "<td>"+respuesta[index].descripcionPuesto+"</td>"+
                                              "<td>"+respuesta[index].correoElectronico+"</td>"+
                                              "<td><a href='#'><img class='img-telefono img-responsive center-block' data-identificador='"+respuesta[index].idPersona+"' src='/SisConAsadaLaUnion/public/assets/images/TelefonoLogo.png' width='32px'/></a></td>"+
                                          "</tr>");

        });     
          
      },
      error: function(error){

        alertify.error("Error de conexión al tratar de cargar la lista del personal que trabaja para la ASADA");

      }
      
    });

  }

  /*
  //Metodo encargado de gestionar la carga de los telefonos de una persona con el servidor
  */

  function cargarTelefonosPersona(idPersonaActual,idVentanaNumsTel){

        $.ajax({
          url: "/SisConAsadaLaUnion/index/consultarTelefonosPersonaPorId",
          type: "POST",
          data: { idPersona : idPersonaActual },
          dataType: "json",
          beforeSend: function(){

            idVentanaNumsTel.html('<img style="position:absolute; top:50%; left:46.5%; transform:translateY(-50%);" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/>');
            
            idVentanaNumsTel.dialog("open");

          },
          success: function(respuesta){

            idVentanaNumsTel.empty();

            if (respuesta["tablaTelefonos"] != "false") {

              var informacionTelefonosPersona = eval(respuesta);
      
              idVentanaNumsTel.html(informacionTelefonosPersona["tablaTelefonos"]);

            }else{

              alertify.error("Error al tratar de cargar los números de teléfono de la persona seleccionada en la ventana modal, la función esperaba un parámetro no vacío y de tipo numérico");

            }
          
          },
          error: function(error){

            idVentanaNumsTel.empty();

            alertify.error("Error de conexión al tratar de cargar los números de teléfono de la persona seleccionada en la ventana modal");

          }

        });

  }

  /*
  // Metodo encargado de levantar la ventana modal de los números de teléfono de una persona
  */

  function levantarVentanaModalTelefonos(idVentanaNumsTel){

     $("#tablaPersonalAsada").on("click", ".img-telefono", function(e){

        var idPersona = $(this).attr("data-identificador");

        cargarTelefonosPersona(idPersona,idVentanaNumsTel);

      });

  }

  /*
  //Metodo encargado de levantar la ventana modal para enviar una sugerencia
  */

  function levantarVentanaModalEnviarSugerencia(){

    $("#idEnviarSugerencia").click(function() {
      
      $("#idEnviarSugerenciaModal").dialog("open");

    });

  }

  /*
  //Metodo para enviar el formulario de sugerencia, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioSugerencia(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

        if (respuesta == "true") {

          alertify.success("La sugerencia se ha enviado satisfactoriamente");

          $("#idEnviarSugerenciaModal").dialog("close");

          limpiarCamposForm(idForm);

        }else{

          alertify.error(respuesta);

        }
        
      },
      error: function(error){

        alertify.error("Error de conexión al tratar de enviar la sugerencia, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo encargado de enviar el formulario de sugerencia
  */

  function activarEnvioDatosSugerencia(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      var url = "/SisConAsadaLaUnion/index/enviarSugerencia";

      var datosFormulario = idForm.serialize();

      enviarFormularioSugerencia(idForm,url,datosFormulario);
      
    });  

  }