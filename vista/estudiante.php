<?php
    require_once __DIR__.'/validar.sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
  <?php require_once 'head.php';?>
  <link rel="stylesheet" href="../util/LTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="../util/LTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../util/LTE/plugins/iCheck/all.css">
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
        <li class="active">Estudiante</li>
      </ol>
    </section>

    <!-- Contenido principal -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Estudiantes</h3>

              <div class="box-tools pull-right">
                <button type="button" id="btnAgregar" onclick="agregar()" class="btn btn-block btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Agregar nuevo estudiante</button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-lg-12 col-xs-12 col-md-12">
                <div id="divListado">

                </div>
              </div>
              <div id="divAgregar" >
                <form method="post">
                  <div class="form-group">
                    <label for="txtNombreEstudiante">Nombre</label>
                    <input type="text" class="form-control" name="txtNombreEstudiante" id="txtNombreEstudiante" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="txtApellidoPaterno">Apellido Paterno</label>
                    <input type="text" class="form-control" name="txtApellidoPaterno" id="txtApellidoPaterno" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="txtApellidoMaterno">Apellido Materno</label>
                    <input type="text" class="form-control" name="txtApellidoMaterno" id="txtApellidoMaterno" placeholder="">
                  </div>

                  <div class="form-group">
                    <label>
                      <input type="radio" name="r1" class="minimal" checked>
                      Masculino
                    </label>
                    <label>
                      <input type="radio" name="r1" class="minimal">
                      Femenino
                    </label>
                  </div>

                  <div class="form-group">
                    <label>Fecha nacimiento:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker">
                    </div>
                    <!-- /.input group -->
                  </div>

                  <div class="form-group">
                    <label>Telefono:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input type="text" class="form-control" data-inputmask='"mask": "999-999-999"' data-mask>
                    </div>
                    <!-- /.input group -->
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
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
<script src="../util/LTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../util/LTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../util/LTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../util/LTE/plugins/iCheck/icheck.min.js"></script>
<!-- InputMask -->
<script src="../util/LTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../util/LTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../util/LTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript" src="js/estudiante.js"></script>

</body>
</html>
