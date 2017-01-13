<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383255394_edit_property.png')?>"> <a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a> <a class="bom-menu" href="<?=base_url('bom/catalogo/index')?>">CAT&Aacute;LOGOS</a> / ACTIVOS</h4>
</div>
<div class="row">
<a href="#" class="btn btn-warning" id="btnTodo">Exportar Todo</a>
<a href="#" class="btn btn-warning" id="btnExport">Exportar</a>

<a class="btn btn-success pull-right agregar-activo">Agregar activo</a><br><br>
<table id="grid" style="font-size:10px;"></table>
</div>
<div class="modal fade" id="modal-catalogo-activo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="left">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            	<form class="form-horizontal" role="form" id="form-modal-activo" style="font-size:10px;">
                  <div class="form-group">
                    <label for="equipo" class="col-sm-2 control-label">Equipo</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="equipo" id="equipo">
                      	<?php foreach ($equipos as $equipo):?>
                        <option value="<?=$equipo["idequipo"]?>"><?=$equipo["nombre_equipo"]?></option>
						<?php endforeach;?>	
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="equipo" class="col-sm-2 control-label">Marca</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control required" name="marca" id="marca" placeholder="Marca">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="modelo" class="col-sm-2 control-label">Modelo</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control required" name="modelo" id="modelo" placeholder="Modelo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="serie" class="col-sm-2 control-label">Serie</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control required" name="serie" id="serie" placeholder="Serie">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="simex" class="col-sm-2 control-label">No. parte SIMEX</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control required" name="simex" id="simex" placeholder="No. Simex">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="observacion" class="col-sm-2 control-label">Observaci&oacute;n</label>
                    <div class="col-sm-10">
                      <textarea class="form-control required" name="observacion" id="observacion" placeholder="Observaci&oacute;n"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="proyecto" class="col-sm-2 control-label">Proyecto</label>
                    <div class="col-sm-10">
                      <select class="form-control required" name="proyecto" id="proyecto">
                      	<option value="0">-SELECCIONE-</option>
                      	<?php foreach ($proyectos as $proyecto):?>
                        <option value="<?=$proyecto["idproyecto"]?>"><?=$proyecto["nombre_proyecto"]?></option>
						<?php endforeach;?>	
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="proyecto" class="col-sm-2 control-label">Plaza</label>
                    <div class="col-sm-10">
                      <select class="form-control required" name="plaza" id="plaza" disabled>
                        <option value="0">-SELECCIONE-</option>	
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ubicacion" class="col-sm-2 control-label">&Aacute;rea Afectaci&oacute;n</label>
                    <div class="col-sm-10">
                      <select class="form-control required" name="ubicacion" id="ubicacion">
                      	<option value="0">-SELECCIONE-</option>
                      	<?php foreach ($areas as $area):?>
                        <option value="<?=$area["idareaafectacion"]?>"><?=$area["nombre_area"]?></option>
						<?php endforeach;?>	
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="carril" class="col-sm-2 control-label">Ubicaci&oacute;n</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="carril" id="carril" disabled>
                      	
                      </select>
                    </div>
                  </div>
                  
                  
                  <input type="hidden" name="idactivo" value="" id="idactivo">
                </form>	                               
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-agregar-activo">Agregar activo</button>
                <button type="button" class="btn btn-warning" id="btn-editar-activo">Modificar activo</button>
            </div>
        </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->