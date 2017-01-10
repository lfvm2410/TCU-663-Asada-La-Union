  /*
  //Archivo .js que se encarga de elaborar la paginacion de registros a mostrar para el usuario
  //Este .js es genérico, se puede utilizar en cualquier paginación
  */
  
  //Variable global que contiene el numero de la pagina actual de la paginacion

  var paginaActualGlb = 0;

  /*
  //Metodo encargado de gestionar la carga de la lista de registros con el servidor
  */
  function cargarListaRegistros(direccion,paginaActualProd,busqueda,idCuerpoTabla,colspan){

        $.ajax({
          url: direccion,
          type: "POST",
          data: { paginaActual : paginaActualProd , filtroBusqueda: busqueda },
          dataType: "json",
          beforeSend: function(){

            idCuerpoTabla.html('<tr><td colspan="'+colspan+'"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

          },
          success: function(respuesta){

            idCuerpoTabla.empty();

            if (respuesta["tablaRegistros"] != "false") {

              var informacionRegistros = eval(respuesta);
      
              idCuerpoTabla.html(informacionRegistros["tablaRegistros"]);

            }else{

              alertify.error("Error al tratar de cargar la información sobre los registros en la tabla, la función esperaba un parámetro entero como entrada");

            }
          
          },
          error: function(error){

            idCuerpoTabla.empty();

            alertify.error("Error de conexión al tratar de cargar la información sobre los registros en la tabla");

          }

        });

  }

  /*
  //Metodo encargado de hacer la paginación de la consulta sobre la información de los registros
  */
  function listaPaginasConsultaRegistros(totalPaginas,paginasVisibles,paginaInicio,direccionCantidadPaginas,direccionConsultaRegistros,busqueda,idCuerpoTabla,colspan){

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
            crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,page,busqueda,idCuerpoTabla,colspan);
          }
          cargarListaRegistros(direccionConsultaRegistros,page,busqueda,idCuerpoTabla,colspan);
        }
      });

    }else{

      idCuerpoTabla.html("<tr><td colspan='"+colspan+"' style='text-align:center;'>No se encontraron resultados</td></tr>");

    }
    
  }

  /*
  //Metodo encargado de crear la lista de páginas que va tener la paginación
  */
  function crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,paginaInicio,busqueda,idCuerpoTabla,colspan){

        $.ajax({
          url: direccionCantidadPaginas,
          type: "POST",
          data: { permisoConsultaTotalPaginas : "true", filtroBusqueda : busqueda },
          dataType: "json",
          beforeSend: function(){

            idCuerpoTabla.html('<tr><td colspan='+colspan+'><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

          },
          success: function(respuesta){

            if (respuesta["totalPaginas"] != "false") { 

              var totalidadDePaginas = respuesta["totalPaginas"];

              //Calcular paginas visibles

              if (totalidadDePaginas <= 10) {

                listaPaginasConsultaRegistros(totalidadDePaginas,totalidadDePaginas,paginaInicio,
                                              direccionCantidadPaginas,direccionConsultaRegistros,
                                              busqueda,idCuerpoTabla,colspan);

              }else{

                listaPaginasConsultaRegistros(totalidadDePaginas,10,paginaInicio,direccionCantidadPaginas,
                                              direccionConsultaRegistros,busqueda,idCuerpoTabla,colspan);

              }

            }else{

              alertify.error("Error al tratar de obtener la totalidad de registros que se encuentran alojados en la base de datos, la función esperaba un filtro de búsqueda como entrada");

            }
          
          },
          error: function(error){

            idCuerpoTabla.empty();

            alertify.error("Error de conexión al tratar de obtener la totalidad de registros que se encuentran alojados en la base de datos");
           
          }

        });

  }

  /*
  //Metodo encargado de gestionar la busqueda de registros por su filtro de busqueda
  */
  function buscarRegistrosPorFiltro(direccionCantidadPaginas,direccionConsultaRegistros,idFiltroBusqueda,idCuerpoTabla,colspan){

    var timeout = null;

    idFiltroBusqueda.on('keyup', function() {

    idCuerpoTabla.html('<tr><td colspan="'+colspan+'"><img class="center-block" src="/SisConAsadaLaUnion/public/assets/images/Loading.gif" alt="Cargando" width="38px"/></td></tr>');

    var busqueda = $(this).val().trim();
    
    clearTimeout(timeout);
    
    timeout = setTimeout(function() {

          if ($("#paginacion").html().length > 0) {

            $("#paginacion").twbsPagination('destroy');
              
          }
          
          crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,1,busqueda,idCuerpoTabla,colspan);

    }, 500)
    
    })
  
  }

  /*
  // Metodo encargado de actualizar la tabla de acuerdo a la acción que ejecute el usuario
  */
  function actualizarTabla(accionEjecutada,cantidadFilasTabla,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan) {

   if (accionEjecutada == "Delete") {

    cantidadFilasTabla = cantidadFilasTabla - 2;
      
   }else if (accionEjecutada == "Update") {

    cantidadFilasTabla = cantidadFilasTabla - 1;
  
   }

   if ($("#paginacion").html().length > 0) {

    $("#paginacion").twbsPagination('destroy');
                
   }

   var busqueda = idFiltroBusqueda.val().trim();

   if(cantidadFilasTabla == 0 && paginaActualGlb > 1){

      paginaActualGlb--;

   }

   crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,paginaActualGlb,busqueda,idCuerpoTabla,colspan);

  }