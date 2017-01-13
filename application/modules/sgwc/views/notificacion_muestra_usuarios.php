<div class="col-md-5">
   	USUARIO DISPONIBLES
   	<div id='usuarios-origen'>
       	<select id="origen" name="origen" multiple size="15" class="form-control">
		  <?php foreach ($datasource as $o_usuario): ?>
          	<option value="<?=$o_usuario['idusuario']?>" correo="<?=$o_usuario['correo']?>"><?=$o_usuario['nombre']?></option>
          <?php endforeach ?>  
        </select>
    </div>
</div>
<div class="col-md-2" style="line-height:300px; padding-left:50px">    	
	<i class="fa fa-exchange fa-4x"></i>
</div>
    
<div class="col-md-5">
	USUARIOS AGREGADOS
    <div id='usuarios-destino'>
     	<select id="destino" name="destino" multiple size="15" class="form-control">
	  		<?php foreach ($d_usuarios as $d_usuario): ?>
            	<option value="<?=$d_usuario["idusuario"]?>" correo="<?=$d_usuario["correo"]?>"><?=$d_usuario["usuario"]?></option>
            <?php endforeach ?>  
        </select>
    </div>
</div>