$(document).ready(function(e) {
	//Iniciar calendario
    $('.datepicker').datetimepicker({
      pickTime: false
    });
	
	//Iniciar horas
	$('.timepicker').datetimepicker({
      pickDate: false
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
		$.getJSON(base_url+'bic/home/desplegar',function(json){
			$("#grid").btechco_excelexport({
				containerid: "grid"
				, datatype: $datatype.Json
				, dataset: json
				, columns: [
						  { headertext: "PROYECTO", datatype: "string", datafield: "nombre_proyecto" }
						, { headertext: "CUERPO", datatype: "string", datafield: "cuerpo" }
						, { headertext: "INCIDENCIA", datatype: "string", datafield: "tipo_incidencia" }
						, { headertext: "CAUSA", datatype: "string", datafield: "causa" }
						, { headertext: "KM INICIAL", datatype: "string", datafield: "km_min" }
						, { headertext: "KM FINAL", datatype: "string", datafield: "km_max" }
						, { headertext: "INICIA", datatype: "date", datafield: "fecha_inicio_tabla" }
						//, { headertext: "TERMINA", datatype: "date", datafield: "fecha_fin_tabla" }		
					]					
				});
		});		
	});
	
	//Abrir modal para agregar incidencia
	$('#btn-abrir-agregar-incidencia').click(function(){
		$('#myModalLabel').html('Agregar Incidencia');
		$('#btn-agregar-incidencia').show();
		$('#btn-editar-incidencia').hide();
		$('div#modal-alta-incidencia').modal();
		clearFields();
	});
	
	//Cargar hitos al seleccionar proyecto
	$('#form-agregar-incidencia select#proyecto').change(function(){
		loadHitos($(this).val())	
	});
	
	//Validar y agregar incidencia
	$('#btn-agregar-incidencia').click(function(){
		errores = 0;
		$('#form-agregar-incidencia select.validar').each(function(index, element) {
            if($(this).val()==0){
				errores = errores + 1;
				}
        });
		
		if(errores>0){
			alert('Llene los campos correctamente');
			}else{
				datos = $('#form-agregar-incidencia').serialize();
				$.getJSON(base_url+'bic/home/agregar',datos,function(data){
					if(data.msg>0){
						alert('La incidencia ha sido registrada');
						$('#modal-alta-incidencia').modal('hide');
						clearFields();
						$.getJSON(base_url+'bic/home/desplegar',function(json){
							LoadTable(json);
							});
						}else{
							alert('Error, intente nuevamente');
							}
				});
			}
	});
	
	//Eliminar incidencia
	$('#grid').on('click','a.eliminar-incidencia',function(){
		if(confirm('¿Esta seguro de eliminar la incidencia?')){
			datos = 'idincidencia='+$(this).attr('id');
			$.getJSON(base_url+'bic/home/eliminar',datos,function(data){
				if(data.msg>0){
					alert('La incidencia ha sido eliminada');
					$.getJSON(base_url+'bic/home/desplegar',function(json){
							LoadTable(json);
						});
					}else{
						alert('La incidencia no pudo ser eliminada, intente nuevamente.');
						}
				});
			}
	});
	
	//Cargar datos de incidencia y abrir modal para editar
	$('#grid').on('click','a.btn-abrir-editar-incidencia',function(){
		var idincidencia=$(this).attr('id');
		$('#myModalLabel').html('Editar Incidencia');
		$('#btn-agregar-incidencia').hide();
		$('#btn-editar-incidencia').show();
		$('input#idincidencia').val(idincidencia);
		datos='idincidencia='+idincidencia;
		$('#seleccionar-todos').prop('checked',false);
		$.getJSON(base_url+'bic/home/consultar',datos,function(json){
			loadHitos(json[0].idproyecto);
			$('select#proyecto').val(json[0].idproyecto);
			$('select#cuerpo').val(json[0].idcuerpo);
			$('select#tipo').val(json[0].idtipo_incidencia);
			$('select#causa').val(json[0].idcausa);
			$('input#fecha_inicio').val(json[0].fecha_inicio);
			$('input#fecha_fin').val(json[0].fecha_fin);
			$('input#hora_inicio').val(json[0].hora_inicio);
			$('input#hora_fin').val(json[0].hora_fin);
			$('textarea#notas').val(json[0].notas);
			if(json[0].fecha_fin==''){
				$('#icono-fecha-fin').hide();
				$('#icono-hora-fin').hide();
				$('#eval-final').prop('checked',true)
			}else{
				$('#icono-fecha-fin').show();
				$('#icono-hora-fin').show();
				$('#eval-final').prop('checked',false)
				}
			setTimeout(function(){
				$('select#km_min').val(json[0].hito_km_ini);
				$('select#km_max').val(json[0].hito_km_fin);
				$('select#ms_min').val(json[0].metro_hito_km_ini);
				$('select#ms_max').val(json[0].metro_hito_km_fin);
			},1000)
		}).done(function(){
			datos1 = 'idincidencia='+idincidencia;
			var carriles = [];
			$.getJSON(base_url+'bic/home/consultar_incidencia_carril',datos1,function(data){
				$.each(data,function(k,v){
					carriles.push(v.idcarril);
				});
			}).done(function(){
				Array.prototype.inArray = function (value){
					var i;
					for (i=0; i < this.length; i++){
						if (this[i] == value){
					 		return true;
					 	}
					 }
					 return false;
				};
				$('input.carril').each(function(index, element) {
					if(carriles.inArray($(this).val())){
						$(this).prop("checked",true);
					}else{
						$(this).prop("checked",false);
						}
				});
			});
			$('div#modal-alta-incidencia').modal();
		});
	});
	
	//Editar incidencia
	$('#btn-editar-incidencia').click(function(){
		errores = 0;
		$('#form-agregar-incidencia select.validar').each(function(index, element) {
            if($(this).val()==0){
				errores = errores + 1;
				}
        });
		
		if(errores>0){
			alert('Llene los campos correctamente');
			}else{
				datos = $('#form-agregar-incidencia').serialize();
				//alert(datos);
				$.getJSON(base_url+'bic/home/editar',datos,function(data){
					if(data.msg>0){
						alert('La incidencia ha sido modificada');
						$('#modal-alta-incidencia').modal('hide');
						clearFields();
						$.getJSON(base_url+'bic/home/desplegar',function(json){
							LoadTable(json);
							});
						}else{
							alert('Error, intente nuevamente');
							}
				});
			}
	});
	
	
	$('#eval-final').click(function(){
		if($(this).is(':checked')){
			$('input#fecha_fin').val('');
			$('input#hora_fin').val('');
			$('#icono-fecha-fin').hide();
			$('#icono-hora-fin').hide();
		}else{
			var f = new Date();
			anio = f.getFullYear();
			mes = (f.getMonth() +1).toString();
			mes = (mes.length>1)?mes:'0'+mes;
			dia = f.getDate().toString();
			fecha = anio+'-'+mes+'-'+dia;
			$('input#fecha_fin').val(fecha);
			$('input#hora_fin').val('12:00:00');
			$('#icono-fecha-fin').show();
			$('#icono-hora-fin').show();
		} 	
	});
	
	$('#seleccionar-todos').click(function(){
		if($('#seleccionar-todos').is(':checked')){
			$('input.carril').each(function(index, element) {
                $(this).prop('checked',true)
            });
		}else{
			$('input.carril').each(function(index, element) {
                $(this).prop('checked',false)
            });
		}
	});
	
	
});

