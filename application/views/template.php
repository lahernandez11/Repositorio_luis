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
    <?=$css?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Wrap all page content here -->
    <div id="wrap">
	<!-- Modal -->
      <div class="modal fade" id="myModal-clave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <?=form_open('grl/usuario/agregar',array("class"=>"form-horizontal", "role"=>"form", "id"=>"cmabiar-clave"));?>
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Cambiar Clave</h4>
            </div>
            <div class="modal-body">
                          <div class="form-group">
                            <label for="input1" class="col-lg-4 control-label">Clave actual</label>
                            <div class="col-lg-8">
                              <input type="text" class="form-control requerido" id="actual" name="input1" placeholder="Ingrese clave actual">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input2" class="col-lg-4 control-label">Nueva clave</label>
                            <div class="col-lg-8">
                              <input type="text" class="form-control requerido" id="nueva" name="input2" placeholder="Ingrese nueva clave">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input3" class="col-lg-4 control-label">Confirmar clave</label>
                            <div class="col-lg-8">
                              <input type="text" class="form-control requerido" id="confirmar" name="input3" placeholder="Confirmar clave">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-4 col-lg-8" id="mensaje_cambio_clave">
                             
                            </div>
                          </div>
                  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-success cambiar-clave">Cambiar</button>
            </div>
          </div>
          <?=form_close();?>
          <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
  
      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=base_url('login/index')?>"><img src="<?=base_url('assets/img/logo_.png')?>"></a>
          </div>
          <div class="collapse navbar-collapse">
          	<?=$menu?>
          </div>
        </div>
        <div class="usuario">
        	<div class="container" style="text-align:right;">
        		Bienvenido <?=$usuario?>
        	</div>
        </div>	
      </div>
	  
      <!-- Begin page content -->
      <div class="container">
        <?=$contents?>
      </div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="text-muted credit" align="center">Grupo Hermes Infraestructura</p>
      </div>
    </div>
    <script src="<?=base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/js/grl.js')?>"></script>
    <?=$js?>
  </body>
</html>
