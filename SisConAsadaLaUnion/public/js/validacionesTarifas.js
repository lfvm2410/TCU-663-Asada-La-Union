  /*
  // Archivo .js encargado de contener las validaciones a emplear para las tarifas
  */

  /*
  //Metodo ajax que permite llenar el combobox que se requiera
  */

  function llenarCombobox(idCombo,direccionControladorMetodo,mensajeError){

    $.ajax({
      url: "/SisConAsadaLaUnion/"+direccionControladorMetodo,
      type: "POST",
      success: function(respuesta){

        var informacionCombo = eval(respuesta);
      
        idCombo.html(informacionCombo["optionsList"]);
          
      },
      error: function(error){

        alertify.error("Error de conexión al tratar de cargar "+mensajeError);

      }

    });

  }

  /*
  //Metodo ajax que permite verificar la existencia de la descripción para un rango de abonados seleccionado
  */

  function verificarExistenciaDescripcion(valorComboRango,valorComboDescripcion){

        $.ajax({
          url: "/SisConAsadaLaUnion/tarifa/verificarDescripcionExistente",
          type: "POST",
          data: "idAbonadoAsada="+valorComboRango+"&descripcion="+valorComboDescripcion,
          beforeSend: function(){

            $("#mensajeVerificacionDescripcion").fadeIn(1000).html('<img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/>');

          },
          success: function(respuesta){

            $("#mensajeVerificacionDescripcion").fadeIn(1000).html(respuesta);
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de verificar la disponibilidad de la descripción para el rango de abonados seleccionado");

          }

        });

  }

  /*
  //Metodo para activar evento change para los combos de rango y descripcion
  */

  function activarValidacionExistenciaDescripcion(idComboRango,idComboDescripcion){

      $(".combo").change(function(){

        var valorComboRango = idComboRango.val().trim();
        var valorComboDescripcion = idComboDescripcion.val().trim();

        if (valorComboRango != "" && valorComboDescripcion != "") {
        
          verificarExistenciaDescripcion(valorComboRango,valorComboDescripcion);
           
        }else{

          $("#mensajeVerificacionDescripcion").html("");

        }

      });

  }

  /*
  //Metodo ajax que permite verificar la existencia de la descripción para un rango de abonados seleccionado
  //Nota: Este metodo se utiliza al editar una tarifa
  */

  function verificarExistenciaDescripcionEnEdicion(valorComboRango,valorComboDescripcionActual,valorComboDescripcionNueva){

        $.ajax({
          url: "/SisConAsadaLaUnion/tarifa/verificarDescripcionExistenteEnEdicion",
          type: "POST",
          data: "idAbonadoAsada="+valorComboRango+"&descripcionActual="+valorComboDescripcionActual+"&descripcionNueva="+valorComboDescripcionNueva,
          beforeSend: function(){

            $("#mensajeVerificacionDescripcion").fadeIn(1000).html('<img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/>');

          },
          success: function(respuesta){

            $("#mensajeVerificacionDescripcion").fadeIn(1000).html(respuesta);
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de verificar la disponibilidad de la descripción para el rango de abonados seleccionado");

          }

        });

  }

  /*
  //Metodo para activar evento change para los combos de rango y descripcion
  */

  function activarValidacionExistenciaDescripcionEnEdicion(idComboRango,idComboDescripcion,valorComboDescripcionActual){

      $(".combo").change(function(){

        var valorComboRango = idComboRango.val().trim();
        var valorComboDescripcionNueva = idComboDescripcion.val().trim();

        if (valorComboRango != "" && valorComboDescripcionNueva != "") {
        
          verificarExistenciaDescripcionEnEdicion(valorComboRango,valorComboDescripcionActual,valorComboDescripcionNueva);
           
        }else{

          $("#mensajeVerificacionDescripcion").html("");

        }

      });

  }