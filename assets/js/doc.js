$(document).ready(function(e) {
	//Iniciar grid
	loadTable();
    
	//Iniciar calendario
    $('.datepicker').datetimepicker({
      pickTime: false
    });
	
	//Boton para exportar lo visualizado en el grid
	$("#btnExport").click(function () {
		$("#grid").btechco_excelexport({
			containerid: "grid"
			, datatype: $datatype.Table
		});
	});
	
	//Boton para exportar todos los registros
	$("#btnTodo").click(function () {
		$.getJSON(base_url+'doc/contrato/desplegar',function(json){
			$("#grid").btechco_excelexport({
				containerid: "grid"
				, datatype: $datatype.Json
				, dataset: json
				, columns: [
						  { headertext: "PROYECTO", datatype: "string", datafield: "proyecto" }
						, { headertext: "CONTRATO", datatype: "string", datafield: "contrato" }
						, { headertext: "DESCRIPCION", datatype: "string", datafield: "descripcion" }
						, { headertext: "FECHA INICIO", datatype: "string", datafield: "finicio" }
						, { headertext: "FECHA FIN", datatype: "string", datafield: "ffin" }
						, { headertext: "ESTADO", datatype: "string", datafield: "estado" }		
					]					
				});
		});		
	});
	
	//Abrir modal para agregar contrato
	$('#btn-abrir-agregar-contrato').click(function(){
		$('#myModalLabel').html('Agregar Contrato');
		$('#btn-agregar-contrato').show();
		$('#btn-editar-contrato').hide();
		$('div#modal-alta-contrato').modal();
		clearFields();
	});
	
	//Agregar contrato
	$('#btn-agregar-contrato').on('click',function(){
		errores = 0;
		$('#form-agregar-contrato select.required').each(function(index, element) {
            if($(this).val()==0){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		$('#form-agregar-contrato input.required').each(function(index, element) {
            if($(this).val()==''){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		if($('#form-agregar-contrato textarea').val()==''){
			errores = errores + 1;
			$('#form-agregar-contrato textarea').css('border','solid 1px red');
		}else{
			$('#form-agregar-contrato textarea').css('border','solid 1px #ccc');
		}
		
		if(errores >0 ){
			alert('Llene los campos correctamente');
		}else{
			var form = new FormData($('#form-agregar-contrato')[0]);
			$.ajax({
				url: base_url+'doc/contrato/agregar',
				type: 'POST',
				xhr: function() {
					var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){
						myXhr.upload.addEventListener('progress',progress, false);
					}
					return myXhr;
				},
					//add beforesend handler to validate or something
					//beforeSend: functionname,
					success: function (res) {
						$('#content_here_please').html(res);
					},
					//add error handler for when a error occurs if you want!
					//error: errorfunction,
					data: form,
					cache: false,
					contentType: false,
					processData: false
				});
		}
		
    });
	
	//abrir modal editar contrato
	$('#grid').on('click','a.modificar',function(){
		idcontrato = $(this).attr('idcontrato');
		$('input#idcontrato').val(idcontrato);
		datos = 'idcontrato='+idcontrato;
		$('#myModalLabel').html('Editar Contrato');
		$('#btn-agregar-contrato').hide();
		$('#btn-editar-contrato').show();
		$('div#modal-alta-contrato').modal();
		$.getJSON(base_url+'doc/contrato/buscar',datos,function(json){
			$('select#proyecto').val(json[0].idproyecto);
			$('input#numero').val(json[0].numero_contrato);
			$('textarea#descripcion').val(json[0].descripcion_contrato);
			$('input#fecha_inicio').val(json[0].fecha_inicio);
			$('input#fecha_fin').val(json[0].fecha_fin);
			$('select#estado').val(json[0].idcat_estado);
			$('div#documento-previo').html('Documento existente: <a href="'+base_url+'documents/doc/'+json[0].doc_contrato+'" target="_blank">'+json[0].doc_contrato+'</a>')
		});
	});
	
	//Editar contrato
	$('#btn-editar-contrato').on('click',function(){
		errores = 0;
		$('#form-agregar-contrato select.required').each(function(index, element) {
            if($(this).val()==0){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		$('#form-agregar-contrato input.required').each(function(index, element) {
            if($(this).val()==''){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		if($('#form-agregar-contrato textarea').val()==''){
			errores = errores + 1;
			$('#form-agregar-contrato textarea').css('border','solid 1px red');
		}else{
			$('#form-agregar-contrato textarea').css('border','solid 1px #ccc');
		}
		
		if(errores >0 ){
			alert('Llene los campos correctamente');
		}else{
			var form = new FormData($('#form-agregar-contrato')[0]);
			$.ajax({
				url: base_url+'doc/contrato/editar',
				type: 'POST',
				xhr: function() {
					var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){
						myXhr.upload.addEventListener('progress',progress, false);
					}
					return myXhr;
				},
					//add beforesend handler to validate or something
					//beforeSend: functionname,
					success: function (res) {
						$('#content_here_please').html(res);
					},
					//add error handler for when a error occurs if you want!
					//error: errorfunction,
					data: form,
					cache: false,
					contentType: false,
					processData: false
				});
		}
		
    });
	
	//Cambiar estado categoria
	$('#grid').on('click','a.cancelar',function(){
		estado = $(this).attr('estado');
		idcontrato = $(this).attr('idcontrato');
		datos = 'idcontrato='+idcontrato+'&estado='+estado;
		leyenda = (estado==1)?'desactivado':'activado';
		if(confirm('El contrato sera '+leyenda+', desea continuar?')){
			$.getJSON(base_url+'doc/contrato/cancelar',datos,function(json){
				if(json.msg>0){
					alert('El contrato ha sido '+leyenda);
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
});

function loadTable()
{
	$.getJSON(base_url+'doc/contrato/desplegar',function(json){
		$(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "PROYECTO", key: "nombre_proyecto", dataType: "string", width: "20%" },
					{ headerText: "CONTRATO", key: "numero_contrato", dataType: "string", width: "10%" },					
					{ headerText: "DESCRIPCION", key: "descripcion_contrato", dataType:"string", width: "30%" },
					{ headerText: "FECHA INICIO", key: "fechainicio_tabla", dataType: "date", format:"dd-MM-yyyy", width: "10%" },
					{ headerText: "FECHA FIN", key: "fechafin_tabla", dataType: "date", format:"dd-MM-yyyy", width: "10%" },
					{ headerText: "ESTADO", key: "cat_estado", dataType: "string", width: "10%"},
					{ headerText: "ACCION", key: "botones", dataType: "string", width: "12%",},						
                ],
                
				autofitLastColumn: false,
    			autoGenerateColumns: false,
    			dataSource: json,
				dataRendered: function (evt, ui) {
					ui.owner.element.find("tr td").css("vertical-align", "top");
				},
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
	});
}


// Yes outside of the .ready space becouse this is a function not an event listner!
function progress(e){
	if(e.lengthComputable){
		//this makes a nice fancy progress bar
		$('progress').attr({value:e.loaded,max:e.total});
    }
}

function clearFields()
{
	var f = new Date();
	anio = f.getFullYear();
	mes = (f.getMonth() +1).toString();
	mes = (mes.length>1)?mes:'0'+mes;
	dia = f.getDate().toString();
	dia = (dia.length>1)?dia:'0'+dia;
	fecha = anio+'-'+mes+'-'+dia;
	$("select#proyecto, select#estado").val(0);
	$("input#numero, textarea#descripcion, input#userfile").val("");
	$("progress").attr({value:0,max:0});
	$("input#fecha_inicio, input#fecha_fin").val(fecha);
	$('input#idcontrato').val('');
	$('div#documento-previo').html('');
}