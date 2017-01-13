<?php if($valor>0):?>
<div class="col-md-8">
    	<div class="square">
        <h5><strong>CONFIGURACI&Oacute;N DE RESPUESTA AUTOM&Aacute;TICA</strong></h5>
        	<!--<div style="height:20px;"></div>-->
            <br>
            <?php foreach($resultados as $resultado):?>
            <div class="form-group">
            	<label for="asunto" class="col-sm-2 control-label">Asunto:</label>
            	<div class="col-sm-10">
                    <input value="<?=$resultado['respuesta_automatica_asunto']?>" type="text" id="asunto" name="asunto" placeholder="Escriba el Asunto" class="form-control required">
            	</div>
          	</div>
            <div class="form-group">
            	<label for="registro-tipo" class="col-sm-2 control-label">Cuerpo:</label>
            	<div class="col-sm-10">                	
	            	<div id="summernote" class="required"><?=$resultado["respuesta_automatica_cuerpo"]?></div>                 				   
            	</div>
          	</div>   
            <input type="hidden" id="accion" value="<?=$resultado["idrespuesta_automatica"]?>"/>
            <?php endforeach; ?>
            <div id="resultado"></div>
            <span id="errores"></span>
        </div>
    </div>
<?php else:?>
<div class="col-md-8">
    	<div class="square">
        <h5><strong>CONFIGURACI&Oacute;N DE RESPUESTA AUTOM&Aacute;TICA</strong></h5>
        	<!--<div style="height:20px;"></div>-->
            <br>
            <div class="form-group">
            	<label for="asunto" class="col-sm-2 control-label">Asunto:</label>
            	<div class="col-sm-10">
                    <input type="text" id="asunto" name="asunto" placeholder="Escriba el Asunto" class="form-control required" >
            	</div>
          	</div>
            <div class="form-group">
            	<label for="registro-tipo" class="col-sm-2 control-label">Cuerpo:</label>
            	<div class="col-sm-10">
                   <div id="summernote" class="required">Escribe el texto</div>                 
            	</div>
          	</div>    
            <input type="hidden" id="accion" value="0"/>        
            <div id="resultado"></div>
            <span id="errores"></span>
        </div>        
    </div>
<?php endif; ?>
<script>
$(document).ready(function(e) {
    //editor
	$('#summernote').summernote({
	  height: 150,
	  toolbar: [
	  	['style', ['style']],
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['height', ['height']],
		['table', ['table']],		
		['link', ['link']],
		['help', ['help']]
	  ]
	});
});
</script>