$(document).ready(function(e) {
    loadTable();
	
	//Abrir modal para agregar categoria
	$('#btn-abrir-agregar-subcategoria').click(function(){
		$('#myModalLabel').html('Agregar Subategoria');
		$('#btn-agregar-subcategoria').show();
		$('#btn-editar-subcategoria').hide();
		$('div#modal-alta-subcategoria').modal();
		clearFields();
	});
	
	//Agregar categoria
	$('#btn-agregar-subcategoria').click(function(){
		errores = 0;
		if($('input#subcategoria').val()==''){
			errores = errores + 1;
			$('input#subcategoria').css('border','solid 1px red');
		}else{
			$('input#subcategoria').css('border','solid 1px #ccc');
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-agregar-subcategoria').serialize();
			$.getJSON(base_url+'doc/subcategoria/agregar',datos,function(json){
				if(json.msg>0){
					alert('La subcategoria ha sido registrada');
					$('div#modal-alta-subcategoria').modal('hide');
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
		idsubcategoria = $(this).attr('idsubcategoria');
		$('input#idsubcategoria').val(idsubcategoria);
		datos = 'idsubcategoria='+idsubcategoria;
		$('#myModalLabel').html('Editar Subcategoria');
		$('#btn-agregar-subcategoria').hide();
		$('#btn-editar-subcategoria').show();
		$.getJSON(base_url+'doc/subcategoria/buscar',datos,function(json){
			$('input#subcategoria').val(json[0].cat_subcategoria);
		}).done(function(){
			$('div#modal-alta-subcategoria').modal();
		});
	});
	
	//Editar categoria
	$('#btn-editar-subcategoria').click(function(){
		errores = 0;
		if($('input#subcategoria').val()==''){
			errores = errores + 1;
			$('input#subcategoria').css('border','solid 1px red');
		}else{
			$('input#subcategoria').css('border','solid 1px #ccc');
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-agregar-subcategoria').serialize();
			$.getJSON(base_url+'doc/subcategoria/editar',datos,function(json){
				if(json.msg>0){
					alert('La subcategoria ha sido modificada');
					$('div#modal-alta-subcategoria').modal('hide');
					clearFields();
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	//Cambiar estado categoria
	$('#grid').on('click','a.cancelar',function(){
		estado = $(this).attr('estado');
		idsubcategoria = $(this).attr('idsubcategoria');
		datos = 'idsubcategoria='+idsubcategoria+'&estado='+estado;
		leyenda = (estado==1)?'desactivada':'activada';
		if(confirm('La subcategoria sera '+leyenda+', desea continuar?')){
			$.getJSON(base_url+'doc/subcategoria/cancelar',datos,function(json){
				if(json.msg>0){
					alert('La subcategoria ha sido '+leyenda);
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	$('#subcatxcont_contrato').change(function(){
		$('#lista-subcategorias').html('');
		idcontrato = $(this).val();
		if(idcontrato==0){
			$('#subcatxcont_categoria').html('<option value="0">- SELECCIONE -</option>');
			
		}else{
			datos = 'idcontrato='+idcontrato;
			categorias='<option value="0">- SELECCIONE -</option>';
			$.getJSON(base_url+'doc/subcategoria_contrato/categorias',datos,function(json){
				$.each(json,function(x,y){
					if(y.estado==1){
						categorias = categorias + '<option value="'+y.idcat_categoria+'">'+y.cat_categoria+'</option>';
					}
				});
			$('#subcatxcont_categoria').html(categorias);
			});	
		}
	});
	
	
	$('#subcatxcont_categoria').change(function(){
		if($(this).val()==0){
			$('#lista-subcategorias').html('');
		}else{
			idcategoria = $(this).val();
			idcontrato = $('#subcatxcont_contrato').val();
			datos = 'idcategoria='+idcategoria+'&idcontrato='+idcontrato;
			lista ='<h5><strong>Subcategor&iacute;as</strong></h5><ul class="lista">';
			$.getJSON(base_url+'doc/subcategoria_contrato/subcategorias',datos,function(json1){
				n=0;
				$.each(json1, function(x,y){
					n++;
					lista = lista + '<li id="'+n+'" style="color:'+y.color+'" idsubcategoria="'+y.idcat_subcategoria+'" idestado="'+y.estado+'">'+y.cat_subcategoria+'</li>';
				});
				lista = lista + '</ul>';
				$('#lista-subcategorias').html(lista);	
			});	
		}
		
	});
	
	$('#lista-subcategorias').on('click','li',function(){
		var id = $(this).attr('id');
		idsubcategoria = $(this).attr('idsubcategoria');
		idestado = $(this).attr('idestado');
		idcontrato = $('select#subcatxcont_contrato').val();
		icategoria = $('select#subcatxcont_categoria').val();
		datos = 'idcategoria='+idcategoria+'&idcontrato='+idcontrato+'&idestado='+idestado+'&idsubcategoria='+idsubcategoria;
		new_color = (idestado=='0')?'green':'red';
		new_state = (idestado=='0')?'1':'0';
		$.getJSON(base_url+'doc/subcategoria_contrato/cambiar',datos,function(json){
			if(json.msg==1){
				$('li#'+id).css('color',new_color);
				$('li#'+id).attr('idestado',new_state);	
			}else{
				alert('Ocurrio un error, intente nuevamente');
			}
		
		});
	});

	 
});

//Consultar categorias
function loadTable()
{
	$.getJSON(base_url+'doc/subcategoria/desplegar',function(json){
		$(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "SUBCATEGORIA", key: "cat_subcategoria", dataType: "string", width: "20%" },
					{ headerText: "ESTADO", key: "cat_estado", format: "date",width: "10%"},						
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
	$('input#subcategoria').val('');
	$('input#idsubcategoria').val('');
}

