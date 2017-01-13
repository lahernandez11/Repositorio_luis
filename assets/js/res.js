$(document).ready(function(e) {	
	
	//consulta residente
	$("#buscador_residente").keyup(function(){
		var longitud = $(this).val().length;
		if (longitud>3)
		{
			busca=$(this).val();
			datos='busca='+busca;
			$.post(base_url+'res/residentes/busca_residentes',datos,function(data){
			$('div#residentes').html(data);
			});			
		}
		else
		{
			$('div#residentes').html('');;
		}
	});
	
	//consulta residente pendiente
	$("#buscador_ife").keyup(function(){
		var longitud = $(this).val().length;
		if (longitud>3)
		{
			busca=$(this).val();
			datos='busca='+busca;
			$.post(base_url+'res/residentes/busca_pendientes',datos,function(data){
			$('div#pendientes').html(data);
			});			
		}
		else
		{
			$('div#residentes').html('');;
		}
	});
   
   //ENTER COMO TAB
  	$(".enter").keydown(function(e){
		if (e.keyCode == 13) {
           cb = parseInt($(this).attr('tabindex'));
    
           if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null) {
               $(':input[tabindex=\'' + (cb + 1) + '\']').focus();
               $(':input[tabindex=\'' + (cb + 1) + '\']').select();
               e.preventDefault();
    
               return false;
           }
       }
	});
	
	//REGISTRO DE PASO (SALTA A TIPO DE VEHICULO)
	/*$("#ife").keyup(function(){
		if($("#ife").val().length>=13)
		{
			$("#tipo-vehiculo").focus();
		}
    });*/
   //FOCUS EN EL PASO
   $("#placas").focus();
   
   //MANDA VALORES PARA EL REGISTRO DE PASO
   $("#b_continuar").click(function(){
		$("#placas").focus();
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
					$("#i_mensaje").load("guarda_registro",{placas:$("#placas").val(),ife:$("#ife").val(),vehiculo:$("#tipo-vehiculo").val(),turno:$("#turno").val(),idcarril:$("#idcarril").val(),idplaza:$("#idplaza").val(),comercial:$("#comercial").val()});
					}
			
		$("#placas").val('');
		$("#ife").val('');
		$('#tipo-vehiculo').prop('selectedIndex',0);		
   });
   
   //CARGA LOCALIDADES
   $("select#select1").change(function(){
   		$("select#select2").attr('readonly',false);
		municipio=$(this).val();
		datos="municipio="+municipio;
		$.post("desplega_localidad",datos,function(data){
			$("option","select#select2").remove();
			$("select#select2").append(data);
		});
   });
   
   //SELECT OBLIGATORIOS
   $("form#registro").on("submit",function() {
			errores=0;			
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
				}
	});
	
	/*----------------------------------------------------------------------------*/	
	$("form#reporte").on("submit",function() {
			errores=0;			
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
				}
	});
	
   //SUBIR IMAGENES PENDIENTES DE MODIFICAR
   $("form#cambiar").on("submit",function() {
			var i_frente=$("#i_frente")[0].files[0];
			var i_atras=$("#i_atras")[0].files[0];
			var filetype_frente=i_frente.type;
			var filetype_atras=i_atras.type;
			if(filetype_frente=='image/png' || filetype_frente=='image/jpeg' || filetype_frente=='image/gif')
			{
				if(filetype_atras=='image/png' || filetype_atras=='image/jpeg' || filetype_atras=='image/gif'){
				return true;}
				else{
					$("div#error_imagen").text("Las imagenes deben de estar en formato jpg").show().fadeOut(3000);
					return false;
				}
				
			}
			else
			{
				$("div#error_imagen").text("Las imagenes deben de estar en formato jpg").show().fadeOut(3000);
				return false;
			}
		
	});
	
   //SUBIR IMAGENES ALTA RESIDENTES
   $("form#alta").on("submit",function() {
			var i_frente=$("#i_frente")[0].files[0];
			var i_atras=$("#i_atras")[0].files[0];
			var filetype_frente=i_frente.type;
			var filetype_atras=i_atras.type;
			if(filetype_frente=='image/png' || filetype_frente=='image/jpeg' || filetype_frente=='image/gif')
			{
				if(filetype_atras=='image/png' || filetype_atras=='image/jpeg' || filetype_atras=='image/gif'){
				return true;}
				else{
					$("div#error_imagen").text("Las imagenes deben de estar en formato jpg").show().fadeOut(3000);
					return false;
				}
				
			}
			else
			{
				$("div#error_imagen").text("Las imagenes deben de estar en formato jpg").show().fadeOut(3000);
				return false;
			}
		
	});
	
   //SUBIR IMAGENES ALTA RESIDENTES
   $("form#modifica").on("submit",function() {
			var i_frente=$("#imagen_f")[0].files[0];
			var i_atras=$("#imagen_a")[0].files[0];			
			var filetype_frente=i_frente.type;
			var filetype_atras=i_atras.type;
			if(filetype_frente=='image/jpeg')
			{
				if(filetype_atras=='image/jpeg'){
				return true;}
				else{
					$("div#error_imagen").text("Las imagenes deben de estar en formato jpg").show().fadeOut(3000);
					return false;
				}
				
			}
			else
			{
				$("div#error_imagen").text("Las imagenes deben de estar en formato jpg").show().fadeOut(3000);
				return false;
			}
	});
	
	
	
		//AGREGAR MUNICIPIO
	$('div.main').on('click','.agregar_municipio',function(){
		actual = $(this).attr("n");
		sig  = actual + 1;
		municipio = $('div#contenedor'+actual+' input').val();
		datos = "municipio="+municipio;
		div ='<div id="contenedor'+sig+'"><div class="form-group"><input type="text" class="form-control" id="municipio'+sig+'" n="'+sig+'" name="municipio'+sig+'" placeholder="Ingrese municipio" size="30"></div>&nbsp;<a id="boton_agregar'+sig+'"  class="btn btn-success agregar_municipio" n="'+sig+'"><i class="fa fa-plus"></i></a></div>';
		if(municipio!=''){
			$.getJSON(base_url+'res/municipio/agrega_municipio',datos,function(data){
				if(data.msg!='ko'){
					falla = '<a href="#" id="falla'+actual+'" n="'+actual+'" idmunicipio="'+data.msg+'" class="btn btn-success agregar_localidad"><i class="fa fa-plus"></i><i class="fa fa-warning"></i></a>';
					$('a#boton_agregar'+actual).removeClass('btn-success').removeClass('agregar_municipio').addClass('btn-warning').addClass('modificar_municipio');
					$('a#boton_agregar'+actual+' i').removeClass('fa-plus').addClass('fa-edit');
					$('div#contenedor'+actual+' input').attr('readonly',true);
					$(div).insertAfter('#contenedor'+actual);
					$(falla).insertAfter('a#boton_agregar'+actual);
					$('a#boton_agregar'+actual).attr("idmunicipio",data.msg);
					}else{
						alert('Ocurri\u00f3 un error, intente nuevamente');
						}
				});
			}
		});
		
	//Habilitar Edicion municipio
	$('div.main').on('click','.modificar_municipio',function(){
		idmunicipio = $(this).attr('idmunicipio');
		municipio = $('div#contenedor'+actual+' input');
		municipio.attr('readonly',false);
		$('div#contenedor'+actual+' a.modificar_municipio').removeClass('btn-warning').removeClass('modificar_municipio').addClass('btn-success').addClass('guardar_municipio');	
		$('div#contenedor'+actual+' i.fa-edit').removeClass('fa-edit').addClass('fa-save');	
		});
		
	//Habilitar Edicion municipio Anterior
	$('div.main').on('click','.modificar_municipio_anterior',function(){
		actual = $(this).attr('idmunicipio');
		municipio = $('div#contenedor_anterior'+actual+' input');
		municipio.attr('readonly',false);
		$('div#contenedor_anterior'+actual+' a.modificar_municipio_anterior').removeClass('btn-warning').removeClass('modificar_municipio_anterior').addClass('btn-success').addClass('guardar_municipio_anterior');	
		$('div#contenedor_anterior'+actual+' i.fa-edit').removeClass('fa-edit').addClass('fa-save');	
		});
		
	//Guardar Modificacion de municipio
	$('div.main').on('click','.guardar_municipio',function(){
		idmunicipio = $(this).attr('idmunicipio');
		actual = $(this).attr('n');
		console.log(actual);
		municipio = $('div#contenedor'+actual+' input');
		if(municipio.val()!=''){
			datos = 'idmunicipio='+idmunicipio+'&municipio='+municipio.val();
			$.getJSON(base_url+'res/municipio/modifica_municipio',datos,function(data){
				if(data.msg!='ko'){
					municipio.attr('readonly',true);
					$('div#contenedor'+actual+' a.guardar_municipio').removeClass('btn-success').removeClass('guardar_municipio').addClass('btn-warning').addClass('modificar_municipio');
					$('div#contenedor'+actual+' i.fa-save').removeClass('fa-save').addClass('fa-edit');
				}else{
					alert('Ocurri\u00f3 un error, intente nuevamente');
					}
			});
			
			}
		});
	
	//Guardar Modificacion de municipio Anterior
	$('div.main').on('click','.guardar_municipio_anterior',function(){
		actual = $(this).attr('idmunicipio');
		municipio = $('div#contenedor_anterior'+actual+' input');
		if(municipio.val()!=''){
			datos = 'idmunicipio='+actual+'&municipio='+municipio.val();
			$.getJSON(base_url+'res/municipio/modifica_municipio',datos,function(data){
				if(data.msg!='ko'){
					municipio.attr('readonly',true);
					$('div#contenedor_anterior'+actual+' a.guardar_municipio_anterior').removeClass('btn-success').removeClass('guardar_municipio_anterior').addClass('btn-warning').addClass('modificar_municipio_anterior');
					$('div#contenedor_anterior'+actual+' i.fa-save').removeClass('fa-save').addClass('fa-edit');
				}else{
					alert('Ocurri\u00f3 un error, intente nuevamente');
					}
			});
			}
		});
		
	//Mostrar localidades de municipios
	$('div.main').on('click','.agregar_localidad',function(){
		municipio = $(this).attr("idmunicipio");
		//console.log(area);
		datos='municipio='+municipio;
		$.post(base_url+'res/municipio/carga_localidad',datos,function(data){
			$('div#localidad').html(data);
			});
		});
	
	//Agregar localidad
	$('div.main').on('click','.guardar_localidad',function(){
		actual = $(this).attr('n');
		sig  = actual + 1;
		idmunicipio = $('input#idmunicipio').val();
		localidad= $('#contenedor-localidad'+actual+' input').val();
		datos = 'idmunicipio='+idmunicipio+'&localidad='+localidad;
		if(localidad!=''){
			$.getJSON(base_url+'res/municipio/agrega_localidad',datos,function(data){
				if(data.msg!='ko'){
					div ='<div id="contenedor-localidad'+sig+'"><div class="form-group"><input type="text" class="form-control" id="localidad'+sig+'" n="'+sig+'" name="localidad'+sig+'" placeholder="Ingrese localidad"></div>&nbsp;<a id="boton_guardar'+sig+'"  class="btn btn-success guardar_localidad" n="'+sig+'"><i class="fa fa-plus"></i></a></div>';
					$('a#boton_guardar'+actual).removeClass('btn-success').removeClass('guardar_localidad').addClass('btn-warning').addClass('modificar_localidad');
					$('a#boton_guardar'+actual+' i').removeClass('fa-plus').addClass('fa-edit');
					$('div#contenedor-localidad'+actual+' input').attr('readonly',true);
					$('div#contenedor-localidad'+actual+' input').attr('idlocalidad',data.msg);
					$(div).insertAfter('#contenedor-localidad'+actual);
				}else{
					alert('Ocurri\u00f3 un error, intente nuevamente');
					}
			});
			}
		});
		
		
	//Habilitar Edicion localidad
	$('div.main').on('click','.modificar_localidad',function(){
		actual = $(this).attr('n');
		localidad = $('div#contenedor-localidad'+actual+' input');
		localidad.attr('readonly',false);
		$('div#contenedor-localidad'+actual+' a.modificar_localidad').removeClass('btn-warning').removeClass('modificar_localidad').addClass('btn-success').addClass('guardar_localidad_modificacion');	
		$('div#contenedor-localidad'+actual+' i.fa-edit').removeClass('fa-edit').addClass('fa-save');	
		});
		
	//Habilitar Edicion localidad Anterior
	$('div.main').on('click','.modificar_localidad_anterior',function(){
		actual = $(this).attr('localidad');
		localidad = $('div#contenedor_localidad_anterior'+actual+' input');
		localidad.attr('readonly',false);
		$('div#contenedor_localidad_anterior'+actual+' a.modificar_localidad_anterior').removeClass('btn-warning').removeClass('modificar_localidad_anterior').addClass('btn-success').addClass('guardar_localidad_modificacion_anterior');	
		$('div#contenedor_localidad_anterior'+actual+' i.fa-edit').removeClass('fa-edit').addClass('fa-save');	
		});
		
	//Guardar Modificacion de localidad
	$('div.main').on('click','.guardar_localidad_modificacion',function(){
		actual = $(this).attr('n');
		//console.log(actual);
		idlocalidad = $('div#contenedor-localidad'+actual+' input').attr("idlocalidad");
		localidad = $('div#contenedor-localidad'+actual+' input');
		if(localidad.val()!=''){
			datos = 'idlocalidad='+idlocalidad+'&localidad='+localidad.val();
			$.getJSON(base_url+'res/municipio/modifica_localidad',datos,function(data){
				if(data.msg!='ko'){
					localidad.attr('readonly',true);
					$('div#contenedor-localidad'+actual+' a.guardar_localidad_modificacion').removeClass('btn-success').removeClass('guardar_localidad_modificacion').addClass('btn-warning').addClass('modificar_localidad');
					$('div#contenedor-localidad'+actual+' i.fa-save').removeClass('fa-save').addClass('fa-edit');
				}else{
					alert('Ocurri\u00f3 un error, intente nuevamente');
					}
			});
			}
		});
		
	//Guardar Modificacion de localidad Anterior
	$('div.main').on('click','.guardar_localidad_modificacion_anterior',function(){
		actual = $(this).attr('localidad');
		localidad = $('div#contenedor_localidad_anterior'+actual+' input');
		if(localidad.val()!=''){
			datos = 'idlocalidad='+actual+'&localidad='+localidad.val();
			//console.log(datos);
			$.getJSON(base_url+'res/municipio/modifica_localidad',datos,function(data){
				if(data.msg!='ko'){
					localidad.attr('readonly',true);
					$('div#contenedor_localidad_anterior'+actual+' a.guardar_localidad_modificacion_anterior').removeClass('btn-success').removeClass('guardar_localidad_modificacion_anterior').addClass('btn-warning').addClass('modificar_localidad_anterior');
					$('div#contenedor_localidad_anterior'+actual+' i.fa-save').removeClass('fa-save').addClass('fa-edit');
				}else{
					alert('Ocurri\u00f3 un error, intente nuevamente');
					}
			});
			}
		});
		
});