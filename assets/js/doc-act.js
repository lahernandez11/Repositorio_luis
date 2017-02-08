$(document).ready(function(e) {
	//Iniciar calendario
    $('.datepicker').datetimepicker({
      pickTime: false
    });
	
    $('select#act-contrato').change(function(){
		idcontrato = $(this).val();
		if(idcontrato==0){
			$('div#act-categoria-contenedor').html('');
		}else{
			datos = 'idcontrato='+idcontrato;
			opciones = '<b>CATEGOR&Iacute;A</b><select class="form-control" id="act-categoria-select"><option value="0">- SELECCIONE -</option>';
			$.getJSON(base_url+'doc/actividad/categorias',datos,function(json){
				$.each(json,function(x,y){
					if(y.estado==1){
						opciones = opciones + '<option value="'+y.idcat_categoria+'">'+y.cat_categoria+'</option>';
					}
				});
				opciones = opciones + '</select>';	
				$('#act-categoria-contenedor').html(opciones);
			});
		}
		$('div#act-subcategoria-contenedor').html('');
		$('#act-resultado').hide();
	});
	
	$('#act-categoria-contenedor').on('change','select',function(){
		idcategoria = $(this).val();
		if(idcategoria==0){
			$('div#act-subcategoria-contenedor').html('');
		}else{
			idcontrato = $('select#act-contrato').val();
			datos = 'idcontrato='+idcontrato+'&idcategoria='+idcategoria;
			opciones2 = '<b>SUBCATEGOR&Iacute;A</b><select class="form-control" id="act-subcategoria-select"><option value="0">- SELECCIONE -</option>';
			$.getJSON(base_url+'doc/actividad/subcategorias',datos,function(json1){
				$.each(json1,function(x,y){
					if(y.estado==1){
						opciones2 = opciones2 + '<option value="'+y.idcat_subcategoria+'">'+y.cat_subcategoria+'</option>';
					}
				});
				opciones2 = opciones2 + '</select>';	
				$('#act-subcategoria-contenedor').html(opciones2);
			});
		}
		$('#act-resultado').hide();
	});
	
	
	$('#act-subcategoria-contenedor').on('change','select',function(){
		idsubcategoria = $(this).val();
		if(idsubcategoria==0){
			$('#act-resultado').hide();
		}else{
			idcontrato = $('select#act-contrato').val();
			idcategoria = $('select#act-categoria-select').val();
			loadTable(idcontrato,idcategoria,idsubcategoria);
			$('input#idcontrato').val(idcontrato);
			$('input#idcategoria').val(idcategoria);
			$('input#idsubcategoria').val(idsubcategoria);
			$('#act-resultado').show();
		}
	});
	
	$('#btn-abrir-agregar-actividad').click(function(){
		clearFields();
		contrato = $("select#act-contrato option:selected").text();
		categoria = $("select#act-categoria-select option:selected").text();
		subcategoria = $("select#act-subcategoria-select option:selected").text();
		$('#label-contrato').text(contrato);
		$('#label-categoria').text(categoria);
		$('#label-subcategoria').text(subcategoria);
		$('#modal-alta-actividad').modal();
	});
	
	$('#btn-agregar-actividad').click(function(){
		errores = 0;
		$('form#form-agregar-actividad input.required, form#form-agregar-actividad textarea.required').each(function(index, element) {
            if($(this).val()==''){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		if($(".areas_i").is(':checked')){
			errores = errores+0;
		}
		else{
			errores=errores+1;
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('form#form-agregar-actividad').serialize();
			idcontrato = $('select#act-contrato').val();
			idcategoria = $('select#act-categoria-select').val();
			idsubcategoria = $('select#act-subcategoria-select').val();
			$.getJSON(base_url+'doc/actividad/agregar',datos,function(json){
				if(json.msg>0){
					alert('La actividad ha sido registrada');
					$('#modal-alta-actividad').modal('hide');
					//loadAreas(json.msg);
					loadTable(idcontrato,idcategoria,idsubcategoria);
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
			
		}
	});
	
	/*$('#grid').on('click','i.accion',function(){
		ruta = $(this).attr('ruta');
		idactividad = $(this).attr('id');
		estado = $(this).attr('idestado');
		datos = 'idactividad='+idactividad+'&estado='+estado+'&ruta='+ruta;
		$.getJSON(base_url+'doc/actividad/cambiar_estado',datos,function(json){
			if(json.msg>0){
				alert('La actividad ha sido '+json.text);
				idcontrato = $('select#act-contrato').val();
				idcategoria = $('select#act-categoria-select').val();
				idsubcategoria = $('select#act-subcategoria-select').val();
				loadTable(idcontrato,idcategoria,idsubcategoria);
				if(estado!=5){
					$('form#form-evidencia-documental input#idactividad').val(idactividad);
					$('form#form-evidencia-documental input#idestado').val(estado);
					$('div#modal-evidencia-documental').modal();
					//$('div#modal-evidencia-documental').modal({});
				}
			}else{
				alert('Ha ocurrido un error, intente nuevamente');
			}
		})
		
	});
	
	
	
	var options = { 
    	beforeSend: function(){
        	$("#progress").hide();
        	//clear everything
        	$("#bar").width('0%');
        	$("#message").html("");
        	$("#percent").html("0%");
    	},
    	uploadProgress: function(event, position, total, percentComplete){
        	$("#bar").width(percentComplete+'%');
        	$("#percent").html(percentComplete+'%');
 		},
    	success: function(){
        	$("#bar").width('100%');
        	$("#percent").html('100%');
    	},
		complete: function(response){
			//$("#message").html("<font color='green'>"+response.responseText+"</font>");
			alert(response.responseText);
			idactividad = $('input#idactividad').val();
			idestado = $('input#idestado').val();
			loadEvidencias(idactividad,idestado);
		},
		error: function(){
			//$("#message").html("<font color='red'> ERROR: Intente nuevamente</font>");
			alert('Ocurrio un error, intente nuevamente');
		}
	};
	$("#form-evidencia-documental").ajaxForm(options);
	
	*/
	
	$('#actividad-areas').on('click','input.area',function(){
		idarea = $(this).val();
		idactividad = $(this).attr("idactividad");
		estado = $(this).attr("estado");
		nuevo = (estado==0)?1:0;
		mensaje = (estado==0)?'agregada':'eliminada';
		datos = 'idarea='+idarea+'&idactividad='+idactividad+'&estado='+estado;
		$.getJSON(base_url+'doc/actividad/agregar_atividad_area',datos,function(json){
			if(json.msg>0){
				alert('El area ha sido '+mensaje);
				$('input#'+idactividad+'_'+idarea).attr('estado',nuevo);
			}else{
				alert('Ha ocurrido un error, intente nuevamente');	
			}
		});
	});
	
	$('#grid').on('click','a.modificar-actividad',function(){

		contrato = $("select#act-contrato option:selected").val();
		categoria = $("select#act-categoria-select option:selected").val();
		subcategoria = $("select#act-subcategoria-select option:selected").val();

		$("#mod-contrato").attr('selected','selected').val(contrato);
		$("#mod-categoria").attr('selected','selected').val(categoria);
		$("#mod-subcategoria").attr('selected','selected').val(subcategoria);

		idactividad=$(this).attr('idactividad');
		datos = 'idactividad='+idactividad;
		$('input#modificar-idactividad').val(idactividad);
		$.getJSON(base_url+'doc/actividad/buscar',datos,function(json){
			$('textarea#modificar-nombre').val(json[0].nombre_actividad);
			$('textarea#modificar-descripcion').val(json[0].descripcion_actividad);
			$('input#modificar-documento').val(json[0].documento_contractual);
			$('input#modificar-area').val(json[0].empresa_responsable);
			$('input#modificar-persona').val(json[0].persona_responsable);
			$('input#modificar-referencia').val(json[0].referencia_documental);
			$('textarea#modificar-detalle').val(json[0].detalle_referencia);
			$('textarea#modificar-observaciones').val(json[0].observacion);
		}).done(function(){
			areas='';
			$.getJSON(base_url+'doc/actividad/desplegar_actividad_area',datos,function(json1){
				$.each(json1,function(x,y){
					areas = areas+'<div class="checkbox"><label>'+y.checkbox+'</label>&nbsp;<i id="'+y.idarea_involucrada+'" class="info_area fa fa-info-circle"></i><div id="area'+y.idarea_involucrada+'"></div></div>';
				});
				$('div#modificar-areas').html(areas);
			})
		});
		$('#modal-modificar-actividad').modal();
	});
	
	$('div#modal-modificar-actividad').on('click','i.info_area',function(){
		idarea=($(this).attr('id'));		
		datos='idarea='+idarea;
		var info='';
		$('div#area'+idarea).toggle();
		$.getJSON(base_url+'doc/actividad/usuarios_area',datos,function(json){
			if(json.length==0){
				$('div#area'+idarea).html('<span style="font-size:10px">No existen usuarios para notificar</span>');				
			}
			else{
				$.each(json,function(x,y){
					info = info +'<span style="font-size:10px">'+y.usuario+' <b>Nivel: '+y.idnivel+'</b></span><br/>';
				});
				$('div#area'+idarea).html(info);
			}
		});
		
	});
	
	$('#btn-modificar-actividad').click(function(){
		idcontrato = $('select#mod-contrato').val();
		idcategoria = $('select#mod-categoria').val();
		idsubcategoria = $('select#mod-subcategoria').val();
		//alert(idcontrato+' - '+ idcategoria+' - '+idsubcategoria)
		errores=0;
		$('form#form-modificar-actividad input.required, form#form-modificar-actividad textarea.required').each(function(index, element) {
            if($(this).val()==''){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		if($(".areas_i").is(':checked')){
			errores = errores+0;
		}
		else{
			errores=errores+1;
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{

			var mensaje = confirm("¿Está de modificar la actividad?");
			if(mensaje){
			            
				datos = $('form#form-modificar-actividad').serialize()+'&idcontrato='+idcontrato+'&idcategoria='+idcategoria+'&idsubcategoria='+idsubcategoria;
				$.getJSON(base_url+'doc/actividad/modificar',datos,function(json){
					if(json.msg>0){
						$('#modal-modificar-actividad').modal('hide');
						$("#act-contrato").attr('selected','selected').val(idcontrato).change();
						$("#act-categoria-select").attr('selected','selected').val(idcategoria).change();
						$("#act-subcategoria-select").attr('selected','selected').val(idsubcategoria);
						alert('La actividad ha sido modificada');

						loadTable(idcontrato,idcategoria,idsubcategoria);
					}else{
						alert('Ocurrio un error, intente nuevamente');
					}
				});
			}
		}
			
	});
	
});

/*function loadEvidencias(idactividad,idestado)
{
	for(i=2;i<=idestado;i++){
		var texto;
		if(i==2){texto='INICIADA'}
		if(i==3){texto='FINALIZADA'}
		if(i==4){texto='ENTREGADA'}
		datos = 'idactividad='+idactividad+'&idestado='+i;
		$.getJSON(base_url+'doc/actividad/desplegar_evidencias',datos,function(json){
			evidencias='<h5>EVIDENCIA DOCUMENTAL DE ACTIVIDAD AL SER '+texto+'</h5><table class="table table-striped table-condensed table-bordered"><tr><td>&nbsp</td><td>Documento</td><td>Registra</td><td align="center">Acci&oacute;n</td></tr>';
			n=0;
			$.each(json,function(x,y){
				n++;
				evidencias=evidencias+'<tr><td>'+n+'</td><td>'+y.documento+'</td><td>'+y.usuario_registra+'</td><td>'+y.boton+'</td></tr>';
			});
			evidencias=evidencias+'</table>';
			if(n>0){
				$('#detalle-evidencia-documental-'+i).html(evidencias);
			}else{
				$('#detalle-evidencia-documental-'+i).html('');
			}
		});
	}
}*/

function clearFields()
{
	$('form#form-agregar-actividad input.required').each(function(index, element) {
        $(this).val('');
    });
	$('form#form-agregar-actividad textarea.required').each(function(index, element) {
        $(this).val('');
    });
	$('form#form-agregar-actividad input:checkbox').each(function(index, element) {
        $(this).prop('checked',false);
    });
	
}

function loadAreas(idactividad)
{
	datos = 'idactividad='+idactividad;
	$.getJSON(base_url+'doc/actividad/desplegar_actividad',datos,function(json){
		$('#area-contrato').text(json[0].numero_contrato);
		$('#area-categoria').text(json[0].cat_categoria);
		$('#area-subcategoria').text(json[0].cat_subcategoria);
		$('#area-actividad').text(json[0].nombre_actividad);
		$('#area-descripcion').text(json[0].descripcion_actividad);
		$('#area-documento').text(json[0].documento_contractual);
		$('#area-empresa').text(json[0].empresa_responsable);
		$('#area-persona').text(json[0].persona_responsable);
		$('#area-referencia').text(json[0].referencia_documental);
		$('#area-detalle').text(json[0].detalle_referencia);
		$('#area-observacion').text(json[0].observacion);
	});
	
	
	$.getJSON(base_url+'doc/area/desplegar_activas',function(json){
		areas='';
		$.each(json,function(x,y){
			areas = areas+'<div class="checkbox"><label><input id="'+idactividad+'_'+y.idarea_involucrada+'" idactividad="'+idactividad+'" class="area" estado="0" type="checkbox" value="'+y.idarea_involucrada+'">'+y.nombre_area_involucrada+'</label></div>';
		});
		$('div#actividad-areas').html(areas);
	}).done(function(){
		$('div#modal-areas').modal();
	});
}

function loadTable(idcontrato,idcategoria,idsubcategoria)
{
	$("#act-categoria-select").attr('selected','selected').val(idcategoria);
	$("#act-subcategoria-select").attr('selected','selected').val(idsubcategoria);
	datos = 'idcontrato='+idcontrato+'&idcategoria='+idcategoria+'&idsubcategoria='+idsubcategoria;
	$.getJSON(base_url+'doc/actividad/desplegar',datos,function(json){
		$(function () {
			
            $("#grid").igGrid({
                width: '100%',
                columns: [	
					{ headerText: "ID", key: "idactividad", dataType: "string", width: "5%" },
					{ headerText: "ACTIVIDAD", key: "nombre_actividad", dataType: "string", width: "20%" },					
					{ headerText: "DESCRIPCION", key: "descripcion_actividad", dataType:"string", width: "30%" },
					{ headerText: "DOC CONTRACTUAL", key: "documento_contractual", dataType:"string", width: "30%" },
					{ headerText: "AREA/EMPRESA RESPONSABLE", key: "empresa_responsable", dataType:"string", width: "30%" },
					{ headerText: "PERSONA RESPONSABLE", key: "persona_responsable", dataType:"string", width: "30%" },
					{ headerText: "ESTADO", key: "estado_programada", dataType: "string", width: "10%"},
					{ headerText: "ACCION", key: "modificar", dataType: "string", width: "12%"}					
                ],
                
				autofitLastColumn: false,
    			autoGenerateColumns: false,
    			dataSource: json,
				dataRendered: function (evt, ui) {
					//ui.owner.element.find("tr td:nth-child(8)").css("text-align", "center");
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
                ]
            });
        });
	});
}