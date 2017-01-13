// JavaScript Document
$(document).ready(function(e) {
    loadTable();
	
	//Abrir modal para agregar
	$('#btn-abrir-agregar-area').click(function(){
		$('#myModalLabel').html('Agregar &aacute;rea');
		$('#btn-agregar-area').show();
		$('#btn-editar-area').hide();
		$('div#modal-alta-area').modal();
		clearFields();
	});
	
	
	//Agregar
	$('#btn-agregar-area').click(function(){
		errores = 0;
		if($('input#area').val()==''){
			errores = errores + 1;
			$('input#area').css('border','solid 1px red');
		}else{
			$('input#area').css('border','solid 1px #ccc');
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-agregar-area').serialize();
			$.getJSON(base_url+'doc/area/agregar',datos,function(json){
				if(json.msg>0){
					alert('El \xe1rea ha sido registrada');
					id_area = json.msg;
					datos_area = 'idarea='+id_area;
					$.getJSON(base_url+'doc/area/buscar',datos_area,function(json){
						$('input#area').val(json[0].nombre_area_involucrada);
						$('input#idarea').val(json[0].idarea_involucrada);
					});
					//$('div#modal-alta-area').modal('hide');
					$('#btn-agregar-area').hide();
					$('#btn-editar-area').show();
					loadUsuarios(json.msg);
					clearFields();
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});	
	
	$('#modal-alta-area').on('keyup','input#nivel',function(){
		this.value = this.value.replace(/[^1-9\.]/g,'');
	});
	
	//Agregar usuario area
	$('#modal-alta-area').on('click','a.agregar-usuario',function(){
		var usuario = $('select#usuario').val();
		var nivel = $('select#nivel').val();
		var idarea = $('input#idarea_inv').val();
		errores = 0;
		
		if(usuario==0){
			errores = errores + 1;
		}
		
		if(nivel==''){
			errores = errores + 1;
		}	
		
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = 'idarea='+idarea+'&usuario='+usuario+'&nivel='+nivel;
			$.getJSON(base_url+'doc/area/agregar_usuario',datos,function(json){
				if(json.msg>0){
					alert('El usuario ha sido agregado al \xe1rea');
					loadUsuariosAgregados(idarea);
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	$('#modal-alta-area').on('click','a.cancelar-usuario',function(){
		idnivel_area_usuario = $(this).attr("idnivel_area_usuario");
		var idarea_involucrada = $(this).attr("idarea_involucrada");
		datos = 'idnivel_area_usuario='+idnivel_area_usuario;
		$.getJSON(base_url+'doc/area/cancelar_usuario',datos,function(json){
			if(json.msg>0){
				alert('El usuario ha sido eliminado del \xe1rea');
				loadUsuariosAgregados(idarea_involucrada)
			}else{
				alert('Ocurrio un error, intente nuevamente');
			}
		});
	});
	
	
	//abrir modal editar categoria
	$('#grid').on('click','a.modificar',function(){
		clearFields();
		idarea = $(this).attr('idarea_involucrada');
		$('input#idarea').val(idarea);
		datos = 'idarea='+idarea;
		$('#myModalLabel').html('Editar &aacute;rea');
		$('#btn-agregar-area').hide();
		$('#btn-editar-area').show();
		$.getJSON(base_url+'doc/area/buscar',datos,function(json){
			$('input#area').val(json[0].nombre_area_involucrada);
		}).done(function(){
			$('div#modal-alta-area').modal();
			loadUsuarios(idarea)
		});
	});
	
	
	//Editar 
	$('#btn-editar-area').click(function(){
		errores = 0;
		if($('input#area').val()==''){
			errores = errores + 1;
			$('input#area').css('border','solid 1px red');
		}else{
			$('input#area').css('border','solid 1px #ccc');
		}
		
		if(errores>0){
			alert('Llene los campos correctamente');
		}else{
			datos = $('#form-agregar-area').serialize();
			$.getJSON(base_url+'doc/area/editar',datos,function(json){
				if(json.msg>0){
					alert('El \xe1rea ha sido modificada');
					//$('div#modal-alta-estado-actividad').modal('hide');
					//clearFields();
					loadTable();
					ar = $('input#area').val();
					$('span#caption').text(ar);
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	//Cambiar estado
	$('#grid').on('click','a.cancelar',function(){
		estado = $(this).attr('estado');
		idarea = $(this).attr('idarea_involucrada');
		datos = 'idarea='+idarea+'&estado='+estado;
		leyenda = (estado==1)?'desactivada':'activada';
		if(confirm('EL \xe1rea sera '+leyenda+', desea continuar?')){
			$.getJSON(base_url+'doc/area/cancelar',datos,function(json){
				if(json.msg>0){
					alert('El \xe1rea ha sido '+leyenda);
					loadTable();
				}else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});

	 
});

function loadUsuarios(idarea)
{
	$.getJSON(base_url+'doc/area/desplegar_usuarios_intranet',function(json){
		usuarios='<fieldset class="well the-fieldset" id="fieldset_usuarios"><legend class="the-legend">Usuarios</legend><div class="row"><div class="col-md-7"><select id="usuario" class="form-control"><option value="0">- SELECCIONE USUARIO -</option>';
		$.each(json,function(x,y){
			usuarios=usuarios+'<option value="'+y.nombre+'/'+y.correo+'">'+y.nombre+'</option>';
		});
		usuarios=usuarios+'</select></div><div class="col-md-3" id="combo-niveles"></div><div class="col-md-2"><input type="hidden" id="idarea_inv" value="'+idarea+'"><a class="btn btn-success agregar-usuario"><i class="fa fa-plus"></i></a></div></div><div id="usuarios-agregados"></div></fieldset>';
		$('div#combo-usuarios').html(usuarios);
	}).done(function(){
		loadNiveles();
		loadUsuariosAgregados(idarea);
	});        				
}

function loadNiveles()
{
	$.getJSON(base_url+'doc/area/desplegar_niveles',function(json){
		niveles='<select id="nivel" class="form-control">';
		$.each(json,function(x,y){
			niveles=niveles+'<option value="'+y.idnivel+'">'+y.idnivel+'-'+y.descripcion_nivel+'</option>';
		});
		niveles=niveles+'</select>';
		$('div#combo-niveles').html(niveles);
	});
}
//<input type="text" id="nivel" class="form-control" placeholder="Nivel">

function loadUsuariosAgregados(idarea)
{
	var datos='idarea='+idarea;
	$.getJSON(base_url+'doc/area/buscar',datos,function(json){
		return area = json[0].nombre_area_involucrada;
		//$('span#caption').text(area);
	}).done(function(){
		$.getJSON(base_url+'doc/area/desplegar_usuarios_agregados',datos,function(json1){
			table='<br><b>Usuarios agregados al &aacute;rea <span id="caption">'+area+'</span>:</b><br><br><table style="font-size:10px;" class="table table-condensed table-bordered table-striped"><tr><th>Usuario</th><th>Correo</th><th>Nivel</th><th>Acci&oacute;n</th></tr>';
			n=0;
				$.each(json1,function(u,v){
					table=table+'<tr><td>'+v.usuario+'</td><td>'+v.correo_usuario+'</td><td>'+v.idnivel+'</td><td align="center"><a class="btn btn-danger btn-xs cancelar-usuario" idnivel_area_usuario="'+v.id_nivel_area_usuario+'" idarea_involucrada="'+v.idarea_involucrada+'"><i class="fa fa-minus"></i></a></td></tr>';
				$n=n+1;
				});
			table=table+'</table>';
				$('div#usuarios-agregados').html(table)
		});
	
	});
}

//Consultar categorias
function loadTable()
{
	$.getJSON(base_url+'doc/area/desplegar',function(json){
		$(function () {
            $("#grid").igGrid({
                width: '100%',
                columns: [
		    	    { headerText: "AREA INVOLUCRADA", key: "nombre_area_involucrada", dataType: "string", width: "20%" },
					{ headerText: "ESTADO", key: "estado_area", format: "date",width: "10%"},						
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
	$('input#area').val('');
	$('input#idarea').val('');
	$('div#combo-usuarios').html('');
}

