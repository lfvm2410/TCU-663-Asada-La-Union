  /*
  //Archivo .js que se encarga de contener los metodos globales que son utilizados en cualquier .js
  */

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