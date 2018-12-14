$(document).ready(function() {
  $('#divAgregar').hide();

  $('#rango').daterangepicker({
    locale: { cancelLabel: 'cancelar', applyLabel: 'Aplicar', format: 'DD-MM-YYYY', separator: ' hasta ', fromLabel:'Desde', toLabel: 'Hasta', customRangeLabel: 'Custom', daysOfWeek: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'], monthNames: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']}
  }, function(start,end,label){
    $('#txtFechaIni').val(start.format('YYYY-MM-DD'));
    $('#txtFechaFin').val(end.format('YYYY-MM-DD'));
    console.warn($('#txtFechaIni').val()+' hasta '+$('#txtFechaFin').val());
  });
  $('#rango').val('');
  listarPeriodos();
});

function listarPeriodos() {
  $('#div').hide(1000);
  $('#divListado').show(1000);
  $('#divAgregar').hide(1000);
  $.post(
    "../webservice/periodo.listar.php"
  ).done(function(resultado) {
    var datosJSON = resultado;

    if (datosJSON.estado === 200) {
      var html = "";
      html += '<small>';
      html += '<table class="table table-bordered" id="tabla-listado" cellspacing="0" width="100%">';
      html += '<thead>';
      html += '<tr style="background-color: #ededed; height:20px;">';
      html += '<th style="min-width: 80px;" align="center" >OPCIONES</th>';
      html += '<th style="min-width: 150px;" align="center" >PERIODO</th>';
      html += '<th style="min-width: 100px;">FECHA DE INICIO</th>';
      html += '<th style="min-width: 100px;">FECHA DE FIN</th>';
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
        html += '<button onclick="listarPersonasPeriodo(' + item.id_periodo + ',\''+item.nombre+'\')" type="button" class="btn btn-primary btn-xs tip"><i class="fa fa-plus-circle"></i></button>&nbsp;&nbsp;';
        html += '<button onclick="leerDatos(' + item.id_periodo + ')" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>&nbsp;&nbsp;';
        html += '<button onclick="eliminar(' + item.id_periodo + ',\''+item.nombre+'\')" type="button" class="btn btn-danger btn-xs tip"><i class="fa fa-trash-o"></i></button>&nbsp;&nbsp;';
        // if(item.conteo > 0){
        //   html += '<button onclick="mostrarAmbientes(' + item.id_periodo + ',\''+item.nomb+'\')" type="button" class="btn btn-success btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
        // }else{
        //   html += '<button onclick="mostrarAmbientes(' + item.id_periodo + ',\''+item.nomb+'\')" type="button" class="btn btn-primary btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-building-o"></i></button>&nbsp;&nbsp;';
        // }
        html += '</div>';
        html += '</td>';
        html += '<td>' + item.nombre + '</td>';
        html += '<td>' + item.fecha_inicio + '</td>';
        html += '<td>' + item.fecha_fin + '</td>';
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
          "info": "Mostrando _START_ a _END_ de _TOTAL_ periodos",
          "infoEmpty": "0 datos",
          "infoFiltered": "(filtrados de _MAX_ periodos)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_  periodos",
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

function agregar(){
  $('#divAgregar').show(1000);
  $('#divListado').hide(1000);
  $('#btnAgregar').hide(1000);
  $('#div').hide(1000);
  $('#txtNombrePeriodo').focus();
}

function cancelar(){
  $('#btnAgregar').show(1000);
  $('#divAgregar').hide(1000);
  $('#divListado').show(1000);
  $('#div').hide(1000);
  $('#txtNombrePeriodo').val('');
  $('#rango').val('');
  $('#txtFechaIni').val('');
  $('#txtFechaFin').val('');
  $('#txtIdPeriodo').val('');
}

function eliminar(id_periodo, nombre_periodo) {

  swal({
        title: 'Advertencia',
        text: "¿Estás seguro de borrar a este periodo?",
        type: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Sí',
        cancelButtonColor: '#E93939'
  }).then((result) => {
    if (result.value) {
      swal({
            title: 'Confirmación',
            text: "Escribe el nombre del periodo para confirmar. \n Nombre del periodo: " + nombre_periodo,
            type: 'question',
            input: 'text',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
            cancelButtonColor: '#E93939'
      }).then((result) => {
        if (result.value == nombre_periodo) {
          $.post("../webservice/periodo.eliminar.php",
            {periodo: id_periodo}).done(function(resultado) {
            let datosJSON = resultado;
            if (datosJSON.estado === 200) {
              listarPeriodos();
              const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 7000
                  });

                  toast({
                    type: 'success',
                    title: `${nombre_periodo} eliminado con éxito!`
                  })
            }
          }).fail(function(error) {
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
          });
        }else{
          const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000
              });

              toast({
                type: 'error',
                title: "Parece que el nombre ingresado no coincide con el del periodo que desea eliminar."
              })
        }
      })
    }
  })
}

function leerDatos(id_periodo){
  agregar();
  $.post("../webservice/periodo.leer.datos.php", {
    periodo: id_periodo
  }).done(function(resultado) {
    var datosJSON = resultado;
    if (resultado.estado === 200) {
      $('#txtIdPeriodo').val(resultado.datos.id_periodo);
      $("#txtNombrePeriodo").val(resultado.datos.nombre);
      $("#rango").val(resultado.datos.fecha_inicio + ' hasta '+resultado.datos.fecha_fin);
      $("#txtFechaIni").val(resultado.datos.fecha_inicio);
      $("#txtFechaFin").val(resultado.datos.fecha_fin);
      $("#txtNombrePeriodo").focus();
    } else {
      swal("Hey!", resultado, "info");
    }
  }).fail(function(error) {
    var datosJSON = $.parseJSON(error.responseText);
    swal("Error", datosJSON.mensaje, "error");
  });
}

