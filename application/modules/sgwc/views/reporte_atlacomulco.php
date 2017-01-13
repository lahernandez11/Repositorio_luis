<div class="row letra10">
    	<div class="col-md-2 form-group">
        	<label style="text-align:left" for="registro-fecha" class="col-sm-12 control-label">Seleccione fecha: </label>
            <div class="col-sm-12">
            	<div id="datetimepicker" class="input-append input-group">
                	<input id="registro-fecha" data-format="yyyy-MM" value="<?=date('Y-m');?>" type="text" class="form-control letra10 required" readonly name="registro_fecha">
                    <span class="input-group-addon add-on">
                    	<i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i>
                    </span>                        
                </div>                            
            </div>
        </div>
        <div class="col-md-2 form-group">
            <label style="text-align:left" for="validacion" class="col-sm-12 control-label">Validaci&oacute;n: </label>
            	<div class="col-sm-12">
                    <div><input type="checkbox" id="v_todo"> <span id="v_todo">MARCAR TODO</span></div>
                    <div><input type="checkbox" name="validacion2" class="validacion checkAll_v" value="2"> Validada</div>
                    <div><input type="checkbox" name="validacion1" class="validacion checkAll_v" value="1"> No validada</div>
            	</div>
        </div>
        <div class="col-md-3 form-group">
            <label style="text-align:left" for="info" class="col-sm-12 control-label">Fuente de informaci&oacute;n: </label>
            	<div class="col-sm-11">
                    <input type="hidden" name="c_fuente" value="<?=sizeof($fuentes)?>" />
                    <div><input type="checkbox" id="i_todo"> <span id="i_todo">MARCAR TODO</span></div>
                    <?php foreach($fuentes as $fuente):?>
                        <div><input type="checkbox" name="info<?=$fuente->idfuente?>" class="info checkAll_i" value="<?=$fuente->idfuente?>"> <?=$fuente->fuente_informacion?></div>
                    <?php endforeach ?>                
            	</div>
        </div>
        <div class="col-md-6 form-group">
            <label style="text-align:left" for="clase" class="col-sm-12 control-label">Clase: </label>
            	<div class="col-sm-12">
                    <div><input type="checkbox" id="c_todo"> <span id="c_todo">MARCAR TODO</span></div>
                    <?php foreach($clases as $clase):?>
                        <div><input type="checkbox" name="clase<?=$clase->idclase?>" class="clase checkAll_c" value="<?=$clase->idclase?>"> <?=$clase->clase?></div>
                    <?php endforeach ?>
            	</div>
        </div>
        <div><a id="enviar" href="" class="btn btn-success loading-state" target="_blank" >Generar Reporte</a></div>
    </div>
    
    