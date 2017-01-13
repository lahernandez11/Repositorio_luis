<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383194266_online_support.png')?>"> <a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a><a class="bom-menu" href="<?=base_url('bom/asignacion/index')?>">ASIGNACI&Oacute;N DE T&Eacute;CNICO A REPORTE </a></h4>
</div>
<?php if($mensaje!='Error'):?>
<div class="row" align="center">
	<br>
    <h3>LA ASIGNACI&Oacute;N DE T&Eacute;CNICO HA SIDO REALIZADA CON &Eacute;XITO</h3>
    <br>
    <h4>SE ASIGN&Oacute; EL T&Eacute;CNICO <span class="text-danger"><?=$tecnico?></span><br> AL REPORTE <?=$mensaje?></h4>
    <br>
    <a href="<?=base_url('bom/home/index');?>" class="btn btn-success">ACEPTAR</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?=base_url('bom/asignacion/index');?>" class="btn btn-warning">ASIGNAR OTRO T&Eacute;CNICO</a>
</div>
<?php
	else:
?>
<div class="row" align="center">
	<br>
    <h3>LA ASIGNACI&Oacute;N DE T&Eacute;CNICO NO PUDO SER REGISTRADA</h3>
    <br>
    <h4>INTENTE NUEVAMENTE<br> </h4>
    <br>
    <a href="<?=base_url('bom/asignacion/index');?>" class="btn btn-warning">INTENTAR NUEVAMENTE</a>
</div>
<?php 
	endif;
?>
