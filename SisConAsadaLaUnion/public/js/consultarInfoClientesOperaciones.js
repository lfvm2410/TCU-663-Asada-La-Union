  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    crearListaPaginasPaginacion(1,"obtenerClientes","false");

    crearDialogTelefonos();

    buscarClientesCedulaNombre();

    levantarVentanaModalTelefonos($("#verNumsTel"));

  });

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

            $("#cuerpoTablaClientes").html('<tr><td colspan="7"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

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

      $("#cuerpoTablaClientes").html("<tr><td colspan='7' style='text-align:center;'>No se encontraron resultados</td></tr>");

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

            $("#cuerpoTablaClientes").html('<tr><td colspan="7"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

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
  //Metodo encargado de gestionar la busqueda de clientes por su cedula o nombre
  */

  function buscarClientesCedulaNombre(){

    var timeout = null;

    $("#buscarCliente").on('keyup', function() {

    $("#cuerpoTablaClientes").html('<tr><td colspan="7"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

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