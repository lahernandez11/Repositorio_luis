<style>
	.the-legend {
		border-style: none;
		border-width: 0;
		font-size: 14px;
		line-height: 20px;
		margin-bottom: 0;
		font-weight:bold;
	}
	.the-fieldset {
		border: 2px groove threedface #444;
		-webkit-box-shadow:  0px 0px 0px 0px #000;
		box-shadow:  0px 0px 0px 0px #000;
	}
	select#carril option:selected{
		background-color:#7ac142;
		color:#fff;	
	}
</style>
<div class="page-header">
	<h4><a class="bom-menu" href="<?=base_url('grl/bitacora/index')?>">
    <img src="<?=base_url('assets/img/1406664015_519908-101_Warning_small.png')?>"> BIT&Aacute;CORA DE INCIDENCIAS CARRETERAS</h4></a>
</div> 
<script src="<?=base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
<a href="#" class="btn btn-warning" id="btnTodo">Exportar Todo</a>
<a href="#" class="btn btn-warning" id="btnExport">Exportar</a>
<a href="#" class="btn btn-success pull-right" id="btn-abrir-agregar-incidencia"><i class="fa fa-plus"></i> Agregar</a> 
<table id="grid" style="font-size:10px;" width="100%">
	<tr><td align="center"><img src="<?=base_url('assets/img/cargando.gif')?>"></td></tr>
