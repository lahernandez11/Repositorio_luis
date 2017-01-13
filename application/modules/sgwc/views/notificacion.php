<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/32x32-black-white-android-new-message.png')?>"> <a class="bom-menu" href="<?=base_url('sgwc/reporte/index')?>">SGWC</a> / <a class="bom-menu" href="<?=base_url('sgwc/incidencia/index')?>">NOTIFICACI&Oacute;N INCIDENCIAS / NOTIFICACI&Oacute;NES </a></b></h5>
</div>
<div class="row busqueda">
	<div class="col-md-6">
    	<label style="text-align:left" for="proyecto" class="control-label">Seleccione proyecto: </label>
        <select id="proyecto" name="proyecto" class="form-control required">
        	<option value="0">- SELECCIONE -</option>
            <?php foreach($proyectos as $proyecto):?>
            	<option value="<?=$proyecto->idbase?>"><?=$proyecto->nombre_proyecto?></option>
			<?php endforeach;?>            
        </select>
    </div>
    <div class="col-md-6" id="muestra_segmentos">
    	<label style="text-align:left" for="proyecto" class="control-label">Seleccione segmento: </label>
        <select id="segmento" name="segmento" class="form-control required">
        	<option value="0">- SELECCIONE -</option>                       
        </select>
    </div>
	 
</div>    
<br><br>

<div class="row" id="muestra_usuarios"></div>

