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
            <th>Marca</th>
            <th>Modelo</th>
            <th>Capacidad</th>
            <th>Serie</th>
            <th>Motivo</th>
            <th>Ubicaci&oacute;n</th>
        </tr>
        <tr class="contenedor_viejo" n="1" id="contenedor_viejo1">
            <td><input type="text" name="v_marca1" class="form-control input-sm required"></td>
            <td><input type="text" name="v_modelo1" class="form-control input-sm required"></td>
            <td><input type="text" name="v_capacidad1" class="form-control input-sm"></td>
            <td><input type="text" name="v_serie1" class="form-control input-sm required"></td>
            <td><textarea name="v_motivo1" class="form-control required" style="width:150px; height:30px;"></textarea></td>
            <td><input type="text" name="v_ubicacion1" class="form-control input-sm required"></td>
        </tr>
    </table>
	</div>
    <div class="col-md-6">
    Equipo Nuevo:
    <table class="table table-striped table-bordered table-condensed" style="font-size:10px;">
        <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Capacidad</th>
            <th>Serie</th>
            <th>Motivo</th>
            <th>Ubicaci&oacute;n</th>
            <th></th>
        </tr>
        <tr class="contenedor_nuevo" n="1" id="contenedor_nuevo1">
            <td><input type="text" name="n_marca1" class="form-control input-sm required"></td>
            <td><input type="text" name="n_modelo1" class="form-control input-sm required"></td>
            <td><input type="text" name="n_capacidad1" class="form-control input-sm"></td>
            <td><input type="text" name="n_serie1" class="form-control input-sm required"></td>
            <td><textarea name="n_motivo1" class="form-control required" style="width:150px; height:30px;"></textarea></td>
            <td><input type="text" name="n_ubicacion1" class="form-control input-sm required"></td>
            <td><a class="btn btn-danger btn-sm eliminar_reemplazar" n="1"><i class="fa fa-minus"></i></a></td>
        </tr>
    </table>
	</div>
</div>