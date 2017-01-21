  /*
  // Archivo .js encargado de contener las validaciones a emplear para las personas
  */

  /*
  //Metodo encargado de habilitar o deshabilitar campos obligatorios de acuerdo al perfil de la persona
  */
  function habilitarCamposRequeridosUsuarioSistema(habilitado){

    var idNombreUsuarioPersona = $("#idNombreUsuarioPersona");
    var idContraseniaPersona = $("#idContraseniaPersona");
    var idConfirmarContraseniaPersona = $("#idConfirmarContraseniaPersona");

    if (habilitado == "true") {

      idNombreUsuarioPersona.attr("required","");
      idContraseniaPersona.attr("required","");
      idConfirmarContraseniaPersona.attr("required","");

    }else if (habilitado == "false") {

      idNombreUsuarioPersona.removeAttr("required");
      idContraseniaPersona.removeAttr("required");
      idConfirmarContraseniaPersona.removeAttr("required");

    }

  }

  /*
  //Metodo encargado de adaptar el formulario de acuerdo al tipo de perfil de la persona a registrar
  */
  function configurarFormularioPorPerfilPersona(){

      var idPerfilPersona = $("#idPerfilPersona");
      var seccionformularioPersona = $("#seccionFormularioPersona");
      var seccionUsuarioSistema = $("#seccionUsuarioSistema");

      seccionformularioPersona.hide();
      habilitarCamposRequeridosUsuarioSistema("false");

      idPerfilPersona.change(function() {
      
        if (idPerfilPersona.val() == ""){

          seccionformularioPersona.hide();
          habilitarCamposRequeridosUsuarioSistema("false");
          
        }else if (idPerfilPersona.val() == "Administrador") {

          seccionformularioPersona.show();
          seccionUsuarioSistema.show();
          habilitarCamposRequeridosUsuarioSistema("true");

        }else if (idPerfilPersona.val() == "Colaborador") {

          seccionformularioPersona.show();
          seccionUsuarioSistema.hide();
          habilitarCamposRequeridosUsuarioSistema("false");

        }
    
     });

  }

  /*
  //Metodo encargado de inicializar el datepicker de jquery
  */

  function calendarioFechaNacimiento(){

    $('#idFechaNacimientoPersona').datepicker({
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

     $("#idContraseniaPersona").keyup(function(){

        validarContrasenias();

     });

     $("#idConfirmarContraseniaPersona").keyup(function(){

        validarContrasenias();

     });

  }

  /*
  //Metodo encargado de validar las contraseñas entre si
  */

  function validarContrasenias(){

    var idContrasenia1 = $("#idContraseniaPersona");
    var idContrasenia2 = $("#idConfirmarContraseniaPersona");
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
  //Metodo ajax que permite verificar la existencia de varios campos del formulario en la base de datos
  */

  function verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError,idDivMensaje){

        $.ajax({
          url: "/SisConAsadaLaUnion/persona/"+metodoNombre,
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
  //Metodo ajax que permite verificar la existencia de varios campos del formulario en la base de datos
  //Nota: Este metodo se llama para los campos en edicion (editando la información de un registro) que se necesiten verificar
  */

  function verificarExistenciaCamposEnEdicion(metodoNombre,valorAct,valorNue,mensajeError,idDivMensaje){

        $.ajax({
          url: "/SisConAsadaLaUnion/persona/"+metodoNombre,
          type: "POST",
          data: "valorActual="+valorAct+"&valorNuevo="+valorNue,
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
  //Metodo para activar evento blur en el campo que se necesite, este metodo se utiliza al actualizar un registro existente
  */

  function blurCamposEnEdicion(idCampo,valorActual,metodoNombre,mensajeError,idDivMensaje){

      idCampo.blur(function(){

        var valorNuevo = idCampo.val().trim();

        if (valorNuevo!="") {

          if (metodoNombre == "verificarCedulaExistenteEditar") {

            if (!valorNuevo.match("^[0-9]*$") && !valorActual.match("^[0-9]*$")) {

              idDivMensaje.html("<div class='alert alert-danger'>"+
                          "<strong><span class='glyphicon glyphicon-remove'></span></strong>"+
                          " El contenido del campo correspondiente a cédula solo puede admitir números</div>");

            }else{

              verificarExistenciaCamposEnEdicion(metodoNombre,valorActual,valorNuevo,mensajeError,idDivMensaje);
              
            }
          
          }else{

            if (metodoNombre == "verificarCorreoElectronicoExistenteEditar") {

              if (!valorNuevo.match("[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}$") 
                  && !valorActual.match("[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}$")) {

                idDivMensaje.html("<div class='alert alert-danger'>"+
                          "<strong><span class='glyphicon glyphicon-remove'></span></strong>"+
                          " El contenido del campo correspondiente a correo electrónico no cuenta con el formato correcto"+
                          "<br>Formato: ejemplo@gmail.com</div>");

              }else{

                verificarExistenciaCamposEnEdicion(metodoNombre,valorActual,valorNuevo,mensajeError,idDivMensaje);
                      
              }
                  
            }else{

              verificarExistenciaCamposEnEdicion(metodoNombre,valorActual,valorNuevo,mensajeError,idDivMensaje);
                  
            }

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

    var idTelefono = $("#idTipoTel2Persona");
    var idNumTelefono = $("#idNumTel2Persona");

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