<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../util/LTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['nombres'] ." ".$_SESSION['paterno'];  ?></p>
      </div>
    </div>

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENÚ PRINCIPAL</li>
      <li class="active treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Panel de control</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="periodo.php"><i class="fa fa-circle-o"></i> Periodos</a></li>
          <li><a href="estudiante.php"><i class="fa fa-circle-o"></i> Estudiantes</a></li>
          <li><a href="reporte.estudiante.php"><i class="fa fa-circle-o"></i> Reporte Estudiantes</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
