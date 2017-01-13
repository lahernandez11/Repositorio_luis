<h5>Localidades de Municipio:<?=$municipio?></h5>
<form class="form-inline">
	<input type="hidden" name="idmunicipio" id="idmunicipio" value="<?=$idmunicipio?>">
    
			<?php foreach ($localidades as $localidad):?>
                        <div id="contenedor_localidad_anterior<?=$localidad->idlocalidad?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="localidad" n="0" name="localidad" value="<?=$localidad->nombre_localidad?>" readonly size="50">
                        </div>
                        <a id="modificar<?=$localidad->idlocalidad?>" localidad="<?=$localidad->idlocalidad?>" class="btn btn-warning modificar_localidad_anterior"><i class="fa fa-edit">		</i></a>
                    </div>
            <?php endforeach;?>
            
            <div id="contenedor-localidad1">
                <div class="form-group">
                    <input type="text" class="form-control" id="localidad1" n="1" name="localidad1" placeholder="Ingrese localidad" size="50">
                </div>
                <a id="boton_guardar1"  class="btn btn-success guardar_localidad" n="1"><i class="fa fa-plus"></i></a>
            </div>
        </form>