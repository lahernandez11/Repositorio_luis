<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1399338062_change_user.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/facturacion/index')?>">SOLICITUD DE FACTURACI&Oacute;N</a></b></h5>
</div>
<div class="row main">
	<?php foreach ($tipos as $tipo):?>
    <div class="col-md-4" align="center">
        <a class="bom-menu" href="<?=base_url($tipo->link)?>">
			<img src="<?=base_url('assets/img/'.$tipo->icono)?>" class="img-responsive">
			<h5><?=$tipo->solicitudes?></h5>
			<h4 class="text-danger"><?=$tipo->total?></h4>
		</a>
    </div>    
    <?php endforeach; ?>
</div>
<br><br>
<div class="row main">
	<div class="col-md-4" align="center">
    	<a class="bom-menu" href="<?=base_url('baw/facturacion/consultar')?>">
			<img src="<?=base_url('assets/img/consultar.png')?>" class="img-responsive">
			<h5>CONSULTAR SOLICITUDES</h5>
			<!--<h4 class="text-danger"></h4>-->
		</a>
    </div>
    <div class="col-md-4" align="center">
    	<a class="bom-menu" href="<?=base_url('baw/facturacion/cargar_tickets')?>">
			<img src="<?=base_url('assets/img/upload.png')?>" class="img-responsive">
			<h5>CARGAR TICKETS</h5>
		</a>
    </div>
    <div class="col-md-4" align="center">
    	<a class="bom-menu" href="<?=base_url('baw/facturacion/busqueda')?>">
			<img src="<?=base_url('assets/img/search.png')?>" class="img-responsive">
			<h5>B&Uacute;SQUEDA DE EVENTOS</h5>
		</a>
    </div>
</div>
