$("#login-form").submit(function(evento){
    evento.preventDefault()
    let usuario = $('#txtIdUsuario').val(), clave = $('#txtclave').val()

    $.post("../webservice/sesion.iniciar.php", {txtIdUsuario: usuario, txtclave: clave}).done(function(resultado) {
      console.warn(resultado);
      if (resultado.estado === 200){
        window.location.href=resultado.mensaje
      }
    }).fail(function(error) {
      console.error(error);
      let datosJSON = $.parseJSON(error.responseText);
      swal({
            type: 'error',
            title: 'Oops...',
            text: datosJSON.mensaje
          });
    });
});
