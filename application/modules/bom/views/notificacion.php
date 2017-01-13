<div class="page-header">
	<h4><a href="<?=base_url('bom/home/index')?>">
    <img src="<?=base_url('assets/img/1383255394_edit_property.png')?>"> </a>NOTIFICACI&Oacute;N DE REPORTES</h4>
</div>
<div class="row">
	<div class="col-md-4">
    	TIPO REPORTE
        <select id="select_tipo" name="tipo" class="form-control">
        	<option value="0">- SELECCIONE -</option>
            <?php foreach($tipo as $t): ?>
            	<option value="<?=$t["idtiporeporte"]?>"><?=$t['nombre_tiporeporte']?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div id="div_pasos" class="col-md-4">
    	
    </div>
    <div class="col-md-4">
    	CLASIFICACION DE REPORTE
        <select id="select_cla" name="clasificacion" class="form-control">
        	<option value="0" selected> - SELECCIONE - </option>
            <?php foreach($cla as $c): ?>
            	<option value="<?=$c['idclasificacion']?>"><?=$c['nombre_clasificacion']?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<br/><br/>
<div class="row">
	<div class="col-md-4">
    	<div id='usuarios-origen'></div>
    </div>
    <div id="notificacion-botones" style="display:none" class="col-md-4">
    	<br/><br/><br/><br/><br/><br/><br/>
	    <a id="notificacion-agregar" href="#"><img src="<?=base_url('assets/img/1383894329_end.png')?>"></a>
        <br/><br/>
        <a id="notificacion-borrar" href="#"><img src="<?=base_url('assets/img/1383894329_.png')?>"></a>
    </div>
    <div class="col-md-4">
    	<div id='usuarios-destino'></div>
    </div>
</div>

