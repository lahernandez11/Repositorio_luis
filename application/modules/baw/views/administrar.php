<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1399338062_change_user.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/administrar/index')?>">ADMINISTRAR</a></b></h5>
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
