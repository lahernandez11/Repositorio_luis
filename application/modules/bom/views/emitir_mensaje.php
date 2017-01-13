<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383354398_purchase_order.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. /  </a>EMITIR REPORTE</h4>
</div>
<?php if($mensaje=='ok'): ?>
<div class="row" align="center">
	<br>
    <h3>EL DOCUMENTO FU&Eacute; SUBIDO CON &Eacute;XITO</h3>
    <br>
    <h4><br>FU&Eacute; SUBIDO EL DOCUMENTO<br>AL REPORTE <?=$folio?></h4>
    <br>
    <a href="<?=base_url('bom/home/index');?>" class="btn btn-success">ACEPTAR</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?=base_url('bom/emitir/index');?>" class="btn btn-warning">SUBIR OTRO DOCUMENTO</a>
</div>
<?php else: ?>
<div class="row" align="center">
	<br>
    <h3>EL DOCUMENTO NO PUDO SER SUBIDO</h3>
    <br>
    <h4>INTENTE NUEVAMENTE<br></h4>
    <br>
    <a href="<?=base_url('bom/emitir/index');?>" class="btn btn-warning">INTENTAR NUEVAMENTE</a>
</div>
<?php endif;?>

