  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    gestionarValidacionContrasenias();

    activarEnvioDatosRestablecerContrasenia($("#idRestablecerContraseniaForm"));

   });  

  /*
  //Metodo encargado de gestionar los eventos de teclado para la validacion de contraseñas entre si
  */

  function gestionarValidacionContrasenias(){

     $("#idNuevaContrasenia").keyup(function(){

        validarContrasenias();

     });

     $("#idConfirmarNuevaContrasenia").keyup(function(){

        validarContrasenias();

     });

  }

  /*
  //Metodo encargado de validar las contraseñas entre si
  */

  function validarContrasenias(){

    var idContrasenia1 = $("#idNuevaContrasenia");
    var idContrasenia2 = $("#idConfirmarNuevaContrasenia");
    var idMensajeContrasenias = $("#mensajeVerificacionContrasenias");

    if (idContrasenia1.val() != "" || idContrasenia2.val() != "") {

        if (idContrasenia1.val() == idContrasenia2.val()) {

            idMensajeContrasenias.html("<div id='msjContrasenias' class='alert alert-success' data-password='true'><strong><span class='glyphicon glyphicon-ok'></span></strong> Contraseñas idénticas</div>");

          }else{

            idMensajeContrasenias.html("<div id='msjContrasenias' class='alert alert-danger' data-password='false'><strong><span class='glyphicon glyphicon-remove'></span></strong> Contraseñas distintas</div>");

          }

    }else{

       idMensajeContrasenias.empty();

    }

  }

  /*
  //Metodo para enviar el formulario de restablecer contraseña, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioRestablecerContrasenia(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

        if (respuesta == "true") {

          alertify.success("Su contraseña se ha restablecido correctamente");

          var timeout = null;

          clearTimeout(timeout);

          timeout = setTimeout(function() {
            
          window.location.href = "/SisConAsadaLaUnion/login";   
          
          }, 2500)   

        }else{

          alertify.error(respuesta);

        }
        
      },
      error: function(error){

        alertify.error("Error de conexión al tratar de restablecer la nueva contraseña para su cuenta, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo encargado de enviar el formulario de restablecer contraseña
  */

  function activarEnvioDatosRestablecerContrasenia(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      var verificarContrasenias = $("#msjContrasenias").attr("data-password");

      if (verificarContrasenias == "true") {

        var url = "/SisConAsadaLaUnion/login/restablecerContrasenia";

        var datosFormulario = idForm.serialize();

        enviarFormularioRestablecerContrasenia(idForm,url,datosFormulario);

      }
      
    });

  }