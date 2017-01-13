<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1399334087_time.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/administrar/index')?>">ADMINISTRAR / </a>
    <?php if($titulo=="SOLICITUDES REGISTRADAS"):?>
    <a class="bom-menu" href="<?=base_url('baw/administrar/registrados')?>"><?=$titulo?> / ATENDER SOLICITUD</a></b></h5>
    <?php else:?>
    <a class="bom-menu" href="<?=base_url('baw/administrar/atendiendose')?>"><?=$titulo?> / ATENDER SOLICITUD</a></b></h5>
    <?php endif;?>
</div>
<?=form_open('baw/administrar/responder_solicitud',array('class'=>'form-horizontal','role'=>'form'));?>

<div class="row">
	<div class="col-md-6">
    	<div class="square letra10">
        	<div class="row">
            	<div class="col-md-6">
                	<h5><strong>DATOS DE LA SOLICITUD</strong></h5>
                </div>
                <div class="col-md-6">
                	<button style="float:right" type="button" class="btn btn-info editar" id="editar">Editar</button>  
                </div>
            </div> 
            <br>
    	<?php foreach ($solicitudes as $solicitud):?>
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
            <label for="descripcion" class="col-sm-3 control-label">Descripci&oacute;n:</label>
            <div class="col-sm-9">
              <textarea class="form-control letra10" rows="10" readonly><?=$solicitud->mensaje_solicitud?></textarea>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6">
    	<div class="square letra10">
        <div class="row">
        	<div class="col-md-8"><h5><strong>SOLICITUDES DE INFORMACI&Oacute;N</strong></h5></div>
        	<div class="col-md-4"><a id="info" style="float:right" href="<?=base_url('baw/administrar/solicitar_datos')?>/<?=$solicitud->idsolicitud?>/<?=$accion?>" class="btn btn-warning loading-state">Solicitar Info</a></div>
        </div>
        <div id="cargando_info"></div>
        <br>
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
                        <!-- Modal -->
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
          	</div>
        </div>
    </div>
</div>
<input type="hidden"  name="accion" value="<?=$accion?>"/>
<input type="hidden" id="idsolicitud" name="idsolicitud" value="<?=$solicitud->idsolicitud?>"/>
<br>
<div class="row" align="center">
	<div class="col-md-12">    	
        <input type="submit" value="Responder Solicitud" class="btn btn-success">
    </div>
</div>
<?php endforeach;?>
<div class="row">
	<div class="col-md-10"></div>
    <div class="col-md-2"><?=$siguiente?><?=$anterior?></div>
</div>
<?=form_close();?>