function LoadTable(data){
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "PROYECTO", key: "nombre_proyecto", dataType: "string", width: "20%" },
					{ headerText: "CUERPO", key: "cuerpo", dataType: "string", width: "11%" },	
					{ headerText: "INCIDENCIA", key: "tipo_incidencia", dataType: "string", width: "18%" },	
					{ headerText: "CAUSA", key: "causa", dataType: "string", width: "15%" },	
					{ headerText: "KM INICIAL", key: "km_min", dataType: "string", width: "6%" },
					{ headerText: "KM FINAL", key: "km_max", dataType: "string", width: "6%" },
					{ headerText: "INICIA", key: "fecha_inicio_tabla", dataType: "date", format:"dd-MM-yyyy HH:mm:ss", width: "10%" },
					//{ headerText: "TERMINA", key: "fecha_fin_tabla", dataType: "date", format:"dd-MM-yyyy HH:mm:ss", width: "10%" },					
					{ headerText: "ACCION", key: "idincidencia", dataType: "string", width: "5%",
					  template: "<a href='#' class='btn btn-warning btn-xs btn-abrir-editar-incidencia' id='${idincidencia}'><i class='fa fa-pencil' style='color:white;'></i></a><a hre='#' class='btn btn-danger btn-xs eliminar-incidencia' id='${idincidencia}' style='color:white;'><i class='fa fa-times'></i></a>"}
                ],
                
				autofitLastColumn: false,
    			autoGenerateColumns: false,
    			dataSource: data,
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
        }
		
