  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    crearListaPaginasPaginacion(1,"obtenerClientes","false");

    crearDialogTelefonos();

    crearDialogEditarCliente();

    buscarClientesCedulaNombre();

    levantarVentanaModalTelefonos($("#verNumsTel"));

    validarTelefonoNoRequeridoCombo();

    validarTelefonoNoRequeridoInput();

    ejecutarAccionSeleccionada();
    
  });

  //Variable global que contiene el numero de la pagina actual de la paginacion

  var paginaActualGlb = 0;

  /*
  //Metodo encargado de gestionar la carga de la lista de clientes con el servidor
  */

  function cargarListaClientes(paginaActualCli,nombreMetodo,cedulaNombre){

        $.ajax({
          url: "/SisConAsadaLaUnion/cliente/consultarClientesActivos",
          type: "POST",
          data: { paginaActual : paginaActualCli , metodo : nombreMetodo , busqueda: cedulaNombre },
          dataType: "json",
          beforeSend: function(){

            $("#cuerpoTablaClientes").html('<tr><td colspan="8"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

          },
          success: function(respuesta){

            $("#cuerpoTablaClientes").empty();

            if (respuesta["tablaClientes"] != "false") {

              var informacionClientes = eval(respuesta);
      
              $("#cuerpoTablaClientes").html(informacionClientes["tablaClientes"]);

            }else{

              alertify.error("Error al tratar de cargar la información sobre los clientes en la tabla, la función esperaba un parámetro entero como entrada");

            }
          
          },
          error: function(error){

            $("#cuerpoTablaClientes").empty();

            alertify.error("Error de conexión al tratar de cargar la información sobre los clientes en la tabla");

          }

        });

  }

  /*
  //Metodo encargado de hacer la paginación de la consulta sobre la información de clientes
  */

  function listaPaginasConsultaClientes(totalPaginas,paginasVisibles,paginaInicio,nombreMetodo,cedulaNombre){

    if (totalPaginas != 0) {

      var ejecucionOnLoad = true;
           
      $("#paginacion").twbsPagination({
        totalPages: totalPaginas,
        visiblePages: paginasVisibles,
        startPage: paginaInicio,
        first: 'Primero',
        prev: '&laquo; Anterior',
        next: 'Siguiente &raquo;',
        last: 'Último',
        onPageClick: function (event, page) { 
          paginaActualGlb = page;
          if (ejecucionOnLoad) {
            ejecucionOnLoad = false;
          }else{
            $("#paginacion").twbsPagination('destroy');
            crearListaPaginasPaginacion(page,nombreMetodo,cedulaNombre);
          }
          cargarListaClientes(page,nombreMetodo,cedulaNombre);
        }
      });

    }else{

      $("#cuerpoTablaClientes").html("<tr><td colspan='8' style='text-align:center;'>No se encontraron resultados</td></tr>");

    }
    
  }

  /*
  //Metodo encargado de crear la lista de páginas que va tener la paginación
  */

  function crearListaPaginasPaginacion(paginaInicio,nombreMetodo,cedulaNombre){

        $.ajax({
          url: "/SisConAsadaLaUnion/cliente/consultarTotalidadPaginasClientesActivos",
          type: "POST",
          data: { permisoConsultaTotalPaginas : "true", metodo : nombreMetodo, busqueda : cedulaNombre },
          dataType: "json",
          beforeSend: function(){

            $("#cuerpoTablaClientes").html('<tr><td colspan="8"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

          },
          success: function(respuesta){

            if (respuesta["totalPaginas"] != "false") { 

              var totalidadDePaginas = respuesta["totalPaginas"];

              //calcular paginas visibles

              if (totalidadDePaginas <= 10) {

                listaPaginasConsultaClientes(totalidadDePaginas,totalidadDePaginas,paginaInicio,nombreMetodo,cedulaNombre);

              }else{

                listaPaginasConsultaClientes(totalidadDePaginas,10,paginaInicio,nombreMetodo,cedulaNombre);

              }

            }else{

              alertify.error("Error al tratar de obtener la totalidad de clientes que se encuentran alojados en la base de datos, la función esperaba alguna cédula o nombre como entrada");

            }
          
          },
          error: function(error){

            $("#cuerpoTablaClientes").empty();

            alertify.error("Error de conexión al tratar de obtener la totalidad de clientes que se encuentran alojados en la base de datos");
           
          }

        });

  }

  /*
  //Metodo encargado de crear el dialog correspondiente para mostrar los telefonos de cada cliente
  */

 function crearDialogTelefonos(){

  var idVentanaNumsTel = $("#verNumsTel");

  idVentanaNumsTel.dialog({
      autoOpen: false,
      modal: true,
      width: 500,
      height: 180,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
      close: function(ev,ui){
        idVentanaNumsTel.empty();
      }
    });

 }

  /*
  //Metodo encargado de crear el dialog correspondiente para mostrar la pagina para editar un cliente
  */

 function crearDialogEditarCliente(){

  var idVentanaEditarCliente = $("#editarCliente");

  idVentanaEditarCliente.dialog({
      autoOpen: false,
      modal: true,
      width: 600,
      height: 600,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });

 }

  /*
  //Metodo encargado de gestionar la busqueda de clientes por su cedula o nombre
  */

  function buscarClientesCedulaNombre(){

    var timeout = null;

    $("#buscarCliente").on('keyup', function() {

    $("#cuerpoTablaClientes").html('<tr><td colspan="8"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

    var cedulaNombre = $(this).val().trim();
    
    clearTimeout(timeout);
    
    timeout = setTimeout(function() {

          if ($("#paginacion").html().length > 0) {

            $("#paginacion").twbsPagination('destroy');
              
          }

          if (cedulaNombre != "") {

            crearListaPaginasPaginacion(1,"obtenerClientesCedulaNombre",cedulaNombre);

          }else{

            crearListaPaginasPaginacion(1,"obtenerClientes","false");        

          }

    }, 500)
    
    })
  
  }

  /*
  //Metodo encargado de gestionar la carga de los telefonos de un cliente con el servidor
  */

  function cargarTelefonosCliente(cedulaClienteActual,idVentanaNumsTel){

        $.ajax({
          url: "/SisConAsadaLaUnion/cliente/consultarTelefonosClientePorCedula",
          type: "POST",
          data: { cedulaCliente : cedulaClienteActual },
          dataType: "json",
          beforeSend: function(){

            idVentanaNumsTel.html('<img style="position:absolute; top:50%; left:46.5%; transform:translateY(-50%);" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/>');
            
            idVentanaNumsTel.dialog("open");

          },
          success: function(respuesta){

            idVentanaNumsTel.empty();

            if (respuesta["tablaTelefonos"] != "false") {

              var informacionTelefonosCliente = eval(respuesta);
      
              idVentanaNumsTel.html(informacionTelefonosCliente["tablaTelefonos"]);

            }else{

              alertify.error("Error al tratar de cargar los números de teléfono del cliente seleccionado en la ventana modal, la función esperaba un parámetro no vacío y de solo números (no más de 16)");

            }
          
          },
          error: function(error){

            idVentanaNumsTel.empty();

            alertify.error("Error de conexión al tratar de cargar los números de teléfono del cliente seleccionado en la ventana modal");

          }

        });

  }

  /*
  // Metodo encargado de levantar la ventana modal de los números de teléfono de un cliente
  */

  function levantarVentanaModalTelefonos(idVentanaNumsTel){

     $("#tablaClientes").on("click", ".img-telefono", function(e){

        var cedulaCliente = $(this).attr("data-cedula");

        cargarTelefonosCliente(cedulaCliente,idVentanaNumsTel);

      });

  }

  /*
  // Metodo para que el usuario confirme una transaccion
  */

  function confirmarTransaccion(mensaje) {

   return confirm(mensaje);

  }

  /*
  // Metodo ajax para anular un cliente
  */

  function anularCliente(cedulaClienteSeleccionado,tablaClientes){

    $.ajax({
          url: "/SisConAsadaLaUnion/cliente/anularCliente",
          type: "POST",
          data: "cedulaCliente="+cedulaClienteSeleccionado,
          success: function(respuesta){

           if (respuesta == "true") {

            if ($("#paginacion").html().length > 0) {

               $("#paginacion").twbsPagination('destroy');
              
            }

            var cantidadFilasTabla = $('#tablaClientes tr').length-2;

            var cedulaNombre = $("#buscarCliente").val().trim();

            if(cantidadFilasTabla == 0 && paginaActualGlb > 1){

              paginaActualGlb--;

            }

            if (cedulaNombre != "") {

              crearListaPaginasPaginacion(paginaActualGlb,"obtenerClientesCedulaNombre",cedulaNombre);

            }else{

              crearListaPaginasPaginacion(paginaActualGlb,"obtenerClientes","false");

            }

            alertify.success("Cliente anulado con éxito");

           }else{

            tablaClientes.closest('select').val("");

            alertify.error("Ha ocurrido un error al tratar de anular el cliente seleccionado");            

           }
          
          },
          error: function(error){

            tablaClientes.closest('select').val("");

            alertify.error("Error de conexión al tratar de anular el cliente seleccionado");

          }

        });

  }

   /*
  // Metodo ajax para cargar un cliente por su numero de cedula
  */

  function cargarClientePorCedula(cedulaClienteSeleccionado){

    $.ajax({
          url: "/SisConAsadaLaUnion/cliente/obtenerClientePorCedula",
          type: "POST",
          data: { cedulaCliente : cedulaClienteSeleccionado },
          dataType: "json",
          success: function(respuesta){

           if (respuesta != "false") {

            var cedulaActual = "";
            var correoActual = "";
            var numeroPlanoActual = "";

             $(respuesta).each(function(indice, valor){

                cedulaActual = valor.cliente.cedula;
                correoActual = valor.cliente.correo;

                $("#idCedulaCliente").val(valor.cliente.cedula);
                $("#idNombreCliente").val(valor.cliente.nombre);
                $("#idApellidosCliente").val(valor.cliente.apellidos);
                $("#idCorreoCliente").val(valor.cliente.correo);
                $("#idTipoTel1Cliente").val(valor.telefonosCliente[indice].tipo).change();
                $("#idNumTel1Cliente").val(valor.telefonosCliente[indice].numero);
                
                if(valor.telefonosCliente.length > 1){
                
                  $("#idTipoTel2Cliente").val(valor.telefonosCliente[indice+1].tipo).change();
                  $("#idNumTel2Cliente").val(valor.telefonosCliente[indice+1].numero);
                
                }else{
                
                  $("#idTipoTel2Cliente").val("").change();
                  $("#idNumTel2Cliente").val("");
                
                }
                
                $("#idDireccionCliente").val(valor.cliente.direccion);

                if (valor.cliente.numeroPlano != null) {

                  numeroPlanoActual = valor.cliente.numeroPlano;
                  $("#idNumPlanoCliente").val(valor.cliente.numeroPlano);

                }else{

                  valor.cliente.numeroPlano = "";
                  $("#idNumPlanoCliente").val("");

                }
                  
             });

             var idCedula = $("#idCedulaCliente");
             var idCorreoElectronico = $("#idCorreoCliente");
             var idNumeroPlano = $("#idNumPlanoCliente");

            //Desasociar eventos de componentes
            idCedula.unbind("blur");
            idCorreoElectronico.unbind("blur");
            idNumeroPlano.unbind("blur");

            //Validaciones para el form de actualizar cliente
             blurCampos(idCedula,cedulaActual,"verificarCedulaExistenteEditar","de la cédula ingresada",$('#mensajeVerificacionCedula'));
             blurCampos(idCorreoElectronico,correoActual,"verificarCorreoElectronicoExistenteEditar","del correo electrónico ingresado",$('#mensajeVerificacionCorreo'));
             blurCampos(idNumeroPlano,numeroPlanoActual,"verificarNumeroPlanoExistenteEditar","del número de plano ingresado",$('#mensajeVerificacionPlano'));

             $("#editarCliente").dialog("open");
           
           }else{

            alertify.error("Ha ocurrido un error al tratar de cargar la información del cliente seleccionado");            

           }
          
          },
          error: function(error){

            alertify.error("Error de conexión al tratar de cargar la información del cliente seleccionado");

          }

    });

  }

  /*
  // Metodo encargado de ejecutar una accion seleccionada por el usuario en el combobox de Acciones
  */

  function ejecutarAccionSeleccionada() {

     $("#tablaClientes").on("change", ".form-control.acciones", function(e){
        
        var accion = $(this).val();

        if (accion == "Editar") {

          var idForm = $("#idEditarClienteForm");
          var cedulaCliente = $(this).attr("data-cedula");

          //Limpiar campos siempre antes de cargar form de edicion
          limpiarCamposForm(idForm);
          $('#mensajeVerificacionCedula').empty();
          $('#mensajeVerificacionCorreo').empty();
          $('#mensajeVerificacionPlano').empty();
          
          //Llamada al metodo ajax para cargar el form edicion con los datos del cliente seleccionado
          cargarClientePorCedula(cedulaCliente);

          $(this).closest('select').val("");

        }

        if (accion == "Anular") {

          if (confirmarTransaccion("¿Desea continuar con la exclusión del cliente seleccionado?")) {
      
              var cedulaCliente = $(this).attr("data-cedula");

              anularCliente(cedulaCliente,$(this));

            }else{

              $(this).closest('select').val("");
            
            }

        }

      });

  }