  /*
  //Metodo principal (llamado de todas las funciones hechas en este .js)
  */

  $(document).on("ready", function () {

    crearListaPaginasPaginacion(1,"obtenerProductos","false");

    crearDialogEditarProducto();

    buscarProductosNombre();
    
    ejecutarAccionSeleccionada();

  });

  //Variable global que contiene el numero de la pagina actual de la paginacion

  var paginaActualGlb = 0;

  /*
  //Metodo encargado de gestionar la carga de la lista de productos con el servidor
  */

  function cargarListaProductos(paginaActualProd,nombreMetodo,nombre){

        $.ajax({
          url: "/SisConAsadaLaUnion/producto/consultarProductos",
          type: "POST",
          data: { paginaActual : paginaActualProd , metodo : nombreMetodo , busqueda: nombre },
          dataType: "json",
          beforeSend: function(){

            $("#cuerpoTablaProductos").html('<tr><td colspan="5"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

          },
          success: function(respuesta){

            $("#cuerpoTablaProductos").empty();

            if (respuesta["tablaProductos"] != "false") {

              var informacionProductos = eval(respuesta);
      
              $("#cuerpoTablaProductos").html(informacionProductos["tablaProductos"]);

            }else{

              alertify.error("Error al tratar de cargar la información sobre los productos en la tabla, la función esperaba un parámetro entero como entrada");

            }
          
          },
          error: function(error){

            $("#cuerpoTablaProductos").empty();

            alertify.error("Error de conexión al tratar de cargar la información sobre los productos en la tabla");

          }

        });

  }

  /*
  //Metodo encargado de hacer la paginación de la consulta sobre la información de productos
  */

  function listaPaginasConsultaProductos(totalPaginas,paginasVisibles,paginaInicio,nombreMetodo,nombre){

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
            crearListaPaginasPaginacion(page,nombreMetodo,nombre);
          }
          cargarListaProductos(page,nombreMetodo,nombre);
        }
      });

    }else{

      $("#cuerpoTablaProductos").html("<tr><td colspan='5' style='text-align:center;'>No se encontraron resultados</td></tr>");

    }
    
  }

  /*
  //Metodo encargado de crear la lista de páginas que va tener la paginación
  */

  function crearListaPaginasPaginacion(paginaInicio,nombreMetodo,nombre){

        $.ajax({
          url: "/SisConAsadaLaUnion/producto/consultarTotalidadPaginasProductos",
          type: "POST",
          data: { permisoConsultaTotalPaginas : "true", metodo : nombreMetodo, busqueda : nombre },
          dataType: "json",
          beforeSend: function(){

            $("#cuerpoTablaProductos").html('<tr><td colspan="5"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

          },
          success: function(respuesta){

            if (respuesta["totalPaginas"] != "false") { 

              var totalidadDePaginas = respuesta["totalPaginas"];

              //calcular paginas visibles

              if (totalidadDePaginas <= 10) {

                listaPaginasConsultaProductos(totalidadDePaginas,totalidadDePaginas,paginaInicio,nombreMetodo,nombre);

              }else{

                listaPaginasConsultaProductos(totalidadDePaginas,10,paginaInicio,nombreMetodo,nombre);

              }

            }else{

              alertify.error("Error al tratar de obtener la totalidad de productos que se encuentran alojados en la base de datos, la función esperaba el nombre del producto como entrada");

            }
          
          },
          error: function(error){

            $("#cuerpoTablaProductos").empty();

            alertify.error("Error de conexión al tratar de obtener la totalidad de productos que se encuentran alojados en la base de datos");
           
          }

        });

  }

  /*
  //Metodo encargado de crear el dialog correspondiente para mostrar la pagina para editar un producto
  */

 function crearDialogEditarProducto(){

  var idVentanaEditarProducto = $("#editarProducto");

  idVentanaEditarProducto.dialog({
      autoOpen: false,
      modal: true,
      width: 600,
      height: 370,
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
  //Metodo encargado de gestionar la busqueda de productos por su nombre
  */

  function buscarProductosNombre(){

    var timeout = null;

    $("#buscarProducto").on('keyup', function() {

    $("#cuerpoTablaProductos").html('<tr><td colspan="5"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

    var nombre = $(this).val().trim();
    
    clearTimeout(timeout);
    
    timeout = setTimeout(function() {

          if ($("#paginacion").html().length > 0) {

            $("#paginacion").twbsPagination('destroy');
              
          }

          if (nombre != "") {

            crearListaPaginasPaginacion(1,"obtenerProductosNombre",nombre);

          }else{

            crearListaPaginasPaginacion(1,"obtenerProductos","false");        

          }

    }, 500)
    
    })
  
  }


  /*
  // Metodo para que el usuario confirme una transaccion
  */

  function confirmarTransaccion(mensaje) {

   return confirm(mensaje);

  }

  /*
  // Metodo encargado de ejecutar una accion seleccionada por el usuario en el combobox de Acciones
  */

  function ejecutarAccionSeleccionada() {

     $("#tablaProductos").on("change", ".form-control.acciones", function(e){
        
        var accion = $(this).val();

        if (accion == "Editar") {

          var idForm = $("#idEditarProductoForm");
          var idProducto = $(this).attr("data-producto");

          //Limpiar campos siempre antes de cargar form de edicion
          limpiarCamposForm(idForm);
          
          //Llamada al metodo ajax para cargar el form edicion con los datos del producto seleccionado
          cargarProductoPorId(idProducto);

          $(this).closest('select').val("");

        }

        if (accion == "Eliminar") {

          if (confirmarTransaccion("¿Desea continuar con la eliminación del producto seleccionado?")) {
      
              var idProducto = $(this).attr("data-producto");

              eliminarProducto(idProducto,$(this));

            }else{

              $(this).closest('select').val("");
            
            }

        }

      });

  }