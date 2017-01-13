<h5>Fallas del Area:<?=$area?></h5>
<form class="form-inline">
	<input type="hidden" name="idarea" id="idarea" value="<?=$idarea?>">
    
			<?php foreach ($fallas as $falla):?>
                        <div id="contenedor_falla_anterior<?=$falla->idtipofalla?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="falla" n="0" name="falla" value="<?=$falla->nombre_tipofalla?>" disabled size="50">
                            <select name="clasificacion1" id="clasificacion1" n="1" class="form-control" disabled>
                        	<?php foreach($clasificaciones as $clasificacion):?>
                    			<option style="color: <?=$clasificacion['fondo']?>" value="<?=$clasificacion['idclasificacion']?>"
                                <?php if($falla->idclasificacion==$clasificacion['idclasificacion']): echo "selected"; endif;?>>
                                	<span class="label label-default"><?=$clasificacion['nombre_clasificacion']?></span>
                                </option>
                			<?php endforeach;?>
                        </select>
                        </div>
                        <a href="#" id="modificar<?=$falla->idtipofalla?>" falla="<?=$falla->idtipofalla?>" class="btn btn-warning modificar_falla_anterior"><i class="fa fa-edit"></i></a><!--<a href="#" idtipofalla="<?=$falla->idtipofalla?>" class="btn btn-danger"><i class="fa fa-minus"></i></a>-->
                    </div>
            <?php endforeach;?>
            
            <div id="contenedor-falla1">
                <div class="form-group">
                      	<input type="text" class="form-control" id="falla1" n="1" name="falla1" placeholder="Ingrese falla" size="42">
                      	<select name="clasificacion1" id="clasificacion1" n="1" class="form-control">
                        	<option value="0">- SELECCIONE -</option>
							<?php foreach($clasificaciones as $clasificacion):?>
                    			<option style="color: <?=$clasificacion['fondo']?>" value="<?=$clasificacion['idclasificacion']?>">
                                	<span class="label label-default"><?=$clasificacion['nombre_clasificacion']?></span>
                                </option>
                			<?php endforeach;?>
                        </select>
                </div>
                <a href="#" id="boton_guardar1"  class="btn btn-success guardar_falla" n="1"><i class="fa fa-plus"></i></a>
            </div>
        </form>