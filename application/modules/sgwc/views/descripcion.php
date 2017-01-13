<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1399338062_change_user.png')?>"> <a class="bom-menu" href="<?=base_url('sgwc/reporte/configuracion')?>">REPORTE FOTOGR&Aacute;FICO / CONFIGURACI&Oacute;N</a></b></h5>
</div>
<?=form_open('',array('class'=>'form-horizontal','role'=>'form','id'=>'reporte'));?>
<fieldset>
	<h5><strong>DESCRIPCI&Oacute;N DE FOTOGRAFIAS</strong></h5>
    <br>
    <span id="errores" class="errores"></span>
    <div class="row letra10" id="descripcion">
    	<div class="col-md-4 form-group">
    	<label style="text-align:left" for="d_proyecto" class="control-label">Seleccione proyecto: </label>
        <select id="d_proyecto" name="d_proyecto" class="form-control letra10 required">
        	<option value="00">- SELECCIONE -</option>
            <?php foreach($proyectos as $proyecto):?>
            	<option value="<?=$proyecto->idbase?>"><?=$proyecto->proyecto?></option>
			<?php endforeach;?>            
        </select>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-4 form-group">
    	<label style="text-align:left" for="fotos" class="control-label">Seleccione n&uacute;mero de fotograf&iacute;as: </label>
        <div id="no_fotos">
            <select id="fotos" name="fotos" class="form-control letra10 required">
                <option value="00">- SELECCIONE -</option>                      
            </select>
        </div>
        </div>
    </div>
    <br>
				
    <div id="descripciones">
       
	</div>
    
</fieldset>

<?=form_close();?>
