<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1409271617_519616-115_List-32.png')?>"> <a class="bom-menu" href="<?=base_url('sgwc/reporte/index')?>">SGWC</a> / <a class="bom-menu" href="<?=base_url('sgwc/eventos/reporte_eventos')?>">REPORTE FOTOGR&Aacute;FICO DE EVENTOS </a> / <a class="bom-menu" href="<?=base_url('sgwc/eventos/configuracion')?>">CONFIGURACI&Oacute;N / ORDEN-DESCRIPCI&Oacute;N</a></b></h5>
</div>
<?=form_open('',array('class'=>'form-horizontal','role'=>'form','id'=>'reporte'));?>
<fieldset>
	<h5><strong>ORDEN Y DESCRIPCI&Oacute;N DE FOTOGRAF&Iacute;AS</strong></h5>
    <br>
    <span id="errores" class="errores"></span>
    <div class="row letra10" id="ordena">
    	<div class="col-md-4">
    	<label style="text-align:left" for="o_proyecto" class="control-label">Seleccione proyecto: </label>
        <select id="o_proyecto" name="o_proyecto" class="form-control letra10 required">
        	<option value="00">- SELECCIONE -</option>
            <?php foreach($proyectos as $proyecto):?>
            	<option value="<?=$proyecto->idbase?>"><?=$proyecto->nombre_proyecto?></option>
			<?php endforeach;?>            
        </select>
        </div>
        <div class="col-md-4 col-md-offset-3">
    	<label style="text-align:left" for="o_fotos" class="control-label">Distribuci&oacute;n de fotograf&iacute;as por p&aacute;gina: </label>
        <div id="no_fotos">
            <select id="o_fotos" name="o_fotos" class="form-control letra10 required">
                <option value="00">- SELECCIONE -</option>                      
            </select>
        </div>
        </div>
    </div>
    <br>
				
    <div id="orden">
        
	</div>
    
</fieldset>

<?=form_close();?>
