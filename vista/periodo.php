<?php
    require_once __DIR__.'/validar.sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
  <?php require_once 'head.php';?>
  <link rel="stylesheet" href="../util/LTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../util/LTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <?php require_once 'cabecera.php'; ?>

  <?php require_once 'barra.izquierda.php'; ?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Inicio
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Panel de Control</li>
        <li class="active">Periodo</li>
      </ol>
    </section>

    <!-- Contenido principal -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Periodos</h3>

              <div class="box-tools pull-right">
                <button type="button" id="btnAgregar" onclick="agregar()" class="btn btn-block btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Agregar nuevo periodo</button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-lg-12 col-xs-12 col-md-12">
                <div id="divListado">

                </div>
                <div id="div" hidden>
                  <div class="box-tools pull-right">
                    <button type="button" id="btnAgregarUsuario" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus-o"></i> Agregar estudiante al periodo</button>
                  </div>
                  <div id="divListadoAlumnosPeriodo">
                  
                  </div>
                  <div id="agregarAlumno" hidden>
                    <form method="post">
                      <div class="form-group">
                        <input type="text" class="form-control" name="txtIdPeriodoAlumno" id="txtIdPeriodoAlumno" placeholder="" hidden>
                      </div>
                      <div class="form-group">
                        <label for="txtAlumnoAgregar">Ingrese el código del alumno</label>
                        <input type="text" class="form-control" name="txtAlumnoAgregar" id="txtAlumnoAgregar" placeholder="">
                      </div>

                      <div class="form-group pull-right">
                        <button type="button" onclick="AgregarAlumno()" name="btnGuardarAlumno" id="btnGuardarbtnGuardarAlumno" class="btn btn-sm btn-success"> Agregar Alumno </button>
                        <button type="button" onclick="cancelarAgregar()" name="btnCancelarAlumno" id="btnCancelarbtnCancelarAlumno" class="btn btn-sm btn-danger"> Cancelar </button>
                      </div>
                    </form>
                  </div>
                  <div class="box-tools pull-right">
                    <button type="button" id="btnVolver" onclick="listarPeriodos()" class="btn btn-block btn-danger btn-xs"><i class="fa fa-arrow-up"></i> Volver</button>
                  </div>
                </div>
              </div>
              <div id="divAgregar" hidden>
                <form method="post">
                  <div class="form-group">
                    <label for="txtNombrePeriodo">Nombre periodo</label>
                    <input type="text" class="form-control" name="txtNombrePeriodo" id="txtNombrePeriodo" placeholder="">
                  </div>
                  <div class="form-group">
                    <label>Fecha de inicio - fecha de fin</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="rango">
                      <input type="text" name="txtFechaIni" id="txtFechaIni" hidden>
                      <input type="text" name="txtFechaFin" id="txtFechaFin" hidden>
                      <input type="text" name="txtIdPeriodo" id="txtIdPeriodo" hidden>
                    </div>
                  </div>

                  <div class="form-group pull-right">
                    <button type="button" onclick="guardar()" name="btnGuardar" id="btnGuardar" class="btn btn-sm btn-success"> Guardar </button>
                    <button type="button" onclick="cancelar()" name="btnCancelar" id="btnCancelar" class="btn btn-sm btn-danger"> Cancelar </button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.Fin del contenido principal -->
  </div>

  <?php require_once 'footer.php'; ?>

</div>
<?php require_once 'script.php' ?>
<script src="../util/LTE/bower_components/moment/min/moment.min.js"></script>
<script src="../util/LTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../util/LTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../util/LTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="js/periodo.js"></script>
</body>
</html>
