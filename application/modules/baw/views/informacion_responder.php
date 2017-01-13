<script>
var postForm = function() {
	var content = $('textarea[name="respuesta"]').html($('#summernote').code());
} 
</script>
<div class="page-header">
<div class="btn-group pull-right" style="margin-left:5px;">
        <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
        <ul class="dropdown-menu ayuda">
            <li><a href="<?=base_url('downloads/baw/v20140512_opi-responer-solicitud-info.pdf')?>" download><i class="fa fa-file"></i> Responder Solicitud Info</a></li>
        </ul>
    </div>
	<h5><b><a class="bom-menu" href="<?=base_url('baw/informacion/index')?>">
    <img src="<?=base_url('assets/img/1383255394_edit_property.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/informacion/index')?>"> SOLICITUD DE INFORMACI&Oacute;N / RESPONDER SOLICITUD</a></b></h5>
</div>
<?=form_open_multipart('baw/informacion/responder_comentario',array('class'=>'form-horizontal','role'=>'form'));?>
<div class="row">
	<div class="col-md-6">
    	<div class="square letra10">
        <h5><strong>RESPONDER</strong></h5>
             <br>
        <div id="mensaje_cargando"></div>
        <div class="form-group">
            	<label for="ticket" class="col-sm-3 control-label">Folio: </label>
            	<div class="col-sm-9">
              		<label class="text-danger"><h5><?=$resultados[0]["folio"]?></h5></label>
            	</div>
          	</div>
            <div class="form-group">
            	<label for="pregunta" class="col-sm-3 control-label">Comentario: </label>
            	<div class="col-sm-9">
					<div><?=$resultados[0]["comentario"]?></div><br>
            	</div>
          	</div>            
            <!--<div class="form-group">
            	<label for="pregunta" class="col-sm-3 control-label">Respuesta: </label>
            	<div class="col-sm-9">
              		<div id="summernote" class="required">Escribe el texto</div> 
            	</div>
          	</div>-->
            <div class="form-group">
                <label for="respuesta" class="col-sm-3 control-label">Respuesta: </label>
            </div>
            <div class="form-group">
                <div class="col-sm-11 pull-right">
                	<textarea name="respuesta" id="summernote"></textarea>
                    <!--<div class="required">Escribe el texto</div>-->               
                </div>
              </div>
              <div class="form-group">
              	<label for="respuesta" class="col-sm-3 control-label">Archivos: </label>
                <div class="col-sm-9">
                  <input type="file" name="userfile[]" id="userfile" class="fileUpload" multiple>              
                </div>
              </div>
        	<div id="mensaje_respuesta"></div>  
            <br>
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="<?=base_url('baw/informacion/index')?>" class="btn btn-warning cancelar-state">Cancelar</a>
                    <button type="submit" class="btn btn-success loading-state">Enviar</button>
                </div>
            </div>          
        </div>
    </div>
    <div class="col-md-6">
    	<div class="square letra10">
        	<h5><strong>RESPUESTAS</strong></h5>
            <div class="form-group">
            	<?php if(sizeof($preguntas)==0):?>
                	<div class="col-sm-12"><label class="control-label">No se ha hecho solicitud de informaci&oacute;m</label></div>
                <?php endif;?>  
                <div class="col-sm-12"><label class="control-label">Tema: </label> <?=$preguntas[0]["tema"]?> <?=$preguntas[0]["fecha_solicitud"]?> | <?=$preguntas[0]["hora_s"]?>
                </div>        
                    <div class="col-sm-12"><label class="control-label">Solicitud: </label> <?=$preguntas[0]["comentario"]?></div>
                    <div class="col-sm-12"><label class="control-label">Respuesta: </label></div>                                       	
                    <div class="col-sm-12"><?=$preguntas[0]["link"]?></div> 
            	<?php foreach($preguntas as $pregunta):?>
                	<input type="hidden" name="usuario_solicita" id="usuario_solicita" value="<?=$pregunta["usuario_solicita"]?>"/>
                    <input type="hidden" name="idrespuesta" id="idrespuesta" value="<?=$sol?>"/>                
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
									<b>CONTESTO: </b><?=$respuesta2["usuario_respuesta"]." <b> A LAS: </b>".$respuesta2["fecha_respuesta"]."|".$respuesta2["hora_respuesta"]?> 
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
                <?php endforeach;?>                                         
          	</div>
        </div>
    </div>
</div>
<input type="hidden" name="solicitud" id="solicitud" value="<?=$resultados[0]["idsolicitud_datos"]?>" />
<br/>
<?=form_close();?>