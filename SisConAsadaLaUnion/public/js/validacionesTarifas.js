  /*
  // Archivo .js encargado de contener las validaciones a emplear para las tarifas
  */

  /*
  //Metodo ajax que permite llenar el combobox de rango de abonados
  */

  function llenarComboboxRangoAbonados(){

    $.ajax({
      url: "/SisConAsadaLaUnion/tarifa/llenarComboRangoAsada",
      type: "POST",
      success: function(respuesta){

        var informacionRangosAbonados = eval(respuesta);
      
        $("#idRangoAbonados").html(informacionRangosAbonados["optionsList"]);
          
      },
      error: function(error){

        alertify.error("Error de conexión al tratar de cargar la lista desplegable de rango de abonados");

      }

    });

  }