// JavaScript Document
$(document).ready(function(e) {
    loadTable();
		
	//abrir modal editar notificacion
	$('#grid').on('click','a.modificar',function(){
		clearFields();
		id = $(this).attr('id');
		$('input#idnotificacion').val(id);
		datos = 'id='+id;
		$('div#modal-notificacion').modal();
		$('#myModalLabel').html('Editar Notificaci&oacute;n');				
		loadNiveles(id);

	});
	
	
	//Editar 
	$('#btn-modificar').click(function(){		
		datos = $('form#form-agregar-area').serialize();
		$.getJSON(base_url+'doc/notificacion/modifcar',datos,function(json){
			
		});
	});
	

	 
});


function loadNiveles(id)
{
	datos='id='+id;
	$.getJSON(base_url+'doc/notificacion/buscar',datos,function(json){
		niveles='';
		$.each(json,function(x,y){
			niveles=niveles+'<input type="checkbox" name="nivel[]" '+y.check+' value="'+y.idnivel+'" id="'+y.idnivel+'" /><label> &nbsp;Nivel '+y.idnivel+' ('+y.descripcion_nivel+') </label><br/>';
		});
		$('div#combo-niveles').html(niveles);
	});
}



//Consultar categorias
function loadTable()
{
	$.getJSON(base_url+'doc/notificacion/desplegar',function(json){
		$(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "DESCRIPCION", key: "descripcion", dataType: "string", width: "30%" },
					{ headerText: "INICIO", key: "dia_inicio", format: "date",width: "10%"},						
					{ headerText: "FIN", key: "dia_fin", dataType: "string", width: "10%"},
					{ headerText: "COLOR", key: "color", dataType: "string", width: "10%",
						  template:"<span style='background:${color}'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>" },
					{ headerText: "ACCION", key: "idnotificacion_color", dataType: "string", width: "15%",
						  template:"<a class='modificar' id='${idnotificacion_color}'>MODIFICAR</a>" }
						  
                ],
                
				autofitLastColumn: false,
    			autoGenerateColumns: false,
    			dataSource: json,
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
                ]
            });
        });
	});
}

function clearFields()
{
	$('input#area').val('');
	$('input#idarea').val('');
	$('div#combo-usuarios').html('');
}

