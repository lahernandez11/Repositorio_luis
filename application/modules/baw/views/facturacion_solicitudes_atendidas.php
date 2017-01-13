<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1399334087_time.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/facturacion/index')?>">SOLICITUD DE FACTURACI&Oacute;N / </a>
    <?php if($titulo=="SOLICITUDES REGISTRADAS"):?>
    <a class="bom-menu" href="<?=base_url('baw/facturacion/registrados')?>"><?=$titulo?> / ATENDER SOLICITUD</a></b></h5>
    <?php else:?>
    <a class="bom-menu" href="<?=base_url('baw/facturacion/atendiendose')?>"><?=$titulo?> / ATENDER SOLICITUD</a></b></h5>
    <?php endif;?>
</div>
<?=form_open('baw/facturacion/responder_solicitud',array('class'=>'form-horizontal','role'=>'form'));?>
<style>
i.fa{
	cursor:pointer;
	}
</style>
<div class="row">
	<div class="col-md-5">
    	<div class="square letra10">
        	<div class="row">
            	<div class="col-md-6">
                	<h5><strong>DATOS DE LA SOLICITUD</strong></h5>
                </div>
                <div class="col-md-6">
                	<button style="float:right" type="button" class="btn btn-info fact-editar" id="editar">Editar</button>   
                </div>
            </div> 
            <br>
    	<?php foreach ($solicitudes as $solicitud):?>
        	
          <?php $fol=explode('-',$solicitud->folio);?>            
          <div class="form-group">
            <label for="ticket" class="col-sm-3 control-label">Folio: </label>
            <div class="col-sm-9">
              <label class="text-danger"><h5><?=$solicitud->folio?></h5></label>
            </div>
          </div>
          <div class="form-group">
            <label for="solicitante" class="col-sm-3 control-label ">Escrito por: </label>
            <div class="col-sm-9">
              <input type="text" class="form-control letra10" value="<?=$solicitud->nombre_solicitante?>" readonly />
              <br>
              <input type="text" name="correo" id="correo" class="form-control letra10" value="<?=$solicitud->mail_solicitante?>"  disabled />
            </div>
          </div>
          <div class="form-group">
            <label for="solicitante" class="col-sm-3 control-label ">Fecha y Hora: </label>
            <div class="col-sm-9">
              <input type="text" class="form-control letra10" value="El <?=$solicitud->fecha?> a las <?=$solicitud->hora?>" readonly />
            </div>
          </div>
          <div class="form-group">
            <label for="tipo-solicitud" class="col-sm-3 control-label">Tipo:</label>
            <div class="col-sm-9" >
              <select name="tipo-solicitud" id="tipo-solicitud" class="form-control letra10" disabled>
                <?php foreach ($tipos as $tipo):?>
                	<option value="<?=$tipo->idtipo_solicitud?>" <?php if($solicitud->idtipo_solicitud==$tipo->idtipo_solicitud) echo 'selected';?>><?=$tipo->tipo_solicitud?></option>
                <?php endforeach;?> 
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="tema" class="col-sm-3 control-label">Tema:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control letra10" value="<?=$solicitud->tema_solicitud?>" readonly />
            </div>
          </div>
          <div class="form-group">
            <label for="descripcion" class="col-sm-3 control-label">Datos fiscales:</label>
            <div class="col-sm-9">
              <textarea class="form-control letra10" rows="10" readonly><?=$solicitud->mensaje_solicitud?></textarea>
            </div>
          </div>
          <!--<?php if($solicitud->idtipo_solicitud==6 and $fol[0]=='ATA'):?>
          <div class="form-group">
            <label for="archivos" class="col-sm-3 control-label">Archivos adjuntos:</label>
            <div class="col-sm-9">
            	<?php foreach($archivos as $archivo):?>
                	<a target="_blank" href="http://dev.autopista-toluca-atlacomulco.com.mx/<?=$archivo->nombre_documento?>">
                    <i class="fa fa-file-text fa-3x bom-menu"></i>
					<?=substr($archivo->nombre_documento, 19);?>
                    </a>
                <?php endforeach;?>  
            </div>
          </div>
		  <?php endif;?>-->
        </div>
    </div>
    <div class="col-md-7">
    	<div class="square letra10">
        	<div class="row">
            	<div class="col-md-8"><h5><strong>DETALLE DE TICKETS</strong></h5></div>
            </div>
            <br>
            <div class="row">
            	<div class="col-md-12">
                	<?php if(sizeof($tickets)==0): ?>
                  	No existen tickets registrados para esta solicitud
				  <?php else: ?>
                  <table class="table table-bordered table-striped" style="font-size:11px;" border="1">
                  	<thead>
                    	<tr>
                        	<th>#</th>
                            <th>Folio</th>
                            <th>Plaza Cobro</th>
                            <th>Carril</th>
                            <th>Folio Evento</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tarifa</th>
                            <th>Validar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form>
                  <?php 
				  $importe=0;
				  $iva=0;
				  $total=0; $n=1; foreach ($tickets as $ticket): ?>
                  <?php $count=($ticket->idestado_ticket==2)?'count':''?>
                  		<tr class="<?=$count?>" tarifa="<?=$ticket->tarifa?>">
                        	<td><?=$n?></td>
                        	<td><?=$ticket->folio_impreso?></td>
                            <td><?=$ticket->nombre_plaza?></td>
                            <td><?=$ticket->carril?></td>
                            <td><?=$ticket->folio_evento?></td>
                            <td><?=$ticket->fecha?></td>
                            <td><?=$ticket->hora?></td>
                            <td align="right"><?=$ticket->tarifa?></td>
                            
                            <?php if($ticket->idusuario!=''):?>
                            
                                <td <?php $clase=($ticket->idestado_ticket==2||$ticket->idestado_ticket==3)?'no_contar':'contar'?>
                                class="celda-validar-ticket <?=$clase?> no_vacio" id="<?=$ticket->idsolicitud_ticket?>" folio="<?=$ticket->folio_impreso?>" idticket="<?=$ticket->idsolicitud_ticket?>" tarifa="<?=$ticket->tarifa?>">
                                <?php if($accion==1):?>
                                <?php endif; ?>
                                <?php $disabled = ($accion==0)?'disabled':'';?>
                                <?php if($facturados[0]->facturados==0):?>
                                    <input type="radio" value="3" name="validar<?=$ticket->idsolicitud_ticket?>" <?=$disabled?>>No
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="2" name="validar<?=$ticket->idsolicitud_ticket?>" <?=$disabled?>>Si
                                <?php else:?>
                                    <input type="radio" value="3" name="validar<?=$ticket->idsolicitud_ticket?>" <?=$disabled?>
                                    <?php echo ($ticket->idestado_ticket==3)?'checked':'';?>
                                    <?php echo ($ticket->idestado_ticket>1)?'disabled':'';?>>No
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="2" name="validar<?=$ticket->idsolicitud_ticket?>"<?=$disabled?>
                                    <?php echo ($ticket->idestado_ticket==2)?'checked':'';?>
                                    <?php echo ($ticket->idestado_ticket>1)?'disabled':'';?>>Si
                                <?php endif;?>
                                </td>
                            
                            <?php else:?>
                            
                                <td <?php $clase=($ticket->idestado_ticket==2||$ticket->idestado_ticket==3)?'no_contar':'contar'?>
                                class="celda-validar-ticket <?=$clase?> vacio" id="<?=$ticket->idsolicitud_ticket?>" folio="<?=$ticket->folio_impreso?>" idticket="<?=$ticket->idsolicitud_ticket?>" tarifa="<?=$ticket->tarifa?>">
                                <?php if($accion==1):?>
                                <?php endif; ?>
                                <?php $disabled = ($accion==0)?'disabled':'';?>
                                    <input type="radio" value="3" name="validar<?=$ticket->idsolicitud_ticket?>" disabled
                                    <?php echo ($ticket->idestado_ticket==3)?'checked':'';?>>No
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="2" name="validar<?=$ticket->idsolicitud_ticket?>" disabled
                                    <?php echo ($ticket->idestado_ticket==2)?'checked':'';?>>Si
                                </td>
                            
                            <?php endif;?>
                            
                        </tr>
                        <?php 
						if($ticket->idestado_ticket==2):
							$importe = $importe + $ticket->importe;
							$iva = $iva + $ticket->iva;
							$total = $total + $ticket->tarifa;
						endif;
						?>
                  <?php $n++; endforeach;?>
                  <?php if($accion==0):?>
                  		<tr>
                        	<td colspan="6" align="right"><b>IMPORTE</b></td>
                            <td id="total-tickets-seleccionados" align="right" colspan="2"><?=number_format($importe,2)?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                        	<td colspan="6" align="right"><b>IVA</b></td>
                            <td id="total-tickets-seleccionados" align="right" colspan="2"><?=number_format($iva,2)?></td>
                            <td>&nbsp;</td>
                        </tr>
                  <?php endif; ?>
                        <tr>
                        	<td colspan="6" align="right"><b>TOTAL</b></td>
                            <td id="total-tickets-seleccionados" align="right" colspan="2">
								<?=number_format($total,2)?>
                                <input type="hidden" name="total" id="total" value="<?=number_format($total,2)?>">
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                  	</tbody>
                  </table>
                  <span id="tickets-mensaje"></span>
				  <?php endif; ?>
                  <?php if($accion==1):?>  
					<?php if($facturados[0]->facturados==0):?>
        				<a class="btn btn-success validar-tickets pull-right">Validar tickets</a>
                    	<a idsolicitud="<?=$solicitud->idsolicitud?>" class="btn btn-primary notificar-tickets pull-right" style="display:none;">Notificar</a>
                    	<a idsolicitud="<?=$solicitud->idsolicitud?>" class="btn btn-danger eliminar-tickets pull-right" style="display:none; margin-right:5px;">Revertir validaci&oacute;n</a>
        			<?php else:?>
                    	<?php if($no_validados[0]->no_validados==0):?>
                    		<a class="btn btn-success validar-tickets pull-right" style="display:none;">Validar tickets</a>
        					<a idsolicitud="<?=$solicitud->idsolicitud?>" class="btn btn-primary notificar-tickets pull-right">Notificar</a>
                    	<?php else:?>
                        	<a class="btn btn-success validar-tickets pull-right">Validar tickets</a>
                        	<a idsolicitud="<?=$solicitud->idsolicitud?>" class="btn btn-primary notificar-tickets pull-right" style="display:none;">Notificar</a>
                    	<?php endif; ?>
                    	<a idsolicitud="<?=$solicitud->idsolicitud?>" class="btn btn-danger eliminar-tickets pull-right" style="margin-right:5px;">Revertir validaci&oacute;n</a>
        			<?php endif;?>
                    <a class="btn btn-warning pull-right" href="<?=base_url('baw/facturacion/registrados')?>" style="margin-right:5px;">Cancelar</a>
                    
                    <?php else:?>
                    <input type="submit" value="Responder Solicitud" class="btn btn-success pull-right">
                    <a class="btn btn-warning pull-right" href="<?=base_url('baw/facturacion/atendiendose')?>" style="margin-right:5px;">Cancelar</a>
                    <?php endif;?>
                </div>
            </div>
        <!--<div class="row">
        	<div class="col-md-8"><h5><strong>SOLICITUDES DE INFORMACI&Oacute;N</strong></h5></div>
        	<div class="col-md-4">
            <?php if($fol[0]=='ATA'):?>
        		<?php if($facturados[0]->facturados==0):?>
            	<a id="info" style="float:right" href="<?=base_url('baw/facturacion/solicitar_datos')?>/<?=$solicitud->idsolicitud?>/<?=$accion?>" class="btn btn-warning loading-state disabled">Solicitar Info</a>
            	<?php else:?>
                <a id="info" style="float:right" href="<?=base_url('baw/facturacion/solicitar_datos')?>/<?=$solicitud->idsolicitud?>/<?=$accion?>" class="btn btn-warning loading-state">Solicitar Info</a>
                <?php endif;?>
            <?php else:?>
            	<a id="info" style="float:right" href="<?=base_url('baw/facturacion/solicitar_datos')?>/<?=$solicitud->idsolicitud?>/<?=$accion?>" class="btn btn-warning loading-state">Solicitar Info</a>
            <?php endif;?>
            </div>
        </div>
        <div id="cargando_info"></div>-->
        <!--<br>
            <div class="form-group" id="preguntas">      
            	<?php if(sizeof($preguntas)==0):?>
                	<div class="col-sm-12"><label class="control-label">No se ha hecho solicitud de informaci&oacute;m</label></div>
                <?php endif;?>      	
            	<?php foreach($preguntas as $pregunta):?>
                	<div class="col-sm-12"><label class="control-label">Tema: </label> <?=$pregunta->tema?> <?=$pregunta->fecha_solicitud?> | <?=$pregunta->hora_s?>
                    <?=$pregunta->boton?>
                    </div>
                    <div class="col-sm-12"><label class="control-label">Solicitud: </label> <?=$pregunta->comentario?></div>
                    <div class="col-sm-12"><label class="control-label">Respuesta: </label></div>
                    <div class="col-sm-12"><?=$pregunta->link?></div>
                    <?php $respuestas=$this->administrar_model->desplega_respuesta($pregunta->idsolicitud_datos);?>
                    <hr>
                    <?php foreach($respuestas as $respuesta):?> 
                        <div class="modal fade" id="myModal<?=$respuesta["idsolicitud_datos"]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">TEMA <?=$respuesta["tema"]?></h4>
                              </div>
                              <div class="modal-body">
                                <?php foreach($respuestas as $respuesta2):?> 
									<?=$respuesta2["titulo"]?> 
                                    <br>
									<?=$respuesta2["respuesta"]?>
                                    <hr>
                                <?php endforeach;?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php endforeach;?>   
                <?php endforeach?>                      
          	</div>-->
        </div>
    </div>
