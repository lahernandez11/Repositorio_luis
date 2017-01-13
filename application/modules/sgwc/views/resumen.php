<div class="page-header">
	<h5><b>
    <img src="<?=base_url('assets/img/1422508772_graph-32.png')?>"><a class="bom-menu" href="<?=base_url('sgwc/reporte/index')?>"> SGWC </a>/ RESUMEN INCIDENCIAS </b></h5>
</div>
<style>
#back,#back_to,#back_scatter,#back_to_scatter{
	/*position:absolute;*/
	z-index:999999;
	}
div#buscar_periodo{
	font-size:10px;
}
</style>
<ul class="nav nav-tabs" role="tablist" id="man-ges-inc-ul"></ul>
<div class="tab-content" id="man-ges-inc-tabs"></div>
<br>

<div class="row">
    <div class="col-md-6">
    	<div class="combo" id="combo-proyectos"></div>
    </div>
    <div class="col-md-6">
    	<div class="combo" id="combo-filtos"></div>
    </div>
</div>
<br><br>

<div class="row">
    <div class="col-md-12">
	<button id="back" class="btn btn-green" idproyecto="" serie="" proyecto="">
            <i class="fa fa-mail-reply"></i> Regresar a Clases
        </button>
	<button id="back_to" class="btn btn-green" valor="" idproyecto="" serie="">
        	<i class="fa fa-mail-reply"></i> Regresar a <span id="button_title"></span>
        </button>
        <button id="back_filtro" class="btn btn-green" idproyecto="" serie="" proyecto="" yi="" yf="" mi="" mf="" di="" df="" clase="" tipo="" sub="">
        	<i class="fa fa-mail-reply"></i> Regresar a Clases
        </button>
	<button id="back_to_filtro" class="btn btn-green" valor="" idproyecto="" serie="" yi="" yf="" mi="" mf="" di="" df="" clase="" tipo="" sub="">
        	<i class="fa fa-mail-reply"></i> Regresar a <span id="button_title"></span>
        </button>	
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="chart-estandares" style="height:700px;"></div>
</div>


<div class="row">
	<div class="col-md-12">
		<button id="back_mensual" class="btn btn-green" idproyecto="" serie="" proyecto="">
        	<i class="fa fa-mail-reply"></i> Regresar a Clases
        </button>
		<button id="back_to_mensual" class="btn btn-green" valor="" idproyecto="" serie="">
        	<i class="fa fa-mail-reply"></i> Regresar a <span id="button_title_mensual"></span>
        </button>	
    </div>
</div>
<div class="row">
	<div class="col-md-12" id="chart-mensual" style="height:700px;"></div>
</div>

<div id="contenedor-scatters"></div>
