<div>
	<legend>Usuarios disponibles</legend><br>
<select id="origen" name="origen" multiple size="20">
  <?php foreach ($utodos as $tcorreos): ?>
    <option value="<?=$tcorreos['idusuario']?>" correo="<?=$tcorreos['correo']?>"><?=$tcorreos['nombre']?></option>
  <?php endforeach ?>  
</select>
</div>
<br/><br/>
