  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

   $(document).on("ready", function () {

        var direccionCantidadPaginas = "/SisConAsadaLaUnion/abonadoAsada/consultarTotalidadPaginasAbonados";

        var direccionConsultaRegistros = "/SisConAsadaLaUnion/abonadoAsada/consultarAbonados";

        var idFiltroBusqueda = $("#buscar");

        var idCuerpoTabla = $("#cuerpoTablaRangosAbonados");

        var colspan = 3;

        crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,1,idFiltroBusqueda.val().trim(),idCuerpoTabla,colspan);

        buscarRegistrosPorFiltro(direccionCantidadPaginas,direccionConsultaRegistros,idFiltroBusqueda,idCuerpoTabla,colspan);

        crearVentanaModal($("#editarRangoAbonados"),600,295,"false");

        ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

    });

  /*
  //Metodo para enviar el formulario de rangos de abonados, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioRangoAbonados(idForm,url,idAbonadoAsadaActual,rangoAbonadosAct,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    $.ajax({
      url:  url,
      type: "POST",
      data: "idAbonadoAsada="+idAbonadoAsadaActual+"&rangoAbonadosActual="+rangoAbonadosAct+"&"+datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("La información del rango de abonados seleccionado se ha editado correctamente");
             
              $("#editarRangoAbonados").dialog("close");
             
              limpiarCamposForm(idForm);
              $('#mensajeVerificacionRangoAbonados').html("");

              //Se recarga la tabla de rangos de abonados

              actualizarTabla("Update",$('#tablaRangosAbonados tr').length,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);
         
          }else{
            
              alertify.error("Ha ocurrido un error al tratar de editar la información del rango de abonados seleccionado, inténtelo de nuevo");

          }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de editar la información del rango de abonados seleccionado, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de edición del rango de abonados seleccionado
  */

  function activarEnvioDatos(idForm,idAbonadoAsadaActual,rangoAbonadosActual,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    idForm.on('submit', function(e){

      e.preventDefault();

      var verificarRangoAbonados = $("#msjRangoAbonados").attr("data-rangoAbonados");

      if (verificarRangoAbonados != "false") {

        if (confirmarTransaccion('¿Está seguro de proceder con la edición de información del rango de abonados seleccionado?')){
                
          var url = "/SisConAsadaLaUnion/abonadoAsada/editarAbonado";

          var datosFormulario = idForm.serialize();

          enviarFormularioRangoAbonados(idForm,url,idAbonadoAsadaActual,rangoAbonadosActual,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

        }

      }  

    });

  }

  /*
  // Metodo ajax para cargar un rango de abonados por su id
  */

  function cargarRangoAbonadosPorId(idAbonadoAsadaSeleccionado,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    $.ajax({
          url: "/SisConAsadaLaUnion/abonadoAsada/obtenerAbonadoPorId",
          type: "POST",
          data: { idAbonadoAsada : idAbonadoAsadaSeleccionado },
          dataType: "json",
          success: function(respuesta){

           if (respuesta != "false") {

            var idForm = $("#idEditarRangoAbonadosForm");
            var idRangoAbonados = $("#idRangoAbonados");
            var idAbonadoAsadaActual = respuesta.idAbonadoAsada;
            var rangoAbonadosActual = respuesta.rango;
            
            idRangoAbonados.val(respuesta.rango);

            //Desasociar eventos de componentes
            idForm.unbind("submit");
            idRangoAbonados.unbind("blur");

            //Validaciones para el form de editar rango de abonados
            blurCamposEnEdicionGenerico(idRangoAbonados,rangoAbonadosActual,"abonadoAsada/verificarRangoAbonadosExistenteEditar","del rango de abonados ingresado",$("#mensajeVerificacionRangoAbonados"));
             
            //Activar .submit del formulario
            activarEnvioDatos(idForm,idAbonadoAsadaActual,rangoAbonadosActual,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

            $("#editarRangoAbonados").dialog("open");
           
           }else{

            alertify.error("Ha ocurrido un error al tratar de cargar la información del rango de abonados seleccionado");            

           }
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de cargar la información del rango de abonados seleccionado");

          }

    });

  }

  /*
  // Metodo encargado de ejecutar una accion seleccionada por el usuario en el combobox de Acciones
  */

  function ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan) {

     $("#tablaRangosAbonados").on("change", ".form-control.acciones", function(e){
        
        var accion = $(this).val();

        if (accion == "Editar") {

          var idForm = $("#idEditarRangoAbonadosForm");
          var idAbonadoAsada = $(this).attr("data-identificador");

          //Limpiar campos siempre antes de cargar form de edicion
          limpiarCamposForm(idForm);
          $('#mensajeVerificacionRangoAbonados').html("");

          //Llamada al metodo ajax para cargar el form edicion con los datos del rango de abonados seleccionado
          cargarRangoAbonadosPorId(idAbonadoAsada,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

          $(this).closest('select').val("");

        }

      });

  }