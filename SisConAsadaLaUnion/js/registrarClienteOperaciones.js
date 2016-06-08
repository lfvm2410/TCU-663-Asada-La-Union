/*
//Metodo principal (llamado de todas las funciones hechas en este .js)
*/

$(document).on("ready", function () {

var idForm = $("#idRegistrarClienteForm");

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

    alertify.error("Es posible que se haya presentado un error de conexión, inténtelo nuevamente");

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
