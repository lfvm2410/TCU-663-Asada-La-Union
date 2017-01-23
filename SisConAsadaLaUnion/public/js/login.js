  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    crearVentanaModal($("#idRecuperarContrasenia"),845,210,"false");

    levantarVentanaModalRecuperarContrasenia();

    activarEnvioDatosLogueoSistema($("#idLoginForm"));

    activarEnvioDatosRecuperarContrasenia($("#idRecuperarContraseniaForm"));

   });

  /*
  //Metodo para enviar el formulario de login, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioLogin(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

        if (respuesta == "true") {

          window.location.href = "/SisConAsadaLaUnion/index/inicio";

        }else{

          alertify.error(respuesta);

        }
        
      },
      error: function(error){

        alertify.error("Error de conexión al tratar de iniciar sesión en el sistema, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de logueo al sistema
  */

  function activarEnvioDatosLogueoSistema(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      var url = "/SisConAsadaLaUnion/login/validarLogin";

      var datosFormulario = idForm.serialize();

      enviarFormularioLogin(idForm,url,datosFormulario);

    });

  }

  /*
  //Metodo encargado de levantar la ventana modal para la recuperación de la contraseña
  */

  function levantarVentanaModalRecuperarContrasenia(){

    $("#idOlvidoContrasenia").click(function() {
      
      $("#idRecuperarContrasenia").dialog("open");

    });

  }

  /*
  //Metodo para enviar el formulario de recuperar contraseña, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioRecuperarContrasenia(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

        if (respuesta == "true") {

          alertify.success("Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña");

          $("#idRecuperarContrasenia").dialog("close");

          limpiarCamposForm(idForm);

        }else{

          alertify.error(respuesta);

        }
        
      },
      error: function(error){

        alertify.error("Error de conexión al tratar de enviar la solicitud para la recuperación de la contraseña de su cuenta, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo encargado de enviar el formulario de recuperar contraseña
  */

  function activarEnvioDatosRecuperarContrasenia(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      var url = "/SisConAsadaLaUnion/login/solicitudRecuperarContrasenia";

      var datosFormulario = idForm.serialize();

      enviarFormularioRecuperarContrasenia(idForm,url,datosFormulario);
      
    });  

  }