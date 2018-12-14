$(document).ready(function() {
  $('#btnVolver').hide(1000);
  listarEstudiantes();
});

function listarEstudiantes() {
  $('#divListadoTest').hide(1000);
  $('#divListadoTest-detalle').hide(1000);
  $('#btnVolver').hide(1000);
  $('#divListado').show(1000);
  $.post(
    "../webservice/reporte.estudiante.listar.php"
  ).done(function(resultado) {
    var datosJSON = resultado;

    if (datosJSON.estado === 200) {
      var html = "";
      html += '<small>';
      html += '<table class="table table-bordered" id="tabla-listado" cellspacing="0" width="100%">';
      html += '<thead>';
      html += '<tr style="background-color: #ededed; height:20px;">';
      html += '<th style="min-width: 80px;" align="center" >VER TEST INDIVIDUALES</th>';
      html += '<th style="min-width: 150px;" align="center" >NOMBRE COMPLETO</th>';
      html += '<th style="min-width: 150px;" align="center" >CÓDIGO DE USUARIO</th>';
      html += '<th style="min-width: 100px;">PERIODO</th>';
      html += '<th style="min-width: 100px;">N° DE INTENTOS</th>';
      html += '<th style="min-width: 100px;">NOTA PROMEDIO</th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';

      //Detalle
      $.each(datosJSON.datos, function(i, item) {

        if (i % 2 == 0) {
          html += '<tr style="background-color: RGBA(123, 62, 48, 0.2); color: black;">';
        } else {
          html += '<tr>';
        }
        html += '<td align="center">';
        html += '<div class="row-fluid">';
        html += '<button onclick="verTestIndividual(' + item.id_periodo + ',\''+item.nombre_completo+'\',\''+item.id+'\',\''+item.nom_peri+'\')" type="button" class="btn btn-primary btn-xs tip"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
        // if(item.conteo > 0){
        //   html += '<button onclick="mostrarAmbientes(' + item.id_usuario + ',\''+item.nombre_completo+'\')" type="button" class="btn btn-success btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
        // }else{
        //   html += '<button onclick="mostrarAmbientes(' + item.id_usuario + ',\''+item.nombre_completo+'\')" type="button" class="btn btn-primary btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-building-o"></i></button>&nbsp;&nbsp;';
        // }
        html += '</div>';
        html += '</td>';
        html += '<td>' + item.nombre_completo +'</td>';
        html += '<td>' + item.id + '</td>';
        html += '<td>' + item.nom_peri + '</td>';
        html += '<td>' + item.num_veces + '</td>';
        html += '<td>' + item.prom + '</td>';
        html += '</tr>';
      });

      html += '</tbody>';
      html += '</table>';
      html += '</small>';

      $("#divListado").html(html);
      $('#tabla-listado').dataTable({
        "scrollX": "100%",
        "bPaginate": true,
        "bScrollCollapse": true,
        "sScrollXInner": "100%",
        "language": {
          "emptyTable": "No hay datos disponibles para mostrar.",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ estudiantes",
          "infoEmpty": "0 datos",
          "infoFiltered": "(filtrados de _MAX_ estudiantes)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_  estudiantes",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "No se han encontrado coincidencias",
          "paginate": {
            "first": "Primera",
            "last": "Última",
            "next": "Siguiente",
            "previous": "Anterior"
          },
          "aria": {
            "sortAscending": ": activar para ordenar de forma ascendiente",
            "sortDescending": ": activar para ordenar de forma descendiente"
          }
        }
      });
    } else {
      swal("Mensaje del sistema", resultado, "warning");
    }
  }).fail(function(error) {
    var datosJSON = $.parseJSON(error.responseText);
    swal("Error", datosJSON.mensaje, "error");
  });
}