</table>
<!--INICIA MODAL ALTA DE INCIDENCIA-->
<div class="modal fade" id="modal-alta-incidencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <form class="form-horizontal" role="form" id="form-agregar-incidencia">
      <div class="modal-body">
      <fieldset class="well the-fieldset">
      	<legend class="the-legend">Datos Generales</legend>
      	<!--<div class="well">-->
  			<div class="form-group">
    			<label for="proyecto" class="col-sm-4 control-label">Proyecto</label>
    			<div class="col-sm-8">
      				<select class="form-control validar input-sm" id="proyecto" name="proyecto">
                    	<option value="0">- SELECCIONE -</option>
                        <?php foreach ($proyectos as $proyecto):?>
                        <option value="<?=$proyecto->idproyecto?>"><?=$proyecto->nombre_proyecto?></option>	
						<?php endforeach;?>
                    </select>
    			</div>
  			</div>
            <div class="form-group">
    			<label for="cuerpo" class="col-sm-4 control-label">Cuerpo</label>
    			<div class="col-sm-8">
      				<select class="form-control validar input-sm" id="cuerpo" name="cuerpo">
                    	<option value="0">- SELECCIONE -</option>
                        <?php foreach ($cuerpos as $cuerpo):?>
                        <option value="<?=$cuerpo->idcuerpo?>"><?=$cuerpo->cuerpo?></option>	
						<?php endforeach;?>	
                    </select>
    			</div>
  			</div>
            <!--<div class="form-group">
    			<label for="cuerpo" class="col-sm-4 control-label">Carril</label>
    			<div class="col-sm-8">
      				<select class="form-control validar input-sm" id="carril" name="carril[]" multiple style="height:100px;">
                        <?php foreach ($carriles as $carril):?>
                        <option value="<?=$carril->idcarril?>"><?=$carril->carril?></option>	
						<?php endforeach;?>	
                    </select>
    			</div>
  			</div>-->
            
            
            <div class="form-group">
    			<label for="cuerpo" class="col-sm-4 control-label">Carril</label>
    			<div class="col-sm-8">
                	<div style="background-color:#FFF; border:solid 1px #ccc; padding-left:10px; padding-right:10px; font-size:12px; height:100px; overflow:auto;">
                    	<div class="checkbox" style="padding-top: 0px;">
                          <label>
                            <input type="checkbox" value="0" id="seleccionar-todos">
                            SELECCIONAR TODOS
                          </label>
                        </div>
						<?php foreach ($carriles as $carril):?>
                        <div class="checkbox" style="padding-top: 0px;">
                          <label>
                            <input type="checkbox" class="carril" name="carril[]" value="<?=$carril->idcarril?>">
                            <?=$carril->carril?>
                          </label>
                        </div>
                        <?php endforeach;?>	
                    </div>
    			</div>
  			</div>
            
            <div class="form-group">
    			<label for="tipo" class="col-sm-4 control-label">Km Inicial</label>
    			<div class="col-sm-4" id="km_min">
      				<select class="form-control input-sm" id="km_min" disabled name="km_min">
                    	<option value="0">- SELECCIONE -</option>
                    </select>
    			</div>
                <div class="col-sm-4" id="ms_min">
      				<select class="form-control input-sm" id="ms_min" disabled name="ms_min">
                    	<option value="0">- SELECCIONE -</option>
                    </select>
    			</div>
  			</div>
            <div class="form-group">
    			<label for="tipo" class="col-sm-4 control-label">Km Final</label>
                <div class="col-sm-4" id="km_max">
      				<select class="form-control input-sm" id="km_max" disabled name="km_max">
                    	<option value="0">- SELECCIONE -</option>
                    </select>
    			</div>
                <div class="col-sm-4" id="ms_max">
      				<select class="form-control input-sm" id="ms_max" disabled name="ms_max">
                    	<option value="0">- SELECCIONE -</option>
                    </select>
    			</div>
  			</div>
        </fieldset>
        <!--</div>-->
        <!--<div class="well">-->
        <fieldset class="well the-fieldset">
        	<legend class="the-legend">Datos de Incidencia</legend>
			<div class="form-group">
    			<label for="tipo" class="col-sm-4 control-label">Incidencia</label>
    			<div class="col-sm-8">
      				<select class="form-control validar input-sm" id="tipo" name="tipo">
                    	<option value="0">- SELECCIONE -</option>
                        <?php foreach ($tipos as $tipo):?>
                        <option value="<?=$tipo->idtipo_incidencia?>"><?=$tipo->tipo_incidencia?></option>	
						<?php endforeach;?>
                    </select>
    			</div>
  			</div>
            <div class="form-group">
    			<label for="causa" class="col-sm-4 control-label">Causa</label>
    			<div class="col-sm-8">
      				<select class="form-control validar input-sm" id="causa" name="causa">
                    	<option value="0">- SELECCIONE -</option>
                        <?php foreach ($causas as $causa):?>
                        <option value="<?=$causa->idcausa?>"><?=$causa->causa?></option>	
						<?php endforeach;?>
                    </select>
    			</div>
  			</div>
        </fieldset>
        <!--</div>-->
        <fieldset class="well the-fieldset">
        	<legend class="the-legend">Vigencia</legend>
        <!--<div class="well">-->
            <div class="form-group">
    			<label for="Inicio" class="col-sm-4 control-label">Inicio</label>
    			<div class="col-sm-4">
                	<div class="input-append input-group datepicker">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control" readonly name="fecha_inicio" id="fecha_inicio">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
    			</div>
                <div class="col-sm-4">
                	<div class="input-append input-group timepicker">
                        <input data-format="hh:mm:ss" value="12:00:00" type="text" class="form-control" readonly name="hora_inicio" id="hora_inicio">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
                </div>
  			</div>
            <div class="form-group">
    			<label for="Fin" class="col-sm-4 control-label">Fin</label>
    			<div class="col-sm-4">
                	<div class="input-append input-group datepicker">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control" readonly name="fecha_fin" id="fecha_fin">
                        <span class="input-group-addon add-on" id="icono-fecha-fin">
                        <i data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
    			</div>
                <div class="col-sm-4">
                	<div class="input-append input-group timepicker">
                        <input data-format="hh:mm:ss" value="12:00:00" type="text" class="form-control" readonly name="hora_fin" id="hora_fin">
                        <span class="input-group-addon add-on" id="icono-hora-fin">
                        <i data-time-icon="fa fa-clock-o">
                          </i>
                          </span>
                    </div>
                </div>
  			</div>
            <div class="form-group">
    			<label for="Fin" class="col-sm-4 control-label"></label>
    			<div class="col-sm-4">
                	<div class="checkbox">
                        <label>
                          <input type="checkbox" id="eval-final"> Sin final
                        </label>
                     </div>
    			</div>
  			</div>
        <!--</div>-->
        </fieldset>
        <fieldset class="well the-fieldset">
        	<legend class="the-legend">Notas</legend>
        	<div class="form-group">
    			<div class="col-sm-12">
            		<textarea class="form-control" name="notas" id="notas" maxlength="254"></textarea>
                </div>
            </div>
    	</fieldset>
        
        
      </div>
      <input type="hidden" name="idincidencia" id="idincidencia" value="">
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="btn-agregar-incidencia" style="display:none;">Agregar</button>
        <button type="button" class="btn btn-warning" id="btn-editar-incidencia" style="display:none;">Editar</button>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL ALTA DE INCIDENCIA-->
<script>
$(document).ready(function(e) {
    LoadTable(<?=$datasource?>)
});
</script>