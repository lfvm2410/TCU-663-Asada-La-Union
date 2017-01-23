  /*
  //Metodo para enviar el formulario de edición de la persona seleccionada
  */

  function activarEnvioDatos(idForm,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    idForm.on('submit', function(e){

      e.preventDefault(); 

        if (confirmarTransaccion('¿Está seguro de proceder con el registro del servicio?')) 
        {
            
            var url = "/SisConAsadaLaUnion/servicio/editarServicio";

            var datosFormulario = idForm.serialize();

            enviarFormularioServicio(idForm,url,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

        }

    });

  }

  /*
  //Metodo para enviar el formulario de cliente, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioServicio(idForm,url,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    $.ajax({
      url:  url,
      type: "POST",
      data: datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("Servicio editado con éxito");

              actualizarTabla("Update",$('#tablaServicio tr').length,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);


              //limpiarCamposForm(idForm);

              $('#mensajeVerificacionNumNIS').html("");

          }else{
            
              alertify.error("Ha ocurrido un error al tratar de editar el Servicio, inténtelo de nuevo");
      	  }
      },
      error: function(error){

          alertify.error("Error de conexión al tratar de editar el Servicio, inténtelo de nuevo");

      }

      });
    }
  
  /*
  // Metodo ajax para cargar un servicio por su id
  */

  function cargarServicioPorId(idServicio,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan)
  {
  	$.ajax({
          url: "/SisConAsadaLaUnion/servicio/obtenerServicioPorID",
          type: "POST",
          data: { idServicio : idServicio },
          dataType: "json",
          success: function(respuesta){

          	if (respuesta != "false") 
          	{
          		var idServicioActual = 0;
          		var numNISActual = "";

       			idServicioActual = respuesta.idServicio;	
       			$("#idnumNIS").val(respuesta.numeroNIS);
          		$("#idCliente").val(respuesta.cliente);
          		$("#tipoServicio").val(respuesta.tipoServicio);
          		$("#cbEstado").val(respuesta.estado);
          		$("#fecModificacion").val(respuesta.fechaModificacion);
          		$("#idServicio").val(respuesta.idServicio);
          		
          		var idForm = $("#idEditarServicioForm");
          		var idnumNIS = $("#idnumNIS");

          		//Desasociar eventos de componentes
          		idForm.unbind("submit");

          		

          		//Activar .submit del formulario
          		activarEnvioDatos(idForm,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);


  				$("#editarServicio").dialog("open");

          	}
          	else
          	{
          		alertify.error("Ha ocurrido un error al tratar de cargar la información del servicio seleccionado");
          	}
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de cargar la información del servicio seleccionado");

          }
  });
}

function cargarServicioPorIdLecturas($idServicio)
  {
    $.ajax({
          url: "/SisConAsadaLaUnion/servicio/obtenerServicioPorID",
          type: "POST",
          data: { idServicio : $idServicio },
          dataType: "json",
          success: function(respuesta){

            if (respuesta != "false") 
            {
              var idServicioActual = 0;
              var numNISActual = "";

              idServicioActual = respuesta.idServicio;  
              $("#idnumNISLec").val(respuesta.numeroNIS);
              $("#idClienteLec").val(respuesta.cliente);
              $("#idServicioLec").val(respuesta.idServicio);
              
              var idForm = $("#idEditarServicioForm");
              var idnumNIS = $("#idnumNIS");

              //Desasociar eventos de componentes
              idForm.unbind("submit");

              cargarTablaLecturas();

              //Activar .submit del formulario
              //activarEnvioDatos(idForm,idServicioActual,numNISActual);


          $("#verLecturas").dialog("open");

            }
            else
            {
              alertify.error("Ha ocurrido un error al tratar de cargar la información del servicio seleccionado");
            }
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de cargar la información del servicio seleccionado");

          }
  });
}

function cargarTablaLecturas()
{

  var direccionCantidadPaginas = "/SisConAsadaLaUnion/lectura/consultarTotalidadPaginasLecturas";
  var direccionConsultarServicios = "/SisConAsadaLaUnion/lectura/consultarLecturas";
  var idFiltroBusqueda = $('#idServicioLec');
  var idCuerpoTabla = $('#cuerpoTablaLectura');
  var colspan = 9;

  crearListaPaginasPaginacion(direccionCantidadPaginas, direccionConsultarServicios, 1, idFiltroBusqueda.val().trim(), idCuerpoTabla, colspan);

  buscarRegistrosPorFiltro(direccionCantidadPaginas, direccionConsultarServicios, idFiltroBusqueda, idCuerpoTabla, colspan);
}


  /*
  // Metodo encargado de ejecutar una accion seleccionada por el usuario en el combobox de Acciones
  */

  function ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    crearVentanaModal($("#dialogLecturas"),1100,800,"false");

  	$("#tablaServicio").on("change", ".form-control.acciones", function(e){

  		var accion = $(this).val();

  		if (accion == "Editar") 
      {
  			var idForm = $("#editarServicio");
  			var idServicio = $(this).attr("data-identificador");
  			cargarServicioPorId(idServicio,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);
  			
        $(this).closest('select').val("");
  		}
      else if(accion == "Lecturas")
      {
        var idServicio = $(this).attr("data-identificador");
      
        $("#dialogLectura").html('<iframe id="idIframe" title="La pinga de herodes" width="100%" height="100%"></iframe>');
        $('#idIframe').attr("src","/SisConAsadaLaUnion/lectura/registrarLecturaForm/?idServicio="+idServicio);
        $("#dialogLecturas").dialog("open");

        $(this).closest('select').val("");

      }

  	});
  }