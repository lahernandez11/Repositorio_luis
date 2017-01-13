$(document).ready(function(e) {
	loadTable();

    $('.agregar-activo').click(function(){
		clearFields();
		$('#btn-editar-activo').hide();
		$('#btn-agregar-activo').show();
		$('#myModalLabel').text('Agregar activo');
		$('#modal-catalogo-activo').modal();
	});
	
	
	$('select#proyecto').on('change',function(){
		idproyecto=$(this).val();
		$('select#plaza').html('<option value="0">-SELECCIONE-</option>').attr('disabled',true);
		if(idproyecto==0){
			$('select#ubicacion').val(0);
			$('select#carril').html('<option value="0">-SELECCIONE-</option>').attr('disabled',true);
			alert('Selecicone un proyecto');	
		}else{
			datos = 'idproyecto='+idproyecto;
			$.getJSON(base_url+'bom/catalogo_activo/deplegar_plazas',datos,function(json){
				opciones='<option value="0">-SELECCIONE-</option>';
				$.each(json,function(x,y){
					opciones = opciones+'<option value="'+y.idplaza+'">'+y.nombre_plaza+'</option>';
				});
				$('select#plaza').html(opciones).attr('disabled',false);
			});
		}
	});
	
	$('select#plaza').on('change',function(){
		//if($(this).val()==0){
			$('select#ubicacion').val(0);
			$('select#carril').html('<option value="0">-SELECCIONE-</option>').attr('disabled',true);	
		//}
	});
		
	
	$('select#ubicacion').on('change',function(){
		idubicacion = $(this).val();
		idplaza = $('select#plaza').val();
		if(idubicacion==0){
			$('select#carril').html('<option value="0">-SELECCIONE-</option>').attr('disabled',true);
		}else{
			if(idubicacion==31){
				if(idplaza!=0){
					datos='idplaza='+idplaza;
					$.getJSON(base_url+'bom/catalogo_activo/desplegar_carriles',datos,function(json){
						carriles='';
						$.each(json,function(x,y){
							carriles = carriles + '<option value="'+y.idcarril+'">'+y.nombre_carril+'</option>';
						});
					$('select#carril').html(carriles).attr('disabled',false);
					});
				}else{
					alert('Seleccione una plaza');
					$('select#ubicacion').val(0);
				}	
			}else{
				$('select#carril').html('<option value="0">-SELECCIONE-</option>').attr('disabled',true);	
			}
		}
	});
	
	

	$('#btn-agregar-activo').click(function(){
		errores = 0;
		$('#form-modal-activo input.required').each(function(index, element) {
            if($(this).val()==''){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		$('#form-modal-activo select.required').each(function(index, element) {
            if($(this).val()==0){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		$('#form-modal-activo textarea.required').each(function(index, element) {
            if($(this).val()==''){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-modal-activo').serialize();
			$.getJSON(base_url+'bom/catalogo_activo/agregar',datos,function(json){
				if(json.msg>0){
					alert('El activo ha sido registrado');
					clearFields();
					$('#modal-catalogo-activo').modal('hide');
					loadTable();
				}else{
					alert('El activo no pudo ser registrado,intente nuevamente');
				}
			});
		}
	});
	
	$('#grid').on('click','a.modificar',function(){
		clearFields();
		idactivo = $(this).attr('idactivo');
		datos = 'idactivo='+idactivo;
		var plaza_activa;
		var ubicacion_activa;
		var carril_activo;
		$.getJSON(base_url+'bom/catalogo_activo/buscar',datos,function(json){
			$('select#equipo').val(json[0].idequipo);
			$('input#marca').val(json[0].nombre_marca);
			$('input#modelo').val(json[0].modelo);
			$('input#serie').val(json[0].serie);
			$('input#simex').val(json[0].no_simex);
			$('textarea#observacion').val(json[0].observacion);
			$('select#proyecto').val(json[0].idproyecto);
			$('select#ubicacion').val(json[0].idareaafectacion);
			plaza_activa = json[0].idplaza;
			ubicacion_activa = json[0].idareaafectacion;
			carril_activo = json[0].idcarril;
		}).done(function(){
			datos = 'idproyecto='+$('select#proyecto').val();
			$.getJSON(base_url+'bom/catalogo_activo/deplegar_plazas',datos,function(json){
				opciones='<option value="0">-SELECCIONE-</option>';
				$.each(json,function(x,y){
					opciones = opciones+'<option value="'+y.idplaza+'">'+y.nombre_plaza+'</option>';
				});
				$('select#plaza').html(opciones).attr('disabled',false).val(plaza_activa);
			});
			
			if(ubicacion_activa==31){
				datos2='idplaza='+plaza_activa;
				$.getJSON(base_url+'bom/catalogo_activo/desplegar_carriles',datos2,function(json){
					carriles='';
					$.each(json,function(x,y){
						carriles = carriles + '<option value="'+y.idcarril+'">'+y.nombre_carril+'</option>';
					});
					$('select#carril').html(carriles).attr('disabled',false).val(carril_activo);
				});
			}else{
				$('select#carril').html('<option value="0">-SELECCIONE-</option>').attr('disabled',true);
			}
			
			
			$('input#idactivo').val(idactivo);
			$('#btn-editar-activo').show();
			$('#btn-agregar-activo').hide();
			$('#myModalLabel').text('Modificar activo');
			$('#modal-catalogo-activo').modal();
		});
	});
	
	$('#btn-editar-activo').click(function(){
		errores = 0;
		$('#form-modal-activo input.required').each(function(index, element) {
            if($(this).val()==''){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		$('#form-modal-activo select.required').each(function(index, element) {
            if($(this).val()==0){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		$('#form-modal-activo textarea.required').each(function(index, element) {
            if($(this).val()==''){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-modal-activo').serialize();
			$.getJSON(base_url+'bom/catalogo_activo/editar',datos,function(json){
				if(json.msg>0){
					alert('El activo ha sido modificado');
					clearFields();
					$('#modal-catalogo-activo').modal('hide');
					
					//ACTUALIZA SOLO LA FILA QUE SE MODIFICO
					activo=$("#idactivo").val();
					actualiza(activo);
					//loadTable();
				}else{
					alert('El activo no pudo ser modificado,intente nuevamente');
				}
			});
		}
	});
	
	//exportar lo que se ve 
	$("#btnExport").click(function () {
		$("#grid").btechco_excelexport({
			containerid: "grid"
		   , datatype: $datatype.Table
		   ,filename: "Activos"
		});
	});
	
	//exportar todo
	$("#btnTodo").click(function () {	
		$.getJSON(base_url+'bom/catalogo_activo/desplegar',function(json){
			$("#menu").btechco_excelexport({
				containerid: "dvjson"
				, datatype: $datatype.Json
				,filename: "Activos"
				, dataset: json
				, columns: [
					  { headertext: "EQUIPO", datatype: "string", datafield: "nombre_equipo" }
					, { headertext: "MARCA", datatype: "string", datafield: "nombre_marca" }
					, { headertext: "MODELO", datatype: "string", datafield: "modelo" }
					, { headertext: "SERIE", datatype: "string", datafield: "serie" }
					, { headertext: "NO. PARTE SIMEX", datatype: "string", datafield: "no_simex" }
					, { headertext: "PROYECTO", datatype: "string", datafield: "clave" }
					, { headertext: "PLAZA", datatype: "string", datafield: "nombre_plaza" }
					, { headertext: "&Aacute;REA AFECTACI&Oacute;N", datatype: "string", datafield: "nombre_area" }
					, { headertext: "UBICACI&Oacute;N", datatype: "string", datafield: "nombre_carril" }
					, { headertext: "ESTADO", datatype: "string", datafield: "estado_activo" }					
				]					
			});
		});		
	});
	
	$('#grid').on('click','a.estado',function(){
		idestado = $(this).attr('idestado');
		idactivo = $(this).attr('idactivo');
		datos = 'idactivo='+idactivo+'&idestado='+idestado;
		leyenda = (idestado==1)?'desactivado':'activado';
		$.getJSON(base_url+'bom/catalogo_activo/cambiar',datos,function(json){
			if(json.msg>0){
				alert('El activo ha sido '+leyenda);
				actualiza(idactivo);
				//loadTable();
			}else{
				alert('El activo no ha podido ser '+leyenda+', intente nuevamente');
			}
		});
	});
});



function loadTable()
{
	$.getJSON(base_url+'bom/catalogo_activo/desplegar',function(json){
		$("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "EQUIPO", key: "nombre_equipo", dataType: "string", width: "100%" },
					{ headerText: "MARCA", key: "nombre_marca", dataType: "string", width: "70%" },
					{ headerText: "MODELO", key: "modelo", dataType: "string", width: "100%" },
					{ headerText: "SERIE", key: "serie", dataType: "string", width: "100%" },
					{ headerText: "NO. PARTE SIMEX", key: "no_simex", dataType: "string", width: "100%" },
					{ headerText: "PROYECTO", key: "clave", dataType: "string", width: "70%" },
					{ headerText: "PLAZA", key: "nombre_plaza", dataType: "string", width: "70%" },
					{ headerText: "&Aacute;REA AFECTACI&Oacute;N", key: "nombre_area", dataType: "string", width: "100%" },
					{ headerText: "UBICACI&Oacute;N", key: "nombre_carril", dataType: "string", width: "70%" },
					{ headerText: "ESTADO", key: "estado_activo", dataType: "string", width: "50%" },
					{ headerText: "ACCI&Oacute;N", key: "botones", dataType: "string", width: "100%" },					
                ],
                
				autofitLastColumn: false,
    			autoGenerateColumns: false,
    			dataSource: json,
    			features: [
					{
                        name: "Resizing"
                    },
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
                        pageSize: 10,
						pageSizeList : [10, 20, 50, 100, 500, 1000]
                    },
                    {
                        name: "ColumnMoving"
                    },
					{
                        name: "Selection"
                    }
                ]
            });	
	});
}

function actualiza(activo)
{
	idactivo='idactivo='+activo;	
	$.getJSON(base_url+'bom/catalogo_activo/busca_activo',idactivo,function(json0){
		$.each(json0,function(x,y){
			$( "tr.ui-state-focus td:eq( 0 )" ).html(y.nombre_equipo);
			$( "tr.ui-state-focus td:eq( 1 )" ).html(y.nombre_marca);
			$( "tr.ui-state-focus td:eq( 2 )" ).html(y.modelo);
			$( "tr.ui-state-focus td:eq( 3 )" ).html(y.serie);
			$( "tr.ui-state-focus td:eq( 4 )" ).html(y.no_simex);
			$( "tr.ui-state-focus td:eq( 5 )" ).html(y.clave);
			$( "tr.ui-state-focus td:eq( 6 )" ).html(y.nombre_plaza);
			$( "tr.ui-state-focus td:eq( 7 )" ).html(y.nombre_area);
			$( "tr.ui-state-focus td:eq( 8 )" ).html(y.nombre_carril);
			$( "tr.ui-state-focus td:eq( 9 )" ).html(y.estado_activo);
			$( "tr.ui-state-focus td:eq( 10 )" ).html(y.botones);
		});						
	});
}

function clearFields()
{
	$('#form-modal-activo input.required').each(function(index, element) {
    	$(this).val('');
    });
	
	$('#form-modal-activo textarea.required').val('');
	//$('#form-modal-activo select#equipo').val(0);
	//$('#form-modal-activo select#marca').val(0);
	$('#form-modal-activo select#proyecto').val(0);
	$('#form-modal-activo select#ubicacion').val(0);
	$('#form-modal-activo select#plaza').html('<option value="0">-SELECCIONE-</option>').attr('disabled',true);
	$('#form-modal-activo select#carril').html('<option value="0">-SELECCIONE-</option>').attr('disabled',true);
	
}