function loadHitos(idproyecto)
{
	if(idproyecto!=0){
		datos = 'idproyecto='+idproyecto;
		km_min='<select class="form-control input-sm" id="km_min" name="km_min">';
		km_max='<select class="form-control input-sm" id="km_max" name="km_max">';
		$.getJSON(base_url+'bic/home/hitos',datos,function(data){
			$.each(data,function(k,v){
				km_min = km_min + '<option value="'+v.hito_kilometrico+'">'+v.hito_kilometrico+'</option>';
				km_max = km_max + '<option value="'+v.hito_kilometrico+'">'+v.hito_kilometrico+'</option>';
			});
			km_min = km_min + '</select>';
			km_max = km_max + '</select>';
			$('div#km_min').html(km_min);
			$('div#km_max').html(km_max);	
		});
				
			
		ms_min='<select class="form-control input-sm" id="ms_min" name="ms_min">';
		ms_max='<select class="form-control input-sm" id="ms_max" name="ms_max">';	
		$.getJSON(base_url+'bic/home/metros',datos,function(data){
			$.each(data,function(k,v){
				ms_min = ms_min + '<option value="'+v.metros_hito_kilometrico+'">'+v.metros_hito_kilometrico+'</option>';
				ms_max = ms_max + '<option value="'+v.metros_hito_kilometrico+'">'+v.metros_hito_kilometrico+'</option>';
			});
			ms_min = ms_min + '</select>';
			ms_max = ms_max + '</select>';
			$('div#ms_min').html(ms_min);
			$('div#ms_max').html(ms_max);	
		});
		
	}else{
		km_min='<select class="form-control input-sm" id="km_min" disabled name="km_min"><option value="0">- SELECCIONE -</option></select>';
		km_max='<select class="form-control input-sm" id="km_max" disabled name="km_max"><option value="0">- SELECCIONE -</option></select>';
		ms_min='<select class="form-control input-sm" id="ms_min" disabled name="ms_min"><option value="0">- SELECCIONE -</option></select>';
		ms_max='<select class="form-control input-sm" id="ms_max" disabled name="ms_max"><option value="0">- SELECCIONE -</option></select>';
		$('div#km_min').html(km_min);
		$('div#km_max').html(km_max);
		$('div#ms_min').html(ms_min);
		$('div#ms_max').html(ms_max);	
	}

}

function clearFields()
{
	$('#form-agregar-incidencia select').each(function(index, element) {
            $(this).val(0);
    });
	loadHitos(0);
	var f = new Date();
	anio = f.getFullYear();
	mes = (f.getMonth() +1).toString();
	mes = (mes.length>1)?mes:'0'+mes;
	dia = f.getDate().toString();
	fecha = anio+'-'+mes+'-'+dia;
	$('input#fecha_inicio').val(fecha);
	$('input#fecha_fin').val(fecha);
	$('input#hora_inicio').val('12:00:00');
	$('input#hora_fin').val('12:00:00');
	$('input#idincidencia').val('');
	$('textarea#notas').val('');
	$('#icono-fecha-fin').show();
	$('#icono-hora-fin').show();
	$('#eval-final').prop('checked',false);
	$('#seleccionar-todos').prop('checked',false);
	$('input.carril').each(function(index, element) {
		$(this).prop("checked",false);
	});
}