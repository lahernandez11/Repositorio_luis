<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383255394_edit_property.png')?>"> <a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a> <a class="bom-menu" href="<?=base_url('bom/catalogo/index')?>">CAT&Aacute;LOGOS</a> / EQUIPOS</h4>
</div>
<div class="row">
<a class="btn btn-success pull-right agregar-equipo">Agregar equipo</a><br><br>
<table id="grid" style="font-size:10px;"></table>
</div>
<div class="modal fade" id="modal-catalogo-equipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="left">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            	<form class="form-horizontal" role="form" id="form-modal-equipo">
                  <div class="form-group">
                    <label for="equipo" class="col-sm-2 control-label">Equipo</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control required" name="equipo" id="equipo" placeholder="Equipo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="clave" class="col-sm-2 control-label">Clave</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="clave" id="clave" placeholder="Clave" maxlength="10">
                    </div>
                  </div>
                  <input type="hidden" name="idequipo" value="" id="idequipo">
                </form>	                               
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="btn-agregar-equipo">Agregar equipo</button>
                <button type="button" class="btn btn-warning" id="btn-editar-equipo">Modificar equipo</button>
            </div>
        </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->