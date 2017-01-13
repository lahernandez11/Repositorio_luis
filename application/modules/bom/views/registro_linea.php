<select name="registro-carril" id="registro-carril" class="form-control">
<?php foreach($carriles as $carril):?>
	<option value="<?=$carril->idcarril?>"><?=$carril->nombre_carril?></option>
<?php endforeach;?>
</select>