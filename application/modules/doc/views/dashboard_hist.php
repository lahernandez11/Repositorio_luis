
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
	.abrir-proyecto,
	.abrir-contratos,
	.abrir-categorias,
	.abrir-subcategorias{
		cursor:pointer;
	}
	li.proyectos{
		list-style:none;
		/*border-bottom:solid 1px #CCC;*/
	}
	li.proyectos{
		font-size:20px;
		}
	td.abrir-programacion
	{
		cursor:pointer;
		text-decoration:underline;
	}
	td#evidencias{
		cursor:pointer;
	}
	td#notificacion{
		cursor:pointer;
	}	
	span.historico{
		cursor:pointer;
		text-decoration:underline;
	}
	i.notas{
		cursor:pointer;
	}
	i.accion{
		cursor:pointer;
	}
	i.cancelar_act{
		cursor:pointer;
	}
	i.green{
		color:#090;
	}
	i.red{
		color:#C00;
	}
	i.blue{
		color:#036;
	}
	i.yellow{
		color:#F90;
	}
	i.black{
		color:#000;
	}
</style>
<div class="page-header">
	<h4><a class="bom-menu" href="<?=base_url('doc/home/index')?>"> 
    <i class="fa fa-institution fa-2x"></i> DOCUMENTOS </a>/ <a class="bom-menu" href="<?=base_url('doc/contratos_concesion/index')?>">CONTRATOS DE CONCESI&Oacute;N </a> / DASHBOARD HISTORICO <?= $iduser;?></h4>
</div>
<?php

$fecha2meses = date('Y-m-d');
$fecha = date('Y-m-d',strtotime('-2 months', strtotime($fecha2meses)));
?>
<div class="row">  
  <div class="col-md-2 col-md-offset-7">     
  	<label for="Inicio" class=" control-label">Inicio</label>
    	<div class="input-append input-group datepicker date1">            	
        	<input data-format="yyyy-MM-dd" value="<?=$fecha?>" type="text" class="form-control letra11 calendario" readonly name="fecha_inicio" id="fecha_inicio">
            <span class="input-group-addon add-on">
            	<i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i>
            </span>                
        </div>
  </div>
  <div class="col-md-2">
  	<label for="Fin" class=" control-label">Fin</label> 
    	<div class="input-append input-group datepicker date2">
        	<input data-format="yyyy-MM-dd" value="<?=$fecha2meses?>" type="text" class="form-control letra11 calendario" readonly name="fecha_fin" id="fecha_fin">
            <span class="input-group-addon add-on" id="icono-fecha-fin">
            	<i data-date-icon="fa fa-calendar"></i>
			</span>                
        </div>
  </div>
  <div class="col-md-1">
  	<br>
    <button id="actualizar" class="btn btn-warning">Actualizar</button>
  </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 proyecto-inicio" style="border:solid 1px #CCCCCC; padding:20px;">
  	<?php if(sizeof($proyectos)>0):?>
	<?php foreach ($proyectos as $proyecto):?>
    	<li class="proyectos">
        	<i class="fa fa-plus-square-o abrir-proyecto" id="<?=$proyecto["idproyecto"]?>" idproyecto="<?=$proyecto["idproyecto"]?>"></i> 
			<span style="color:<?=$proyecto["color"]?>"><?=$proyecto["nombre_proyecto"]?></span> 
            <i class="fa fa-circle pull-right" style="color:<?=$proyecto["color"]?>"></i>
        	<div class="contratos proyecto<?=$proyecto["idproyecto"]?>" style="display:none;">
            </div>
        </li>
	<?php endforeach;?>
    <?php else:?>
    	<div class="alert alert-info">
        	Sin actividades pendientes por dar seguimiento.
        </div>
    <?php endif;?>
    </div>
    <div class="col-md-3"></div>
</div>
<br>

