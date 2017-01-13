<script src="<?=base_url('assets/js/bootstrap-datetimepicker.min.js')?>"></script>
<script>
    $('.datetimepicker1').datetimepicker({
      pickTime: false
    });
</script>
<br>
Indique el equipo a reparar:
<a class="btn btn-success btn-sm pull-right agregar_equipo"><i class="fa fa-plus"></i></a>
<table class="table table-striped table-bordered table-condensed" style="font-size:10px;">
	<tr>
    	<th>Equipo</th>
    	<th>Marca</th>
        <th>Modelo</th>
        <!--<th>Capacidad</th>
        <th>Serie</th>-->
        <th>Motivo</th>
        <th>Destino</th>
        <th style="width:150px;">Fecha de Regreso</th>
        <th>&nbsp;</th>
    </tr>
    <?php 
		if(sizeof($reparos)>0):
	?>
    <?php foreach($reparos as $key=>$reparo):?>
    <tr class="contenedor_equipo" n="<?=$key+1?>" id="contenedor_equipo<?=$key+1?>">
    	<td>
        <!--<input type="text" name="equipo<?=$key+1?>" class="form-control input-sm" value="<?=$reparo["nombre_equipo"]?>" readonly>-->
        <select n="<?=$key+1?>" name="equipo<?=$key+1?>" class="form-control input-sm combo-equipo" disabled>
                    <option value="0">-SELECCIONE-</option>
                <?php foreach ($equipos as $equipo):?>
                    <option value="<?=$equipo["idactivo"]?>"
                    <?php 
					echo ($equipo["idactivo"]==$reparo["idequipo"])?'selected':'';
					?>
                    
                    >
                        <?=$equipo["nombre_equipo"]?>(<?=$equipo["serie"]?>)
                    </option>
                <?php endforeach;?>
                </select>
        
        </td>
    	<td><input type="text" name="marca<?=$key+1?>" class="form-control input-sm required" value="<?=$reparo["marca"]?>" readonly></td>
        <td><input type="text" name="modelo<?=$key+1?>" class="form-control input-sm required" value="<?=$reparo["modelo"]?>" readonly></td>
        <!--<td><input type="text" name="capacidad<?=$key+1?>" class="form-control input-sm" value="<?=$reparo["capacidad"]?>" readonly></td>
        <td><input type="text" name="serie<?=$key+1?>" class="form-control input-sm" value="<?=$reparo["serie"]?>" readonly></td>-->
        <td><textarea name="motivo<?=$key+1?>" class="form-control required" style="height:30px;" readonly><?=$reparo["motivo"]?></textarea></td>
        <td><input type="text" name="destino<?=$key+1?>" class="form-control input-sm required" value="<?=$reparo["destino"]?>" readonly></td>
        <td>
        	<div class="input-append input-group datetimepicker">
                        <input data-format="yyyy-MM-dd" value="<?=$reparo["fecha_regreso"]?>" type="text" class="form-control" readonly name="fecha<?=$key+1?>">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
        </td>
        <td width="42px;">
        	<a class="btn btn-danger btn-sm eliminar_reparar" n="<?=$key+1?>"><i class="fa fa-minus"></i></a> 			 			<input type="hidden" name="idreparo<?=$key+1?>" value="<?=$reparo["idreparar_equipo"]?>"/>
        </td>
        
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <script>
    $('.datetimepicker').datetimepicker({
      pickTime: false
    });
	</script>
    <tr class="contenedor_equipo" n="1" id="contenedor_equipo1">
    	<td>
        <select n="1" name="equipo1" class="form-control input-sm combo-equipo">
                    <option value="0">-SELECCIONE-</option>
                <?php foreach ($equipos as $equipo):?>
                    <option value="<?=$equipo["idactivo"]?>"
                    <?php 
					echo ($equipo["idactivo"]==$reparo["idequipo"])?'selected':'';
					?>
                    
                    >
                        <?=$equipo["nombre_equipo"]?>(<?=$equipo["serie"]?>)
                    </option>
                <?php endforeach;?>
                </select>
        
        </td>
    	<td><input type="text" name="marca1" class="form-control input-sm required"></td>
        <td><input type="text" name="modelo1" class="form-control input-sm required"></td>
        <td><textarea name="motivo1" class="form-control required" style="height:30px;"></textarea></td>
        <td><input type="text" name="destino1" class="form-control input-sm required"></td>
        <td>
        	<div class="input-append input-group datetimepicker">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control" readonly name="fecha1">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
        </td>
        <td width="42px;">
        	<a class="btn btn-danger btn-sm eliminar_reparar" n="1"><i class="fa fa-minus"></i></a> 			 			<input type="hidden" name="idreparo1" value=""/>
        </td>
        
    </tr>
    <?php endif;?>
</table>
<input type="hidden" value="<?=sizeof($reparos)?>" name="n_reparar" id="n_reparar">