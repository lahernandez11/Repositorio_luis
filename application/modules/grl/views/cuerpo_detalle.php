<form class="form-inline">
    	<input type="hidden" value="<?=$_POST["plaza"]?>" name="plaza" id="plaza">
        
		<?php foreach ($cuerpos as $cuerpo):?>
			<div id="contenedor_anterior<?=$cuerpo->idcuerpo?>">
            <div class="form-group">
                <input type="text" class="form-control" id="cuerpo" n="0" name="cuerpo" value="<?=$cuerpo->nombre_cuerpo?>" readonly size="50">
            </div>
            <a href="#" id="<?=$cuerpo->idcuerpo?>"  class="btn btn-danger eliminar_cuerpo_anterior"><i class="fa fa-minus"></i></a><a href="#" id="modificar<?=$cuerpo->idcuerpo?>" cuerpo="<?=$cuerpo->idcuerpo?>" class="btn btn-warning modificar_cuerpo_anterior"><i class="fa fa-edit"></i></a>
        </div>
		<?php endforeach;?>
    	
        <div id="contenedor1">
            <div class="form-group">
                <input type="text" class="form-control" id="cuerpo1" n="1" name="cuerpo1" placeholder="Ingrese cuerpo" size="50">
            </div>
            <a href="#" id="boton_agregar1"  class="btn btn-success agregar_cuerpo" n="1"><i class="fa fa-plus"></i></a>
        </div>
    </form>