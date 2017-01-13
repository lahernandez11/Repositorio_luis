<select name="registro-clasificacion" id="registro-clasificacion" class="form-control required" style="background-color:<?=$fondo?>; color:#FFF">
	<?php foreach($s_clasificaciones as $s_clasificacion):?>
    	<?php if($clasificaciones[0]['idclasificacion']==$s_clasificacion['idclasificacion']):?>
         	<option style="background-color:<?=$s_clasificacion['fondo']?>; color:#FFF" value="<?=$s_clasificacion['idclasificacion']?>" selected>
				<span class="label label-default"><?=$s_clasificacion['nombre_clasificacion']?></span>
            </option>
        <?php else:?>
                <option style="background-color:<?=$s_clasificacion['fondo']?>; color:#FFF" value="<?=$s_clasificacion['idclasificacion']?>">
					<span class="label label-default"><?=$s_clasificacion['nombre_clasificacion']?></span>
                </option>
        <?php endif;?>
	<?php endforeach;?>
</select>