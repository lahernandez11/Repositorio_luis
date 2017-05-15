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
	a.modificar{
		cursor:pointer;
		text-decoration:underline;
	}
	a.cancelar{
		cursor:pointer;
		text-decoration:underline;
	}	
progress {
	width: 400px;
	height: 14px;
	margin: 50px auto;
	display: block;
	/* Important Thing */
	-webkit-appearance: none;
	border: none;
}

/* All good till now. Now we'll style the background */
progress::-webkit-progress-bar {
	background: #CCC;
	border-radius: 50px;
	padding: 2px;
	box-shadow: 0 1px 0px 0 rgba(255, 255, 255, 0.2);
}

/* Now the value part */
progress::-webkit-progress-value {
	border-radius: 50px;
	box-shadow: inset 0 1px 1px 0 rgba(255, 255, 255, 0.4);
	background: #0064B4;
		/*-webkit-linear-gradient(45deg, transparent, transparent 33%, rgba(0, 0, 0, 0.1) 33%, rgba(0, 0, 0, 0.1) 66%, transparent 66%),
		-webkit-linear-gradient(top, rgba(255, 255, 255, 0.25), rgba(0, 0, 0, 0.2)),
		-webkit-linear-gradient(left, #7ac142, #060);
	
	background-size: 25px 14px, 100% 100%, 100% 100%;
	-webkit-animation: move 5s linear 0 infinite;*/
}

/* That's it! Now let's try creating a new stripe pattern and animate it using animation and keyframes properties  */

@-webkit-keyframes move {
	0% {background-position: 0px 0px, 0 0, 0 0}
	100% {background-position: -100px 0px, 0 0, 0 0}
}

/* Prefix-free was creating issues with the animation */
</style>
<div class="page-header">
	<h4><a class="bom-menu" href="<?=base_url('doc/home/index')?>"> 
    <i class="fa fa-institution fa-2x"></i> DOCUMENTOS </a>/ <a class="bom-menu" href="<?=base_url('doc/contratos_concesion/index')?>">CONTRATOS DE CONCESI&Oacute;N </a> / CONTRATOS</h4>
</div>
<div class="row">
	<a class="btn btn-success pull-right" id="btn-abrir-agregar-contrato"><i class="fa fa-plus"></i> REGISTRAR CONTRATO</a>
    <br><br>
    <table id="grid" style="font-size:10px;"></table>
</div>
<!--INICIA MODAL ALTA DE CONTRATO-->
<div class="modal fade" id="modal-alta-contrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <form class="form-horizontal" role="form" id="form-agregar-contrato">
      <div class="modal-body">
      	<fieldset class="well the-fieldset">
      	<legend class="the-legend">Datos Generales</legend>
  			<div class="form-group">
    			<label for="proyecto" class="col-sm-4 control-label">Proyecto asociado</label>
    			<div class="col-sm-8">
      				<select class="form-control validar input-sm required" id="proyecto" name="proyecto">
                    	<option value="0">- SELECCIONE -</option>
                        <?php foreach ($proyectos as $proyecto):?>
                        <option value="<?=$proyecto->idproyecto?>"><?=$proyecto->nombre_proyecto?></option>	
						<?php endforeach;?>
                    </select>
    			</div>
  			</div>
            <div class="form-group">
    			<label for="cuerpo" class="col-sm-4 control-label">N&uacute;mero de contrato</label>
    			<div class="col-sm-8">
      			<input type="text" class="form-control required" id="numero" name="numero" maxlength="30">	
    			</div>
  			</div>
        </fieldset>
        
        
        <fieldset class="well the-fieldset">
        	<legend class="the-legend">Descripci&oacute;n del contrato</legend>
        	<div class="form-group">
    			<div class="col-sm-12">
            		<textarea class="form-control required" name="descripcion" id="descripcion" maxlength="254"></textarea>
                </div>
            </div>
    	</fieldset>
        
        
        <fieldset class="well the-fieldset">
        	<legend class="the-legend">Vigencia del contrato</legend>
            <div class="form-group">
    			<label for="Inicio" class="col-sm-2 control-label">Inicio</label>
    			<div class="col-sm-4">
                	<div class="input-append input-group datepicker">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="fecha_inicio" id="fecha_inicio">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
    			</div>
                <label for="Fin" class="col-sm-2 control-label">Fin</label>
    			<div class="col-sm-4">
                	<div class="input-append input-group datepicker">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="fecha_fin" id="fecha_fin">
                        <span class="input-group-addon add-on" id="icono-fecha-fin">
                        <i data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
    			</div>
                
  			</div>
        </fieldset>

        <fieldset class="well the-fieldset">
      	<legend class="the-legend">Datos Adicionales</legend>
  			<div class="form-group">
    			<label for="proyecto" class="col-sm-4 control-label">Estado del contrato</label>
    			<div class="col-sm-8">
      				<select class="form-control required input-sm" id="estado" name="estado">
                    	<option value="0">- SELECCIONE ESTADO DE CONTRATO -</option>
                        <option value="1">ACTIVO</option>
                        <option value="2">INACTIVO</option>
                    </select>
    			</div>
  			</div>
            <div class="form-group">
    			<label for="cuerpo" class="col-sm-4 control-label">Formato digital del contrato</label>
    			<div class="col-sm-8">
      			<!--<input type="file" class="form-control" id="userfile" accept="application/pdf" name="userfile">	 -->
            <input type="file" class="form-control" id="userfile" accept="application" name="userfile"> 
    			</div>
  			</div>
        </fieldset>
        Procesando archivo:
        <progress value="0" max="100" style="width:100%;"></progress>
		<div id="content_here_please"></div>
        
      </div>
      <input type="hidden" name="idcontrato" id="idcontrato" value="">
      <div id="documento-previo" style="padding:0px 20px;"></div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="btn-agregar-contrato" style="display:none;">Agregar</button>
        <button type="button" class="btn btn-warning" id="btn-editar-contrato" style="display:none;">Editar</button>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL ALTA DE INCIDENCIA-->