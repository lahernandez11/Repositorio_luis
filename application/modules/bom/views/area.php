<div class="page-header">
	<i class="fa fa-crosshairs"></i> &Aacute;reas de Afectaci&oacute;n 
</div>
<div class="row main">
    <div class="col-md-4">
    	<h5>&Aacute;reas</h5>
        <form class="form-inline">
        
			<?php foreach ($areas as $area):?>
                <div id="contenedor_anterior<?=$area->idareaafectacion?>">
                <div class="form-group">
                    <input type="text" class="form-control" id="area" n="0" name="area" value="<?=$area->nombre_area?>" readonly size="30">
                </div>
              	<a href="#" id="modificar<?=$area->idareaafectacion?>" idarea="<?=$area->idareaafectacion?>" class="btn btn-warning modificar_area_anterior"><i class="fa fa-edit"></i></a><a href="#" idarea="<?=$area->idareaafectacion?>" class="btn btn-success agregar_falla"><i class="fa fa-plus"></i><i class="fa fa-warning"></i></a>
            </div>
            <?php endforeach;?>
            
            <div id="contenedor1">
                <div class="form-group">
                    <input type="text" class="form-control" id="area1" n="1" name="area1" placeholder="Ingrese area" size="30">
                </div>
                <a href="#" idarea="" id="boton_agregar1"  class="btn btn-success agregar_area" n="1"><i class="fa fa-plus"></i></a>
            </div>
        </form>
    </div>
    <div class="col-md-1">
    	<br><br><br>
    	<i class="fa fa-arrow-right fa-2x"></i>
    </div>
	<div class="col-md-7" id="falla">
    </div>
</div>