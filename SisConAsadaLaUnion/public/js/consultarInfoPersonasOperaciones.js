  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

   $(document).on("ready", function () {

        var direccionCantidadPaginas = "/SisConAsadaLaUnion/persona/consultarTotalidadPaginasPersonas";

        var direccionConsultaRegistros = "/SisConAsadaLaUnion/persona/consultarPersonas";

        var idFiltroBusqueda = $("#buscar");

        var idCuerpoTabla = $("#cuerpoTablaPersonas");

        var colspan = 9;

        crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,1,idFiltroBusqueda.val().trim(),idCuerpoTabla,colspan);

        buscarRegistrosPorFiltro(direccionCantidadPaginas,direccionConsultaRegistros,idFiltroBusqueda,idCuerpoTabla,colspan);

        crearVentanaModal($("#verNumsTel"),500,180,"true");

        crearVentanaModal($("#editarPersona"),600,600,"false");

        levantarVentanaModalTelefonos($("#verNumsTel"));

        ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);
    
     });

  /*
  // Metodo encargado de levantar la ventana modal de los números de teléfono de una persona
  */

  function levantarVentanaModalTelefonos(idVentanaNumsTel){

     $("#tablaPersonas").on("click", ".img-telefono", function(e){

        var idPersona = $(this).attr("data-identificador");

        cargarTelefonosPersona(idPersona,idVentanaNumsTel);

      });

  }

  /*
  //Metodo encargado de gestionar la carga de los telefonos de una persona con el servidor
  */

  function cargarTelefonosPersona(idPersonaActual,idVentanaNumsTel){

        $.ajax({
          url: "/SisConAsadaLaUnion/persona/consultarTelefonosPersonaPorId",
          type: "POST",
          data: { idPersona : idPersonaActual },
          dataType: "json",
          beforeSend: function(){

            idVentanaNumsTel.html('<img style="position:absolute; top:50%; left:46.5%; transform:translateY(-50%);" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/>');
            
            idVentanaNumsTel.dialog("open");

          },
          success: function(respuesta){

            idVentanaNumsTel.empty();

            if (respuesta["tablaTelefonos"] != "false") {

              var informacionTelefonosPersona = eval(respuesta);
      
              idVentanaNumsTel.html(informacionTelefonosPersona["tablaTelefonos"]);

            }else{

              alertify.error("Error al tratar de cargar los números de teléfono de la persona seleccionada en la ventana modal, la función esperaba un parámetro no vacío y de tipo numérico");

            }
          
          },
          error: function(error){

            idVentanaNumsTel.empty();

            alertify.error("Error de conexión al tratar de cargar los números de teléfono de la persona seleccionada en la ventana modal");

          }

        });

  }

  /*
  // Metodo encargado de ejecutar una accion seleccionada por el usuario en el combobox de Acciones
  */

  function ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan) {

     $("#tablaPersonas").on("change", ".form-control.acciones", function(e){
        
        var accion = $(this).val();

        if (accion == "Editar") {

          var idForm = $("#idEditarPersonaForm");
          var idPersona = $(this).attr("data-identificador");

          //Limpiar campos siempre antes de cargar form de edicion
          limpiarCamposForm(idForm);
          
          //Llamada al metodo ajax para cargar el form edicion con los datos de la persona seleccionada
          cargarPersonaPorId(idPersona,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

          $(this).closest('select').val("");

        }else if (accion == "Eliminar") {

          if (confirmarTransaccion("¿Desea continuar con la eliminación de la persona seleccionada?")) {
      
              var idPersona = $(this).attr("data-identificador");

              //eliminarPersona(idPersona,$(this));

            }else{

              $(this).closest('select').val("");
            
            }

        }

      });

  }

  /*
  // Metodo ajax para cargar una persona por su id
  */

  function cargarPersonaPorId(idPersonaSeleccionada,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    $.ajax({
          url: "/SisConAsadaLaUnion/persona/obtenerPersonaPorId",
          type: "POST",
          data: { idPersona : idPersonaSeleccionada, tipoPersona: "Colaborador" },
          dataType: "json",
          success: function(respuesta){

           if (respuesta != "false") {

            var idPersonaActual = 0;
            var cedulaActual = "";
            var correoActual = "";

             $(respuesta).each(function(indice, valor){

                idPersonaActual = valor.persona.idPersona;
                cedulaActual = valor.persona.cedula;
                correoActual = valor.persona.correoElectronico;

                $("#idCedulaPersona").val(valor.persona.cedula);
                $("#idNombrePersona").val(valor.persona.nombre);
                $("#idApellidosPersona").val(valor.persona.apellidos);
                $("#idFechaNacimientoPersona").val(valor.persona.fechaNacimiento);
                $("#idCorreoPersona").val(valor.persona.correoElectronico);   
                $("#idTipoTel1Persona").val(valor.telefonosPersona[indice].tipo).change();
                $("#idNumTel1Persona").val(valor.telefonosPersona[indice].numero);
                
                if(valor.telefonosPersona.length > 1){
                
                  $("#idTipoTel2Persona").val(valor.telefonosPersona[indice+1].tipo).change();
                  $("#idNumTel2Persona").val(valor.telefonosPersona[indice+1].numero);
                
                }else{
                
                  $("#idTipoTel2Persona").val("").change();
                  $("#idNumTel2Persona").val("");
                
                }
                
                $("#idDireccionPersona").val(valor.persona.direccion);
                $("#idPuestoPersona").val(valor.persona.puesto);
                $("#idDescripcionPuestoPersona").val(valor.persona.descripcionPuesto);
                  
             });

            var idForm = $("#idEditarProductoForm");

            //Desasociar eventos de componentes
            idForm.unbind("submit");

            //Activar .submit del formulario
            activarEnvioDatos(idForm,idPersonaActual,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

            $("#editarPersona").dialog("open");
           
           }else{

            alertify.error("Ha ocurrido un error al tratar de cargar la información de la persona seleccionada");            

           }
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de cargar la información de la persona seleccionada");

          }

    });

  }

  /*
  //Metodo para enviar el formulario de persona, usa ajax para la comunicacion del servidor
  */

  function enviarFormularioPersona(idForm,url,idPersonaActual,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    $.ajax({
      url:  url,
      type: "POST",
      data: "idPersona="+idPersonaActual+"&"+datosFormulario,
      success: function(respuesta){

          if (respuesta == "true") {
            
              alertify.success("La información de la persona seleccionada se ha editado correctamente");
             
              $("#editarPersona").dialog("close");
             
              limpiarCamposForm(idForm);

              //Se recarga la tabla de personas

              actualizarTabla("Update",$('#tablaPersonas tr').length,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);
         
          }else{
            
              alertify.error("Ha ocurrido un error al tratar de editar la información de la persona seleccionada, inténtelo de nuevo");

          }

      },
      error: function(error){

          alertify.error("Error de conexión al tratar de editar la información de la persona seleccionada, inténtelo de nuevo");

      }

    });

  }

  /*
  //Metodo para enviar el formulario de edición de la persona seleccionada
  */

  function activarEnvioDatos(idForm,idPersona,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    idForm.on('submit', function(e){

      e.preventDefault();

      if (confirmarTransaccion('¿Está seguro de proceder con la edición de información de la persona seleccionada?')){
            
          var url = "/SisConAsadaLaUnion/persona/editarPersona";

          var datosFormulario = idForm.serialize();

          enviarFormularioPersona(idForm,url,idPersona,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

        }

    });

  }