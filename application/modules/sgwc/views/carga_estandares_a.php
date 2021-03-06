<div class="row letra10">
	<div class="col-md-2 form-group">
    	<label style="text-align:left" for="fecha-inicio" class="col-sm-11 control-label">Fecha Inicio: </label>
        <div class="col-sm-11">
        	<div id="" class="input-append input-group datetimepicker">
                <input id="fecha_inicio" data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control letra10 required" readonly name="fecha_inicio">
                <span class="input-group-addon add-on">
                    <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i>
                </span>                                        
            </div>                            
        </div>
        <br>
        <label style="text-align:left" for="fecha-fin" class="col-sm-11 control-label">Fecha Fin: </label>
        <div class="col-sm-11">
        	<div id="" class="input-append input-group datetimepicker">
                <input id="fecha_fin" data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control letra10 required" readonly name="fecha_fin">
                <span class="input-group-addon add-on">
                    <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i>
                </span>                                        
            </div>                            
        </div>
        <br>
        <label style="text-align:left" for="orden" class="col-sm-11 control-label">Ordenar por: </label>
        <div class="col-sm-11">
        	<input type="radio" name="orden" value="at.tareaID" checked />Referencia
            <br>
            <input type="radio" name="orden" value="clase,at.tareaID" />Referencia y Clase
        </div>
        <br>
        <label style="text-align:left" for="orden" class="col-sm-11 control-label">Mostrar: </label>
        <div class="col-sm-11">
        	<input type="radio" name="resumen" value="1" checked />Resumen de Inconsistencias
            <br>
            <input type="radio" name="resumen" value="2" />Reporte Fotogr&aacute;fico
        </div>
        <br><br>
        <label style="text-align:left" for="pagina" class="col-sm-11 control-label">No. de p&aacute;ginas: </label>        
        <div class="col-sm-11">
        	<input type="checkbox" name="pagina" id="pagina" value="1" />           
	        <br>
    	    <input type="number" class="form-control required" id="numero_pagina" name="numero_pagina" value="1" style="display:none" />
        </div>
	</div>
    <div class="col-md-3 form-group verticalLine-2">
    	<label style="text-align:left" for="validacion" class="col-sm-12 control-label">Estado: </label>
        <div class="col-sm-12">
        	<div><input type="checkbox" id="v_todo"> <span id="v_todo">MARCAR TODO</span></div>
            <div><input type="checkbox" name="validacion[]" class="validacion checkAll_v" value="1"> VALIDADA</div>
            <div><input type="checkbox" name="validacion[]" class="validacion checkAll_v" value="0"> NO VALIDADA</div>
        </div>
        <br>
        <label style="text-align:left" for="info" class="col-sm-12 control-label">Fuente de informaci&oacute;n: </label>
        <div class="col-sm-11">
            <input type="hidden" name="c_fuente" value="<?=sizeof($fuentes)?>" />
            <div><input type="checkbox" id="i_todo"> <span id="i_todo">MARCAR TODO</span></div>
            	<?php foreach($fuentes as $fuente):?>
                	<div><input type="checkbox" name="info<?=$fuente->idfuente?>" class="info checkAll_i" value="<?=$fuente->idfuente?>"> <?=$fuente->fuente_informacion?></div>
                <?php endforeach ?>                
        </div>
    </div>    
    <div class="col-md-3 form-group verticalLine">
    	<label style="text-align:left" for="clase" class="col-sm-12 control-label">Carreteras: </label>
        <div class="col-sm-11">
            <input type="hidden" name="c_carretera" value="<?=sizeof($carreteras)?>" />            
            	<?php foreach($carreteras as $carretera):?>
                	<div><input type="checkbox" name="carretera[]" class="carretera checkAll_ca"  value="<?=$carretera->carreteraID?>"> <?=$carretera->carretera?></div>
                <?php endforeach ?>                
        </div>
        <br/>
        <label style="text-align:left" class="col-sm-12 control-label" id="label_segmento"></label>
        <div class="col-sm-11" id="div_segmentos">
                           
        </div>
    </div>
    <div class="col-md-4 form-group verticalLine">
        <label style="text-align:left" for="clase" class="col-sm-12 control-label">Clase: </label>
        <div class="col-sm-12">
                <div><input type="checkbox" id="c_todo"> <span id="c_todo">MARCAR TODO</span></div>
                <?php foreach($clases as $clase):?>
                	<div id="c_<?=$clase->idclase?>" class="n_clase"><input id="c_<?=$clase->idclase?>" type="checkbox" name="clase<?=$clase->idclase?>" class="clase checkAll_c" value="<?=$clase->idclase?>"> <?=$clase->clase?></div>
                <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-1 form-group">
    	<a id="enviar" href="" class="btn btn-success loading-state" >Generar Reporte</a>
    </div>	    
</div>
<script>
//calendario 
$(document).ready(function(e) {    	
	$('.datetimepicker').datetimepicker({	 
      pickTime: false,
	  format: "yyyy-MM-dd"	  
    });
});
$('.datetimepicker').datetimepicker()
  .on('changeDate', function(ev){
    $('.datetimepicker').datetimepicker('hide');
  });
</script>