$("#login-form").submit(function(evento){
    evento.preventDefault()
    let usuario = $('#txtIdUsuario').val(), clave = $('#txtclave').val()

    $.post("../webservice/sesion.iniciar.php", {txtIdUsuario: usuario, txtclave: clave}).done(function(resultado) {
      let datosJSON = resultado;
      console.error(resultado.mensaje);
      window.location.href=resultado.mensaje
      // if(datosJSON.estado === 200){

        // datosJSON.datos.map(function(item){
        //   if(item.vac_disp > 0){
        //
        //   });
        // }
      // }
    }).fail(function(error) {
      let datosJSON = $.parseJSON(error.responseText);
      swal("Error", datosJSON.mensaje, "error");
    });
});