</div>
<input type="hidden"  name="accion" value="<?=$accion?>"/>
<input type="hidden" id="idsolicitud" name="idsolicitud" value="<?=$solicitud->idsolicitud?>"/>
<br>
<div class="row" align="">
	<!--<div class="col-md-6">
        <?php if($fol[0]=='ATA'):?>
        	<?php if($facturados[0]->facturados==0):?>	
        		<input id="btn-responder-solicitud" type="submit" value="Responder Solicitud" class="btn btn-success disabled pull-right">
            <?php else:?>
            	<input id="btn-responder-solicitud" type="submit" value="Responder Solicitud" class="btn btn-success pull-right">
        	<?php endif;?>
        <?php else:?>
        <input type="submit" value="Responder Solicitud" class="btn btn-success pull-right">
        <?php endif; ?>
        <?php if($fol[0]=='ATA'):?>
        	<?php if($facturados[0]->facturados==0):?>
        		<a class="btn btn-primary btn-acc-tickets pull-right" data-toggle="modal" data-target="#tickets" style="margin-right:10px;">Validar tickets</a>
        	<?php else:?>
        		<a class="btn btn-primary btn-acc-tickets pull-right" data-toggle="modal" data-target="#tickets" style="margin-right:10px;">Ver tickets</a>
        	<?php endif;?>
        <?php endif;?>
    </div>-->
    <div class="col-md-6"></div>
