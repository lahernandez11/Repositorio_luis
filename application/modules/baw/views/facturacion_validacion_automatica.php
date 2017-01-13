<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1399334070_user.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/facturacion/index')?>">SOLICITUD DE FACTURACI&Oacute;N / </a><a class="bom-menu" href="<?=base_url('baw/facturacion/registrados')?>">SOLICITUDES REGISTRADAS</a> / VALIDACI&Oacute;N AUTOM&Aacute;TICA</b></h5>
</div>
<div class="row">
	<form class="form-inline" role="form">
      Seleccione la fecha de las solicitudes a validar<br>
      <div class="form-group col-md-2">
        <div id="datetimepicker3" class="input-append input-group">
        	<input data-format="yyyy-MM-dd" value="<?=date('Y-m-d', strtotime('-1 day'));?>" type="text" class="form-control" readonly id="validacion_automatica_fecha">
           	<span class="input-group-addon add-on">
            	<i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i>
            </span>
		</div>
      </div>
      <button type="button" class="btn btn-success" id="comenzar_validacion_automatica">Ejecutar validaci&oacute;n</button>
    </form>
    <br>
    <div id="validacion_automatica_resumen"></div>
</div>