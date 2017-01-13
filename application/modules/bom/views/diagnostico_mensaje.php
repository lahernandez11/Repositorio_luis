<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383194873_services.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a><a class="bom-menu" href="<?=base_url('bom/diagnostico/index')?>">REGISTRO DE DIAGN&Oacute;STICO</a></h4>
</div>
<?php if($mensaje!='error'):?>
<div class="row" align="center">
	<br>
    <h3>EL REGISTRO DE DIAGN&Oacute;STICO HA SIDO REGISTRADO CON &Eacute;XITO</h3>
    <br>
    <h4>EL DIAGN&Oacute;STICO SE REGISTR&Oacute;<br> AL REPORTE <?=$mensaje?></h4>
    <br>
    <a href="<?=base_url('bom/home/index');?>" class="btn btn-success">ACEPTAR</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?=base_url('bom/diagnostico/index');?>" class="btn btn-warning">REGISTRAR OTRO DIAGN&Oacute;STICO</a>
</div>
<?php
	else:
?>
<div class="row" align="center">
	<br>
    <h3>EL REGISTRO DE DIAGN&Oacute;STICO NO PUDO SER REGISTRADO</h3>
    <br>
    <h4>INTENTE NUEVAMENTE<br> </h4>
    <br>
    <a href="<?=base_url('bom/diagnostico/index');?>" class="btn btn-warning">INTENTAR NUEVAMENTE</a>
</div>
<?php 
	endif;
?>
