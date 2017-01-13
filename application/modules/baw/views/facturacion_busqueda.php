<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/search_small.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/facturacion/index')?>">SOLICITUD DE FACTURACI&Oacute;N</a> / B&Uacute;SQUEDA</b></h5>
</div>
<div class="row">
	<form class="form-horizontal formulario" role="form">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">Evento</label>
        <div class="col-sm-4">
            <input type="text" placeholder="Digite el # de evento" class="form-control" id="evento">  
        </div>
      </div>
  	</form>
</div>
<div class="row">
	<div id="loading" style="display:none;" align="center">
    	<i class="fa fa-refresh fa-spin"></i> Cargando...
    </div>
	<div class="col-md-12" id="resultados">
    	<table id="grid" style="font-size:10px; display:none;"></table>
    </div>
</div>
