  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

  var idForm = $("#idRegistrarClienteForm");

  var idCedula = $("#idCedulaCliente");

  blurCampos(idCedula,"verificarCedulaExistente","de la cédula ingresada");

  activarEnvioDatos(idForm);

  });

  /*
  //Metodo para enviar el formulario de cliente, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioCliente(idForm,url,metodoNombre,datosFormulario){

    var scrollY = window.pageYOffset;

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario+"&metodo="+metodoNombre,
      success: function(respuesta){

      if (respuesta == "true") {
      	
      	  alertify.success("Cliente registrado con éxito");

          $(".alertify-logs").css("top", scrollY+"px");

      	  limpiarCamposForm(idForm);

      }else{
      	
          alertify.error("Ha ocurrido un error al tratar de registrar el cliente, inténtelo de nuevo");

          $(".alertify-logs").css("top", scrollY+"px");

      }

      },
      error: function(error){

      alertify.error("Error de conexión al tratar de registrar el cliente, inténtelo de nuevo");

      $(".alertify-logs").css("top", scrollY+"px");

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

    	if (confirmarTransaccion('¿Está seguro de proceder con el registro del cliente?')) 
    		{
    			
  		var url = "../controllers/clienteController.php";

  		var metodoNombre = "registrarCliente";

  		var datosFormulario = idForm.serialize();

  		enviarFormularioCliente(idForm,url,metodoNombre,datosFormulario);

    		}
  });

  }

  /*
  //Metodo para activar evento blur en el campo que se necesite
  */

  function blurCampos(idCampo,metodoNombre,mensajeError){

      idCampo.blur(function(){

      var datosEnvio = idCampo.val();

      if (datosEnvio!="") {
          
      verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError);

      }else{

       $('#mensajeVerificacionCedula').html("");

      }

      });
  }

  /*
  //Metodo ajax que permite verificar la existencia de varios campos del formulario en la base de datos
  */

  function verificarExistenciaCampos(metodoNombre,datosEnvio,mensajeError){
        //$("#infoVerificacionCedula").html("<img src='loader.gif'/>").fadeOut(1000);

        $.ajax({
          url:  "../controllers/clienteController.php",
          type: "POST",
          data: "valor="+datosEnvio+"&metodo="+metodoNombre,
          success: function(respuesta) {

          $('#mensajeVerificacionCedula').fadeIn(1000).html(respuesta);
          
          },
          error: function(error){

          alertify.error("Error de conexión al tratar de verificar la disponibilidad "+mensajeError);

          $(".alertify-logs").css("top", scrollY+"px");

          }

        });
  
  }
