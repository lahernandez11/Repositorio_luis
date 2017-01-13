<div>
	<legend>Usuarios Suscritos</legend><br>
<select id="destino" name="origen" multiple size="20">
  <?php foreach ($utodos as $tcorreos): ?>
    <option value="<?=$tcorreos['idnotificacion']?>" idu="<?=$tcorreos['idusuario']?>"><?=$tcorreos['nombre']?></option>
  <?php endforeach ?>  
</select>
<br/><br/>
</div>