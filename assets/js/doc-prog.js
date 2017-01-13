$(document).ready(function(e) {
	//Iniciar calendario
    $('.datepicker').datetimepicker({
      pickTime: false
    });
	
	var f = new Date();
	anio = f.getFullYear();
	mes = (f.getMonth() +1).toString();
	mes = (mes.length>1)?mes:'0'+mes;
	dia = f.getDate().toString();
	dia = (dia.length>1)?dia:'0'+dia;
	var fecha = anio+'-'+mes+'-'+dia;
	
	
    $('select#prog-contrato').change(function(){
		idcontrato = $(this).val();
		if(idcontrato==0){
			$('div#prog-categoria-contenedor').html('');
		}else{
			datos = 'idcontrato='+idcontrato;
			opciones = '<b>CATEGOR&Iacute;A</b><select class="form-control" id="prog-categoria-select"><option value="0">- SELECCIONE -</option>';
			$.getJSON(base_url+'doc/programacion/categorias',datos,function(json){
				$.each(json,function(x,y){
					if(y.estado==1){
						opciones = opciones + '<option value="'+y.idcat_categoria+'">'+y.cat_categoria+'</option>';
					}
				});
				opciones = opciones + '</select>';	
				$('#prog-categoria-contenedor').html(opciones);
			});
		}
		$('div#prog-subcategoria-contenedor').html('');
		$('#prog-resultado').hide();
	});
	
	$('#prog-categoria-contenedor').on('change','select',function(){
		idcategoria = $(this).val();
		if(idcategoria==0){
			$('div#prog-subcategoria-contenedor').html('');
		}else{
			idcontrato = $('select#prog-contrato').val();
			datos = 'idcontrato='+idcontrato+'&idcategoria='+idcategoria;
			opciones2 = '<b>SUBCATEGOR&Iacute;A</b><select class="form-control" id="prog-subcategoria-select"><option value="0">- SELECCIONE -</option>';
			$.getJSON(base_url+'doc/programacion/subcategorias',datos,function(json1){
				$.each(json1,function(x,y){
					if(y.estado==1){
						opciones2 = opciones2 + '<option value="'+y.idcat_subcategoria+'">'+y.cat_subcategoria+'</option>';
					}
				});
				opciones2 = opciones2 + '</select>';	
				$('#prog-subcategoria-contenedor').html(opciones2);
			});
		}
		$('#prog-resultado').hide();
	});
	
	
	$('#prog-subcategoria-contenedor').on('change','select',function(){
		idsubcategoria = $(this).val();
		if(idsubcategoria==0){
			$('#prog-resultado').hide();
		}else{
			idcontrato = $('select#prog-contrato').val();
			idcategoria = $('select#prog-categoria-select').val();
			loadTable(idcontrato,idcategoria,idsubcategoria);
			$('input#idcontrato').val(idcontrato);
			$('input#idcategoria').val(idcategoria);
			$('input#idsubcategoria').val(idsubcategoria);
			$('#prog-resultado').show();
		}
	});
	
	$('#grid').on('click','a.programar-actividad',function(){
		var idactividad = $(this).attr('idactividad');
		var datos = 'idactividad='+idactividad;
		$('input#idactividad').val(idactividad);
		var notificacion='';
		$.getJSON(base_url+'doc/programacion/notificacion',datos,function(json3){
			notificacion = '<span style="font-size:12px">Seleccione a los involucrados que desea notificar de esta programaci\xf3n:</span><br/>';
			if (json3.length == 0 ){
     			$('#areas-notificacion').html('<span>No existen usuarios para notificar</span>');
			}
			else{
				$.each(json3,function(x,y){
					notificacion = notificacion + '<span id="area'+y.idarea_involucrada+'" style="font-size:10px; font-weight:bold;">'+y.nombre_area_involucrada+'</span>';
					$.getJSON(base_url+'doc/programacion/notificacion_usuarios','idarea='+y.idarea_involucrada,function(json1){
							usuarios='';
							$.each(json1,function(k,v){
								usuarios = usuarios + '<div class="checkbox" style="font-size:10px; margin-left:50px;padding-top:0px"><label><input type="checkbox" value="'+v.correo_usuario+'" name="correos[]" class="chek_correos">'+v.usuario+' <strong>&nbsp;&nbsp;NIVEL:'+v.idnivel+'</strong></label></div>';	
			
							});
							$(usuarios).insertAfter('span#area'+y.idarea_involucrada);
						});										
				});
				
				$('#areas-notificacion').html(notificacion);
			}
		});
							
		$.getJSON(base_url+'doc/actividad/buscar',datos,function(json){
			$('span#proyecto').text(json[0].nombre_proyecto);
			$('span#numero').text(json[0].numero_contrato);
			$('span#categoria').text(json[0].cat_categoria);
			$('span#subcategoria').text(json[0].cat_subcategoria);
			$('span#actividad').text(json[0].nombre_actividad);
			$('span#fecha').text(json[0].fecha_limite);
			$('span#descripcion').text(json[0].descripcion_actividad);
			$('span#area').text(json[0].empresa_responsable);
			$('span#persona').text(json[0].persona_responsable);
		}).done(function(){
			existente = '<table class="table table-condensed table-bordered"><tr><th>Id</th><th width="70%">Fecha L&iacute;mite</th><th width="30%">Acci&oacute;n</th></tr>';
			$.getJSON(base_url+'doc/programacion/buscar',datos,function(json2){
				var n=1;
				$.each(json2,function(x,y){
					existente = existente + '<tr id="fila'+y.idprogramacion+'"><td>'+y.idprogramacion+'</td><td><div><input value="'+y.fecha+'" type="text" class="form-control input-sm" readonly id="fecha_oculta'+y.idprogramacion+'"></div><div class="input-append input-group datepicker'+y.idprogramacion+'" style="display:none;" id="fecha_calendario'+y.idprogramacion+'"><input data-format="yyyy-MM-dd" value="'+y.fecha+'" type="text" class="form-control input-sm" readonly id="fecha'+y.idprogramacion+'"><script>$(".datepicker'+y.idprogramacion+'").datetimepicker({pickTime: false});</script><span class="input-group-addon add-on"><i data-date-icon="fa fa-calendar"></i></span></div></td><td align="center"><div id="programacion'+y.idprogramacion+'">'+y.modificar+'&nbsp;'+y.eliminar+'</div></td></tr>';
					n++;
				});
				existente = existente + '</table>';
				if(n>1){
					$('#programacion-existente').html(existente);
				}else{
					$('#programacion-existente').html('<span>No existen tareas programadas</span>');
				}
			}).done(function(){
				$('#modal-programar').modal();
			});
		});
	});
	
	
	$("input#repeticion").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || 
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	$('#prog-guardar-programacion').click(function(){
		if($('input#repeticion').val()==''){
			alert('Ingrese los campos correctamente');
		}else{
			datos = $('#prog-guardar-programacion-form').serialize()+'&'+$('input.chek_correos').serialize();			
			$.getJSON(base_url+'doc/programacion/agregar',datos,function(json){
				if(json.msg>0){
					alert('La programaci\xf3n ha sido registrada');
					$('#modal-programar').modal('hide');
					$('input#repeticion').val(1);
					$('select#periodo').val(1);
					$('input#fecha').val(fecha);
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	
	$('#programacion-existente').on('click','a.modificar_programacion',function(){
		idprogramacion = $(this).attr('idprogramacion');
		$('div#programacion'+idprogramacion+' a.modificar_programacion i').removeClass('fa-edit').addClass('fa-save');
		$('div#programacion'+idprogramacion+' a.modificar_programacion').removeClass('modificar_programacion').addClass('guardar_modificacion');
		$('input#fecha_oculta'+idprogramacion).hide();
		$('div#fecha_calendario'+idprogramacion).show();
	});
	
	$('#programacion-existente').on('click','a.guardar_modificacion',function(){
		var idprogramacion = $(this).attr('idprogramacion');
		fecha = $('input#fecha'+idprogramacion).val();
		datos = 'idprogramacion='+idprogramacion+'&fecha='+fecha;
		$.getJSON(base_url+'doc/programacion/editar',datos,function(json){
			if(json.msg>0){
				alert('La programaci\xf3nn ha sido modificada');
				$('div#programacion'+idprogramacion+' a.guardar_modificacion i').removeClass('fa-save').addClass('fa-edit');
		$('div#programacion'+idprogramacion+' a.guardar_modificacion').removeClass('guardar_modificacion').addClass('modificar_programacion');
				$('div#fecha_calendario'+idprogramacion).hide();
				new_date = $('div#fecha_calendario'+idprogramacion+' input').val();
				$('input#fecha_oculta'+idprogramacion).val(new_date);
				$('input#fecha_oculta'+idprogramacion).show();
			}else{
				alert('Ocurrio un error, intente nuevamente');
			}
		});
	});
	
	
	$('#programacion-existente').on('click','a.eliminar_programacion',function(){
		idprogramacion = $(this).attr('idprogramacion');
		datos = 'idprogramacion='+idprogramacion;
		if(confirm('Esta programaci\xf3n sera cancelada, desea continuar')){
			$.getJSON(base_url+'doc/programacion/cancelar',datos,function(json){
				if(json.msg>0){
					alert('La programaci\xf3nn ha sido cancelada');
					$('tr#fila'+idprogramacion).remove();
				}else{
					alert('Ocurri\xf3n un error, intene nuevamente');
				}	
			});
		}		
	});
	
});

function loadTable(idcontrato,idcategoria,idsubcategoria)
{
	datos = 'idcontrato='+idcontrato+'&idcategoria='+idcategoria+'&idsubcategoria='+idsubcategoria;
	$.getJSON(base_url+'doc/programacion/desplegar',datos,function(json){
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
					{ headerText: "ACCION", key: "accion", dataType: "string", width: "12%" },					
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
                ]
            });
        });
	});
}