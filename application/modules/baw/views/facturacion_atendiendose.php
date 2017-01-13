<div class="page-header">
	<div class="btn-group pull-right" style="margin-left:5px;">
        <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
        <ul class="dropdown-menu ayuda">
            <li><a href="<?=base_url('downloads/baw/v20140519_opi-respoder-solicitud-atendida.pdf')?>" download><i class="fa fa-file"></i> Responder Solicitud</a></li>
            <li><a href="<?=base_url('downloads/baw/v20140519_opi-descartar-solicitud-atendida.pdf')?>" download><i class="fa fa-file"></i> Descartar Solicitud</a></li>
            <li><a href="<?=base_url('downloads/baw/v20140519_opi-editar-solitudes.pdf')?>" download><i class="fa fa-file"></i> Editar Solicitud</a></li>
            <li><a href="<?=base_url('downloads/baw/v20140519_opi-solicitar-informacion2.pdf')?>" download><i class="fa fa-file"></i> Solicitar Informaci&oacute;n</a></li>
        </ul>
    </div>
	<h5><b>
    <img src="<?=base_url('assets/img/1399334087_time.png')?>"> <a class="bom-menu" href="<?=base_url('baw/home/index')?>">BIT&Aacute;CORA DE ATENCI&Oacute;N WEB /</a><a class="bom-menu" href="<?=base_url('baw/facturacion/index')?>"> SOLICITUD DE FACTURACI&Oacute;N / </a><a class="bom-menu" href="<?=base_url('baw/facturacion/atendiendose')?>">SOLICITUDES ATENDIENDOSE</a></b></h5>
</div>
<div class="row">
	<link href="<?=base_url('assets/css/infragistics.theme.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/infragistics.css')?>" rel="stylesheet" />
    
   

    <script src="<?=base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
    
    <div id="menu">
    	<a href="#" class="btn btn-warning" id="btnTodo">Exportar Todo</a>
        <a href="#" class="btn btn-warning" id="btnExport">Exportar</a>
        <br/><br/>
   		<table id="grid" style="font-size:10px;" width="100%;">
        	<tr><td align="center"><img src="<?=base_url('assets/img/cargando.gif')?>"></td></tr>
        </table>
    </div>
</div>

    <script>
        $(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "FOLIO", key: "link", dataType: "string", width: "6%" },
					{ headerText: "PROYECTO", key: "nombre_proyecto", dataType: "string", width: "10%" },					
					/*{ headerText: "TEMA", key: "tema_solicitud", dataType:"string", width: "100%" },
					{ headerText: "TIPO", key: "tipo_solicitud", dataType: "string", width: "100%" },*/
					{ headerText: "RFC", key: "rfc", dataType: "string", width: "6%" },
					{ headerText: "RAZON SOCIAL", key: "razon_social", dataType: "string", width: "25%" },
					{ headerText: "FECHA REGISTRO", key: "fecha", format: "date",width: "6%"},	
					{ headerText: "HORA REGISTRO", key: "hora", format: "time",width: "6%"},							
					{ headerText: "ACCION", key: "idsolicitud", dataType: "string", width: "10%",
					  template: "<a href='<?=base_url('baw/facturacion/solicitudes_atendidas')?>/${idsolicitud}/0' class='atendidos' id='${idsolicitud}'>ATENDER</a>&nbsp;&nbsp;&nbsp;<a href='<?=base_url('baw/facturacion/solicitudes_atendidas_descartadas')?>/${idsolicitud}' id='${idsolicitud}' class='descartados'>DESCARTAR</a>"}
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
						  { headertext: "FOLIO", datatype: "string", datafield: "link" }
						, { headertext: "PROYECTO", datatype: "string", datafield: "nombre_proyecto" }
						, { headertext: "RFC", datatype: "string", datafield: "rfc" }
						, { headertext: "RAZON SOCIAL", datatype: "string", datafield: "razon_social" }
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

