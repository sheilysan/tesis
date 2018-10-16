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


  // blockUI('#listado');
  // $("#liMantenimientos").click();
  // $("#submenuLugar").addClass("active");
});

function listarPeriodos() {
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
        "aaSorting": [
          [1, "asc"]
        ],
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
            text: `El periodo "${nombre}" ha sido registrado con éxito.`,
            type: 'success',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.value) {
              $('#btnCancelar').click();
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
