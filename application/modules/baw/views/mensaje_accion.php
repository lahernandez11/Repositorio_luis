<div class="page-header">
	<h4><a href="<?=base_url('baw/administrar/index')?>">
    <img src="<?=base_url('assets/img/')?>"> </a>SOLICITUDES </h4>
</div>
<div class="row">
<?php if($result==0):?>
	<div class='alert alert-danger'>
    	<h5>Ocurri&oacute; un error durante la acci&oacute;n</h5>
        <a href="<?=$error?>" class='btn btn-danger'>Intentar nuevamente</a>
	</div>";
<?php else:?>
	<div class='alert alert-success'>
    	<h5>La acci&oacute;n se realiz&oacute; con &eacute;xito</h5>
        <a href="<?=$aceptar?>" class='btn btn-success'>Aceptar</a>
	</div>
<?php endif;?>	
</div>		