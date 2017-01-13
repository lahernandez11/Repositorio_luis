<div class="page-header">
	<i class="fa <?=$icon?>"></i> <?=$title?>
</div>
<div class="page-content">
<?php if($result>0):?>
            <div class="alert alert-success">
            <span><i class="fa fa-check"></i> Operaci&oacute;n exitosa. 
            <br>
            <br>
            <a href="<?=base_url($link)?>" class="btn btn-success">Aceptar</a></span>
            </div>
            <?php else:?>
            <div class="alert alert-danger">
            <span><i class="fa fa-warning"></i> Error en la operaci&oacute;n. <a href="<?=base_url($link)?>" class="btn btn-danger">Intentar nuevamente</a></span>
            </div>
            <?php endif;?>
</div>