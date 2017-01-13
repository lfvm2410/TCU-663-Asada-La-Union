  /*
  //Archivo .js que se encarga de contener los metodos globales que son utilizados en cualquier .js
  */

  /*
  //Metodo ajax que permite verificar la existencia de varios campos del formulario en la base de datos
  */

  function verificarExistenciaCamposGenerico(rutaControlador,datosEnvio,mensajeError,idDivMensaje){

        $.ajax({
          url: "/SisConAsadaLaUnion/"+rutaControlador,
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

  function blurCamposGenerico(idCampo,rutaControlador,mensajeError,idDivMensaje){

      idCampo.blur(function(){

        var datosEnvio = idCampo.val().trim();

        if (datosEnvio!="") {
        
          verificarExistenciaCamposGenerico(rutaControlador,datosEnvio,mensajeError,idDivMensaje);
           
        }else{

          idDivMensaje.html("");

        }

      });
  }

  /*
  //Metodo ajax que permite verificar la existencia de varios campos del formulario en la base de datos
  //Nota: Este metodo se llama para los campos en edicion (editando la información de un registro) que se necesiten verificar
  */

  function verificarExistenciaCamposEnEdicion(rutaControlador,valorAct,valorNue,mensajeError,idDivMensaje){

        $.ajax({
          url: "/SisConAsadaLaUnion/"+rutaControlador,
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

  function blurCamposEnEdicionGenerico(idCampo,valorActual,rutaControlador,mensajeError,idDivMensaje){

      idCampo.blur(function(){

        var valorNuevo = idCampo.val().trim();

        if (valorNuevo!="") {

          verificarExistenciaCamposEnEdicion(rutaControlador,valorActual,valorNuevo,mensajeError,idDivMensaje);
            
        }else{

          idDivMensaje.html("");

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
  //Metodo encargado de crear ventana modal
  */

 function crearVentanaModal(idVentana,tamanioAncho,tamanioAlto,limpiarAlFinal){

  idVentana.dialog({
      autoOpen: false,
      modal: true,
      width: tamanioAncho,
      height: tamanioAlto,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
      close: function(ev,ui){

        if (limpiarAlFinal == "true") {

          idVentana.empty();

        }
        
      }
    });

 }