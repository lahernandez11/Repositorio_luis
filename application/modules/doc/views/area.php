<style>
	a.modificar{
		cursor:pointer;
		text-decoration:underline;
	}
	a.cancelar{
		cursor:pointer;
		text-decoration:underline;
	}
	.the-legend {
		border-style: none;
		border-width: 0;
		font-size: 14px;
		line-height: 20px;
		margin-bottom: 0;
		font-weight:bold;
	}
	.the-fieldset {
		border: 2px groove threedface #444;
		-webkit-box-shadow:  0px 0px 0px 0px #000;
		box-shadow:  0px 0px 0px 0px #000;
	}
</style>
<div class="page-header">
	<h4><a class="bom-menu" href="<?=base_url('doc/home/index')?>"> 
    <i class="fa fa-institution fa-2x"></i> DOCUMENTOS </a>/ <a class="bom-menu" href="<?=base_url('doc/contratos_concesion/index')?>">CONTRATOS DE CONCESI&Oacute;N </a>/ <a class="bom-menu" href="<?=base_url('doc/administracion/index')?>">ADMINISTRACI&Oacute;N </a> / &Aacute;REAS</h4>
</div>
<div class="row">
	<a class="btn btn-success pull-right" id="btn-abrir-agregar-area"><i class="fa fa-plus"></i> REGISTRAR AREA</a>
    <br><br>
    <table id="grid" style="font-size:10px;"></table>
</div>
<!--INICIA MODAL ALTA DE CATEGORIA-->
<div class="modal fade" id="modal-alta-area" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <form class="form-horizontal" role="form" id="form-agregar-area">
      <div class="modal-body">
        <fieldset class="well the-fieldset" id="fieldset_area">
        	<legend class="the-legend">&Aacute;rea</legend>
        	<div class="row">
    			<div class="col-md-9">
            		<input type="text" class="form-control required" name="area" id="area" maxlength="254">
                </div>
                <div class="col-md-3">
                	<button type="button" class="btn btn-success" id="btn-agregar-area" style="display:none;">Agregar</button>
        <button type="button" class="btn btn-warning" id="btn-editar-area" style="display:none;">Editar</button>
                </div>
            </div>
    	</fieldset>  
        <div id="combo-usuarios"></div>
      </div>
      <input type="hidden" name="idarea" id="idarea" value="">
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL ALTA DE CATEGORIA-->