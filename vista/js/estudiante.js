$(document).ready(function() {
  $('#rango').daterangepicker({
    locale: { cancelLabel: 'cancelar', applyLabel: 'Aplicar', format: 'DD-MM-YYYY', separator: ' hasta ', fromLabel:'Desde', toLabel: 'Hasta', customRangeLabel: 'Custom', daysOfWeek: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'], monthNames: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']}
  }, function(start,end,label){
    $('#txtFechaIni').val(start.format('YYYY-MM-DD'));
    $('#txtFechaFin').val(end.format('YYYY-MM-DD'));
    console.warn($('#txtFechaIni').val()+' hasta '+$('#txtFechaFin').val());
  });
  $('#rango').val('');
  listarEstudiantes();


  // blockUI('#listado');
  // $("#liMantenimientos").click();
  // $("#submenuLugar").addClass("active");
});

function listarEstudiantes() {
  $.post(
    "../webservice/estudiante.listar.php"
  ).done(function(resultado) {
    var datosJSON = resultado;

    if (datosJSON.estado === 200) {
      var html = "";
      html += '<small>';
      html += '<table class="table table-bordered" id="tabla-listado" cellspacing="0" width="100%">';
      html += '<thead>';
      html += '<tr style="background-color: #ededed; height:20px;">';
      html += '<th style="min-width: 80px;" align="center" >OPCIONES</th>';
      html += '<th style="min-width: 150px;" align="center" >NOMBRE COMPLETO</th>';
      html += '<th style="min-width: 150px;" align="center" >CÓDIGO DE USUARIO</th>';
      html += '<th style="min-width: 100px;">SEXO</th>';
      html += '<th style="min-width: 100px;">TELEFONO</th>';
      html += '<th style="min-width: 100px;">ESTADO</th>';
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
        html += '<button onclick="leerDatos(' + item.id_estudiante + ')" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>&nbsp;&nbsp;';
        html += '<button onclick="eliminar(' + item.id_estudiante + ',\''+item.nombre+'\')" type="button" class="btn btn-danger btn-xs tip"><i class="fa fa-trash-o"></i></button>&nbsp;&nbsp;';
        // if(item.conteo > 0){
        //   html += '<button onclick="mostrarAmbientes(' + item.id_estudiante + ',\''+item.nomb+'\')" type="button" class="btn btn-success btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
        // }else{
        //   html += '<button onclick="mostrarAmbientes(' + item.id_estudiante + ',\''+item.nomb+'\')" type="button" class="btn btn-primary btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-building-o"></i></button>&nbsp;&nbsp;';
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

function agregar(){
  $('#divAgregar').show(1000);
  $('#divListado').hide(1000);
  $('#btnAgregar').hide(1000);
  $('#txtNombrePeriodo').focus();
}

function cancelar(){
  $('#btnAgregar').show(1000);
  $('#divAgregar').hide(1000);
  $('#divListado').show(1000);
  $('#txtNombrePeriodo').val('');
  $('#rango').val('');
  $('#txtFechaIni').val('');
  $('#txtFechaFin').val('');
  $('#txtIdPeriodo').val('');
}

function eliminar(id_estudiante, nombre_estudiante) {

  swal({
        title: 'Advertencia',
        text: "¿Estás seguro de borrar a este estudiante?",
        type: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Sí',
        cancelButtonColor: '#E93939'
  }).then((result) => {
    if (result.value) {
      swal({
            title: 'Confirmación',
            text: "Escribe el nombre del estudiante para confirmar. \n Nombre del estudiante: " + nombre_estudiante,
            type: 'question',
            input: 'text',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
            cancelButtonColor: '#E93939'
      }).then((result) => {
        if (result.value == nombre_estudiante) {
          $.post("../webservice/estudiante.eliminar.php",
            {estudiante: id_estudiante}).done(function(resultado) {
            let datosJSON = resultado;
            if (datosJSON.estado === 200) {
              listarEstudiantes();
              const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 7000
                  });

                  toast({
                    type: 'success',
                    title: `${nombre_estudiante} eliminado con éxito!`
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
                title: "Parece que el nombre ingresado no coincide con el del estudiante que desea eliminar."
              })
        }
      })
    }
  })
}

function leerDatos(id_estudiante){
  agregar();
  $.post("../webservice/estudiante.leer.datos.php", {
    estudiante: id_estudiante
  }).done(function(resultado) {
    var datosJSON = resultado;
    if (resultado.estado === 200) {
      $('#txtIdPeriodo').val(resultado.datos.id_estudiante);
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
  let nombre = $('#txtNombrePeriodo').val(), fechaIni = $('#txtFechaIni').val(), fechaFin = $('#txtFechaFin').val(), estudiante = $('#txtIdPeriodo').val();
  if(validaVacio(nombre)){
    swal({
          title: 'Advertencia',
          text: "El nombre del estudiante no puede estar vacío",
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
          text: "Elija un estudiante de tiempo por favor.",
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

  console.warn(`${nombre} - ${fechaIni} - ${fechaFin} - idPeriodo: ${estudiante}`);

  $.post("../webservice/estudiante.agregar.editar.php",
    {estudiante: estudiante,
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
              listarEstudiantes();
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
