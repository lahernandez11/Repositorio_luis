<div class="page-header">
	<h4><a href="<?=base_url('bom/home/index')?>">
    <img src="<?=base_url('assets/img/1383255394_edit_property.png')?>"> <a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a>REGISTRO DE REPORTES</h4>
</div>
<div class="row" align="center">
	<br>
    <h3>EL REPORTE DE ATENCI&Oacute;N EN EQUIPO DE PEAJE HA SIDO REGISTRADO</h3>
    <br>
    <h4>EL FOLIO DEL REPORTE ES <span class="text-danger"><?=$mensaje?></span><br> Y SE HA NOTIFICADO POR CORREO DE LA FALLA A LAS SIGUIENTES PERSONAS;</h4>
    <br>
    <?php foreach ($usuarios as $usuario):?>
    <span><?=$usuario["nombre"]?></span><br>
    <?php endforeach;?>
    <br>
    <a href="<?=base_url('bom/home/index');?>" class="btn btn-success">ACEPTAR</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?=base_url('bom/registro/index');?>" class="btn btn-warning">REGISTRAR OTRO REPORTE</a>
</div>
