<?php
require_once __DIR__.'/../negocio/Sesion.clase.php';
$sesion = new Sesion();

session_start();
if($sesion->comprobarSesion()){
  header("Location: http://localhost/tesis/vista/");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anatomía 3D</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

    <!-- <link rel="stylesheet" href="../util/LTE/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->

    <style>
    @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
    .login-block{
        background: #DE6262;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    float:left;
    width:100%;
    padding : 50px 0;
    }
    .banner-sec{background:#000  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
    .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
    .carousel-inner{border-radius:0 10px 10px 0;}
    .carousel-caption{text-align:left; left:5%;}
    .login-sec{padding: 50px 30px; position:relative;}
    .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
    .login-sec .copy-text i{color:#FEB58A;}
    .login-sec .copy-text a{color:#E36262;}
    .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
    .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
    .btn-login{background: #DE6262; color:#fff; font-weight:600;}
    .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
    .banner-text h2{color:#fff; font-weight:600;}
    .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
    .banner-text p{color:#fff;}
    </style>
  </head>
  <body class="login-block">
    <section>
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Inicio de Sesión</h2>
		    <form class="login-form" id="login-form" name="login-form" method="post">
  <div class="form-group">
    <label for="txtIdUsuario" class="text-uppercase">Código de usuario</label>
    <input type="text" class="form-control" id="txtIdUsuario" name="txtIdUsuario" placeholder="">

  </div>
  <div class="form-group">
    <label for="txtclave" class="text-uppercase">Clave</label>
    <input type="password" class="form-control" id="txtclave" name="txtclave" placeholder="">
  </div>


    <div class="form-check">
    <button type="submit" class="btn btn-login float-right">Submit</button>
  </div>

</form>
<div class="copy-text">Anatomía <i class="fa fa-heart"></i> <a href="#">3D</a></div>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://www.thoughtco.com/thmb/um8lia277rwTc1MZ_lj4d9DAqLk=/768x0/filters:no_upscale():max_bytes(150000):strip_icc()/muscles-anatomy-58545dc85f9b586e02f71781.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Anatomía 3D</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
        </div>
  </div>
    </div>


            </div>

		</div>
	</div>
</div>
</section>
<script src="../util/LTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../util/LTE/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="../util/LTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../util/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
  </body>
</html>
