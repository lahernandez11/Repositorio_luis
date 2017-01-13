<div class="page-header">
	<h4><a href="<?=base_url('res/administrador/index')?>">
    <i class="fa fa-th-list bom-menu fa-2x"></i> </a>MUNICIPIOS</h4>
</div>
<div class="row main">
    <div class="col-md-4">    	
        <h5>Municipios</h5>
        <form class="form-inline">
        
			<?php foreach ($municipios as $municipio):?>
                <div id="contenedor_anterior<?=$municipio->idmunicipio?>">
                <div class="form-group">
                    <input type="text" class="form-control" id="municipio" n="0" name="municipio" value="<?=$municipio->nombre_municipio?>" readonly size="30">
                </div>
              	<a id="modificar<?=$municipio->idmunicipio?>" idmunicipio="<?=$municipio->idmunicipio?>" class="btn btn-warning modificar_municipio_anterior"><i class="fa fa-edit"></i></a><a href="#" idmunicipio="<?=$municipio->idmunicipio?>" class="btn btn-success agregar_localidad"><i class="fa fa-plus"></i><i class="fa fa-warning"></i></a>
            </div>
            <?php endforeach;?>
            
            <div id="contenedor1">
                <div class="form-group">
                    <input type="text" class="form-control" id="municipio1" n="1" name="municipio1" placeholder="Ingrese municipio" size="30">
                </div>
                <a idmunicipio="" id="boton_agregar1"  class="btn btn-success agregar_municipio" n="1"><i class="fa fa-plus"></i></a>
            </div>
        </form>
    </div>
    <div class="col-md-1">
    	<br><br><br>
    	<i class="fa fa-arrow-right fa-2x"></i>
    </div>
	<div class="col-md-7" id="localidad">
    </div>
</div>
<br/>