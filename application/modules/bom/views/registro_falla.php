<select name="registro-falla" id="registro-falla" class="form-control">
	<option value="0">- SELECCIONE -</option>
<?php foreach($fallas as $falla):?>
	<option value="<?=$falla->idtipofalla?>"><?=$falla->nombre_tipofalla?></option>
<?php endforeach;?>
</select>