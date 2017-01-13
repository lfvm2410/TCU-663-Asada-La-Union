  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    validarArchivoAdjunto($("#idDisponibilidadHidrica"));

    validarArchivoAdjunto($("#idArregloPagos"));

    activarEnvioDatosAdjuntarArchivos($("#idAdjuntarArchivosForm"));

  });

  /*
  //Metodo que valida que el archivo adjunto sea de extensión .pdf
  */

  function validarArchivoAdjunto(idInputArchivo){

    idInputArchivo.on("change",function(){

      if($(this).get(0).files.length > 0){

        var formatoArchivo = $(this).get(0).files[0].type;

        if (formatoArchivo != "application/pdf"){

          alertify.alert("Extensión de archivo no permitida; el archivo debe ser un PDF");

          $(this).val("");

        }

      }

    });

  }

  /*
  //Metodo para enviar el formulario de adjuntar archivos, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioAdjuntarArchivos(idForm,url,datosFormulario){

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

          alertify.success("Los archivos se han guardado correctamente en el servidor");

          limpiarCamposForm(idForm);

        }else{

          alertify.error("Ha ocurrido un error al tratar de guardar los archivos en el servidor, inténtelo de nuevo");

        }
        
      },
      error: function(error){

        $("#idMensajeEspera").empty();

        alertify.error("Error de conexión al tratar de enviar los archivos adjuntos, inténtelo de nuevo");

      }

    });



  }

  /*
  //Metodo encargado de enviar el formulario de adjuntar archivos
  */

  function activarEnvioDatosAdjuntarArchivos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      var url = "/SisConAsadaLaUnion/index/guardarArchivosAdjuntos";

      var datosFormulario = new FormData(document.getElementById("idAdjuntarArchivosForm"));

      enviarFormularioAdjuntarArchivos(idForm,url,datosFormulario);
      
    });  

  }