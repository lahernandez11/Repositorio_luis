<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383252640_handshake.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a> <a class="bom-menu" href="<?=base_url('bom/cerrar/index')?>">CERRAR REPORTE</a></h4>
</div>
<?php if($mensaje=='ok'):?>
<div class="row" align="center">
	<br>
    <h3>EL REPORTE HA SIDO CERRADO CON &Eacute;XITO</h3>
    <br>
    <h4>SE CERR&Oacute; EL REPORTE <?=$folio?></h4>
    <br>
    <a href="<?=base_url('bom/home/index');?>" class="btn btn-success">ACEPTAR</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?=base_url('bom/cerrar/index');?>" class="btn btn-warning">CERRAR OTRO REPORTE</a>
</div>
<?php
	else:
?>
<div class="row" align="center">
	<br>
    <h3>EL REPORTE NO PUDO SER CERRADO</h3>
    <br>
    <h4>INTENTE NUEVAMENTE<br> </h4>
    <br>
    <a href="<?=base_url('bom/cerrar/index');?>" class="btn btn-warning">INTENTAR NUEVAMENTE</a>
</div>
<?php 
	endif;
?>
