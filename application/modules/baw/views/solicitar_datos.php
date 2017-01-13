<script>
var postForm = function() {
	var content = $('textarea[name="comentario"]').html($('#summernote').code());
} 
</script>
<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1399334070_user.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/administrar/index')?>">ADMINISTRAR / </a>
    <?php if($accion==1):?>
    	<a class="bom-menu" href="<?=base_url('baw/administrar/registrados')?>">SOLICITUDES REGISTRADAS</a>
	<?php else:?>
    	<a class="bom-menu" href="<?=base_url('baw/administrar/atendiendose')?>">SOLICITUDES ATENDIENDOSE</a>
    <?php endif;?>
    </b></h5>
</div>
<?=form_open_multipart('baw/administrar/enviar_datos',array('class'=>'form-horizontal','role'=>'form','id'=>'solicitar_info'));?>
<div class="row">
	<div class="col-md-6">
    	<div class="square letra10">
        	 <h5><strong>SOLICITUD DE INFORMACI&Oacute;N</strong></h5>
             <br>
             <div class="form-group">
            <label for="ticket" class="col-sm-3 control-label">Folio: </label>
            <div class="col-sm-9">
              <label class="text-danger"><h5><?=$solicitudes[0]["folio"]?></h5></label>
            </div>
          </div>
          <div class="form-group">
            <label for="solicitante" class="col-sm-3 control-label">Escrito por: </label>
            <div class="col-sm-9">
              <input type="text" class="form-control letra10" value="<?=$solicitudes[0]["nombre_solicitante"]?>" readonly />
              <br>
              <input type="text" name="correo" id="correo" class="form-control letra10" value="<?=$solicitudes[0]["mail_solicitante"]?>"  disabled />
            </div>
          </div>
          <div class="form-group">
            <label for="tipo-solicitud" class="col-sm-3 control-label">Tipo:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control letra10" value="<?=$solicitudes[0]["tipo_solicitud"]?>" readonly />
            </div>
          </div>
          <div class="form-group">
            <label for="tema" class="col-sm-3 control-label">Tema:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control letra10" value="<?=$solicitudes[0]["tema_solicitud"]?>" readonly />
            </div>
          </div>
          <div class="form-group">
            <label for="descripcion" class="col-sm-3 control-label">Descripci&oacute;n:</label>
            <div class="col-sm-9">
              <textarea class="form-control letra10" rows="10" readonly><?=$solicitudes[0]["mensaje_solicitud"]?></textarea>
            </div>
          </div>
        </div>
    </div>  
    <div class="col-md-6" id="solicitar">
    	<div class="square letra10"> 
        	<div class="" id="respuesta_mensaje"></div>        	
            <div class="form-group">
                <label for="usuario_pregunta" class="col-sm-2 control-label">Solicitar:</label>
                <div class="col-sm-10">
                  <select class="form-control required letra10" name="usuario_pregunta" id="usuario_pregunta">
                  	<option value="0">-- SELECIONE --</option>
                    <?php foreach ($datasource as $key=>$usuario):?>
						<option value="<?=$key+1?>" nombre="<?=$usuario["nombre"]?>" correo="<?=$usuario["correo"]?>"><?=$usuario["nombre"]?></option>
				  	<?php endforeach;?>                                        
                  </select>                  
                </div>
          	</div>
            <div class="form-group" id="usuario">
                <input type="hidden" name="conteo" id="conteo" value="0" />
          	</div>
            <div class="form-group">
            	<div class="col-sm-12"></div>
            </div>
			<div class="form-group">
                <label for="tema" class="col-sm-2 control-label">Tema:</label>
                <div class="col-sm-10">                
                	<input type="text"  class="form-control required" name="tema" id="tema" />
                </div>
          	</div>
            <!--<div class="form-group">
                <label for="tema" class="col-sm-2 control-label">Comentario:</label>
                <div class="col-sm-10">                
                	<div id="summernote" class="required">Escribe el texto</div> 
                </div>
          	</div>-->
            <div class="form-group">
                <label for="respuesta" class="col-sm-2 control-label">Comentario: </label>
            </div>
            <div class="form-group">
                <div class="col-sm-11 pull-right">
                	<textarea name="comentario" id="summernote"></textarea>
                    <!--<div class="required">Escribe el texto</div>-->               
                </div>
            </div>
            
            <div class="form-group">
              	<label for="respuesta" class="col-sm-2 control-label">Archivos: </label>
                <div class="col-sm-11">
                  <input type="file" name="userfile[]" id="userfile[]" class="fileUpload" multiple>              
                </div>
            </div>
            
            <span id="errores" class="text-danger"></span>
            <div id="respuesta_solicitud"></div>
            <br>
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="<?=base_url('baw/administrar/solicitudes_atendidas')?>/<?=$solicitudes[0]["idcon_solicitud"]?>/0" class="btn btn-warning cancelar-state">Cancelar</a>
                    <button type="submit" id="btn_enviar" class="btn btn-success loading-state">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="solicitud" id="solicitud" value="<?=$solicitudes[0]["idsolicitud"]?>" />
<input type="hidden" name="usuario_enviar" id="usuario_enviar" />
<input type="hidden" name="correo_enviar" id="correo_enviar" />
<input type="hidden" name="id" id="id" value="<?=$id?>" />
<br>

<?=form_close();?>