</div>
<div class="row">
	<div class="col-md-10"></div>
    <div class="col-md-2"><?=$siguiente?><?=$anterior?></div>
</div>
<?php endforeach;?>
<?=form_close();?>
<?php if($fol[0]=='ATA'):?>
<div class="modal fade" id="tickets" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              	<form id="form_tickets">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tickets registrados</h4>
                  </div>
                  <div class="modal-body">
                  <?php if(sizeof($tickets)==0): ?>
                  	No existen tickets registrados para esta solicitud
				  <?php else: ?>
                  <table class="table table-bordered table-striped">
                  	<thead>
                    	<tr>
                        	<th>#</th>
                            <th>Folio</th>
                            <th>Plaza de cobro</th>
                            <th>Carril</th>
                            <th>Folio de evento</th>
                            <th>Hora</th>
                            <th>Tarifa</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                  <?php $total=0; $n=1; foreach ($tickets as $ticket): ?>
                  		<tr>
                        	<td><?=$n?></td>
                        	<td><?=$ticket->folio_impreso?></td>
                            <td><?=$ticket->plaza_cobro?></td>
                            <td><?=$ticket->carril?></td>
                            <td><?=$ticket->folio_evento?></td>
                            <td><?=$ticket->hora?></td>
                            <td align="right"><?=$ticket->tarifa?></td>
                            <td><i tarifa="<?=$ticket->tarifa?>" id="<?=$ticket->idsolicitud_ticket?>" folio="<?=$ticket->folio_impreso?>" idticket="<?=$ticket->idsolicitud_ticket?>" class="seleccionar"></i></td>
                        </tr>
                  <?php $n++; endforeach;?>
                  		<tr>
                        	<td colspan="6" align="right"><b>TOTAL</b></td>
                            <td id="total-tickets-seleccionados" align="right"><?=number_format($total,2)?></td>
                            <td>&nbsp;</td>
                        </tr>
                  	</tbody>
                  </table>
				  <?php endif; ?>
                  <span id="tickets-mensaje"></span>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <?php if($facturados[0]->facturados==0):?>
        			<a class="btn btn-success validar-tickets">Validar tickets</a>
                    <a idsolicitud="<?=$solicitud->idsolicitud?>" class="btn btn-danger eliminar-tickets" style="display:none;">Revertir validaci&oacute;n</a>
        			<?php else:?>
                    <a class="btn btn-success validar-tickets" style="display:none;">Validar tickets</a>
        			<a idsolicitud="<?=$solicitud->idsolicitud?>" class="btn btn-danger eliminar-tickets">Revertir validaci&oacute;n</a>
        			<?php endif;?>
                  </div>
                </div>
                </form>
              </div>
            </div>
<?php endif;?>