<div class="modal fade" id="modal-detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle de actividad programada</h4>
      </div>
      <div class="modal-body">
      	<fieldset class="well the-fieldset">
      	<legend class="the-legend">Datos de contrato</legend>
        	<div class="col-md-12">
            	<table style="width:100%; vertical-align:top; font-size:10px;">
                	<tr><td style="width:30%;">Proyecto</td><td id="proyecto"></td></tr>
                    <tr><td>Contrato</td><td id="contrato"></td></tr>                    
                    <tr><td>Descripci&oacute;n</td><td id="descripcion_contrato"></td></tr>
                    <tr><td>Fecha Incio</td><td id="inicio_contrato"></td></tr>
                    <tr><td>Fecha Fin</td><td id="fin_contrato"></td></tr>
                </table>
        	</div>
        </fieldset>
        
        <fieldset class="well the-fieldset">
      	<legend class="the-legend">Datos de actividad</legend>
        	<div class="col-md-12">
            	<table style="width:100%; vertical-align:top; font-size:10px;">
                    <tr><td style="width:30%;">ID Tarea Programada</td><td id="idactividad_p"></td></tr>
                    <tr><td>Categor&iacute;a</td><td id="categoria"></td></tr>
                    <tr><td>Subcategor&iacute;a</td><td id="subcategoria"></td></tr>
                    <tr><td style="width:30%;">Actividad</td><td id="actividad"></td></tr>
                    <tr><td>Descripci&oacute;n</td><td id="descripcion"></td></tr>
                    <tr><td>Documento Cotnractual</td><td id="documento"></td></tr>
                    <tr><td>&Aacute;rea/Empresa Responsable</td><td id="empresa"></td></tr>
                    <tr><td>Persona Responsable</td><td id="persona"></td></tr>
                    <tr><td>Referencia Documental</td><td id="referencia"></td></tr>
                    <tr><td>Detalle Referencia Documental</td><td id="detalle"></td></tr>
                    <tr><td>Observaci&oacute;n/Acci&oacute;n</td><td id="observacion"></td></tr>
                    <tr><td>Fecha Fin</td><td id="fin_actividad"></td></tr>
                </table>
        	</div>
        </fieldset>
        
        <fieldset class="well the-fieldset">
      	<legend class="the-legend">Seguimiento de la tarea</legend>
        	<div id="seguimiento" class="col-md-12">            	
        	</div>
        </fieldset>
        
        <div id="detalle_acciones"></div>
        <fieldset class="well the-fieldset">
      		<legend class="the-legend">Notificaciones</legend>
        	<div class="col-md-12" id="areas">
            	
        	</div>
        </fieldset>
        
        <fieldset class="well the-fieldset">
        	<legend class="the-legend">Evidencias documentales</legend>
            <div class="col-md-12" id="consultar-evidencias"></div>
        </fieldset>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_detalle">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!--INICIA MODAL PARA EVIDENCIAS DOCUMENTALES-->
<div class="modal fade" id="modal-evidencia-documental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Agregar evidencia documental</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
        	<form id="form-evidencia-documental" action="<?=base_url('doc/dashboard_hist/agregar_evidencia_documental')?>" method="post" enctype="multipart/form-data">
        	<div class="col-md-12">
            	<div class="form-group">
                	<label for="exampleInputFile">Evidencia documental</label>
                	<input type="file" name="myfile" id="exampleInputFile">
              	</div>
            </div>
            <div class="col-md-3">
            	<input type="submit" value="Guardar" class="btn btn-success" id="guardar_evidencia">
                <input type="hidden" id="idprogramacion" name="idprogramacion" value="">
                <input type="hidden" id="idestado" name="idestado" value="">
            </div>
            </form>
        </div>
        <div class="row">
        	<br>
        	<div class="col-md-12" id="detalle-evidencia-documental"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--TERMINA MODAL PARA EVIDENCIAS DOCUMENTALES-->


