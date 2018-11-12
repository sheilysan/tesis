$(document).ready(function() {
  $('#txtFechaNacimiento').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  })

  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })

  $('[data-mask]').inputmask()

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
        let sexo = 'MASCULINO'
        if(item.sexo == 'F'){
          sexo = 'FEMENINO'
        }

        html += '<td align="center">';
        html += '<div class="row-fluid">';
        html += '<button onclick="leerDatos(' + item.id_persona + ')" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>&nbsp;&nbsp;';
        html += '<button onclick="eliminar(' + item.id_persona + ',\''+item.nomb+'\')" type="button" class="btn btn-danger btn-xs tip"><i class="fa fa-trash-o"></i></button>&nbsp;&nbsp;';
        // if(item.conteo > 0){
        //   html += '<button onclick="mostrarAmbientes(' + item.id_persona + ',\''+item.nomb+'\')" type="button" class="btn btn-success btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
        // }else{
        //   html += '<button onclick="mostrarAmbientes(' + item.id_persona + ',\''+item.nomb+'\')" type="button" class="btn btn-primary btn-xs tip" data-toggle="modal" data-target="#modalAmbientes"><i class="fa fa-building-o"></i></button>&nbsp;&nbsp;';
        // }
        html += '</div>';
        html += '</td>';
        html += '<td>' + item.nomb +'</td>';
        html += '<td>' + item.usu + '</td>';
        html += '<td>' + sexo + '</td>';
        html += '<td>' + item.telefono + '</td>';
        if(item.estado == 'A'){
          html += '<td> <small class="label label-success"><i class="fa fa-check-circle-o"></i> ACTIVO</small></td>';  
        }
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
  $('#txtNombreEstudiante').focus();
}

function cancelar(){
  $('#btnAgregar').show(1000);
  $('#divAgregar').hide(1000);
  $('#divListado').show(1000);
  $('#txtNombreEstudiante').val('');
  $('#txtApellidoPaterno').val('');
  $('#txtApellidoMaterno').val('');
  $('#txtFechaNacimiento').val('');
  $('#txtTelefono').val('');
  $('#txtCodigoUsuario').val('');
  $('#txtClave').val('');
  $('#txtIdPersona').val('');
}

function guardar(){
  let nombre = $('#txtNombreEstudiante').val(),
      paterno = $('#txtApellidoPaterno').val(),
      materno = $('#txtApellidoMaterno').val(),
      nacimiento = $('#txtFechaNacimiento').val(),
      usuario = $('#txtCodigoUsuario').val(),
      clave = $('#txtClave').val(),
      persona = $('#txtIdPersona').val(),
      telefono = $('#txtTelefono').val();
  if(validaVacio(nombre) || validaVacio(paterno) || validaVacio(materno)){
    swal({
          title: 'Advertencia',
          text: "Ingrese el nombre completo del estudiante",
          type: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'
    }).then((result) => {
      if (result.value) {
        $('#txtNombreEstudiante').focus();
      }
    })
    return;
  }

  if(validaVacio(nacimiento)){
    swal({
          title: 'Advertencia',
          text: "Ingrese la fecha de nacimiento del estudiante",
          type: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'
    }).then((result) => {
      if (result.value) {
        $('#txtFechaNacimiento').focus();
      }
    })
    return;
  }

  if(validaVacio(usuario)){
    swal({
          title: 'Advertencia',
          text: "Ingrese el código de usuario del estudiante",
          type: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Entendido'
    }).then((result) => {
      if (result.value) {
        $('#txtCodigoUsuario').focus();
      }
    })
    return;
  }

  if(validaVacio(persona)){
    if(validaVacio(clave)){
      swal({
            title: 'Advertencia',
            text: "Ingrese la contraseña del estudiante",
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Entendido'
      }).then((result) => {
        if (result.value) {
          $('#txtClave').focus();
        }
      })
      return;
    }
  }

  $.post("../webservice/estudiante.agregar.editar.php",
    {nombres: nombre,
    paterno: paterno,
    materno: materno,
    sexo: $("input:radio[name=rbSexo]:checked").val(),
    nacimiento: nacimiento.split('/')[2]+'-'+nacimiento.split('/')[1]+'-'+nacimiento.split('/')[0],
    telefono: telefono,
    clave: clave,
    usuario: usuario,
    persona: persona
  }).done(function(resultado) {

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



function eliminar(id_persona, nombre_estudiante) {

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
            {persona: id_persona}).done(function(resultado) {
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

function leerDatos(id_persona){
  agregar();
  $.post("../webservice/estudiante.leer.datos.php", {
    persona: id_persona
  }).done(function(resultado) {
    var datosJSON = resultado;
    if (resultado.estado === 200) {
      let datos = resultado.datos

      $('#txtNombreEstudiante').val(datos.nombres);
      $('#txtApellidoPaterno').val(datos.paterno);
      $('#txtApellidoMaterno').val(datos.materno);
      $('#txtFechaNacimiento').val(datos.fecha_nacimiento.split('-')[2]+'/'+datos.fecha_nacimiento.split('-')[1]+'/'+datos.fecha_nacimiento.split('-')[0]);
      $('#txtTelefono').val(datos.telefono);
      $('#txtCodigoUsuario').val(datos.id_usuario);
      $('#txtClave').val('****');
      $('#txtIdPersona').val(datos.id_persona);
      if(datos.sexo == 'F'){
        $('#rbFemenino').iCheck('check')
      }else{
        $('#rbMasculino').iCheck('check');
      }
      $("#txtNombreEstudiante").focus();
    } else {
      swal("Hey!", resultado, "info");
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
