
	<form class="form-inline">
    	<input type="hidden" value="<?=$_POST["cuerpo"]?>" name="cuerpo" id="cuerpo">
        
		<?php foreach ($sentidos as $sentido):?>
			<div id="contenedor_anterior<?=$sentido->idsentido?>">
            <div class="form-group">
                <input type="text" class="form-control" id="sentido" n="0" name="sentido" value="<?=$sentido->nombre_sentido?>" readonly size="50">
            </div>
            <a href="#" id="<?=$sentido->idsentido?>"  class="btn btn-danger eliminar_sentido_anterior"><i class="fa fa-minus"></i></a><a href="#" id="modificar<?=$sentido->idsentido?>" sentido="<?=$sentido->idsentido?>" class="btn btn-warning modificar_sentido_anterior"><i class="fa fa-edit"></i></a>
        </div>
		<?php endforeach;?>
    	
        <div id="contenedor1">
            <div class="form-group">
                <input type="text" class="form-control" id="sentido1" n="1" name="sentido1" placeholder="Ingrese sentido" size="50">
            </div>
            <a href="#" id="boton_agregar1"  class="btn btn-success agregar_sentido" n="1"><i class="fa fa-plus"></i></a>
        </div>
    </form>