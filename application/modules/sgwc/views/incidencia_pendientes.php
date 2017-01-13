<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1413332776_attention-32.png')?>"> <a class="bom-menu" href="<?=base_url('sgwc/reporte/index')?>">SGWC</a> / <a class="bom-menu" href="<?=base_url('sgwc/incidencia/index')?>">NOTIFICACI&Oacute;N INCIDENCIAS / PROXIMAS A VENCER </a></b></h5>
</div>
<?=form_open('',array('class'=>'form-horizontal','role'=>'form','id'=>'reporte'));?>
<fieldset>
	<h5><strong>INCIDENCIAS PROXIMAS A VENCER</strong></h5>
    <br>
    <div class="row">
    	<div class="col-md-4 form-group">
    	<label style="text-align:left" for="proyecto" class="control-label">Seleccione proyecto: </label>
        <select id="proyecto" name="proyecto" class="form-control letra10 required">
        	<option value="00">- SELECCIONE -</option>
            <?php foreach($proyectos as $proyecto):?>
            	<option value="<?=$proyecto->idbase?>"><?=$proyecto->nombre_proyecto?></option>
			<?php endforeach;?>            
        </select>
        </div>
    </div>
    
    <div id="info_pendiente"></div>
    
</fieldset>

<?=form_close();?>
