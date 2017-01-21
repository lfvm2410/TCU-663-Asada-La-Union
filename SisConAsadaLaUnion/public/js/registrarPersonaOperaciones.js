  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    var idForm = $("#idRegistrarPersonaForm");

    var idCedula = $("#idCedulaPersona");

    var idCorreoElectronico = $("#idCorreoPersona");

    var idNombreUsuario = $("#idNombreUsuarioPersona");

    configurarFormularioPorPerfilPersona();

    calendarioFechaNacimiento();

    gestionarValidacionContrasenias();

    blurCampos(idCedula,"verificarCedulaExistente","de la cédula ingresada",$('#mensajeVerificacionCedula'));

    blurCampos(idCorreoElectronico,"verificarCorreoElectronicoExistente","del correo electrónico ingresado",$('#mensajeVerificacionCorreo'));

    blurCampos(idNombreUsuario,"verificarNombreUsuarioExistente","del nombre de usuario ingresado",$('#mensajeVerificacionNombreUsuario'));
    
    validarTelefonoNoRequerido();

    activarEnvioDatos(idForm);

  });

  /*
  //Metodo para enviar el formulario de persona, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioPersona(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("Persona registrada con éxito");

              limpiarCamposForm(idForm);

              $('#mensajeVerificacionCedula').html("");

              $('#mensajeVerificacionCorreo').html("");

              $('#mensajeVerificacionNombreUsuario').html("");

              $('#mensajeVerificacionContrasenias').html("");

              $("#idTipoTel2Persona").removeAttr("required");
              
              $("#idNumTel2Persona").removeAttr("required");

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de registrar la persona, inténtelo de nuevo");

      }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de registrar la persona, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de registro de una persona
  */

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault(); 

      var perfilPersona = $("#idPerfilPersona");

      var verificarCedula = $("#msjCedula").attr("data-cedula");

      var verificarCorreo = $("#msjCorreo").attr("data-correo");

      var verificarNombreUsuario = "";

      var verificarContrasenias = "";

      //Se ignora o se incluye la validación para el nombre del usuario y las contraseñas de acuerdo al perfil de persona a registrar

      if (perfilPersona.val() == "Administrador") {

        verificarNombreUsuario = $("#msjNombreUsuario").attr("data-nombreUsuario");
        
        verificarContrasenias = $("#msjContrasenias").attr("data-password");

      }else if (perfilPersona.val() == "Colaborador") {

        verificarNombreUsuario = "true";
        
        verificarContrasenias = "true";

      }
      
      if (verificarCedula == "true" && verificarCorreo == "true" && verificarNombreUsuario  == "true" && verificarContrasenias == "true") {

        if (confirmarTransaccion('¿Está seguro de proceder con el registro de la persona?')) 
          {
            
            var url = "/SisConAsadaLaUnion/persona/registrarPersona";

            var datosFormulario = idForm.serialize();

            enviarFormularioPersona(idForm,url,datosFormulario);

          }

      }

    });

  }