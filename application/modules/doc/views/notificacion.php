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
    <i class="fa fa-institution fa-2x"></i> DOCUMENTOS </a>/ <a class="bom-menu" href="<?=base_url('doc/contratos_concesion/index')?>">CONTRATOS DE CONCESI&Oacute;N </a>/ <a class="bom-menu" href="<?=base_url('doc/administracion/index')?>">ADMINISTRACI&Oacute;N </a> / NOTIFICACI&Oacute;N</h4>
</div>
<div class="row">	
    <br>
    <table id="grid" style="font-size:10px;"></table>
</div>
<!--INICIA MODAL ALTA DE CATEGORIA-->
<div class="modal fade" id="modal-notificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <form class="form-horizontal" role="form" id="form-agregar-area">
      <div class="modal-body">        
        <div id="combo-niveles">        	
        </div>
      </div>
      <input type="hidden" name="idnotificacion" id="idnotificacion" value="">
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" id="btn-modificar" >Modificar</button>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL ALTA DE CATEGORIA-->