<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?=base_url('assets/img/icono.ico')?>">
    <title>OPI | Operaci&oacute;n de Proyectos de Infraestructura</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=base_url('assets/css/general.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="<?=base_url('assets/img/logo_.png')?>"></a>
          </div>
          <div class="collapse navbar-collapse">
            <!--<ul class="nav navbar-nav navbar-right">
              <li><a href="#">Operaci&oacute;n</a></li>
              <li><a href="#about">Bitacora</a></li>
              <li><a href="#contact">Reportes</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ajustes <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>-->
          </div>
        </div>
        <div class="usuario">
        	<div class="container" style="text-align:right;">
        		Bienvenido
        	</div>
        </div>	
      </div>
	  
      <!-- Begin page content -->
      <div class="container">
      	<div class="page-header">
          <h3><i class="fa fa-sign-in fa-2x"></i> Ingresar</h3>
        </div>
        <div class="login-form">
        <?=form_open('login/verifylogin', array('role'=>'form'));?>
          <div class="form-group">
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="usuario" name="usuario">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Clave" name="clave">
          </div>
          <button type="submit" class="btn btn-default btn-success">Aceptar</button>
        <?=form_close()?>
        <?=validation_errors(); ?>
        </div>
      </div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="text-muted credit" align="center">Grupo Hermes Infraestructura</p>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
  </body>
</html>
