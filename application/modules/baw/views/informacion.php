<div class="page-header">
<div class="btn-group pull-right" style="margin-left:5px;">
        <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
        <ul class="dropdown-menu ayuda">
            <li><a href="<?=base_url('downloads/baw/v20140512_opi-responer-solicitud-info.pdf')?>" download><i class="fa fa-file"></i> Responder Solicitud Info</a></li>
        </ul>
    </div>
	<h5><b>
    <img src="<?=base_url('assets/img/1383255394_edit_property.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB / </a> <a class="bom-menu" href="<?=base_url('baw/informacion/index')?>">SOLICITUD DE INFORMACI&Oacute;N</a></b></h5>
</div>
<div class="row">
	<link href="<?=base_url('assets/css/infragistics.theme.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/infragistics.css')?>" rel="stylesheet" />
   

    <script src="<?=base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
    
    <div id="menu">
    	<a href="#" class="btn btn-warning" id="btnTodo">Exportar Todo</a>
        <a href="#" class="btn btn-warning" id="btnExport">Exportar</a>
        <br/><br/>
   		<table id="grid" style="font-size:10px"></table>

<!-- Modal -->   
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <label class="text-danger"><h5 id="folio"></h5></label>
            </div>
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Escrito por: </label>
            </div>
            <div class="col-sm-9">
                <input type="text" class="form-control letra10" id="escrito_por" value="" readonly />
                <input type="text" name="correo" id="correo" class="form-control letra10" value=""  disabled />
            </div>
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Tipo: </label>
            </div>
            <div class="col-sm-9">
                <input type="text" class="form-control letra10" id="tipo" value="" readonly />
            </div>
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Tema: </label>
            </div>
            <div class="col-sm-9">
                <input type="text" class="form-control letra10" id="tema" value="" readonly />
            </div>
            <div class="col-sm-3">
                <label for="ticket" class="control-label">Descripci&oacute;n: </label>
            </div>
            <div class="col-sm-9">
                <textarea class="form-control letra10" rows="10" id="descripcion" readonly></textarea>
            </div>           
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>      
                   
    </div>
</div>

    <script>
        $(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "FOLIO", key: "link", dataType: "string", width: "100%" },
					{ headerText: "PROYECTO", key: "nombre_proyecto", dataType: "string", width: "100%" },	
					{ headerText: "TEMA", key: "tema", dataType: "string", width: "100%" },
					{ headerText: "FECHA REGISTRO", key: "fecha_solicitud", format: "date",width: "100%"},	
					{ headerText: "HORA REGISTRO", key: "hora", format: "time",width: "100%"},
					{ headerText: "ACCION", key: "idsolicitud_datos", dataType: "string", width: "100%" ,
				      template: "<a href='<?=base_url('baw/informacion/informacion_responder')?>/${idsolicitud_datos}' id='${idsolicitud_datos}'>RESPONDER</a>"}
					
                ],
                
				autofitLastColumn: false,
    			autoGenerateColumns: false,
    			dataSource: <?=$datasource?>,
    			features: [
				
				    {
                        name: "Sorting",
                        type: "local",
                        mode: "multi"
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
						  { headertext: "FOLIO", datatype: "string", datafield: "folio" },
						  { headertext: "PROYECTO", datatype: "string", datafield: "nombre_proyecto" },
						  { headertext: "TEMA", datatype: "string", datafield: "tema" },
						  { headertext: "FECHA REGISTRO", datatype: "date", datafield: "fecha_solicitud" },
						  { headertext: "HORA REGISTRO", datatype: "date", datafield: "hora" }
						
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