<!--INICIA MODAL PARA EVIAR NOTIFICACION-->
<div class="modal fade" id="modal-notificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Enviar notificaci&oacute;n</h4>
      </div>
      <div class="modal-body">
      <fieldset class="well the-fieldset">
      	<legend class="the-legend">Datos de actividad</legend>
        	<div class="col-md-12">
            	<table style="width:100%; vertical-align:top; font-size:10px;">
                	<tr><td style="width:30%;">ID Tarea Programada</td><td id="enviar-idactividad_p"></td></tr>
                    <tr><td style="width:30%;">Actividad</td><td id="enviar-actividad"></td></tr>
                    <tr><td>Descripci&oacute;n</td><td id="enviar-descripcion"></td></tr>
                    <tr><td>Documento Contractual</td><td id="enviar-documento"></td></tr>
                    <tr><td>&Aacute;rea/Empresa Responsable</td><td id="enviar-empresa"></td></tr>
                    <tr><td>Persona Responsable</td><td id="enviar-persona"></td></tr>
                    <tr><td>Referencia Documental</td><td id="enviar-referencia"></td></tr>
                    <tr><td>Detalle Referencia Documental</td><td id="enviar-detalle"></td></tr>
                    <tr><td>Observaci&oacute;n/Acci&oacute;n</td><td id="enviar-observacion"></td></tr>
                </table>
        	</div>
        </fieldset>
        
        <fieldset class="well the-fieldset">
      		<legend class="the-legend">Notificaciones</legend>
            	<form id="form-enviar-notificaciones-usuarios">
                    <div class="col-md-12" id="enviar-areas">
                    	    
                    </div>
                    <input type="hidden" name="not-idprogramacion" id="not-idprogramacion">
            	</form>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-enviar-notificacion">Enviar notificaci&oacute;n</button>
      </div>
    </div>
  </div>
</div>
<!--TERMINA MODAL PARA EVIDENCIAS DOCUMENTALES-->

<!--INICIA MODAL PARA ANOTACIONES-->
<div class="modal fade" id="modal-anotacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Anotaciones</h4>
      </div>
      <div class="modal-body">
	      <fieldset class="well the-fieldset">
	      	<legend class="the-legend">Ingrese Anotaci&oacute;nes</legend>
	      	<div class="col-md-12">
            	<table style="width:100%; vertical-align:top; font-size:10px;">
                	<tr><td>Fecha</td><td>
                		<div class="input-append input-group datepicker date-anotacion">            	
        					<input data-format="yyyy-MM-dd" value="<?=date('Y-m-d')?>" type="text" class="form-control letra11 calendario" readonly name="fecha_anotacion" id="fecha_anotacion">
            				<span class="input-group-addon add-on">
            					<i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i>
            				</span>                
        				</div>
                	</td></tr>
                    <tr><td>Anotaci&oacute;n</td><td><textarea class="form-control required" placeholder="Ingrese se nota..." id="nota_v" style="font-size: 11px" maxlength="254" ></textarea></td></tr>
                    <tr><td>Valoraci&oacute;n</td><td>
                    	<select id="val" name="val" class="form-control" >
	      				<option value="1" selected="selected">1</option>
	      				<option value="2">2</option>
	      				<option value="3">3</option>
	      				<option value="4">4</option>
	      				<option value="5">5</option>
	      			</select>
                    </td></tr>
                    <tr><td>Usuario</td><td><input type="text" id="usuario_v" class="form-control" value="<?=$usuario?>" style="font-size: 11px" readonly /></td></tr>
                    <input type="hidden" id="idprogramacion_v" />
                </table>
        	</div>      	
	      </fieldset>
	        
	      <div class="row">
	      	<br>
	        <div class="col-md-12" id="detalle-anotaciones"></div>
	      </div>        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>    
        <button type="button" class="btn btn-primary" id="guarda_anotacion">Guardar</button>    
      </div>
    </div>
  </div>
</div>
<!--TERMINA MODAL PARA ANOTACIONES-->