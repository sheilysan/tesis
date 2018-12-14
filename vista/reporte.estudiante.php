<?php
    require_once __DIR__.'/validar.sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
  <?php require_once 'head.php';?>
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
        <li class="active">Reporte Estudiantes</li>
      </ol>
    </section>

    <!-- Contenido principal -->
    <section class="content">
      <div class="row">
      <div class="col-lg-12 col-xs-12 col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Reporte de evaluaciones de Estudiantes</h3>

              <div class="box-tools pull-right">
                <button type="button" id="btnActualizar" onclick="listarEstudiantes()" class="btn btn-block btn-primary btn-xs"><i class="fa fa-refresh"></i> Actualizar listado</button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-lg-12 col-xs-12 col-md-12">
                <div id="divListado">

                </div>
                <div id="divListadoTest">
                
                </div>
                <div id="divListadoTest-detalle">
                
                </div>
                <div class="box-tools pull-right">
                  <button type="button" id="btnVolver" onclick="listarEstudiantes()" class="btn btn-block btn-danger btn-xs"><i class="fa fa-arrow-up"></i> Volver</button>
                </div>
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
<script src="../util/LTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../util/LTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="js/reporte.estudiante.js"></script>
</body>
</html>
