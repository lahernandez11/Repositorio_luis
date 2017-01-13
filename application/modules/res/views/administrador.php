<div class="page-header">
	<h4><a href="<?=base_url('grl/res/index')?>">
    <i class="fa fa-cogs bom-menu fa-2x"></i> </a>ADMINISTRADOR</h4>
</div>
   	<div class="row">
  		 
<?php foreach($submenu as $menu): ?>
        <div class="col-md-6" align="center">
        <a href="<?=base_url().$menu['ruta']?>">
			<i class="<?=$menu['icono']?> bom-menu fa-4x"></i>
			<h6 class="bom-menu" ><?=$menu['nombre_menu']?></h6>
		</a>
        </div>
<?php endforeach;?>    
    </div> 
  
