<?php foreach($descripciones as $descripcion):?>
<div class="row">
  <div class="col-md-10">
  	<textarea id="des_<?=$descripcion->iddescripcion?>" readonly class="form-control"><?=utf8_encode($descripcion->descripcion)?></textarea>
    <br>
  </div>
  <div class="col-md-2">
    <button id="btn_<?=$descripcion->iddescripcion?>" estado="1" value="<?=$descripcion->iddescripcion?>" type="button" class="btn btn-warning btn-sm btn-modifica"><i class="estado fa fa-pencil-square-o"></i></button>    
  </div>  
</div>
<?php endforeach;?>