  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    cargarListaClientes(1);

    crearDialogTelefonos();

    levantarVentanaModalTelefonos($("#verNumsTel"));

  });

  /*
  //Metodo encargado de gestionar la carga de la lista de clientes con el servidor
  */

  function cargarListaClientes(paginaActual){

        $.ajax({
          url: "/SisConAsadaLaUnion/cliente/consultarClientesActivos",
          type: "POST",
          data: "paginaActual="+paginaActual,
          beforeSend: function(){

            $("#cuerpoTablaClientes").html('<tr><td colspan="7"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

          },
          success: function(respuesta){

            $("#cuerpoTablaClientes").empty();

            if (respuesta["tablaClientes"] != "false") {

              var informacionClientes = eval(respuesta);
      
              $("#cuerpoTablaClientes").html(informacionClientes["tablaClientes"]);
            
              $("#paginacion").html(informacionClientes["listaPaginas"]);

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
  //Metodo encargado de gestionar la carga de los telefonos de un cliente con el servidor
  */

  function cargarTelefonosCliente(cedulaCliente,idVentanaNumsTel){

        $.ajax({
          url: "/SisConAsadaLaUnion/cliente/consultarTelefonosClientePorCedula",
          type: "POST",
          data: "cedulaCliente="+cedulaCliente,
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