function verTestIndividual(id_periodo,nombre_estudiante,id_usuario,nombre_periodo){
  $('#divListadoTest').show(1000);
  $('#divListado').hide(1000);
  $('#btnVolver').show(1000);
  $('#divListadoTest-detalle').hide(1000);
  $.post(
    "../webservice/reporte.estudiante.listar.test.php",
    {
      id_usuario: id_usuario,
      id_periodo: id_periodo
    }
  ).done(function(resultado) {
    var datosJSON = resultado;

    if (datosJSON.estado === 200) {
      var html = "";
      html += `<label > ${nombre_estudiante} - ${nombre_periodo}</label>`
      html += '<small>';
      html += '<table class="table table-bordered" id="tabla-listado-test" cellspacing="0" width="100%">';
      html += '<thead>';
      html += '<tr style="background-color: #ededed; height:20px;">';
      html += '<th style="min-width: 80px;" align="center" >VER DETALLES</th>';
      html += '<th style="min-width: 100px;">FECHA</th>';
      html += '<th style="min-width: 150px;" align="center" >N° INTENTO</th>';
      html += '<th style="min-width: 150px;" align="center" >NOTA</th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';

      //Detalle
      $.each(datosJSON.datos, function(i, item) {

        if (i % 2 == 0) {
          html += '<tr style="background-color: RGBA(123, 62, 48, 0.2); color: black;">';
        } else {
          html += '<tr>';
        }
        html += '<td align="center">';
        html += '<div class="row-fluid">';
        html += '<button onclick="verDetalle('+item.nota+',' + item.id_test + ',\''+item.fecha+'\','+(i+1)+')" type="button" class="btn btn-success btn-xs tip"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
        // if(item.conteo > 0){
        //   html += '<button onclick="mostrarAmbientes(' + item.id_usuario + ',\''+item.nombre_completo+'\')" type="button" class="btn btn-success btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
        // }else{
        //   html += '<button onclick="mostrarAmbientes(' + item.id_usuario + ',\''+item.nombre_completo+'\')" type="button" class="btn btn-primary btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-building-o"></i></button>&nbsp;&nbsp;';
        // }
        html += '</div>';
        html += '</td>';
        html += '<td>' + item.fecha +'</td>';
        html += '<td>' + (i+1) + '</td>';
        html += '<td>' + item.nota + '</td>';
        html += '</tr>';
      });

      html += '</tbody>';
      html += '</table>';
      html += '</small>';

      $("#divListadoTest").html(html);
      $('#tabla-listado-test').dataTable({
        "scrollX": "100%",
        "bPaginate": true,
        "bScrollCollapse": true,
        "sScrollXInner": "100%",
        "language": {
          "emptyTable": "No hay datos disponibles para mostrar.",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ estudiantes",
          "infoEmpty": "0 datos",
          "infoFiltered": "(filtrados de _MAX_ estudiantes)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_  estudiantes",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "No se han encontrado coincidencias",
          "paginate": {
            "first": "Primera",
            "last": "Última",
            "next": "Siguiente",
            "previous": "Anterior"
          },
          "aria": {
            "sortAscending": ": activar para ordenar de forma ascendiente",
            "sortDescending": ": activar para ordenar de forma descendiente"
          }
        }
      });
    } else {
      swal("Mensaje del sistema", resultado, "warning");
    }
  }).fail(function(error) {
    var datosJSON = $.parseJSON(error.responseText);
    swal("Error", datosJSON.mensaje, "error");
  });
}

function verDetalle(nota,id_test,fecha,num_intento){
  $('#divListadoTest-detalle').show();
  $.post(
    "../webservice/reporte.estudiante.listar.test.detalle.php",
    {
      id_test: id_test
    }
  ).done(function(resultado) {
    var datosJSON = resultado;

    if (datosJSON.estado === 200) {
      var html = "";
      html += `<label > Intento n°: ${num_intento} -Nota: ${nota} (${fecha})</label>`
      html += '<small>';
      html += '<table class="table table-bordered" id="tabla-listado-test-detalle" cellspacing="0" width="100%">';
      html += '<thead>';
      html += '<tr style="background-color: #ededed; height:20px;">';
      html += '<th style="min-width: 150px;" align="center" >MODELO DEL HUESO</th>';
      html += '<th style="min-width: 150px;" align="center" >RESPUESTA</th>';
      html += '<th style="min-width: 150px;" align="center" >RESPUESTA CORRECTA</th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';

      //Detalle
      $.each(datosJSON.datos, function(i, item) {

        if (item.puntaje == 0) {
          html += '<tr style="background-color: RGBA(235, 55, 55, 0.6); color: white;">';
        } else {
          html += '<tr>';
        }
        html += '<td>' + item.modelo + '</td>';
        html += '<td>' + item.rpta + '</td>';
        html += '<td>' + item.nom_hueso + '</td>';
        html += '</tr>';
      });

      html += '</tbody>';
      html += '</table>';
      html += '</small>';

      $("#divListadoTest-detalle").html(html);
      $('#tabla-listado-test-detalle').dataTable({
        "scrollX": "100%",
        "bPaginate": false,
        "bScrollCollapse": true,
        "searching":false,
        "sScrollXInner": "100%",
        "language": {
          "emptyTable": "No hay datos disponibles para mostrar.",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ preguntas",
          "infoEmpty": "0 datos",
          "infoFiltered": "(filtrados de _MAX_ preguntas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_  preguntas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "No se han encontrado coincidencias",
          "paginate": {
            "first": "Primera",
            "last": "Última",
            "next": "Siguiente",
            "previous": "Anterior"
          },
          "aria": {
            "sortAscending": ": activar para ordenar de forma ascendiente",
            "sortDescending": ": activar para ordenar de forma descendiente"
          }
        }
      });
    } else {
      swal("Mensaje del sistema", resultado, "warning");
    }
  }).fail(function(error) {
    var datosJSON = $.parseJSON(error.responseText);
    swal("Error", datosJSON.mensaje, "error");
  });
}

