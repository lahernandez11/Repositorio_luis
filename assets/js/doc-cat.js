$(document).ready(function(e) {
    loadTable();
	
	//Abrir modal para agregar categoria
	$('#btn-abrir-agregar-categoria').click(function(){
		$('#myModalLabel').html('Agregar Categoria');
		$('#btn-agregar-categoria').show();
		$('#btn-editar-categoria').hide();
		$('div#modal-alta-categoria').modal();
		clearFields();
	});
	
	//Agregar categoria
	$('#btn-agregar-categoria').click(function(){
		errores = 0;
		if($('input#categoria').val()==''){
			errores = errores + 1;
			$('input#categoria').css('border','solid 1px red');
		}else{
			$('input#categoria').css('border','solid 1px #ccc');
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-agregar-categoria').serialize();
			$.getJSON(base_url+'doc/categoria/agregar',datos,function(json){
				if(json.msg>0){
					alert('La categoria ha sido registrada');
					$('div#modal-alta-categoria').modal('hide');
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
		idcategoria = $(this).attr('idcategoria');
		$('input#idcategoria').val(idcategoria);
		datos = 'idcategoria='+idcategoria;
		$('#myModalLabel').html('Editar Categoria');
		$('#btn-agregar-categoria').hide();
		$('#btn-editar-categoria').show();
		$.getJSON(base_url+'doc/categoria/buscar',datos,function(json){
			$('input#categoria').val(json[0].cat_categoria);
		}).done(function(){
			$('div#modal-alta-categoria').modal();
		});
	});
	
	//Editar categoria
	$('#btn-editar-categoria').click(function(){
		errores = 0;
		if($('input#categoria').val()==''){
			errores = errores + 1;
			$('input#categoria').css('border','solid 1px red');
		}else{
			$('input#categoria').css('border','solid 1px #ccc');
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-agregar-categoria').serialize();
			$.getJSON(base_url+'doc/categoria/editar',datos,function(json){
				if(json.msg>0){
					alert('La categoria ha sido modificada');
					$('div#modal-alta-categoria').modal('hide');
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
		idcategoria = $(this).attr('idcategoria');
		datos = 'idcategoria='+idcategoria+'&estado='+estado;
		leyenda = (estado==1)?'desactivada':'activada';
		if(confirm('La categoria sera '+leyenda+', desea continuar?')){
			$.getJSON(base_url+'doc/categoria/cancelar',datos,function(json){
				if(json.msg>0){
					alert('La categoria ha sido '+leyenda);
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	$('#catxcont_contrato').change(function(){
		idcontrato = $(this).val();
		if(idcontrato==0){
			$('#lista-categorias').html('');
		}else{
			datos = 'idcontrato='+idcontrato;
			lista ='<h5><strong>Categorias</strong></h5><ul class="lista">';
			
			$.getJSON(base_url+'doc/categoria_contrato/categorias',datos,function(json){
				n=0;
				$.each(json, function(x,y){
					n++;
					lista = lista + '<li id="'+n+'" style="color:'+y.color+'" idcategoria="'+y.idcat_categoria+'" idestado="'+y.estado+'">'+y.cat_categoria+'</li>';
				});
			lista = lista + '</ul>';
			$('#lista-categorias').html(lista);
			});
		}
			
		
	});

	$('#lista-categorias').on('click','li',function(){
		var id = $(this).attr('id');
		idcategoria = $(this).attr('idcategoria');
		idestado = $(this).attr('idestado');
		idcontrato = $('select#catxcont_contrato').val();
		datos = 'idcategoria='+idcategoria+'&idcontrato='+idcontrato+'&idestado='+idestado;
		new_color = (idestado=='0')?'green':'red';
		new_state = (idestado=='0')?'1':'0';
		$.getJSON(base_url+'doc/categoria_contrato/cambiar',datos,function(json){
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
	$.getJSON(base_url+'doc/categoria/desplegar',function(json){
		$(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "CATEGORIA", key: "cat_categoria", dataType: "string", width: "20%" },
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
	$('input#categoria').val('');
	$('input#idcategoria').val('');
}

