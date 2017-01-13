
	<form class="form-inline">
    	<input type="hidden" value="<?=$_POST["plaza"]?>" name="plaza" id="plaza">
        
		<?php foreach ($lineas as $linea):?>
			<div id="contenedor_anterior<?=$linea->idcarril?>">
            <div class="form-group">
                <input type="text" class="form-control" id="linea" n="0" name="linea" value="<?=$linea->nombre_carril?>" readonly size="50">
            </div>
            <a href="#" id="<?=$linea->idcarril?>"  class="btn btn-danger eliminar_linea_anterior"><i class="fa fa-minus"></i></a><a href="#" id="modificar<?=$linea->idcarril?>" linea="<?=$linea->idcarril?>" class="btn btn-warning modificar_linea_anterior"><i class="fa fa-edit"></i></a>
        </div>
		<?php endforeach;?>
    	
        <div id="contenedor1">
            <div class="form-group">
                <input type="text" class="form-control" id="linea1" n="1" name="linea1" placeholder="Ingrese linea" size="50">
            </div>
            <a href="#" id="boton_agregar1"  class="btn btn-success agregar_linea" n="1"><i class="fa fa-plus"></i></a>
        </div>
    </form>