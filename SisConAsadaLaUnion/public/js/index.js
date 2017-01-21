  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    cargarInfoPaginaPresentacion("index/obtenerInformacionImagenesPaginaPresentacion", "la información de la ASADA");

  });

  /*
  //Metodo encargado de cargar la informacion necesaria para elaborar el slider de la página de presentación
  */

  function cargarInfoPaginaPresentacion(direccionControladorMetodo,mensajeError){

    $.ajax({
      url: "/SisConAsadaLaUnion/"+direccionControladorMetodo,
      type: "POST",
      success: function(respuesta){

        if (respuesta != "false") {

          cargarSlider(respuesta.informacionAsada,respuesta.imagenes);

        }else{

          alertify.error("Ha ocurrido un error al tratar de cargar "+mensajeError);  

        }
          
      },
      error: function(error){

        alertify.error("Error de conexión al tratar de cargar "+mensajeError);

      }
      
    });

  }

  /*
  // Metodo encargado de cargar el slider
  */

  function cargarSlider(informacionAsada,imagenes){

    $("#item1").append("<div class='carousel-caption hidden-xs hidden-sm'><h3>Quienes somos</h3><p>"+informacionAsada.quienesSomos[0]+"</p></div>");
    $("#item2").append("<div class='carousel-caption hidden-xs hidden-sm'><h3>Misión</h3><p>"+informacionAsada.mision[0]+"</p></div>");
    $("#item3").append("<div class='carousel-caption hidden-xs hidden-sm'><h3>Visión</h3><p>"+informacionAsada.vision[0]+"</p></div>");
    $("#item4").append("<div class='carousel-caption hidden-xs hidden-sm'><h3>Valores</h3><p>"+informacionAsada.valores[0]+"</p></div>");
    
    var contadorImagenes = 4;
    var contadorImagenesGenericas = 0;
  
    if (imagenes.length > 0){

      var i = 0;

      $(imagenes).each(function(index) {
        
        var idActual = "#item"+(index+1);
          
        $(idActual).append("<img src='/SisConAsadaLaUnion/public/assets/imagesPresentacion/"+imagenes[index]+"' width='1200' class='img-responsive' alt=''/>");
          
        contadorImagenes--;

        i++;

      });

      contadorImagenesGenericas = i;

    }else{

      contadorImagenesGenericas = 0;

    }
    
    for (i = 0; i < contadorImagenes; i++) {

      var idActual = "#item"+(contadorImagenesGenericas+1);

      $(idActual).append("<img src='/SisConAsadaLaUnion/public/assets/images/acueductoGenerico.jpg' width='1200' class='img-responsive' alt=''/>");
      
      contadorImagenesGenericas++;

    }
  
  }