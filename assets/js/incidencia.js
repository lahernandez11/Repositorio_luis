$(document).ready(function(){
		
	$('select#proyecto').change(function(){
		proyecto=$(this).val();
		$("div#info_pendiente").load(base_url+'sgwc/pendientes/carga_pendientes?proyecto='+proyecto);	
	});	
	
	/* MENU DESPLEGABLE*/
	var cargando='<div style="font-size:12px;" align="center"><i class="fa fa-spinner fa-spin"></i> Cargando</div>';	
    
	/*CLASE ORIGEN*/
	$('div#info_pendiente').on('click','.abrir-clase',function(){
		idclase = $(this).attr('idclase');
		idbase = $(this).attr('idbase');
		datos = 'idclase='+idclase+'&idbase='+idbase;
		tipos = '';
		val=0;		
		if($('li.clases i#c_'+idclase).hasClass('fa-plus-square-o')){
			$('.tipo'+idclase).html(cargando).toggle();
			$.getJSON(base_url+'sgwc/pendientes/tipos',datos,function(json){
				$.each(json,function(x,y){
					val=val+1;
					tipos = tipos + '<li id="T'+y.tipoID+'" style="margin-left:20px;"><i class="fa fa-plus-square-o abrir-subtipos" idbase="'+y.idbase+'" idtipo="'+y.tipoID+'"></i><span style="background:'+y.color+'"> <input '+y.disabled+' type="checkbox" name="t[]" value="'+y.tipoID+'" class="ch_tipo" id="'+y.tipoID+'" idbase="'+y.idbase+'" > '+y.title+'</span><div class="subtipos stipo'+y.tipoID+'" style="display:none"></div></li>';
				});
			$('.tipo'+idclase).html(tipos);
			});
			$('li.clases i#c_'+idclase).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
		}else{
			$('.tipo'+idclase).toggle();
			$('li.clases i#c_'+idclase).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
		}
	});
	
	/*CLASE DESTINO*/
	$('div#info_pendiente').on('click','.abrir-clase_d',function(){
		idclase = $(this).attr('idclase');
		idbase = $(this).attr('idbase');
		datos = 'idclase='+idclase+'&idbase='+idbase;
		tipos = '';
		if($('li.clases i#d_'+idclase).hasClass('fa-plus-square-o')){
			$('.tipo_d'+idclase).html(cargando).toggle();
			$.getJSON(base_url+'sgwc/pendientes/tipos_destino',datos,function(json){
				$.each(json,function(x,y){
					tipos = tipos + '<li id="T'+y.tipoID+'" style="margin-left:20px;"><table><tr><td style="width:100%"><i class="fa fa-plus-square-o abrir-subtipos_d" idbase="'+y.idbase+'" idtipo="'+y.tipoID+'"></i><span> <input '+y.disabled+' type="checkbox" class="ch_tipo_d" name="t_d[]" value="'+y.idnotificacion+'" id="'+y.idnotificacion+'" idbase="'+y.idbase+'" > '+y.title+' '+y.valor +'  '+y.abreviatura+' </span></td><td><a id="n_'+y.idnotificacion+'" id_n="'+y.idnotificacion+'" idestado="'+y.idestado+'" class="'+y.color+' estado" ><i class="'+y.icon+' estado"></i></a></td><td><a id="'+y.idnotificacion+'" indicador="'+y.indicador+'" class="'+y.color_editar+'" data-toggle="modal" data-target="#myModal" ><i class="'+y.editar+'"></i></a></td></tr></table><div class="subtipos_d tipos_d'+y.tipoID+'" style="display:none"></div></li>';
				});
			$('.tipo_d'+idclase).html(tipos);
			});
			$('li.clases i#d_'+idclase).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
		}else{
			$('.tipo_d'+idclase).toggle();
			$('li.clases i#d_'+idclase).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
		}
	});	
	
	/*TIPO ORIGEN*/
	$('div#info_pendiente').on('click','i.abrir-subtipos',function(){
		var idtipo = $(this).attr('idtipo');
		var idbase = $(this).attr('idbase');
		datos = 'idtipo='+idtipo+'&idbase='+idbase;
		subtipos='';
		val=0;
		if($(this).hasClass('fa-plus-square-o')){
			$('.stipo'+idtipo).html(cargando).toggle();
			$.getJSON(base_url+'sgwc/pendientes/subtipos',datos,function(json){
				$.each(json,function(x,y){
					val=val+1;
					subtipos = subtipos + '<li id="S'+y.tipoID+'" style="margin-left:40px;"><span style="background:'+y.color+'"> <input '+y.disabled+' name="s[]" value="'+y.subtipoID+'" type="checkbox" class="ch_subtipo" id="'+y.subtipoID+'" idbase="'+y.idbase+'" > '+y.title+' | PLAZO: '+y.hr+'</span></li>';
				});
			$('.stipo'+idtipo).html(subtipos);	
			});
			$(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
		}else{
			$('.stipo'+idtipo).toggle();
			$(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
		}	
	});	
	
	/*TIPO DESTINO*/	
	$('div#info_pendiente').on('click','i.abrir-subtipos_d',function(){
		var idtipo = $(this).attr('idtipo');
		var idbase = $(this).attr('idbase');
		datos = 'idtipo='+idtipo+'&idbase='+idbase;
		subtipos='';
		if($(this).hasClass('fa-plus-square-o')){
			$('.tipos_d'+idtipo).html(cargando).toggle();
			$.getJSON(base_url+'sgwc/pendientes/subtipos_destino',datos,function(json){
				$.each(json,function(x,y){
					subtipos = subtipos + '<li style="margin-left:40px;"><table><tr><td style="width:100%"><span> <input '+y.disabled+' name="s_d[]" type="checkbox" class="ch_subtipo_d" id="'+y.idnotificacion+'" idbase="'+y.idbase+'" value="'+y.idnotificacion+'" > '+y.title+' '+y.valor+'  '+y.abreviatura+' </span></td><td><a id="n_'+y.idnotificacion+'" id_n="'+y.idnotificacion+'" idestado="'+y.idestado+'" class="'+y.color+' estado" ><i class="'+y.icon+' estado"></i></a></td><td><a id="'+y.idnotificacion+'" indicador="'+y.indicador+'" class="'+y.color_editar+'" data-toggle="modal" data-target="#myModal" ><i class="'+y.editar+'"></i></a></td></tr></table></li>';
				});
			$('.tipos_d'+idtipo).html(subtipos);	
			});
			$(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
		}else{
			$('.tipos_d'+idtipo).toggle();
			$(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
		}	
	});	
	
	/* TERMINA MENU*/
	
	/*BOTON AGREGAR*/
	$('div#info_pendiente').on('click','#btn-agregar',function(){			
		if($(".ch_clase").is(':checked') || $(".ch_tipo").is(':checked') || $(".ch_subtipo").is(':checked')) { 			
			$('h4#myModalLabel').text('Agregar notificacion');			
			clase=$(".ch_clase").serialize();						
			tipo=$(".ch_tipo").serialize();
			subtipo=$(".ch_subtipo").serialize();
			base=$('select#proyecto').val();						
			datos='idbase='+base+'&'+clase+'&'+tipo+'&'+subtipo;	
			$('input#base').val(base);		
			$.post(base_url+'sgwc/pendientes/muestra_clases',datos,function(data){
				$("div#contenedor-clases").html(data);
			});			
			$.post(base_url+'sgwc/pendientes/muestra_unidad_tiempo',function(data){
				$("div#contenedor-tiempos").html(data);
			});
			$("button.btn-accion").attr("id","guardar").removeClass('btn-warning').addClass('btn-success').text('Guardar');
			return true;
			
        } else {  
            alert("Selecione por lo menos una clase para continuar");  
			return false;
        }  
		
	});	
	
	
	$('div#info_pendiente').on('click','button#guardar',function(){	
		errores=0;
				
		clase=$(".ch_clase").serialize();						
		tipo=$(".ch_tipo").serialize();
		subtipo=$(".ch_subtipo").serialize();
		base=$('select#proyecto').val();
		valor=$('input#valor').val();
		tiempo=$('select#tiempo').val();
		datos='idbase='+base+'&'+clase+'&'+tipo+'&'+subtipo+'&valor='+valor+'&tiempo='+tiempo;		
		
		$("input:text.required").each(function() {
				if($(this).val()==''){
					errores = errores+1;
					$(this).css("border","1px solid red");
				}else{
					$(this).css("border","1px solid #ccc");
				}
		});
		$("select.required").each(function() {
				if($(this).val()==0){
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
		else{
			$.getJSON(base_url+'sgwc/pendientes/agregar_notificacion',datos,function(data){
				if(data.msg=='ok'){
					$('#myModal').modal('hide');
					$("div#info_pendiente").load(base_url+'sgwc/pendientes/carga_pendientes?proyecto='+base);	
				}
				else{
					alert('Ocurrio un error intente de nuevo.');
					$('#myModal').modal('hide');
					$("div#info_pendiente").load(base_url+'sgwc/pendientes/carga_pendientes?proyecto='+base);
				}				
			});
		}

	});
	
	/*BOTON BORRAR*/
	$('div#info_pendiente').on('click','#btn-eliminar',function(){	
		if($(".ch_clase_d").is(':checked') || $(".ch_tipo_d").is(':checked') || $(".ch_subtipo_d").is(':checked')) { 
			clase=$(".ch_clase_d").serialize();						
			tipo=$(".ch_tipo_d").serialize();
			subtipo=$(".ch_subtipo_d").serialize();
			base=$('select#proyecto').val();
			datos='idbase='+base+'&'+clase+'&'+tipo+'&'+subtipo;
			
			$.getJSON(base_url+'sgwc/pendientes/eliminar_notificacion',datos,function(data){
				if(data.msg=='ok'){
					$("div#info_pendiente").load(base_url+'sgwc/pendientes/carga_pendientes?proyecto='+base);	
				}
				else{
					alert('Ocurrio un error intente de nuevo.');
					$("div#info_pendiente").load(base_url+'sgwc/pendientes/carga_pendientes?proyecto='+base);	
				}
			});
			return true;	
		}
		else {  
        	alert("Selecione por lo menos una clase para continuar");  
			return false;
        }  
		
		
	});
	
	/*CAMBIA ESTADO*/
	$('div#info_pendiente').on('click','a.estado',function(){
		id=$(this).attr('id_n');		
		idestado=$(this).attr('idestado');
		datos='id='+id+'&idestado='+idestado;		
		$.getJSON(base_url+'sgwc/pendientes/cambia_estado',datos,function(data){
			if(data.msg=='ok'){
				if(idestado==1){
					$('a#n_'+id).attr("idestado",2).removeClass('btn-success').addClass('btn-danger');
					$('a#n_'+id+' i.estado').removeClass('fa-eye').addClass('fa-eye-slash');
				}
				else{
					$('a#n_'+id).attr("idestado",1).removeClass('btn-danger').addClass('btn-success');
					$('a#n_'+id+' i.estado').removeClass('fa-eye-slash').addClass('fa-eye');
				}
			}
			else{
				alert('Ocurrio un error intente de nuevo.');
			}			
		});	
	});
	
	/*MODIFICA DATOS*/
	$('div#info_pendiente').on('click','a.editar',function(){
		id=$(this).attr('id');		
		indicador=$(this).attr('indicador');
		$('h4#myModalLabel').text('Modificar notificacion');					
		datos='id='+id+'&indicador='+indicador;			
		$.getJSON(base_url+'sgwc/pendientes/busca_notificacion',datos,function(json){
			$.each(json,function(x,y){
				$("div#contenedor-clases").html(y.nombre);
				$("input#valor").val(y.valor);
				$("input#base").val(y.idbase);
				$("input#idnotificacion").val(y.idnotificacion);
				$.post(base_url+'sgwc/pendientes/muestra_unidad_tiempo',function(data){
					$("div#contenedor-tiempos").html(data);
					$("#tiempo option[value="+ y.idtiempo +"]").attr("selected",true);
				});	
			});
					
		});		
		$("button.btn-accion").attr("id","modificar").removeClass('btn-success').addClass('btn-warning').text('Modificar');
	});
	
	$('div#info_pendiente').on('click','button#modificar',function(){	
		errores=0;
		proyecto=$('select#proyecto').val();
		idnotificacion=$("input#idnotificacion").val();
		valor=$('input#valor').val();
		tiempo=$('select#tiempo').val();
		datos='idnotificacion='+idnotificacion+'&valor='+valor+'&tiempo='+tiempo;
		$("input:text.required").each(function() {
				if($(this).val()==''){
					errores = errores+1;
					$(this).css("border","1px solid red");
				}else{
					$(this).css("border","1px solid #ccc");
				}
		});
		$("select.required").each(function() {
				if($(this).val()==0){
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
		else{
			$.getJSON(base_url+'sgwc/pendientes/modifica_datos',datos,function(data){
				if(data.msg=='ok'){
					$('#myModal').modal('hide');
					$("div#info_pendiente").load(base_url+'sgwc/pendientes/carga_pendientes?proyecto='+proyecto);	
				}
				else{
					alert('Ocurrio un error intente de nuevo.');
					$('#myModal').modal('hide');
					$("div#info_pendiente").load(base_url+'sgwc/pendientes/carga_pendientes?proyecto='+proyecto);
				}					
			});
			return true;
		}
		
	});
	
	$("select#proyecto").change(function(){
		$("select#identificador").append("<option selected value='N'>-- SELECCIONE --</option>");
		$("div#muestra_usuarios").html('');
	});
	
	$("select#identificador").click(function(){
		$("select#identificador option[value='N']").remove();
	});
	
	$("select#proyecto").change(function(){
		if(!$(this).val()==0){			
			$("div#muestra_segmentos").load(base_url+'sgwc/notificacion/muestra_segmentos?idbase='+$("select#proyecto").val());
		}
	});
	
	$("div.busqueda").on("change","select#segmento",function(){
		if($(this).val()==0){
			$("div#muestra_usuarios").html('');
		}
		else{
			$("div#muestra_usuarios").load(base_url+'sgwc/notificacion/muestra_usuarios?idbase='+$("select#proyecto").val()+'&tramoID='+$("select#segmento").val());
		}
		
	});
	
	//Agregar usuario de notificaciones
	$("div#muestra_usuarios").on("click","select#origen",function(){
		$("select#origen option:selected").each(function () {				
			var datos='idusu='+$(this).val()+"&correo="+$(this).attr("correo")+"&usuario="+$(this).text()+"&idbase="+$("select#proyecto").val()+"&tramoID="+$("select#segmento").val();
				//alert(datos);
				$.getJSON(base_url+'sgwc/notificacion/addcorreo',datos,function(data){
					if (data.kind=='green')
					{
						$("#origen option:selected").remove().appendTo("#destino");	
						$("div#muestra_usuarios").load(base_url+'sgwc/notificacion/muestra_usuarios?idbase='+$("select#proyecto").val()+'&tramoID='+$("select#segmento").val());			
					}
					else
					{
						alert(data.msg);
					}
				});			
		});				
	});
		
		//Borrar usuario de notificaciones
	$("div#muestra_usuarios").on("click","select#destino",function(){
		$("select#destino option:selected").each(function () {				
			var datos='id='+$(this).val()+"&idbase="+$("select#proyecto").val()+"&tramoID="+$("select#segmento").val();
				//alert(datos);
				$.getJSON(base_url+'sgwc/notificacion/removecorreo',datos,function(data){
					if (data.kind=='green')
					{
						$("#destino option:selected").remove().appendTo("#origen");		
						$("div#muestra_usuarios").load(base_url+'sgwc/notificacion/muestra_usuarios?&idbase='+$("select#proyecto").val()+'&tramoID='+$("select#segmento").val());					
					}
					else
					{
						alert(data.msg);
					}
				});
		});	
	});
	
});