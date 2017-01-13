<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/268131_settings2-512.png')?>"><a class="bom-menu" href="<?=base_url('sgwc/reporte/index')?>"> SGWC </a>/ <a class="bom-menu" href="<?=base_url('sgwc/reporte/reporte_foto')?>">REPORTE FOTOGR&Aacute;FICO / GENERAR REPORTE </a></b></h5>
</div>
<?=form_open('',array('class'=>'form-horizontal','role'=>'form','id'=>'reporte'));?>
<fieldset>
	<h5><strong>DATOS DEL REPORTE FOTOGR&Aacute;FICO</strong></h5>
    <br>
    <span id="errores" class="errores"></span>
    <div class="row letra10">
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
     <input type="hidden" id="user" name="user" value="<?=$user?>" />
     <input type="hidden" id="user" name="server" value="<?=$_SERVER['SERVER_NAME']?>" />
    <br>    
    <?=$mensaje?>
    <br>
    <div id="informacion">       
    </div>
    <br>   
    
</fieldset>

<?=form_close();?>
