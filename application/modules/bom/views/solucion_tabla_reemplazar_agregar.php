<div class="row">
	<div class="col-md-12">
		<a class="btn btn-success btn-sm pull-right agregar_nuevo"><i class="fa fa-plus"></i></a>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
    Equipo que se reemplaza:
    <table class="table table-striped table-bordered table-condensed" style="font-size:10px;">
        <tr>
        	<th>Equipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Motivo</th>
            <th>Ubicaci&oacute;n</th>
        </tr>
        <?php if(sizeof($reemplazos)>0):?>
        
        <?php foreach($reemplazos as $key=>$reemplazo):?>
        <tr class="contenedor_viejo" n="<?=$key+1?>" id="contenedor_viejo<?=$key+1?>">
            <td>
        <select n="<?=$key+1?>" name="v_equipo<?=$key+1?>" class="form-control input-sm v-combo-equipo" disabled>
                    <option value="0">-SELECCIONE-</option>
                <?php foreach ($equipos as $equipo):?>
                    <option value="<?=$equipo["idactivo"]?>"
                    <?php 
					echo ($equipo["idactivo"]==$reemplazo["r_idequipo"])?'selected':'';
					?>
                    
                    >
                        <?=$equipo["nombre_equipo"]?>(<?=$equipo["serie"]?>)
                    </option>
                <?php endforeach;?>
                </select>
            </td>
            <td><input type="text" name="v_marca<?=$key+1?>" class="form-control input-sm" value="<?=$reemplazo["r_marca"]?>" readonly ></td>
            <td><input type="text" name="v_modelo<?=$key+1?>" class="form-control input-sm" value="<?=$reemplazo["r_modelo"]?>" readonly ></td>
            <td><textarea name="v_motivo<?=$key+1?>" class="form-control" style="width:140px;height:30px;" readonly ><?=$reemplazo["r_motivo"]?></textarea></td>
            <td><input type="text" name="v_ubicacion<?=$key+1?>" class="form-control input-sm" value="<?=$reemplazo["r_ubicacion"]?>" readonly ></td>
        </tr>
        <?php endforeach;?>
        
        <?php else:?>
        <tr class="contenedor_viejo" n="1" id="contenedor_viejo1">
            <td>
        <select n="1" name="v_equipo1" class="form-control input-sm v-combo-equipo required">
                    <option value="0">-SELECCIONE-</option>
                <?php foreach ($equipos as $equipo):?>
                    <option value="<?=$equipo["idactivo"]?>"
                    <?php 
					echo ($equipo["idactivo"]==$reemplazo["r_idequipo"])?'selected':'';
					?>
                    
                    >
                        <?=$equipo["nombre_equipo"]?>(<?=$equipo["serie"]?>)
                    </option>
                <?php endforeach;?>
                </select>
            </td>
            <td><input type="text" name="v_marca1" class="form-control input-sm required"></td>
            <td><input type="text" name="v_modelo1" class="form-control input-sm required"></td>
            <td><textarea name="v_motivo1" class="form-control required" style="width:140px;height:30px;"></textarea></td>
            <td><input type="text" name="v_ubicacion1" class="form-control input-sm required" ></td>
        </tr>
        
        <?php endif;?>
    </table>
	</div>
    <div class="col-md-6">
    Equipo Nuevo:
    <table class="table table-striped table-bordered table-condensed" style="font-size:10px;">
        <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Serie</th>
            <th>Motivo</th>
            <th></th>
        </tr>
        
        <?php if(sizeof($reemplazos)>0):?>
        <?php foreach($reemplazos as $key=>$reemplazo):?>
        <tr class="contenedor_nuevo" n="<?=$key+1?>" id="contenedor_nuevo<?=$key+1?>">
            <td><input type="text" name="n_marca<?=$key+1?>" class="form-control input-sm required"></td>
            <td><input type="text" name="n_modelo<?=$key+1?>" class="form-control input-sm required"></td>
            <td><input type="text" name="n_serie<?=$key+1?>" class="form-control input-sm required"></td>
            <td><textarea name="n_motivo<?=$key+1?>" class="form-control required" style="width:140px; height:30px;"></textarea></td>
            <td width="42px;"><a class="btn btn-danger btn-sm eliminar_reemplazar" n="<?=$key+1?>"><i class="fa fa-minus"></i></a><input type="hidden" name="idreemplazo<?=$key+1?>" value="<?=$reemplazo["idreemplazo_equipo"]?>"/>
            <input type="hidden" name="hidden-v_equipo<?=$key+1?>" value="<?=$reemplazo["r_idequipo"]?>"></td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr class="contenedor_nuevo" n="1" id="contenedor_nuevo1">
            <td><input type="text" name="n_marca1" class="form-control input-sm required"></td>
            <td><input type="text" name="n_modelo1" class="form-control input-sm required"></td>
            <td><input type="text" name="n_serie1" class="form-control input-sm required"></td>
            <td><textarea name="n_motivo1" class="form-control required" style="width:140px; height:30px;"></textarea></td>
            <td width="42px;"><a class="btn btn-danger btn-sm eliminar_reemplazar" n="1"><i class="fa fa-minus"></i></a><input type="hidden" name="idreemplazo1"/>
            <input type="hidden" name="hidden-v_equipo1" value=""></td>
        </tr>
        <?php endif;?>
        
        
        
        
    </table>
	</div>
</div>
<input type="hidden" value="<?=sizeof($reemplazos)?>" name="n_reemplazar" id="n_reemplazar"><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
</body>
</html>