function guardar(){
  let nombre = $('#txtNombrePeriodo').val(), fechaIni = $('#txtFechaIni').val(), fechaFin = $('#txtFechaFin').val(), periodo = $('#txtIdPeriodo').val();
  if(validaVacio(nombre)){
    swal({
          title: 'Advertencia',
          text: "El nombre del periodo no puede estar vacío",
          type: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'
    }).then((result) => {
      if (result.value) {
        $('#txtNombrePeriodo').focus();
      }
    })
    return;
  }

  if(validaVacio(fechaIni.toString()) || validaVacio(fechaFin.toString())){
    swal({
          title: 'Advertencia',
          text: "Elija un periodo de tiempo por favor.",
          type: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'
    }).then((result) => {
      if (result.value) {
        $('#rango').focus();
      }
    })
    return;
  }

  console.warn(`${nombre} - ${fechaIni} - ${fechaFin} - idPeriodo: ${periodo}`);

  $.post("../webservice/periodo.agregar.editar.php",
    {periodo: periodo,
    nombre: nombre,
    fechaIni: fechaIni,
    fechaFin: fechaFin}).done(function(resultado) {

    let datosJSON = resultado;
    if (datosJSON.estado === 200) {
      swal({
            title: '¡Genial!',
            text: `${resultado.mensaje}`,
            type: 'success',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.value) {
              $('#btnCancelar').click();
              listarPeriodos();
            }
          })
    }
  }).fail(function(error) {
    var datosJSON = $.parseJSON(error.responseText);
    swal("Error", datosJSON.mensaje, "error");
  });
}

function validaVacio(valor) {
  if (valor.trim().length === 0) {
    return true
  }
  else {
    return false
  }
}



function listarPersonasPeriodo(id_periodo,nombre_periodo){
  $('#div').show(1000);
  $('#divListado').hide(1000);
  $('#divAgregar').hide(1000);
  $.post(
    "../webservice/periodo.listar.estudiante.php",
    {
      id_periodo: id_periodo
    }
  ).done(function(resultado) {
    var datosJSON = resultado;

    if (datosJSON.estado === 200) {
      var html = "";
      html += `<label > ${nombre_periodo}</label>`
      html += '<small>';
      html += '<table class="table table-bordered" id="tabla-listado-periodo" cellspacing="0" width="100%">';
      html += '<thead>';
      html += '<tr style="background-color: #ededed; height:20px;">';
      html += '<th style="min-width: 80px;" align="center" >ELIMINAR</th>';
      html += '<th style="min-width: 100px;">CÓDIGO DE USUARIO</th>';
      html += '<th style="min-width: 150px;" align="center" >NOMBRE COMPLETO</th>';
      html += '<th style="min-width: 150px;" align="center" >FECHA INSCRIPCIÓN</th>';
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
        html += '<button onclick="eliminarUsuarioPeriodo('+item.id_periodo+',\''+item.id_usuario+'\')" type="button" class="btn btn-danger btn-xs tip"><i class="fa fa-trash-o"></i></button>&nbsp;&nbsp;';
      
        html += '</div>';
        html += '</td>';
        html += `<td>${item.id_usuario}</td>`
        html += `<td>${item.nombre_completo}</td>`
        html += `<td>${item.fecha}</td>`
        html += '</tr>';
      });

      html += '</tbody>';
      html += '</table>';
      html += '</small>';

      $("#divListadoAlumnosPeriodo").html(html);
      $('#tabla-listado-periodo').dataTable({
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

      $("#btnAgregarUsuario").click(agregarUsuarioAlPeriodo(id_periodo));
    } else {
      swal("Mensaje del sistema", resultado, "warning");
    }
  }).fail(function(error) {
    var datosJSON = $.parseJSON(error.responseText);
    swal("Error", datosJSON.mensaje, "error");
  });
}

function agregarUsuarioAlPeriodo(id_periodo){
  $('#agregarAlumno').show(1000);
  $("#txtIdPeriodoAlumno").val(id_periodo);
}

function AgregarAlumno(){
  let codigoAlumno = $('#txtAlumnoAgregar').val(), periodo = $('#txtIdPeriodoAlumno').val();
  if(validaVacio(codigoAlumno)){
    swal({
          title: 'Advertencia',
          text: "El código del alumno no puede estar vacío",
          type: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'
    }).then((result) => {
      if (result.value) {
        $('#txtAlumnoAgregar').focus();
      }
    })
    return;
  }

  $.post("../webservice/alumno.agregar.periodo.php",
    {id_periodo: periodo,
    codigo_usuario: codigoAlumno}).done(function(resultado) {

    let datosJSON = resultado;
    if (datosJSON.estado === 200) {
      swal({
            title: '¡Genial!',
            text: `${resultado.mensaje}`,
            type: 'success',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.value) {
              $('#btnCancelar').click();
              listarPeriodos();
            }
          })
    }
  }).fail(function(error) {
    var datosJSON = $.parseJSON(error.responseText);
    swal("Error", datosJSON.mensaje, "error");
  });
}
