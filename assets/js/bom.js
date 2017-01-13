$(document).ready(function(e) {	
	//Agregar Area
	$('div.main').on('click','.agregar_area',function(){
		actual = $(this).attr("n");
		sig  = actual + 1;
		area = $('div#contenedor'+actual+' input').val();
		datos = "area="+area;
		div ='<div id="contenedor'+sig+'"><div class="form-group"><input type="text" class="form-control" id="area'+sig+'" n="'+sig+'" name="area'+sig+'" placeholder="Ingrese area" size="30"></div>&nbsp;<a href="#" id="boton_agregar'+sig+'"  class="btn btn-success agregar_area" n="'+sig+'"><i class="fa fa-plus"></i></a></div>';
		if(area!=''){
			$.getJSON(base_url+'bom/area/agrega_area',datos,function(data){
				if(data.msg!='ko'){
					falla = '<a href="#" id="falla'+actual+'" n="'+actual+'" idarea="'+data.msg+'" class="btn btn-success agregar_falla"><i class="fa fa-plus"></i><i class="fa fa-warning"></i></a>';
					$('a#boton_agregar'+actual).removeClass('btn-success').removeClass('agregar_area').addClass('btn-warning').addClass('modificar_area');
					$('a#boton_agregar'+actual+' i').removeClass('fa-plus').addClass('fa-edit');
					$('div#contenedor'+actual+' input').attr('readonly',true);
					$(div).insertAfter('#contenedor'+actual);
					$(falla).insertAfter('a#boton_agregar'+actual);
					$('a#boton_agregar'+actual).attr("idarea",data.msg);
					}else{
						alert('Ocurrió un error, intente nuevamente');
						}
				});
			}
		});
		
	//Habilitar Edicion Area
	$('div.main').on('click','.modificar_area',function(){
		idarea = $(this).attr('idarea');
		area = $('div#contenedor'+actual+' input');
		area.attr('readonly',false);
		$('div#contenedor'+actual+' a.modificar_area').removeClass('btn-warning').removeClass('modificar_area').addClass('btn-success').addClass('guardar_area');	
		$('div#contenedor'+actual+' i.fa-edit').removeClass('fa-edit').addClass('fa-save');	
		});
		
	//Habilitar Edicion Area Anterior
	$('div.main').on('click','.modificar_area_anterior',function(){
		actual = $(this).attr('idarea');
		area = $('div#contenedor_anterior'+actual+' input');
		area.attr('readonly',false);
		$('div#contenedor_anterior'+actual+' a.modificar_area_anterior').removeClass('btn-warning').removeClass('modificar_area_anterior').addClass('btn-success').addClass('guardar_area_anterior');	
		$('div#contenedor_anterior'+actual+' i.fa-edit').removeClass('fa-edit').addClass('fa-save');	
		});
		
	//Guardar Modificacion de Area
	$('div.main').on('click','.guardar_area',function(){
		idarea = $(this).attr('idarea');
		actual = $(this).attr('n');
		console.log(actual);
		area = $('div#contenedor'+actual+' input');
		if(area.val()!=''){
			datos = 'idarea='+idarea+'&area='+area.val();
			$.getJSON(base_url+'bom/area/modifica_area',datos,function(data){
				if(data.msg!='ko'){
					area.attr('readonly',true);
					$('div#contenedor'+actual+' a.guardar_area').removeClass('btn-success').removeClass('guardar_area').addClass('btn-warning').addClass('modificar_area');
					$('div#contenedor'+actual+' i.fa-save').removeClass('fa-save').addClass('fa-edit');
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
			
			}
		});
	
	//Guardar Modificacion de Area Anterior
	$('div.main').on('click','.guardar_area_anterior',function(){
		actual = $(this).attr('idarea');
		area = $('div#contenedor_anterior'+actual+' input');
		if(area.val()!=''){
			datos = 'idarea='+actual+'&area='+area.val();
			$.getJSON(base_url+'bom/area/modifica_area',datos,function(data){
				if(data.msg!='ko'){
					area.attr('readonly',true);
					$('div#contenedor_anterior'+actual+' a.guardar_area_anterior').removeClass('btn-success').removeClass('guardar_area_anterior').addClass('btn-warning').addClass('modificar_area_anterior');
					$('div#contenedor_anterior'+actual+' i.fa-save').removeClass('fa-save').addClass('fa-edit');
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
			}
		});
		
	//Mostrar Fallas de Area
	$('div.main').on('click','.agregar_falla',function(){
		area = $(this).attr("idarea");
		//console.log(area);
		datos='area='+area;
		$.post(base_url+'bom/area/carga_falla',datos,function(data){
			$('div#falla').html(data);
			});
		});
	
	//Agregar Falla	
	$('div.main').on('click','.guardar_falla',function(){
		actual = $(this).attr('n');
		sig  = actual + 1;
		idarea = $('input#idarea').val();
		falla= $('#contenedor-falla'+actual+' input').val();
		clasificacion=$('#contenedor-falla'+actual+' select').val();
		datos = 'idarea='+idarea+'&falla='+falla+'&idclasificacion='+clasificacion;
		if(falla!='' && clasificacion!=0){
			$.getJSON(base_url+'bom/area/agrega_falla',datos,function(data){
				if(data.msg!='ko'){
					div ='<div id="contenedor-falla'+sig+'"><div class="form-group"><input type="text" class="form-control" id="falla'+sig+'" n="'+sig+'" name="falla'+sig+'" placeholder="Ingrese falla" size="50"></div>&nbsp;<a href="#" id="boton_guardar'+sig+'"  class="btn btn-success guardar_falla" n="'+sig+'"><i class="fa fa-plus"></i></a></div>';
					$('a#boton_guardar'+actual).removeClass('btn-success').removeClass('guardar_falla').addClass('btn-warning').addClass('modificar_falla');
					$('a#boton_guardar'+actual+' i').removeClass('fa-plus').addClass('fa-edit');
					$('div#contenedor-falla'+actual+' input').attr('readonly',true);
					$('div#contenedor-falla'+actual+' input').attr('idfalla',data.msg);
					$(div).insertAfter('#contenedor-falla'+actual);
					
					$('#clasificacion1').clone().attr('id', 'clasificacion'+sig).insertAfter('#falla'+sig+':last');
					$("#clasificacion"+sig).attr('name','clasificacion'+sig);
					$("#clasificacion"+sig).attr('n','n'+sig);
					$('div#contenedor-falla'+sig+' select').attr('disabled',false);
					$('div#contenedor-falla'+actual+' select').attr('disabled',true);
					
				}
				else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
			}
		});
		
		
	//Habilitar Edicion Falla
	$('div.main').on('click','.modificar_falla',function(){
		actual = $(this).attr('n');
		falla = $('div#contenedor-falla'+actual+' input');
		f_select = $('div#contenedor_falla_anterior'+actual+' select');
		falla.attr('disabled',false);
		f_select.attr('disabled',false);
		$('div#contenedor-falla'+actual+' a.modificar_falla').removeClass('btn-warning').removeClass('modificar_falla').addClass('btn-success').addClass('guardar_falla_modificacion');	
		$('div#contenedor-falla'+actual+' i.fa-edit').removeClass('fa-edit').addClass('fa-save');	
		});
		
	//Habilitar Edicion Falla Anterior
	$('div.main').on('click','.modificar_falla_anterior',function(){
		actual = $(this).attr('falla');
		falla = $('div#contenedor_falla_anterior'+actual+' input');
		f_select = $('div#contenedor_falla_anterior'+actual+' select');
		falla.attr('disabled',false);
		f_select.attr('disabled',false);
		$('div#contenedor_falla_anterior'+actual+' a.modificar_falla_anterior').removeClass('btn-warning').removeClass('modificar_falla_anterior').addClass('btn-success').addClass('guardar_falla_modificacion_anterior');	
		$('div#contenedor_falla_anterior'+actual+' i.fa-edit').removeClass('fa-edit').addClass('fa-save');	
		});
		
	//Guardar Modificacion de Falla
	$('div.main').on('click','.guardar_falla_modificacion',function(){
		actual = $(this).attr('n');
		console.log(actual);
		idfalla = $('div#contenedor-falla'+actual+' input').attr("idfalla");
		falla = $('div#contenedor-falla'+actual+' input');
		clasificacion = $('div#contenedor-falla'+actual+' select');
		if(falla.val()!='' && clasificacion!=0){
			datos = 'idfalla='+idfalla+'&falla='+falla.val()+'&idclasificacion='+clasificacion.val();
			$.getJSON(base_url+'bom/area/modifica_falla',datos,function(data){
				if(data.msg!='ko'){
					falla.attr('disabled',true);
					f_select.attr('disabled',true);
					$('div#contenedor-falla'+actual+' a.guardar_falla_modificacion').removeClass('btn-success').removeClass('guardar_falla_modificacion').addClass('btn-warning').addClass('modificar_falla');
					$('div#contenedor-falla'+actual+' i.fa-save').removeClass('fa-save').addClass('fa-edit');
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
			}
		});
		
	//Guardar Modificacion de Falla Anterior
	$('div.main').on('click','.guardar_falla_modificacion_anterior',function(){
		actual = $(this).attr('falla');
		falla = $('div#contenedor_falla_anterior'+actual+' input');
		clasificacion = $('div#contenedor_falla_anterior'+actual+' select');
		if(falla.val()!='' && clasificacion!=0){
			datos = 'idfalla='+actual+'&falla='+falla.val()+'&idclasificacion='+clasificacion.val();
			console.log(datos);
			$.getJSON(base_url+'bom/area/modifica_falla',datos,function(data){
				if(data.msg!='ko'){
					falla.attr('disabled',true);
					f_select.attr('disabled',true);
					$('div#contenedor_falla_anterior'+actual+' a.guardar_falla_modificacion_anterior').removeClass('btn-success').removeClass('guardar_falla_modificacion_anterior').addClass('btn-warning').addClass('modificar_falla_anterior');
					$('div#contenedor_falla_anterior'+actual+' i.fa-save').removeClass('fa-save').addClass('fa-edit');
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
			}
		});	
	
		
		
		
	//Registro de Reporte
	$('select#registro-area').change(function(){
		$('div#registro-clasificacion').html('<select name="registro-clasificacion" id="registro-clasificacion" class="form-control" ><option value="0">--</option></select>');
		if($(this).val()=='31'){
			plaza = $('select#registro-plaza').val();
			datos='plaza='+plaza;
			$.post(base_url+'bom/registro/carga_carriles',datos,function(data){
				$('div#registro-carril').html(data);
				});
			}else{
				$('div#registro-carril').html('<select name="registro-carril" id="registro-carril" class="form-control" disabled><option value="0">--</option></select>');				
				}
		datos2 = 'area='+$(this).val();
		$.post(base_url+'bom/registro/carga_fallas',datos2,function(data){
				$('div#registro-falla').html(data);
			});
		
		});
		
	$('div#registro-falla').click(function(){
			$("select#registro-falla").change(function(){
				falla = $('select#registro-falla').val();
				datos='falla='+falla;
				$.post(base_url+'bom/registro/carga_clasificacion',datos,function(data){
					$('div#registro-clasificacion').html(data);
				});
			});		
	});
	
	$('div#registro-clasificacion').click(function(){
		$('select#registro-clasificacion').change(function(){
			valor=$('select#registro-clasificacion').val();
			if(valor==1){
				$('select#registro-clasificacion').css("background-color","#269ABC");
			}
			if(valor==2){
				$('select#registro-clasificacion').css("background-color","#ED9C28");
			}
			if(valor==3){
				$('select#registro-clasificacion').css("background-color","red");
			}
		});
	});
	
		
	$('select#registro-plaza').change(function(){
		plaza = $('select#registro-plaza').val();
		datos='plaza='+plaza;
		if($('select#registro-area').val()=='31'){
			$.post(base_url+'bom/registro/carga_carriles',datos,function(data){
				$('div#registro-carril').html(data);
				});
			}else{
				$('div#registro-carril').html('<select name="registro-carril" id="registro-carril" class="form-control" disabled><option value="0">--</option></select>');
				}
		
		
		
		/*if($(this).val()=='23'){
			plaza = $('select#registro-plaza').val();
			datos='plaza='+plaza;
			$.post(base_url+'bom/registro/carga_carriles',datos,function(data){
				$('div#registro-carril').html(data);
				});
			}else{
				$('div#registro-carril').html('<select name="registro-carril" id="registro-carril" class="form-control" disabled><option value="0">--</option></select>');
				}*/
		
		});
		
		
/*	$('#datetimepicker4').datetimepicker({
      pickTime: false
    });
	
	$('#datetimepicker5').datetimepicker({
      pickDate: false
    });*/
	
	$("form#registro").on("submit",function() {
			errores=0;
			$("input:text.required").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			
			$("select.required").each(function() {
				if($(this).val()=='0'){
						errores = errores+1;
						$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			
			if(errores>0){
					$("span#errores").text("Llene los campos correctamente").show().fadeOut(3000);
					return false;
				}else{
					if(confirm('ESTA USTED SEGURO DE QUE DESEA REGISTRAR EL REPORTE DE ATENCION EN EQUIPO DE PEAJE?')){
						return true;
						}else{
							return false;
							}
					}
		});
		
	$("form#asignacion").on("submit",function() {
		
			errores=0;
			$("input:text.required").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			
			$("select.required").each(function() {
				if($(this).val()=='0'){
						errores = errores+1;
						$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			

			if(errores>0){
					$("span#errores").text("Llene los campos correctamente").show().fadeOut(3000);
					return false;
				}else{
					if(confirm('ESTA USTED SEGURO DE QUE DESEA REGISTRAR EL TECNICO AL REPORTE?')){
						return true;
						}else{
							return false;
							}
					}
		});
		
		
		$("form#diagnostico_registrar").on("submit",function() {
		
			errores=0;
			$("form#diagnostico_registrar textarea").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			

			if(errores>0){
					$("span#errores").text("Llene los campos correctamente").show().fadeOut(3000);
					return false;
				}else{
					if(confirm('ESTA USTED SEGURO DE QUE DESEA REGISTRAR EL DIAGNOSTICO DEL REPORTE?')){
						return true;
						}else{
							return false;
							}
					}
		});
		
		//Mestra select clasificacion en notificacion
		$("#select_tipo").change(function(){
			datos='tipo='+$(this).val();
			if($(this).val()=='2')
			{
				$.post(base_url+'bom/notificacion/carga_pasos',datos,function(data){
				$('div#div_pasos').html(data);
			});
			}		
		});
		
		$("div#div_pasos").click(function(){
			$("select#select_pasos").change(function(){
				$("select#select_cla").val(0);
			});
		});
		
		$("#select_cla").change(function(){
			tipo = $('#select_tipo').val();
			cla = $('#select_cla').val();
			pasos=$('#select_pasos').val();
			datos='tipo='+tipo+'&cla='+cla+'&pasos='+pasos;
			$.post(base_url+'bom/notificacion/carga_usuarios_origen',datos,function(data){
				$('div#usuarios-origen').html(data);
			});
			$.post(base_url+'bom/notificacion/carga_usuarios_destino',datos,function(data){
				$('div#usuarios-destino').html(data);
			});
			$("#notificacion-botones").css("display","block");
		});
		
		//Agregar usuario de notificaciones
		$("#notificacion-agregar").click(function(event){
			event.preventDefault();
			//alert($('#registrar').serialize());
			$("select#origen option:selected").each(function () {				
				var datos='idusu='+$(this).val()+'&idtipo='+$("#select_tipo").val()+'&idcla='+$("#select_cla").val()+'&pasos='+$("#select_pasos").val();
				$.getJSON(base_url+'bom/notificacion/addcorreo',datos,function(data){
					if (data.kind=='green')
					{
						$("#origen option:selected").remove().appendTo("#destino");						
					}
					else
					{
						alert(data.msg);
					}
				});			
			});				
		});
		
		//Borrar usuario de notificaciones
		$("#notificacion-borrar").click(function(event){
			event.preventDefault();
			//alert($('#registrar').serialize());
			$("select#destino option:selected").each(function () {				
				var datos='id='+$(this).val();
				$.getJSON(base_url+'bom/notificacion/removecorreo',datos,function(data){
					if (data.kind=='green')
					{
						$("#destino option:selected").remove().appendTo("#origen");		
					}
					else
					{
						alert(data.msg);
					}
				});			
			});	
		});
			
		//Estatus del reporte
		$("#example").on('click','.detalle',function(){
			   var i = this
			   $.ajax({url:base_url+'bom/consulta/estatus',
			   data: { idrepo: $(this).attr('idrepo'),tr: $(this).attr('tr'),estado: $(this).attr('estado') }, 
			   dataType: "html", 
			   cache:true, 
			   success: function(data){
			   $(i).popover({html:true,placement:'bottom',content:data}).popover('show')
			   }})
			   $('#trackingblock').on('mouseenter','.popover',function(e) {
			   $(this).attr('data-donotclose',"")
			   }).on('mouseleave','.popover',function(e) {
			   $(this).removeAttr('data-donotclose')
			   });
			  $(document).click(function(e) {
			  if ( $('.popover:visible').length) {
			  $('.popover:not([data-donotclose])').prev().popover('destroy')
			  }
			  }).keyup(function(e) {
			  if (e.keyCode == 27) { $('.popover').prev().popover('destroy') }
			  });
		});
			
	//===========================Funcion para cargar tablas de fechas de regreso===========================//
	$('table#example').on('click','a.abrir-observaciones',function(){
		idreporte = $(this).attr('idreporte');
		idsolucion = $(this).attr('idsolucion');
		datos = 'idreporte='+idreporte+'&idsolucion='+idsolucion;
		$.getJSON(base_url+'bom/cerrar/desplegar_remplazos',datos,function(json){
			tabla = '<table style="font-size:10px;" class="table table-condensed table-striped table-bordered table-responsive"><td>MARCA</td><td>MODELO</td><td>EQUIPO</td><td>MOTIVO</td><td>DESTINO</td><td>FECHA REGRESO</td></td>';
			$.each(json,function(x,y){
				tabla = tabla + '<tr><td>'+y.marca+'</td><td>'+y.modelo+'</td><td>'+y.nombre_equipo+'</td><td>'+y.motivo+'</td><td>'+y.destino+'</td><td width="25%"><div class="input-append input-group datetimepicker'+y.idreparar_equipo+'"><input data-format="yyyy-MM-dd" value="'+y.fecha_regreso+'" type="text" class="form-control input-sm" readonly name="fecha[]" style="font-size:10px;"><span class="input-group-addon add-on"><i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i></span></div></td></tr><script>$(".datetimepicker"+'+y.idreparar_equipo+').datetimepicker({pickTime: false});</script><input type="hidden" name="equipo[]" value="'+y.idequipo+'">';
			});
			tabla = tabla + '</table>';
			$('div#tabla-remplazo').html(tabla);
		});
	});
	/*$('.abrir-observaciones').click(function(){
		idreporte = $(this).attr('idreporte');
		idsolucion = $(this).attr('idsolucion');
		datos = 'idreporte='+idreporte+'&idsolucion='+idsolucion;
		$.getJSON(base_url+'bom/cerrar/desplegar_remplazos',datos,function(json){
			tabla = '<table style="font-size:10px;" class="table table-condensed table-striped table-bordered table-responsive"><td>MARCA</td><td>MODELO</td><td>EQUIPO</td><td>MOTIVO</td><td>DESTINO</td><td>FECHA REGRESO</td></td>';
			$.each(json,function(x,y){
				tabla = tabla + '<tr><td>'+y.marca+'</td><td>'+y.modelo+'</td><td>'+y.nombre_equipo+'</td><td>'+y.motivo+'</td><td>'+y.destino+'</td><td width="25%"><div class="input-append input-group datetimepicker'+y.idreparar_equipo+'"><input data-format="yyyy-MM-dd" value="'+y.fecha_regreso+'" type="text" class="form-control input-sm" readonly name="fecha[]" style="font-size:10px;"><span class="input-group-addon add-on"><i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i></span></div></td></tr><script>$(".datetimepicker"+'+y.idreparar_equipo+').datetimepicker({pickTime: false});</script><input type="hidden" name="equipo[]" value="'+y.idequipo+'">';
			});
			tabla = tabla + '</table>';
			$('div#tabla-remplazo').html(tabla);
		});
	});*/
	
	
	//===========================Funcion para cargar tablas de diagnostico=================================//
	
	$("form#diagnostico_registrar div#reparar input:radio").click(function(){
		if($(this).val()=="1"){
			datos = 'idreporte='+$('input#idreporte').val();
			$.post(base_url+'bom/solucion/carga_tabla_reparar',datos,function(data){
				$('div#tabla_reparar').html(data);
				$("input#n_reparar").val(1);
				});
			}else{
				$('div#tabla_reparar').html('');
				$("input#n_reparar").val(0);
				}
			$('div#reemplazar').show();
		});	
		
	$("div#tabla_reparar").on('change','select.combo-equipo',function(){
		idactivo = $(this).val();
		//alert(idactivo);
		n=$(this).attr("n");
		//alert(n);
		if(idactivo==0){
			alert('Seleccione un equipo');
		}else{
			datos = 'idactivo='+idactivo;
			$.getJSON(base_url+'bom/solucion/carga_datos_activo',datos,function(json){
				$('input[name=marca'+n+']').val(json[0].nombre_marca);
				$('input[name=modelo'+n+']').val(json[0].modelo);
			});
		}
	});	
		
	$("form#diagnostico_registrar div#reemplazar input:radio").click(function(){
		if($(this).val()=="1"){
			datos = 'idreporte='+$('input#idreporte').val();
			$.post(base_url+'bom/diagnostico/carga_tabla_reemplazar',datos,function(data){
				$('div#tabla_reemplazar').html(data);
				$("input#n_reemplazar").val(1);
				});
			}else{
				$('div#tabla_reemplazar').html('');
				$("input#n_reemplazar").val(0);
				}
		$('div#botones').show();
		});	
		
	$("div#tabla_reemplazar").on('change','select.v_combo-equipo',function(){
		idactivo = $(this).val();
		//alert(idactivo);
		n=$(this).attr("n");
		//alert(n);
		if(idactivo==0){
			alert('Seleccione un equipo');
		}else{
			datos = 'idactivo='+idactivo;
			$.getJSON(base_url+'bom/solucion/carga_datos_activo',datos,function(json){
				$('input[name=v_marca'+n+']').val(json[0].nombre_marca);
				$('input[name=v_modelo'+n+']').val(json[0].modelo);
			});
		}
	});	
		
	$("form#diagnostico_registrar div#tabla_reemplazar").on("click",".agregar_nuevo",function(){
		n=0;
		/*$('tr.contenedor_viejo').each(function(index, element) {
            n=n+1;
        	});*/
		n = $('tr.contenedor_viejo_diagnostico').last().attr('n');	
		sig=parseInt(n)+1;
		contenedor_viejo='<tr class="contenedor_viejo_diagnostico" n="'+sig+'" id="contenedor_viejo_diagnostico'+sig+'"><td id="v-con-select'+sig+'"></td><td><input type="text" name="v_marca'+sig+'" class="form-control input-sm required"></td><td><input type="text" name="v_modelo'+sig+'" class="form-control input-sm required"></td><!--<td><input type="text" name="v_capacidad'+sig+'" class="form-control input-sm"></td><td><input type="text" name="v_serie'+sig+'" class="form-control input-sm required"></td>--><td><textarea name="v_motivo'+sig+'" class="form-control required" style="height:30px;"></textarea></td><td><input type="text" name="v_ubicacion'+sig+'" class="form-control input-sm required"></td><td><a class="btn btn-danger btn-sm eliminar_reemplazar" n="'+sig+'"><i class="fa fa-minus"></i></a></td></tr>';
		$(contenedor_viejo).insertAfter('tr#contenedor_viejo_diagnostico'+n);
		$('select[name=v_equipo1]').clone().appendTo('#v-con-select'+sig).attr('n',sig).attr('name','v_equipo'+sig);
		$("input#n_reemplazar").val(sig);
		});
		
	//Eliminar fila reemplazar equipo diagnostico
	$("div#tabla_reemplazar").on("click",".eliminar_reemplazar",function(){
		n = $(this).attr("n");
		if(n==1){
			$("tr#contenedor_viejo_diagnostico"+n+" input.required").each(function(index, element) {
                $(this).val("");
            });
			
			$("select[name=v_equipo1]").val(0);
			
			$("tr#contenedor_viejo_diagnostico"+n+" input[name='v_capacidad"+n+"']").val("");
			}else{
				$("tr#contenedor_viejo_diagnostico"+n).remove();
				}
		});
		
	$("form#diagnostico_registrar").on("submit",function() {
			errores=0;
			$("form#diagnostico_registrar textarea").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			
			$("form#diagnostico__registrar tr.contenedor_equipo").each(function(index, element) {
                n=$(this).attr("n");
				$("form#diagnostico_registrar tr#contenedor_equipo"+n+" input.required").each(function(index, element) {
                    if($(this).val()==""){
						errores = errores+1;
						$(this).css("border","1px solid red");
						}else{
							$(this).css("border","1px solid #ccc");
							}
                });
            });
			
			$("form#diagnostico_registrar tr.contenedor_viejo_diagnostico").each(function(index, element) {
                n=$(this).attr("n");
				$("form#diagnostico_registrar tr#contenedor_viejo_diagnostico"+n+" input.required").each(function(index, element) {
                    if($(this).val()==""){
						errores = errores+1;
						$(this).css("border","1px solid red");
						}else{
							$(this).css("border","1px solid #ccc");
							}
                });
            });
		});
	
	//===========================Funcion para cargar tablas de solucion=================================//
	
	$("form#solucion_registrar").ready(function(){
		if($("div#reparar #r_reparar").attr('activo')==1){
			datos='reporte='+$("div#reparar #r_reparar").attr('reporte');
		$.post(base_url+'bom/solucion/agregar_carga_tabla_reparar',datos,function(data){
				$('div#tabla_reparar').html(data);
				});
			}else{
				$('div#tabla_reparar').html('');
				$("input#n_reparar").val(0);
				}
		$('div#reemplazar').show();
	});
	
	$("form#solucion_registrar").ready(function(){
		if($("div#reemplazar #r_reemplazar").attr('activo')==1){
		datos='reporte='+$("div#reemplazar #r_reemplazar").attr('reporte');
		$.post(base_url+'bom/solucion/agregar_carga_tabla_reemplazar',datos,function(data){
				$('div#tabla_reemplazar').html(data);
				});
			}else{
				$('div#tabla_reemplazar').html('');
				$("input#n_reemplazar").val(0);
				}
		$('div#botones').show();
	});
	
	$("form#solucion_registrar div#reparar input:radio").click(function(){
		if($(this).val()=="1"){
			datos='reporte='+$("div#reparar #r_reparar").attr('reporte');
			$.post(base_url+'bom/solucion/agregar_carga_tabla_reparar',datos,function(data){
				$('div#tabla_reparar').html(data);
				$("input#n_reparar").val(1);
				});
			}else{
				$('div#tabla_reparar').html('');
				$("input#n_reparar").val(0);
				}
			$('div#reemplazar').show();
	});	
		
	$("div#tabla_reparar").on("click",".agregar_equipo",function(){
		var f=new Date();
		var anio = f.getFullYear();
		var mes = (f.getMonth())+1;
		var dia = f.getDate();
		fecha = anio+'-'+mes+'-'+dia;
		n=0;
		/*$('tr.contenedor_equipo').each(function(index, element) {
            n=n+1;
        	});*/
		n = $('tr.contenedor_equipo').last().attr('n');	
		sig=parseInt(n)+1;
		//alert(n);
		contenedor='<tr class="contenedor_equipo" n="'+sig+'" id="contenedor_equipo'+sig+'"><td id="con-select'+sig+'"></td><td><input type="text" name="marca'+sig+'" class="form-control input-sm required"></td><td><input type="text" name="modelo'+sig+'" class="form-control input-sm required"></td><!--<td><input type="text" name="capacidad'+sig+'" class="form-control input-sm"></td><td><input type="text" name="serie'+sig+'" class="form-control input-sm required"></td>--><td><textarea name="motivo'+sig+'" class="form-control required" style="height:30px;"></textarea></td><td><input type="text" name="destino'+sig+'" class="form-control input-sm required"></td><td><div class="input-append input-group datetimepicker'+sig+'"><input data-format="yyyy-MM-dd" value="'+fecha+'" type="text" class="form-control" readonly name="fecha'+sig+'"><span class="input-group-addon add-on"><i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar"></i></span></div></td><td><a class="btn btn-danger btn-sm eliminar_reparar" n="'+sig+'"><i class="fa fa-minus"></i></a></td></tr>';
		$(contenedor).insertAfter('tr#contenedor_equipo'+n);
		$('select[name=equipo1]').clone().appendTo('#con-select'+sig).attr('n',sig).attr('name','equipo'+sig).attr('disabled',false).val(0);
		$('.datetimepicker'+sig).datetimepicker({
      		pickTime: false
    		});
		$("input#n_reparar").val(sig);
		});
		
	//Eliminar fila reparar equipo
	$("div#tabla_reparar").on("click",".eliminar_reparar",function(){
		n = $(this).attr("n");
		if(n==1){
			$("tr#contenedor_equipo"+n+" input.required").each(function(index, element) {
                $(this).val("").attr('readonly',false);
            });
			
			$("tr#contenedor_equipo"+n+" textarea.required").val('').attr('readonly',false);
			
			$("select[name=equipo1]").val(0).attr('disabled',false);
			
			$("tr#contenedor_equipo"+n+" input[name='capacidad"+n+"']").val("");
			
			$('.datetimepicker').datetimepicker({
      		pickTime: false
    		});
			}else{
				$("tr#contenedor_equipo"+n).remove();
				}
		});
		
	$("form#solucion_registrar div#reemplazar input:radio").click(function(){
		if($(this).val()=="1"){
			datos='reporte='+$("div#reparar #r_reparar").attr('reporte');
			$.post(base_url+'bom/solucion/agregar_carga_tabla_reemplazar',datos,function(data){
				$('div#tabla_reemplazar').html(data);
				$("input#n_reemplazar").val(1);
				});
			}else{
				$('div#tabla_reemplazar').html('');
				$("input#n_reemplazar").val(0);
				}
		$('div#botones').show();
		});
		
	$("form#solucion_registrar div#tabla_reemplazar").on("click",".agregar_nuevo",function(){
		n=0;
		/*$('tr.contenedor_viejo').each(function(index, element) {
            n=n+1;
        	});*/
		n = $('tr.contenedor_viejo').last().attr('n');	
		sig=parseInt(n)+1;
		contenedor_viejo='<tr class="contenedor_viejo" n="'+sig+'" id="contenedor_viejo'+sig+'"><td id="v-con-select'+sig+'"></td><td><input type="text" name="v_marca'+sig+'" class="form-control input-sm required"></td><td><input type="text" name="v_modelo'+sig+'" class="form-control input-sm required"></td><!--<td><input type="text" name="v_capacidad'+sig+'" class="form-control input-sm"></td><td><input type="text" name="v_serie'+sig+'" class="form-control input-sm required"></td>--><td><textarea name="v_motivo'+sig+'" class="form-control required" style="width:140px; height:30px;"></textarea></td><td><input type="text" name="v_ubicacion'+sig+'" class="form-control input-sm required"></td></tr>';
		contenedor_nuevo='<tr class="contenedor_nuevo" n="'+sig+'" id="contenedor_nuevo'+sig+'"><td><input type="text" name="n_marca'+sig+'" class="form-control input-sm required"></td><td><input type="text" name="n_modelo'+sig+'" class="form-control input-sm required"></td><!--<td><input type="text" name="n_capacidad'+sig+'" class="form-control input-sm"></td>--><td><input type="text" name="n_serie'+sig+'" class="form-control input-sm required"></td><td><textarea name="n_motivo'+sig+'" class="form-control required" style="width:140px; height:30px;"></textarea></td><!--<td><input type="text" name="n_ubicacion'+sig+'"  class="form-control input-sm required"></td>--><td><a class="btn btn-danger btn-sm eliminar_reemplazar" n="'+sig+'"><i class="fa fa-minus"></i></a><input type="hidden" name="hidden-v_equipo'+sig+'" value=""></td></tr>';
		$(contenedor_viejo).insertAfter('tr#contenedor_viejo'+n);
		$(contenedor_nuevo).insertAfter('tr#contenedor_nuevo'+n);
		$('select[name=v_equipo1]').clone().appendTo('#v-con-select'+sig).attr('n',sig).attr('name','v_equipo'+sig).attr('disabled',false).val(0).addClass('required');
		$("input#n_reemplazar").val(sig);
		});
	
	
	$("div#tabla_reemplazar").on('change','select.v-combo-equipo',function(){
		idactivo = $(this).val();
		//alert(idactivo);
		n=$(this).attr("n");
		$('input[name=hidden-v_equipo'+n+']').val(idactivo);
		//alert(n);
		if(idactivo==0){
			alert('Seleccione un equipo');
		}else{
			datos = 'idactivo='+idactivo;
			$.getJSON(base_url+'bom/solucion/carga_datos_activo',datos,function(json){
				$('input[name=v_marca'+n+']').val(json[0].nombre_marca);
				$('input[name=v_modelo'+n+']').val(json[0].modelo);
			});
		}
	});
	
	
	//Eliminar fila reemplazar equipo
	$("div#tabla_reemplazar").on("click",".eliminar_reemplazar",function(){
		n = $(this).attr("n");
		if(n==1){
			$("tr#contenedor_viejo"+n+" .required").each(function(index, element) {
                $(this).val("");
            });
			$("tr#contenedor_viejo"+n+" input[name='v_capacidad"+n+"']").val("");
			$("tr#contenedor_nuevo"+n+" .required").each(function(index, element) {
                $(this).val("");
            });
			$("tr#contenedor_nuevo"+n+" input[name='n_capacidad"+n+"']").val("");
			}else{
				$("tr#contenedor_viejo"+n).remove();
				$("tr#contenedor_nuevo"+n).remove();
				}
		});
	
	/*$("div#tabla_reemplazar").on("click",".agregar_nuevo",function(){
		n=0;
		//$('tr.contenedor_viejo').each(function(index, element) {
            //n=n+1;
        	//});
		n = $('tr.contenedor_viejo').last().attr('n');	
		sig=parseInt(n)+1;
		contenedor_viejo='<tr class="contenedor_viejo" n="'+sig+'" id="contenedor_viejo'+sig+'"><td><input type="text" name="v_marca'+sig+'" class="form-control input-sm required"></td><td><input type="text" name="v_modelo'+sig+'" class="form-control input-sm required"></td><td><input type="text" name="v_capacidad'+sig+'" class="form-control input-sm"></td><td><input type="text" name="v_serie'+sig+'" class="form-control input-sm required"></td><td><textarea name="v_motivo'+sig+'" class="form-control required" style="width:150px; height:30px;"></textarea></td><td><input type="text" name="v_ubicacion'+sig+'" class="form-control input-sm required"></td></tr>';
		contenedor_nuevo='<tr class="contenedor_nuevo" n="'+sig+'" id="contenedor_nuevo'+sig+'"><td><input type="text" name="n_marca'+sig+'" class="form-control input-sm required"></td><td><input type="text" name="n_modelo'+sig+'" class="form-control input-sm required"></td><td><input type="text" name="n_capacidad'+sig+'" class="form-control input-sm"></td><td><input type="text" name="n_serie'+sig+'" class="form-control input-sm required"></td><td><textarea name="n_motivo'+sig+'" class="form-control required" style="width:150px; height:30px;"></textarea></td><td><input type="text" name="n_ubicacion'+sig+'"  class="form-control input-sm required"></td><td><a class="btn btn-danger btn-sm eliminar_reemplazar" n="'+sig+'"><i class="fa fa-minus"></i></a></td></tr>';
		$(contenedor_viejo).insertAfter('tr#contenedor_viejo'+n);
		$(contenedor_nuevo).insertAfter('tr#contenedor_nuevo'+n);
		$("input#n_reemplazar").val(sig);
		});*/
	
	//Eliminar fila reemplazar equipo
	$("div#tabla_reemplazar").on("click",".eliminar_reemplazar",function(){
		n = $(this).attr("n");
		if(n==1){
			$("tr#contenedor_viejo"+n+" .required").each(function(index, element) {
                $(this).val("");
            });
			$("tr#contenedor_viejo"+n+" input[name='v_capacidad"+n+"']").val("");
			$("tr#contenedor_nuevo"+n+" .required").each(function(index, element) {
                $(this).val("");
            });
			$("tr#contenedor_nuevo"+n+" input[name='n_capacidad"+n+"']").val("");
			}else{
				$("tr#contenedor_viejo"+n).remove();
				$("tr#contenedor_nuevo"+n).remove();
				}
		});
		
	$("form#solucion_registrar").on("submit",function() {
			contador_for=0;
			errores=0;
			$("form#solucion_registrar textarea").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			
			$("form#solucion_registrar tr.contenedor_equipo").each(function(index, element) {
                n=$(this).attr("n");
				$("form#solucion_registrar tr#contenedor_equipo"+n+" input.required").each(function(index, element) {
                    if($(this).val()==""){
						errores = errores+1;
						$(this).css("border","1px solid red");
						}else{
							$(this).css("border","1px solid #ccc");
							}
                });
            });
			
			$('select.combo-equipo').each(function(index, element) {
            	n=$(this).attr('n');
				if(n!=1){
					for(m=1;m<n;m++){
					valor_act = $('tr#contenedor_equipo'+n+' select').val();
					valor_ant = $('tr#contenedor_equipo'+m+' select').val();
					if(valor_ant==valor_act){
						errores = errores + 1;
						contador_for = contador_for + 1;
						}
					}
				}
            });
			
			$('select.v-combo-equipo').each(function(index, element) {
            	n=$(this).attr('n');
				if(n!=1){
					for(m=1;m<n;m++){
					valor_act = $('tr#contenedor_viejo'+n+' select').val();
					valor_ant = $('tr#contenedor_viejo'+m+' select').val();
					if(valor_ant==valor_act){
						errores = errores + 1;
						contador_for = contador_for + 1;
						}
					}
				}
            });
			
			if(contador_for>0){
				alert('Se han encontrado equipos duplicados');
			}
			
			
			$("form#solucion_registrar tr.contenedor_viejo").each(function(index, element) {
                n=$(this).attr("n");
				$("form#solucion_registrar tr#contenedor_viejo"+n+" select.required").each(function(index, element) {
                    if($(this).val()==0){
						errores = errores+1;
						$(this).css("border","1px solid red");
						}else{
							$(this).css("border","1px solid #ccc");
							}
                });
            });
	
			
			$("form#solucion_registrar tr.contenedor_viejo").each(function(index, element) {
                n=$(this).attr("n");
				$("form#solucion_registrar tr#contenedor_viejo"+n+" input.required").each(function(index, element) {
                    if($(this).val()==""){
						errores = errores+1;
						$(this).css("border","1px solid red");
						}else{
							$(this).css("border","1px solid #ccc");

							}
                });
            });
			
			/*$("form#solucion_registrar tr.contenedor_viejo").each(function(index, element) {
                n=$(this).attr("n");
				$("form#solucion_registrar tr#contenedor_nuevo"+n+" input").each(function(index, element) {
                    if($(this).val()==""){
						errores = errores+1;
						$(this).css("border","1px solid red");
						}else{
							$(this).css("border","1px solid #ccc");
							}
                });
            });*/

			if(errores>0){
					$("span#errores").text("Llene los campos correctamente").show().fadeOut(3000);
					return false;
				}else{
					datos = $("form#solucion_registrar").serialize();
					//alert(datos);
					if(confirm('ESTA USTED SEGURO DE QUE DESEA REGISTRAR LA SOLUCION DEL REPORTE?')){
						return true;
						}else{
							return false;
							}
					}
		});
		
	
		
	
	
		
			
		$("#example").on('click','.info_t',function(){
		//$(".info_t").click(function(event){
			//event.preventDefault();
			var id=$(this).attr('id');
			var datos='id='+id;
			$.post(base_url+'bom/asignacion/carga_informacion',datos,function(data){
				$('div#contenido_'+id).html(data);
			});
		});
		
		$("#example").on('click','.info_d',function(){
		//$(".info_d").click(function(event){
			//event.preventDefault();
			var id=$(this).attr('id');
			var datos='id='+id;
			$.post(base_url+'bom/diagnostico/carga_informacion',datos,function(data){
				$('div#contenido_'+id).html(data);
			});
		});
		
		$("#example").on('click','.info_s',function(){
		//$(".info_s").click(function(event){
			//event.preventDefault();
			var id=$(this).attr('id');
			var datos='id='+id;
			$.post(base_url+'bom/solucion/carga_informacion',datos,function(data){
				$('div#contenido_'+id).html(data);
			});
		});
		
		$("#example").on('click','.info',function(){
		//$(".info").click(function(event){
			//event.preventDefault();
			var id=$(this).attr('id');
			var estado=$(this).attr('estado');
			var datos='id='+id+"&estado="+estado;
			
			$.post(base_url+'bom/consulta/carga_informacion',datos,function(data){
				$('div#contenido_'+id).html(data);
			});
		});
		
		$("#example").on('click','.info_e',function(){
		//$("#example a.info_e").click(function(event){
			//event.preventDefault();
			var id=$(this).attr('id');
			var datos='id='+id;
			$.post(base_url+'bom/emitir/carga_informacion',datos,function(data){
				$('div#contenido_'+id).html(data);
			});
		});
		
		
	function limpiar(text){
      text = text.replace(/[,]/, '');
	  text = text.replace(/[']/, '');
	  text = text.replace(/["]/, '');
      return text;
   	}
   
   $("form#solucion_registrar").on("keyup","input:text, textarea",function(){
	   val = $(this).val();
	   console.log(limpiar(val));
	   $(this).val(limpiar(val));
	   });
		
	/*$('.cerrar_reporte').click(function(event){
     if(!confirm('ESTA USTED SEGURO QUE DESEA CERRAR EL REPORTE?')){
         event.preventDefault();
     }
	});	*/
});