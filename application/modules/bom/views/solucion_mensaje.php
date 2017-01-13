<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383246894_solutions.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. /</a><a class="bom-menu" href="<?=base_url('bom/solucion/index')?>">REGISTRO DE SOLUCI&Oacute;N</a></h4>
</div>
<?php if($mensaje!='error'):?>
<div class="row" align="center">
	<br>
    <h3>LA SOLUCI&Oacute;N HA SIDO REGISTRADA CON &Eacute;XITO</h3>
    <br>
    <h4>LA SOLUCI&Oacute;N HA SIDO REGISTRADA<br> AL REPORTE <?=$mensaje?></h4>
    <br>
    <a href="<?=base_url('bom/home/index');?>" class="btn btn-success">ACEPTAR</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?=base_url('bom/solucion/index');?>" class="btn btn-warning">REGISTRAR OTRA SOLUCI&Oacute;N</a>
</div>
<?php
	else:
?>
<div class="row" align="center">
	<br>
    <h3>LA SOLUCI&Oacute;N NO PUDO SER REGISTRADA</h3>
    <br>
    <h4>INTENTE NUEVAMENTE<br> </h4>
    <br>
    <a href="<?=base_url('bom/solucion/index');?>" class="btn btn-warning">INTENTAR NUEVAMENTE</a>
</div>
<?php 
	endif;
?>
