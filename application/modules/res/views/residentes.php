<div class="page-header">
	<h4><a href="<?=base_url('grl/res/index')?>">
    <i class="fa fa-user bom-menu fa-2x"></i> </a>RESIDENTES</h4>
</div>

<div class="row" align="center">
  <div class="col-md-6">
  	<a href="consulta_residentes">
		<i class="fa fa-search bom-menu fa-4x"></i>	
        <h6 class="bom-menu" >CONSULTA RESIDENTES</h6>
	</a>
  </div>
  <div class="col-md-6">
  	<a href="pendientes">
		<i class="fa fa-pencil-square-o  bom-menu fa-4x"></i> 
		<?php foreach ($elementos as $elemento):?>
        <h6 class="bom-menu">PENDIENTES DE REGISTRAR</h6>
		<h4 class="text-danger"><?=$elemento->residente?></h4>
        <?php endforeach; ?>
	</a>
  </div>
</div>

