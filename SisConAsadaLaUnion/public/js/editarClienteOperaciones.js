  /*
  //Archivo .js encargado de contener las validaciones y operaciones sobre el formulario de editar cliente
  */

  /*
  // Metodo ajax para cargar un cliente por su numero de cedula
  */

  function cargarClientePorCedula(cedulaClienteSeleccionado){

    $.ajax({
          url: "/SisConAsadaLaUnion/cliente/obtenerClientePorCedula",
          type: "POST",
          data: { cedulaCliente : cedulaClienteSeleccionado },
          dataType: "json",
          success: function(respuesta){

           if (respuesta != "false") {

            var cedulaActual = "";
            var correoActual = "";
            var numeroPlanoActual = "";

             $(respuesta).each(function(indice, valor){

                cedulaActual = valor.cliente.cedula;
                correoActual = valor.cliente.correo;

                $("#idCedulaCliente").val(valor.cliente.cedula);
                $("#idNombreCliente").val(valor.cliente.nombre);
                $("#idApellidosCliente").val(valor.cliente.apellidos);
                $("#idCorreoCliente").val(valor.cliente.correo);
                $("#idTipoTel1Cliente").val(valor.telefonosCliente[indice].tipo).change();
                $("#idNumTel1Cliente").val(valor.telefonosCliente[indice].numero);
                
                if(valor.telefonosCliente.length > 1){
                
                  $("#idTipoTel2Cliente").val(valor.telefonosCliente[indice+1].tipo).change();
                  $("#idNumTel2Cliente").val(valor.telefonosCliente[indice+1].numero);
                
                }else{
                
                  $("#idTipoTel2Cliente").val("").change();
                  $("#idNumTel2Cliente").val("");
                
                }
                
                $("#idDireccionCliente").val(valor.cliente.direccion);

                if (valor.cliente.numeroPlano != null) {

                  numeroPlanoActual = valor.cliente.numeroPlano;
                  $("#idNumPlanoCliente").val(valor.cliente.numeroPlano);

                }else{

                  numeroPlanoActual = "";
                  $("#idNumPlanoCliente").val("");

                }
                  
             });

             var idForm = $("#idEditarClienteForm");
             var idCedula = $("#idCedulaCliente");
             var idCorreoElectronico = $("#idCorreoCliente");
             var idNumeroPlano = $("#idNumPlanoCliente");

            //Desasociar eventos de componentes
            idForm.unbind("submit");
            idCedula.unbind("blur");
            idCorreoElectronico.unbind("blur");
            idNumeroPlano.unbind("blur");

            //Validaciones para el form de actualizar cliente
             blurCampos(idCedula,cedulaActual,"verificarCedulaExistenteEditar","de la cédula ingresada",$('#mensajeVerificacionCedula'));
             blurCampos(idCorreoElectronico,correoActual,"verificarCorreoElectronicoExistenteEditar","del correo electrónico ingresado",$('#mensajeVerificacionCorreo'));
             blurCampos(idNumeroPlano,numeroPlanoActual,"verificarNumeroPlanoExistenteEditar","del número de plano ingresado",$('#mensajeVerificacionPlano'));

            //Activar .submit del formulario
            activarEnvioDatos(idForm,cedulaActual,correoActual,numeroPlanoActual);
             
             $("#editarCliente").dialog("open");
           
           }else{

            alertify.error("Ha ocurrido un error al tratar de cargar la información del cliente seleccionado");            

           }
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de cargar la información del cliente seleccionado");

          }

    });

  }

  /*
  //Metodo para enviar el formulario de cliente, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioCliente(idForm,url,cedulaAct,correoElectronicoAct,numeroPlanoAct,datosFormulario){

    $.ajax({
      url:  url,
      type: "POST",
      data: "cedulaActual="+cedulaAct+"&correoElectronicoActual="+correoElectronicoAct+"&numeroPlanoActual="+numeroPlanoAct+"&"+datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
          	
          	  alertify.success("La información del cliente seleccionado se ha editado satisfactoriamente");
              $("#editarCliente").dialog("close");

              //Se limpia el formulario de editar
              limpiarCamposForm(idForm);
              $('#mensajeVerificacionCedula').empty();
              $('#mensajeVerificacionCorreo').empty();
              $('#mensajeVerificacionPlano').empty();
              $("#idTipoTel2Cliente").removeAttr("required");
              $("#idNumTel2Cliente").removeAttr("required");

              //Se recarga la tabla de clientes
              if ($("#paginacion").html().length > 0) {

               $("#paginacion").twbsPagination('destroy');
              
                }

                var cantidadFilasTabla = $('#tablaClientes tr').length-1;
                var cedulaNombre = $("#buscarCliente").val().trim();

                if(cantidadFilasTabla == 0 && paginaActualGlb > 1){

                  paginaActualGlb--;

                }

                if (cedulaNombre != "") {

                  crearListaPaginasPaginacion(paginaActualGlb,"obtenerClientesCedulaNombre",cedulaNombre);

                }else{

                  crearListaPaginasPaginacion(paginaActualGlb,"obtenerClientes","false");

                }

          }else{
          	
              alertify.error("Ha ocurrido un error al tratar de editar la información del cliente seleccionado, inténtelo de nuevo");

      }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de editar la información del cliente seleccionado, inténtelo de nuevo");

      }

    });

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
  //Metodo para enviar el formulario de edición de cliente
  */

  function activarEnvioDatos(idForm,cedulaActual,correoElectronicoActual,numeroPlanoActual){

    idForm.on('submit', function(e){

      e.preventDefault(); 

      var verificarCedula = $("#msjCedula").attr("data-cedula");

      var verificarCorreo = $("#msjCorreo").attr("data-correo");

      var verificarNumPlano = $("#msjPlano").attr("data-plano");

      if (verificarCedula != "false" && verificarCorreo != "false" && verificarNumPlano  != "false") {

      	if (confirmarTransaccion('¿Desea proceder con la edición de información del cliente seleccionado?')) 
      		{
      			
        		var url = "/SisConAsadaLaUnion/cliente/editarCliente";

        		var datosFormulario = idForm.serialize();

        		enviarFormularioCliente(idForm,url,cedulaActual,correoElectronicoActual,numeroPlanoActual,datosFormulario);

      		}

      }

    });

  }

  /*
  //Metodo para activar evento blur en el campo que se necesite
  */

  function blurCampos(idCampo,valorActual,metodoNombre,mensajeError,idDivMensaje){

      idCampo.blur(function(){

      var valorNuevo = idCampo.val().trim();

      if (valorNuevo!="") {

        if (metodoNombre == "verificarCedulaExistenteEditar") {

            if (!valorNuevo.match("^[0-9]*$") && !valorActual.match("^[0-9]*$")) {

              idDivMensaje.html("<div class='alert alert-danger'>"+
                        "<strong><span class='glyphicon glyphicon-remove'></span></strong>"+
                        " El contenido del campo correspondiente a cédula solo puede admitir números</div>");

            }else{

              verificarExistenciaCampos("persona/"+metodoNombre,valorActual,valorNuevo,mensajeError,idDivMensaje);
            
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

                      verificarExistenciaCampos("persona/"+metodoNombre,valorActual,valorNuevo,mensajeError,idDivMensaje);
                    
                    }
                
                  }else{

                      verificarExistenciaCampos("cliente/"+metodoNombre,valorActual,valorNuevo,mensajeError,idDivMensaje);
                
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

  function verificarExistenciaCampos(controladorMetodoNombre,valorAct,valorNue,mensajeError,idDivMensaje){

        $.ajax({
          url: "/SisConAsadaLaUnion/"+controladorMetodoNombre,
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
  //Validaciones del formulario editar cliente 
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