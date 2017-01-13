<div class="page-header">
	<h4>Editor</h4>
</div>
   	<div class="row">
		Texto
        <?php foreach ($resultados as $resultado):?>
        	<div><?=$resultado["respuesta_automatica_cuerpo"]?></div>
        <?php endforeach;?>
	</div>