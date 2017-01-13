<div class="page-header">
	<div class="btn-group pull-right" style="margin-left:5px;">
        <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
        <ul class="dropdown-menu ayuda">
            <li><a href="<?=base_url('downloads/baw/v20140512_opi-responer-solicitud.pdf')?>" download><i class="fa fa-file"></i> Responder Solicitud</a></li>
            <li><a href="<?=base_url('downloads/baw/v20140519_opi-descartar-solicitud.pdf')?>" download><i class="fa fa-file"></i> Descartar Solicitud</a></li>
            <li><a href="<?=base_url('downloads/baw/v20140519_opi-editar-solicitud.pdf')?>" download><i class="fa fa-file"></i> Editar Solicitud</a></li>
            <li><a href="<?=base_url('downloads/baw/v20140519_opi-solicitar-informacion.pdf')?>" download><i class="fa fa-file"></i> Solicitar Informaci&oacute;n</a></li>
        </ul>
    </div>
	<h5><b>
    <img src="<?=base_url('assets/img/1399334070_user.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a><a class="bom-menu" href="<?=base_url('baw/administrar/index')?>">ADMINISTRAR / </a><a class="bom-menu" href="<?=base_url('baw/administrar/registrados')?>">SOLICITUDES REGISTRADAS</a></b></h5>
</div>
<div class="row">
	<link href="<?=base_url('assets/css/infragistics.theme.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/infragistics.css')?>" rel="stylesheet" />   
    <!--<link href="http://cdn-na.infragistics.com/jquery/20132/latest/css/structure/infragistics.css" rel="stylesheet" />-->
   

    <script src="<?=base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
    
    <div id="menu">
    	<a href="#" class="btn btn-warning" id="btnTodo">Exportar Todo</a>
        <a href="#" class="btn btn-warning" id="btnExport">Exportar</a>
        <br/><br/>
   		<table id="grid" style="font-size:10px"></table>	
        
        <!-- Modal -->
<?php foreach($solicitudes as $solicitud):?>
<div class="modal fade" id="myModal<?=$solicitud->idsolicitud?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Datos de la Solicitud</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Folio: </label>
            </div>
            <div class="col-sm-9">
                <label class="text-danger"><h5><?=$solicitud->folio?></h5></label>
            </div>
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Escrito por: </label>
            </div>
            <div class="col-sm-9">
                <input type="text" class="form-control letra10" value="<?=$solicitud->nombre_solicitante?>" readonly />                
                <input type="text" name="correo" id="correo" class="form-control letra10" value="<?=$solicitud->mail_solicitante?>"  disabled />
            </div>
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Tipo: </label>
            </div>
            <div class="col-sm-9">
                <input type="text" class="form-control letra10" value="<?=$solicitud->tipo_solicitud?>" readonly />
            </div>
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Tema: </label>
            </div>
            <div class="col-sm-9">
                <input type="text" class="form-control letra10" value="<?=$solicitud->tema_solicitud?>" readonly />
            </div>
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Descripci&oacute;n: </label>
            </div>
            <div class="col-sm-9">
                <textarea class="form-control letra10" rows="10" readonly><?=$solicitud->mensaje_solicitud?></textarea>
            </div>
            <?php $fol=explode('-',$solicitud->folio);?>
            <?php $archivos=$this->administrar_model->desplega_archivos($solicitud->idsolicitud);?>
            <?php if($solicitud->idtipo_solicitud==6 and $fol[0]=='ATA'):?>
            	<div class="col-sm-3">
                <label for="ticket" class="control-label">Archivos adjuntos: </label>
                </div>
                <div class="col-sm-9">
                    <?php foreach($archivos as $archivo):?>
                    	<a target="_blank" href="http://dev.autopista-toluca-atlacomulco.com.mx/<?=$archivo->nombre_documento?>" download>                      
                        	<?=substr($archivo->nombre_documento, 19);?>
                        </a><br>
                    <?php endforeach;?>
                </div>            	
            <?php endif;?>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>        
<?php endforeach;?>	
    </div>
</div>

    <script>
        $(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "FOLIO", key: "folio", dataType: "string", width: "100%" },
					{ headerText: "PROYECTO", key: "nombre_proyecto", dataType: "string", width: "100%" },					
					{ headerText: "TEMA", key: "tema_solicitud", dataType:"string", width: "100%" },
					{ headerText: "TIPO", key: "tipo_solicitud", dataType: "string", width: "100%" },
					{ headerText: "FECHA REGISTRO", key: "fecha", format: "date",width: "100%"},	
					{ headerText: "HORA REGISTRO", key: "hora", format: "time",width: "100%"},						
					{ headerText: "ACCION", key: "idsolicitud", dataType: "string", width: "100%",
					  template: "<a href='<?=base_url('baw/administrar/solicitudes_atendidas')?>/${idsolicitud}/1' class='atendidos' id='${idsolicitud}'>ATENDER</a>&nbsp;&nbsp;&nbsp;\n\
                      <a href='<?=base_url('baw/administrar/solicitudes_descartadas')?>/${idsolicitud}' id='${idsolicitud}' class='descartados'>DESCARTAR</a>&nbsp;&nbsp;&nbsp;\n\
<a href='' data-toggle=modal data-target=#myModal${idsolicitud}>CONSULTAR</a>"}
                ],
                
				autofitLastColumn: false,
    			autoGenerateColumns: false,
    			dataSource: <?=$datasource?>,
    			features: [
				
				    {
                        name: "Sorting",
                        type: "local"/*,
                        mode: "multi"*/
                    },
                    {
                        name: "Filtering",
                        type: "local",
                        mode: "advanced"
                    },
                    {
                        name: "Hiding"
                    },
					{
                        name: "Paging",
                        type: "local",
                        pageSize: 10
                    },
                    {
                        name: "ColumnMoving"
                    },
					{
                        name: "Selection"
                    },
					{
                        name: "Resizing"
                    }
                    /*{
                        name: "Summaries"
                    }*/
                ]
            });
        });
     </script>	
     <!-- exportar todo -->
     <script>
		$(document).ready(function () {
			$("#btnTodo").click(function () {	
				$("#menu").btechco_excelexport({
					containerid: "dvjson"
					, datatype: $datatype.Json
					, dataset: <?=$datasource?>
					, columns: [
						  { headertext: "FOLIO", datatype: "string", datafield: "folio" }
						, { headertext: "PROYECTO", datatype: "string", datafield: "nombre_proyecto" }
						, { headertext: "TEMA", datatype: "string", datafield: "tema_solicitud" }
						, { headertext: "TIPO", datatype: "string", datafield: "tipo_solicitud" }
						, { headertext: "FECHA REGISTRO", datatype: "date", datafield: "fecha" }
						, { headertext: "HORA REGISTRO", datatype: "date", datafield: "hora" }
							
					]					
				});
			});
		});
	</script>
    <!-- exportar lo que se ve  -->
    <script>
		$(document).ready(function () {
			$("#btnExport").click(function () {
				$("#grid").btechco_excelexport({
					containerid: "grid"
				   , datatype: $datatype.Table
				});
			});
		});
	</script>

