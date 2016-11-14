  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    var idForm = $("#idRegistrarUsuarioForm");

    var idCedula = $("#idCedulaUsuario");

    var idNombreUsuario = $("#idNombreUsuarioSistema");

    var idCorreoElectronico = $("#idCorreoUsuario");

    calendarioFechaNacimiento();

    gestionarValidacionContrasenias();

    blurCampos(idCedula,"verificarCedulaExistente","de la cédula ingresada",$('#mensajeVerificacionCedula'));

    blurCampos(idCorreoElectronico,"verificarCorreoElectronicoExistente","del correo electrónico ingresado",$('#mensajeVerificacionCorreo'));

    blurCampos(idNombreUsuario,"verificarNombreUsuarioExistente","del nombre de usuario ingresado",$('#mensajeVerificacionNombreUsuario'));
    
    validarTelefonoNoRequerido();

    activarEnvioDatos(idForm);

  });

  /*
  //Metodo encargado de inicializar el datepicker de jquery
  */

  function calendarioFechaNacimiento(){

    $('#idFechaNacimientoUsuario').datepicker({
      dateFormat: 'dd/mm/yy', 
      changeMonth: true, 
      changeYear: true, 
      yearRange: '-100:+0'
    });

  }

  /*
  //Metodo encargado de gestionar los eventos de teclado para la validacion de contraseñas entre si
  */

  function gestionarValidacionContrasenias(){

     $("#idContraseniaUsuario").keyup(function(){

        validarContrasenias();

     });

     $("#idConfirmarContraseniaUsuario").keyup(function(){

        validarContrasenias();

     });

  }

  /*
  //Metodo encargado de validar las contraseñas entre si
  */

  function validarContrasenias(){

    var idContrasenia1 = $("#idContraseniaUsuario");
    var idContrasenia2 = $("#idConfirmarContraseniaUsuario");
    var idMensajeContrasenias = $("#mensajeVerificacionContrasenias");

    if (idContrasenia1.val() != "" || idContrasenia2.val() != "") {

        if (idContrasenia1.val() == idContrasenia2.val()) {

            idMensajeContrasenias.html("<div id='msjCedula' class='alert alert-success' data-password='true'><strong><span class='glyphicon glyphicon-ok'></span></strong> Contraseñas idénticas</div>");

          }else{

            idMensajeContrasenias.html("<div id='msjCedula' class='alert alert-danger' data-password='false'><strong><span class='glyphicon glyphicon-remove'></span></strong> Contraseñas distintas</div>");

          }

    }else{

       idMensajeContrasenias.empty();
    }

  }

  /*
  //Metodo ajax que permite verificar la existencia de varios campos del formulario en la base de datos
  */

  function verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError,idDivMensaje){

        $.ajax({
          url: "/SisConAsadaLaUnion/usuario/"+metodoNombre,
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
  //Metodo para activar evento blur en el campo que se necesite
  */

  function blurCampos(idCampo,metodoNombre,mensajeError,idDivMensaje){

      idCampo.blur(function(){

      var datosEnvio = idCampo.val().trim();

      if (datosEnvio!="") {

        if (metodoNombre == "verificarCedulaExistente") {

            if (!datosEnvio.match("^[0-9]*$")) {

              idDivMensaje.html("<div class='alert alert-danger'>"+
                        "<strong><span class='glyphicon glyphicon-remove'></span></strong>"+
                        " El contenido del campo correspondiente a cédula solo puede admitir números</div>");

            }else{

              verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError,idDivMensaje);
            
            }
        
        }else if (metodoNombre == "verificarCorreoElectronicoExistente") {

                  if (!datosEnvio.match("[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}$")) {

                    idDivMensaje.html("<div class='alert alert-danger'>"+
                                "<strong><span class='glyphicon glyphicon-remove'></span></strong>"+
                                " El contenido del campo correspondiente a correo electrónico no cuenta con el formato correcto"+
                                "<br>Formato: ejemplo@gmail.com</div>");

                  }else{

                    verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError,idDivMensaje);
                    
                  }
                
              }else{

                verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError,idDivMensaje);
                 
              }

        }else{

          idDivMensaje.html("");

        }

      });
  }

  /*
  // Metodo encargado de validar el telefono no requerido
  */

  function validarTelefonoNoRequerido(){

    var idTelefono = $("#idTipoTel2Usuario");
    var idNumTelefono = $("#idNumTel2Usuario");

    idTelefono.change(function() {
      
      if (idTelefono.val() == "Fijo" || idTelefono.val() == "Móvil"){

        idTelefono.attr("required","");

        idNumTelefono.attr("required","");
      
      }else{

        idTelefono.removeAttr("required");

        idNumTelefono.removeAttr("required");

        idNumTelefono.val("");

      }
    
    });


    idNumTelefono.keyup(function() {
      
      if (idNumTelefono.val() != ""){

        idNumTelefono.attr("required","");

        idTelefono.attr("required","");
      
      }else{

        idNumTelefono.removeAttr("required");

        idTelefono.removeAttr("required");

        idTelefono.val("").change();

      }
    
    });

  }

  /*
  //Metodo para enviar el formulario de usuario, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioUsuario(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("Usuario registrado con éxito");

              limpiarCamposForm(idForm);

              $('#mensajeVerificacionCedula').html("");

              $('#mensajeVerificacionCorreo').html("");

              $('#mensajeVerificacionNombreUsuario').html("");

              $('#mensajeVerificacionContrasenias').html("");

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de registrar el usuario, inténtelo de nuevo");

      }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de registrar el usuario, inténtelo de nuevo");

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

  /*
  //Metodo para enviar el formulario de registro de usuario
  */

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault(); 

      var verificarCedula = $("#msjCedula").attr("data-cedula");

      var verificarCorreo = $("#msjCorreo").attr("data-correo");

      var verificarNombreUsuario = $("#msjNombreUsuario").attr("data-nombreUsuario");

      if (verificarCedula == "true" && verificarCorreo == "true" && verificarNombreUsuario  == "true") {

        if (confirmarTransaccion('¿Está seguro de proceder con el registro del usuario?')) 
          {
            
            var url = "/SisConAsadaLaUnion/usuario/registrarUsuario";

            var datosFormulario = idForm.serialize();

            enviarFormularioUsuario(idForm,url,datosFormulario);

          }

      }

    });

  }