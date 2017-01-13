<div class="row">
	<div class="col-md-12">
		<a class="btn btn-success btn-sm pull-right agregar_nuevo"><i class="fa fa-plus"></i></a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
    Equipo que se reemplaza:
    <table class="table table-striped table-bordered table-condensed" style="font-size:10px;">
        <tr>
        	<th>Equipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <!--<th>Capacidad</th>
            <th>Serie</th>-->
            <th>Motivo</th>
            <th>Ubicaci&oacute;n</th>
            <th></th>
        </tr>
        <tr class="contenedor_viejo_diagnostico" n="1" id="contenedor_viejo_diagnostico1">
        	<td>
                <select n="1" name="v_equipo1" class="form-control input-sm required v_combo-equipo">
                    <option value="0">-SELECCIONE-</option>
                <?php foreach ($equipos as $equipo):?>
                    <option value="<?=$equipo["idactivo"]?>">
                        <?=$equipo["nombre_equipo"]?>(<?=$equipo["serie"]?>)
                    </option>
                <?php endforeach;?>
                </select>
        	</td>
            <td><input type="text" name="v_marca1" class="form-control input-sm required"></td>
            <td><input type="text" name="v_modelo1" class="form-control input-sm required"></td>
            <!--<td><input type="text" name="v_capacidad1" class="form-control input-sm"></td>
            <td><input type="text" name="v_serie1" class="form-control input-sm required"></td>-->
            <td><textarea name="v_motivo1" class="form-control required" style="height:30px;"></textarea></td>
            <td><input type="text" name="v_ubicacion1" class="form-control input-sm required"></td>
            <td><a class="btn btn-danger btn-sm eliminar_reemplazar" n="1"><i class="fa fa-minus"></i></a></td>
        </tr>
    </table>
	</div>    
</div><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
</body>
</html>