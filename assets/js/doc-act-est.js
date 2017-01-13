$(document).ready(function(e) {
    loadTable();
	
	//Abrir modal para agregar
	$('#btn-abrir-agregar-estado-actividad').click(function(){
		$('#myModalLabel').html('Agregar estado actividad');
		$('#btn-agregar-estado-actividad').show();
		$('#btn-editar-estado-actividad').hide();
		$('div#modal-alta-estado-actividad').modal();
		clearFields();
	});
	
	
	//Agregar
	$('#btn-agregar-estado-actividad').click(function(){
		errores = 0;
		if($('input#estado').val()==''){
			errores = errores + 1;
			$('input#estado').css('border','solid 1px red');
		}else{
			$('input#estado').css('border','solid 1px #ccc');
		}
		
		if($('input#descripcion').val()==''){
			errores = errores + 1;
			$('input#descripcion').css('border','solid 1px red');
		}else{
			$('input#descripcion').css('border','solid 1px #ccc');
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-agregar-estado-actividad').serialize();
			$.getJSON(base_url+'doc/actividad_estado/agregar',datos,function(json){
				if(json.msg>0){
					alert('El estado de actividad ha sido registrado');
					$('div#modal-alta-estado-actividad').modal('hide');
					clearFields();
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	//abrir modal editar categoria
	$('#grid').on('click','a.modificar',function(){
		idestado_actividad = $(this).attr('idestado_actividad');
		$('input#idestado_actividad').val(idestado_actividad);
		datos = 'idestado_actividad='+idestado_actividad;
		$('#myModalLabel').html('Editar estado actividad');
		$('#btn-agregar-estado-actividad').hide();
		$('#btn-editar-estado-actividad').show();
		$.getJSON(base_url+'doc/actividad_estado/buscar',datos,function(json){
			$('input#estado').val(json[0].estado_actividad);
			$('input#descripcion').val(json[0].descripcion_dashboard);
		}).done(function(){
			$('div#modal-alta-estado-actividad').modal();
		});
	});
	
	//Editar 
	$('#btn-editar-estado-actividad').click(function(){
		errores = 0;
		if($('input#estado').val()==''){
			errores = errores + 1;
			$('input#estado').css('border','solid 1px red');
		}else{
			$('input#estado').css('border','solid 1px #ccc');
		}
		
		if($('input#descripcion').val()==''){
			errores = errores + 1;
			$('input#descripcion').css('border','solid 1px red');
		}else{
			$('input#descripcion').css('border','solid 1px #ccc');
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-agregar-estado-actividad').serialize();
			$.getJSON(base_url+'doc/actividad_estado/editar',datos,function(json){
				if(json.msg>0){
					alert('El estado actividad ha sido modificado');
					$('div#modal-alta-estado-actividad').modal('hide');
					clearFields();
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	//Cambiar estado
	$('#grid').on('click','a.cancelar',function(){
		estado = $(this).attr('estado');
		idestado_actividad = $(this).attr('idestado_actividad');
		datos = 'idestado_actividad='+idestado_actividad+'&estado='+estado;
		leyenda = (estado==1)?'desactivado':'activado';
		if(confirm('El estado de actividad sera '+leyenda+', desea continuar?')){
			$.getJSON(base_url+'doc/actividad_estado/cancelar',datos,function(json){
				if(json.msg>0){
					alert('El estado de actividad ha sido '+leyenda);
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});

	 
});

//Consultar categorias
function loadTable()
{
	$.getJSON(base_url+'doc/actividad_estado/desplegar',function(json){
		$(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "ESTADO ACTIVIDAD", key: "estado_actividad", dataType: "string", width: "20%" },
					{ headerText: "DESCRIPCION", key: "descripcion_dashboard", dataType: "string", width: "20%" },
					{ headerText: "ESTADO", key: "nombre_estado", format: "date",width: "10%"},						
					{ headerText: "ACCION", key: "botones", dataType: "string", width: "10%"}
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
	$('input#estado').val('');
	$('input#descripcion').val('');
	$('input#idestado_actividad').val('');
}

