  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    var idForm = $("#idRegistrarClienteForm");

    var idCedula = $("#idCedulaCliente");

    var idCorreoElectronico = $("#idCorreoCliente");

    var idNumeroPlano = $("#idNumPlanoCliente");

    blurCampos(idCedula,"verificarCedulaExistente","de la cédula ingresada",$('#mensajeVerificacionCedula'));

    blurCampos(idCorreoElectronico,"verificarCorreoElectronicoExistente","del correo electrónico ingresado",$('#mensajeVerificacionCorreo'));

    validarTelefonoNoRequeridoCombo();

    validarTelefonoNoRequeridoInput();

    blurCampos(idNumeroPlano,"verificarNumeroPlanoExistente","del número de plano ingresado",$('#mensajeVerificacionPlano'));
    
    activarEnvioDatos(idForm);

  });

  /*
  //Metodo para enviar el formulario de cliente, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioCliente(idForm,url,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
          	
          	  alertify.success("Cliente registrado con éxito");

          	  limpiarCamposForm(idForm);

              $('#mensajeVerificacionCedula').html("");

              $('#mensajeVerificacionCorreo').html("");

              $('#mensajeVerificacionPlano').html("");

              $("#idTipoTel2Cliente").removeAttr("required");

              $("#idNumTel2Cliente").removeAttr("required");

          }else{
          	
              alertify.error("Ha ocurrido un error al tratar de registrar el cliente, inténtelo de nuevo");

      }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de registrar el cliente, inténtelo de nuevo");

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
  //Metodo para enviar el formulario de registro de cliente
  */

  function activarEnvioDatos(idForm){

    idForm.on('submit', function(e){

      e.preventDefault(); 

      var verificarCedula = $("#msjCedula").attr("data-cedula");

      var verificarCorreo = $("#msjCorreo").attr("data-correo");

      var verificarNumPlano = $("#msjPlano").attr("data-plano");

      if (verificarCedula == "true" && verificarCorreo == "true" && verificarNumPlano  != "false") {

      	if (confirmarTransaccion('¿Está seguro de proceder con el registro del cliente?')) 
      		{
      			
        		var url = "/SisConAsadaLaUnion/cliente/registrarCliente";

        		var datosFormulario = idForm.serialize();

        		enviarFormularioCliente(idForm,url,datosFormulario);

      		}

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
        
        }else{

                if (metodoNombre == "verificarCorreoElectronicoExistente") {

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

              }

        }else{

         idDivMensaje.html("");

        }

      });
  }

  /*
  //Metodo ajax que permite verificar la existencia de varios campos del formulario en la base de datos
  */

  function verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError,idDivMensaje){

        $.ajax({
          url: "/SisConAsadaLaUnion/cliente/"+metodoNombre,
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
  //Validaciones del formulario registrar cliente 
  */

  /*
  //Metodo para la validación del teléfono #2 desde el combobox 
  */

  function validarTelefonoNoRequeridoCombo(){

    var idTelefono = $("#idTipoTel2Cliente");

    idTelefono.change(function() {
      
      if (idTelefono.val() == "Fijo" || idTelefono.val() == "Móvil"){

        idTelefono.attr("required","");

        $("#idNumTel2Cliente").attr("required","");
      
      }else{

        idTelefono.removeAttr("required");

        $("#idNumTel2Cliente").removeAttr("required");

        $("#idNumTel2Cliente").val("");

      }
    
    });

  }

  /*
  //Metodo para la validación del teléfono #2 desde el input 
  */

  function validarTelefonoNoRequeridoInput(){

    var idNumTelefono = $("#idNumTel2Cliente");

    idNumTelefono.keyup(function() {
      
      if (idNumTelefono.val() != ""){

        idNumTelefono.attr("required","");

        $("#idTipoTel2Cliente").attr("required","");
      
      }else{

        idNumTelefono.removeAttr("required");

        $("#idTipoTel2Cliente").removeAttr("required");

        $("#idTipoTel2Cliente").val("").change();

      }
    
  });

  }