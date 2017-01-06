  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    activarEnvioDatos($("#idLoginForm"));

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

          window.location.href = "/SisConAsadaLaUnion/persona/registrarPersonaForm";

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
  //Metodo para enviar el formulario de registro de producto
  */

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault();

      var url = "/SisConAsadaLaUnion/login/validarLogin";

      var datosFormulario = idForm.serialize();

      enviarFormularioLogin(idForm,url,datosFormulario);

    });

  }