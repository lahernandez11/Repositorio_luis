<style>
	a.programar-actividad{
		cursor:pointer;
		text-decoration:underline;
	}
	i.fa-exclamation-triangle{color:#FF5C0F;}
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
</style>
<div class="page-header">
	<h4><a class="bom-menu" href="<?=base_url('doc/home/index')?>"> 
    <i class="fa fa-institution fa-2x"></i> DOCUMENTOS </a>/ <a class="bom-menu" href="<?=base_url('doc/contratos_concesion/index')?>">CONTRATOS DE CONCESI&Oacute;N </a>/ PROGRAMACI&Oacute;N DE ACTIVIDADES</h4>
</div>
<div class="row">
	<div class="col-md-4">    	
        <b>CONTRATO</b>
    	<select name="prog-contrato" class="form-control" id="prog-contrato">
        	<option value="0">- SELECCIONE -</option>
            <?php foreach ($contratos as $contrato):?>
            <option value="<?=$contrato->idcontrato?>"><?=$contrato->clave.'-'.$contrato->numero_contrato?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="col-md-4" id="prog-categoria-contenedor">
    	
    </div>
    <div class="col-md-4" id="prog-subcategoria-contenedor">
    	
    </div>
</div>
<br>
<div class="row" id="prog-resultado" style="display:none;">
	<div class="col-md-12">
        <table id="grid" style="font-size:10px;"></table>
    </div>
</div>

<!------------------- INICIO MODAL PARA ALTA DE PRIOGRAMACIÓN  -------------->
<div class="modal fade" id="modal-programar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Programar Actividad</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
        	<div class="col-md-12">
            	<table>
            	<tr><td valign="top"><b>Proyecto</b>:</td><td><span id="proyecto"></span></td></tr>
                <tr><td valign="top"><b>Numero Contrato</b>:</td><td><span class="detalle" id="numero"></span></td></tr>
                <tr><td valign="top"><b>Categor&iacute;a</b>:</td><td><span class="detalle" id="categoria"></span></td></tr>
                <tr><td valign="top"><b>Subcategor&iacute;a</b>:</td><td><span class="detalle" id="subcategoria"></span></td></tr>
                <tr><td valign="top"><b>Actividad</b>:</td><td><span class="detalle" id="actividad"></span></td></tr>
                <tr><td valign="top"><b>Descripci&oacute;n</b>:</td><td><span class="detalle" id="descripcion"></span></td></tr>
                <tr><td valign="top"><b>&Aacute;rea/Empresa Responsable</b>:</td><td><span class="detalle" id="area"></span></td></tr>
                <tr><td valign="top"><b>Persona Responsable</b>:</td><td><span class="detalle" id="persona"></span></td></tr>
                </table>
            </div>
        </div>
        <br>
        
        <!--En caso de existir previa programación, se muestra en este espacio-->
        <fieldset class="well the-fieldset">
        <legend class="the-legend">Programaci&oacute;n Existente</legend>
        <div id="programacion-existente">                
        </div>
        </fieldset>
  
        <!--Areas para notificar -->
        <fieldset class="well the-fieldset">
        <legend class="the-legend">Notificaciones</legend>
        <div id="areas-notificacion">        
        </div>
        </fieldset>
        
        <h4>Programar actividades</h4>
        <div class="row">
        	<form class="form-horizontal" role="form" id="prog-guardar-programacion-form">
            	<div class="col-md-4">Fecha L&iacute;mite Inicial</div>
                <div class="col-md-4">Veces a ejecutar</div>
                <div class="col-md-4">Periodo</div>
                
                <div class="col-md-4">
                	<div class="input-append input-group datepicker">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="fecha" id="fecha">
                        <span class="input-group-addon add-on">
                        	<i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-control required" name="repeticion" id="repeticion">
                        <?php for($i=1;$i<=30;$i++):?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php endfor?>
                    </select>
                </div>
                <div class="col-md-4">
                	<select class="form-control required" id="periodo" name="periodo">
                        <?php foreach ($periodos as $periodo): ?>
                        <option value="<?=$periodo["idcat_periodo"]?>"><?=$periodo["cat_periodo"]?></option>
                        <?php endforeach; ?>
                    </select>	
                </div>
        	<!--<div class="col-md-12">
            	<div class="form-group">
                	<label for="fecha" class="col-md-4 control-label">Fecha de inicio</label>
                    <div class="col-md-8">
                    	<div class="input-append input-group datepicker">
                        	<input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="fecha" id="fecha">
                        	<span class="input-group-addon add-on">
                        		<i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i>
                        	</span>
                    	</div>
                    </div>
                </div>
                <div class="form-group">
                	<label for="repeticion" class="col-md-4 control-label">Veces a ejecutar</label>
                    <div class="col-md-8">
                    	<select class="form-control" name="repeticion" id="repeticion">
                        	<?php for($i=1;$i<=15;$i++):?>
                            	<option value="<?=$i?>"><?=$i?></option>
                            <?php endfor?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                	<label for="periodo" class="col-md-4 control-label">Periodo</label>
                    <div class="col-md-8">
                        <select class="form-control required" id="periodo" name="periodo">
                        	<?php foreach ($periodos as $periodo): ?>
                            <option value="<?=$periodo["idcat_periodo"]?>"><?=$periodo["cat_periodo"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>-->
            <input type="hidden" id="idactividad" name="idactividad" value="0">
            </form>
        </div>
        <br><br><br><br><br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="prog-guardar-programacion">Programar</button>
      </div>
    </div>
  </div>
</div>
<!-------------------   FIN MODAL PARA BAJA DE PROGRAMACIÓN    -------------->
