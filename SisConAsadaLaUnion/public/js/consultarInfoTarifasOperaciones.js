  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

   $(document).on("ready", function () {

        var direccionCantidadPaginas = "/SisConAsadaLaUnion/tarifa/consultarTotalidadPaginasTarifas";

        var direccionConsultaRegistros = "/SisConAsadaLaUnion/tarifa/consultarTarifas";

        var idFiltroBusqueda = $("#buscar");

        var idCuerpoTabla = $("#cuerpoTablaTarifas");

        var colspan = 7;

        crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,1,idFiltroBusqueda.val().trim(),idCuerpoTabla,colspan);

        buscarRegistrosPorFiltro(direccionCantidadPaginas,direccionConsultaRegistros,idFiltroBusqueda,idCuerpoTabla,colspan);

        crearVentanaModal($("#editarTarifa"),600,600,"false");

        ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

    });

  /*
  //Metodo para enviar el formulario de tarifa, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioTarifa(idForm,url,idTarifaActual,descripcionAct,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    $.ajax({
      url:  url,
      type: "POST",
      data: "idTarifa="+idTarifaActual+"&descripcionActual="+descripcionAct+"&"+datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("La información de la tarifa seleccionada se ha editado correctamente");
             
              $("#editarTarifa").dialog("close");
             
              limpiarCamposForm(idForm);
              $("#mensajeVerificacionDescripcion").html("");

              //Se recarga la tabla de tarifas

              actualizarTabla("Update",$('#tablaTarifas tr').length,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);
         
          }else{
            
              alertify.error("Ha ocurrido un error al tratar de editar la información de la tarifa seleccionada, inténtelo de nuevo");

          }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de editar la información de la tarifa seleccionada, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de edición de la tarifa seleccionada
  */

  function activarEnvioDatos(idForm,idTarifaActual,descripcionActual,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    idForm.on('submit', function(e){

      e.preventDefault();

      var verificarDescripcion = $("#msjDescripcion").attr("data-descripcion");

      if (verificarDescripcion != "false") {

        if (confirmarTransaccion('¿Está seguro de proceder con la edición de información de la tarifa seleccionada?')){
                
          var url = "/SisConAsadaLaUnion/tarifa/editarTarifa";

          var datosFormulario = idForm.serialize();

          enviarFormularioTarifa(idForm,url,idTarifaActual,descripcionActual,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

        }  

    }

    });

  }

  /*
  // Metodo ajax para cargar una tarifa por su id
  */

  function cargarTarifaPorId(idTarifaSeleccionada,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    $.ajax({
          url: "/SisConAsadaLaUnion/tarifa/obtenerTarifaPorId",
          type: "POST",
          data: { idTarifa : idTarifaSeleccionada },
          dataType: "json",
          success: function(respuesta){

           if (respuesta != "false") {

            var idForm = $("#idEditarTarifaForm");
            var idComboRangoAbonados = $("#idRangoAbonados");
            var idComboDescripcion = $("#idDescripcionTarifa");
            var idTarifaActual = respuesta.idTarifa;
            var descripcionActual = respuesta.descripcion;

            //Desasociar eventos de componentes
            idForm.unbind("submit");
            idComboDescripcion.unbind("change");
            idComboRangoAbonados.unbind("change");

            $("#idRangoAbonados").val(respuesta.idAbonadoAsada).change();
            $("#idNombreTarifa").val(respuesta.nombre);
            $("#idDescripcionTarifa").val(respuesta.descripcion).change();
            $("#idTipoServicio").val(respuesta.tipoServicio).change();
            $("#idMontoTarifa").val(respuesta.monto);

            //Validación para la descripción del form de tarifa
            activarValidacionExistenciaDescripcionEnEdicion(idComboRangoAbonados,idComboDescripcion,descripcionActual);
             
            //Activar .submit del formulario
            activarEnvioDatos(idForm,idTarifaActual,descripcionActual,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

            $("#editarTarifa").dialog("open");
           
           }else{

            alertify.error("Ha ocurrido un error al tratar de cargar la información de la tarifa seleccionada");            

           }
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de cargar la información de la tarifa seleccionada");

          }

    });

  }

  /*
  // Metodo encargado de ejecutar una accion seleccionada por el usuario en el combobox de Acciones
  */

  function ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan) {

     $("#tablaTarifas").on("change", ".form-control.acciones", function(e){
        
        var accion = $(this).val();

        if (accion == "Editar") {

          var idForm = $("#idEditarTarifaForm");
          var idTarifa = $(this).attr("data-identificador");

          //Limpiar campos siempre antes de cargar form de edicion
          limpiarCamposForm(idForm);
          $("#mensajeVerificacionDescripcion").html("");

          //Se cargan los combos
          llenarCombobox($("#idRangoAbonados"),"tarifa/llenarComboRangoAsada","la lista desplegable del campo rango de abonados");
          llenarCombobox($("#idDescripcionTarifa"),"tarifa/llenarComboDescripcion","la lista desplegable del campo de descripción");

          //Llamada al metodo ajax para cargar el form edicion con los datos de la tarifa seleccionada
          cargarTarifaPorId(idTarifa,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

          $(this).closest('select').val("");

        }

      });

  }