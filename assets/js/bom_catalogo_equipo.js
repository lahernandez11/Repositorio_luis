$(document).ready(function(e) {
	loadTable();

    $('.agregar-equipo').click(function(){
		clearFields();
		$('#btn-editar-equipo').hide();
		$('#btn-agregar-equipo').show();
		$('#myModalLabel').text('Agregar equipo');
		$('#modal-catalogo-equipo').modal();
	});
	
	$('#btn-agregar-equipo').click(function(){
		errores = 0;
		$('#form-modal-equipo input.required').each(function(index, element) {
			valor = $.trim($(this).val())
            if(valor.length == 0 ){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-modal-equipo').serialize();
			$.getJSON(base_url+'bom/catalogo_equipo/agregar',datos,function(json){
				if(json.msg>0){
					alert('El equipo ha sido registrado');
					clearFields();
					$('#modal-catalogo-equipo').modal('hide');
					loadTable();
				}else{
					alert('El equipo no pudo ser registrado,intente nuevamente');
				}
			});
		}
	});
	
	$('#grid').on('click','a.modificar',function(){
		clearFields();
		idequipo = $(this).attr('idequipo');
		datos = 'idequipo='+idequipo;
		$.getJSON(base_url+'bom/catalogo_equipo/buscar',datos,function(json){
			$('input#equipo').val(json[0].nombre_equipo);
			$('input#clave').val(json[0].clave_equipo);
		}).done(function(){
			$('input#idequipo').val(idequipo);
			$('#btn-editar-equipo').show();
			$('#btn-agregar-equipo').hide();
			$('#myModalLabel').text('Modificar equipo');
			$('#modal-catalogo-equipo').modal();
		});
	});
	
	$('#btn-editar-equipo').click(function(){
		errores = 0;
		$('#form-modal-equipo input.required').each(function(index, element) {
			valor = $.trim($(this).val())
            if(valor.length == 0 ){
				errores = errores + 1;
				$(this).css('border','solid 1px red');
			}else{
				$(this).css('border','solid 1px #ccc');
			}
        });
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-modal-equipo').serialize();
			$.getJSON(base_url+'bom/catalogo_equipo/editar',datos,function(json){
				if(json.msg>0){
					alert('El equipo ha sido modificado');
					clearFields();
					$('#modal-catalogo-equipo').modal('hide');
					//loadTable();
					idequipo=$("#idequipo").val();
					actualiza(idequipo);
				}else{
					alert('El equipo no pudo ser modificado,intente nuevamente');
				}
			});
		}
	});
	
	
	$('#grid').on('click','a.estado',function(){
		idestado = $(this).attr('idestado');
		idequipo = $(this).attr('idequipo');
		datos = 'idequipo='+idequipo+'&idestado='+idestado;
		leyenda = (idestado==1)?'desactivado':'activado';
		$.getJSON(base_url+'bom/catalogo_equipo/cambiar',datos,function(json){
			if(json.msg>0){
				alert('El equipo ha sido '+leyenda);
				//loadTable();
				actualiza(idequipo);
			}else{
				alert('El equipo no ha podido ser '+leyenda+', intente nuevamente');
			}
		});
	});
});



function loadTable()
{
	$.getJSON(base_url+'bom/catalogo_equipo/desplegar',function(json){
		$("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "EQUIPO", key: "nombre_equipo", dataType: "string", width: "40%" },
					{ headerText: "CLAVE", key: "clave_equipo", dataType: "string", width: "20%" },
					{ headerText: "ESTADO", key: "cat_estado", dataType: "string", width: "20%" },
					{ headerText: "ACCI&Oacute;N", key: "botones", dataType: "string", width: "20%" },					
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

function actualiza(idequipo)
{
	idequipo='idequipo='+idequipo;	
	$.getJSON(base_url+'bom/catalogo_equipo/busca_equipo',idequipo,function(json0){
		$.each(json0,function(x,y){
			$( "tr.ui-state-focus td:eq( 0 )" ).html(y.nombre_equipo);
			$( "tr.ui-state-focus td:eq( 1 )" ).html(y.clave_equipo);
			$( "tr.ui-state-focus td:eq( 2 )" ).html(y.cat_estado);
			$( "tr.ui-state-focus td:eq( 3 )" ).html(y.botones);
		});						
	});
}

function clearFields()
{
	$('#form-modal-equipo input.required').each(function(index, element) {
    	$(this).val('');
    });
}