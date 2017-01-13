$(document).ready(function(){

	//muestra div atlacomulco
	$("select#proyecto").change(function(){
		proyecto=$(this).val();		
		$("div.alert").html('').removeClass("alert alert-success");        
		$("div#informacion").load(base_url+'sgwc/reporte/carga_estandares?proyecto='+proyecto);		
	});
	
	//seleccionar check
	$("div#informacion").on("click",".n_clase",function(){
		id=$(this).attr('id');
		if($("input#"+id).is(':checked')){
			$("input#"+id).prop("checked", false);
		}
		else{
			$("input#"+id).prop("checked", true);
		}
		
	});
	
	//seleccionar paginas
	$("div#informacion").on("click","#pagina",function(){
		id=$(this).attr('id');
		if($("input#"+id).is(':checked')){
			$("input#numero_pagina").css("display","block");
			$("input#numero_pagina").val(1);
		}
		else{
			$("input#numero_pagina").css("display","none");
		}
		
	});
	
	//pintar clase 
	$("div#informacion").on('mouseover','.n_clase',function(){
		idclase=$(this).attr('id');
		//alert(idclase);
		$("div.n_clase").css("background","#FFF");
		$("div#"+idclase).css("background","#CCC");	
	});
	
	$("div#informacion").on('click','.n_clase',function(){
		idclase=$(this).attr('id');
		//alert(idclase);
		$("div#informacion input #"+idclase).prop("checked",true);		
	});
	
	//selecciona todo validacion atlacomulco
	$("div#informacion").on('click','#v_todo',function(){
		if($("#v_todo").is(':checked'))
		{
			$(".checkAll_v").prop("checked", true);
			//$("span#v_todo").html('DESMARCAR TODO');
		}
		else
		{
			$(".checkAll_v").prop("checked", false);
			//$("span#v_todo").html('MARCAR TODO');
		}
	});
	
	//selecciona todo informacion atlacomulco
	$("div#informacion").on('click','#i_todo',function(){
		if($("#i_todo").is(':checked'))
		{
			$(".checkAll_i").prop("checked", true);
			//$("span#i_todo").html('DESMARCAR TODO');
		}
		else
		{
			$(".checkAll_i").prop("checked", false);
			//$("span#i_todo").html('MARCAR TODO');
		}
	});
	
	//selecciona todo clases atlacomulco
	$("div#informacion").on('click','#c_todo',function(){
		if($("#c_todo").is(':checked'))
		{
			$(".checkAll_c").prop("checked", true);
			//$("span#c_todo").html('DESMARCAR TODO');
		}
		else
		{
			$(".checkAll_c").prop("checked", false);
			//$("span#c_todo").html('MARCAR TODO');
		}
	});	
	
	$("div#informacion").on('click','input.checkAll_ca',function(){	
		if($(".checkAll_ca").is(':checked')){		
			proyecto=$("select#proyecto").val();			
			carretera=$('input.checkAll_ca').serialize();
			datos='proyecto='+proyecto+'&'+carretera;
			contenido='';
			$('label#label_segmento').text('Segmento:');
			$.getJSON(base_url+'sgwc/reporte/carga_segmentos',datos,function(data){
				contenido=contenido='<div><input type="checkbox" id="s_todo"> <span id="i_todo">MARCAR TODO</span></div>';
				$.each(data,function(x,y){
					contenido=contenido+'<div><input type="checkbox" name="segmento[]" class="segmento checkAll_s" value="'+y.tramoID+'">'+y.tramo+'</div>';					
				});								
				$('div#informacion div#div_segmentos').html(contenido);
			});		
		}
		else{
			$('div#informacion div#div_segmentos').html('');
		}
	});
	
	//selecciona todo clases atlacomulcosegmento
	$("div#informacion").on('click','#s_todo',function(){
		if($("#s_todo").is(':checked'))
		{
			$(".checkAll_s").prop("checked", true);
			//$("span#c_todo").html('DESMARCAR TODO');
		}
		else
		{
			$(".checkAll_s").prop("checked", false);
			//$("span#c_todo").html('MARCAR TODO');
		}
	});	
		
	//validacion atlacomulco
	$("div#informacion").on('click','#enviar',function(){		
		proyecto=$("select#proyecto").val();
		fecha_inicio=$("#fecha_inicio").val();
		fecha_fin=$("#fecha_fin").val();
		validacion=$(".validacion").serialize();
		info=$(".info").serialize();
		clase=$(".clase").serialize();	
		segmento=$(".segmento").serialize();	
				
		errores=0;
		$("input:text.required").each(function() {
				if($(this).val()=='00'){
						errores = errores+1;
						$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
		$("input:radio.required").each(function() {
				if($(this).val()==''){
						errores = errores+1;
						$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
		$("select.required").each(function() {
				if($(this).val()=='00'){
						errores = errores+1;
						$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
		
		if($(".info").is(':checked'))
		{errores = errores+0;}
		else
		{errores=errores+1;}
		
		if($(".validacion").is(':checked'))
		{errores = errores+0;}
		else
		{errores=errores+1;}
		
		if($(".clase").is(':checked'))
		{errores = errores+0;}
		else
		{errores=errores+1;}
		
		if($(".segmento").is(':checked'))
		{errores = errores+0;}
		else
		{errores=errores+1;}
		
			if(errores>0){
					alert("Falta seleccionar alguna de las opciones para generar el reporte");
					return false;
			}
			else{
				datos = $("form#reporte").serialize();
				//alert(datos);
				
				if(proyecto==1){					
					//$("#enviar").attr('href','http://172.20.73.117/reporte_fotografico/atm_r_foto.php?'+datos)
					$("#enviar").attr('href','http://ns5002111.ip-192-99-17.net/sgwc_repfot/atm_r_foto.php?'+datos)
				}
				else{
					//$("#enviar").attr('href','http://172.20.73.117/reporte_fotografico/cpcc_r_foto.php?'+datos)
					$("#enviar").attr('href','http://ns5002111.ip-192-99-17.net/sgwc_repfot/cpcc_r_foto.php?'+datos)
				}
				$("#enviar").html("<i class='fa fa-refresh fa-spin'></i> Procesando...").attr("disabled",true);	
				return true;								
			}
	});

//////////////////////////////////////////
	
	//CARGA DESCRIPCIONES 
	$("#d_proyecto").change(function(){		
		datos="proyecto="+$(this).val();
		$.post(base_url+'sgwc/reporte/numero_fotos',datos,function(data){
			$('div#no_fotos').html(data);
			$("div#descripciones").html('');
		});
	});
	
	$("div#descripcion").on('change','#fotos',function(){		
		datos="proyecto="+$(this).val()+"&fotos="+$("select#fotos option:selected" ).text();
		$.post(base_url+'sgwc/reporte/carga_descripciones',datos,function(data){
			$('div#descripciones').html(data);
		});
	});
	
	//MODIFICAR DESCRIPCION
	$('div#descripciones').on('click','.btn-modifica',function(){	
		id=$(this).val();
		estado=$(this).attr("estado");	
		
		if(estado==1){
			$("textarea#des_"+id).attr("readonly",false);
			$('button#btn_'+id).attr("estado",2).removeClass('btn-warning').addClass('btn-success');
			$('button#btn_'+id+' i.estado').removeClass('fa fa-pencil-square-o').addClass('fa fa-save');
		}
		else{			
			descripcion=$("textarea#des_"+id).val();
			datos="id="+id+"&descripcion="+descripcion;
			$.getJSON(base_url+"sgwc/reporte/modifica_descripcion",datos,function(data){
				if(data.msg=='ok'){
					$("textarea#des_"+id).attr("readonly",true);
					$('button#btn_'+id).attr("estado",1).removeClass('btn-success').addClass('btn-warning');
					$('button#btn_'+id+' i.estado').removeClass('fa fa-save').addClass('fa fa-pencil-square-o');
				}
				else{
					alert('Ocurrio un error, intente nuevamente');
				}
			});
		}
	});
	
	//FIRMAS DEL PROYECTO
	$("div#firma").on('click','.btn-modificar-firma',function(){
		idfirma=$(this).attr('id');
		datos='idfirma='+idfirma;
		$("h4.modal-title").text('Modificar firma');				
		$.getJSON(base_url+"sgwc/reporte/datos_firma",datos,function(data){
			$.each(data,function(x,y){
				$("input:text#input2").val(y.nombre_firma);
				$("select#input1 option[value="+ y.idbase +"]").attr("selected",true);
				$("input:text#input3").val(y.puesto);
				$("input#accion").val(y.idfirma);
				$("input:text#input3").val(y.puesto);
			});			
		});		
	});
	
	$('.btn-agregar-firma').click(function(){
		$("h4.modal-title").text('Agregar firma');
		$("input:text#input2").val('');
		$("select#input1 option[value='0']").attr("selected",true);		
		$("input#accion").val(0);
		$("input:text#input3").val('');
	});
	
	$("div#firma").on('click','#guardar',function(){
		proyecto=$("select#input1").val();
		nombre=$("input#input2").val();
		accion=$("input#accion").val();
		puesto=$("input#input3").val();
		
		errores=0;
		$("select.required").each(function() {
				if($(this).val()=="0"){
						errores = errores+1;
						$(this).css("border","1px solid #c00");
					}else{
						$(this).css("border","1px solid #ccc");
						}
        });
		$("input.required").each(function() {
				if($(this).val()==""){
						errores = errores+1;
						$(this).css("border","1px solid #c00");
					}else{
						$(this).css("border","1px solid #ccc");
						}
        });
			
		if(errores>0){	
				$("div.errores").text("Llene los campos correctamente").show().fadeOut(3000);			
				return false;
		}else{
			datos='proyecto='+proyecto+'&nombre='+nombre+'&accion='+accion+'&puesto='+puesto;
			//alert(datos);
			$.post(base_url+'sgwc/reporte/agregar_firma',datos,function(data){
				if(data=='ok'){				
					$(location).attr('href',base_url+'sgwc/reporte/firma');
				}
				else{
					alert('Ocurrio un error por favor intente de nuevo');
					$(location).attr('href',base_url+'sgwc/reporte/firma');
				}
				
			});
			return true;
		}
	});
	
	//CAMBIAR ESTADO FIRMA
	$("a.cambiar").click(function(){
		idfirma=$(this).attr('idelemento');
		idestado=$(this).attr('estado');
		datos='idfirma='+idfirma+'&idestado='+idestado;
		$.getJSON(base_url+"sgwc/reporte/cambia_firma",datos,function(data){
			if(data.msg=='ok'){
				$(location).attr('href',base_url+'sgwc/reporte/firma');
			}
			else{
				alert('Ocurrio un error intentalo de nuevo');
			}
		});
	});
	
	
	//MUESTRA ORDEN
	$("#o_proyecto").change(function(){		
		datos="proyecto="+$(this).val();
		$.post(base_url+'sgwc/reporte/numero_fotos',datos,function(data){
			$('div#no_fotos').html(data);
			$("div#orden").html('');
		});
	});
	
	$("div#ordena").on('change','#fotos',function(){		
		datos="proyecto="+$(this).val()+"&fotos="+$("select#fotos option:selected" ).text();
		$.post(base_url+'sgwc/reporte/carga_ordenacion',datos,function(data){
			$('div#orden').html(data);
		});
	});
	
	//MODIFICA ORDEN
	$("div#orden").on('click','#mod-orden',function(){
		estado=$(this).attr("estado");
		fotos=$(this).attr("fotos");
		proyecto=$("input:hidden#proyecto").val();
		errores=0;
						
		if(estado==1){		
			$("input:text.orden").attr("readonly",false);
			$("textarea.dd").attr("readonly",false);
			$("input:text.orden").addClass('required');
			$("textarea.dd").addClass('required');
			$('button#mod-orden').attr("estado",2).removeClass('btn-warning').addClass('btn-success');
			$('button#mod-orden i.estado').removeClass('fa fa-pencil-square-o').addClass('fa fa-save');			
		}
		else{
			$("input:text.required").each(function() {
				if($(this).val()==''){
					errores = errores+1;
					$(this).css("border","1px solid red");
				}else{
					$(this).css("border","1px solid #ccc");
				}
			});
		
			$("textarea.required").each(function() {
				if($(this).val()==''){
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
				orden=$("input:text.orden").serialize();
				id_des=$("input:hidden.descrip").serialize();
				des=$("textarea.dd").serialize();
				datos="proyecto="+proyecto+"&fotos="+fotos+"&"+orden+"&"+id_des+"&"+des;
				$.getJSON(base_url+"sgwc/reporte/modifica_orden",datos,function(data){
					if(data.msg=='ok'){
						$("input:text.orden").attr("readonly",true);
						$("textarea.dd").attr("readonly",true);
						$("input:text.orden").removeClass('required');
						$("textarea.dd").removeClass('required');
						$('button#mod-orden').attr("estado",1).removeClass('btn-success').addClass('btn-warning');
						$('button#mod-orden i.estado').removeClass('fa fa-save').addClass('fa fa-pencil-square-o');
					}
					else{
						alert('Ocurrio un error, intente nuevamente');
					}
				});	
			}
		}
	});	

	//solo numeros
	$("div#orden").on('keyup','.orden',function(){
		if ($(this).val()){
			$(this).val($(this).val().replace(/[^0-9]/g, ""));
		}
	});
	
	//descargar reporte ftp
	$("button.descarga").click(function(){
		id=$(this).attr('id');		
		archivo=$(this).attr('data-archivo');		
		datos="archivo="+archivo;

		$("#"+id).html("<i class='fa fa-refresh fa-spin'></i> Procesando...").attr("disabled",true);
		$.getJSON(base_url+"sgwc/download/descargar/",datos,function(data){
			if(data.msg=='ok'){
				$("#"+id).html("Descargar").attr("disabled",false);	
			}
			else{
				alert('Ocurrio un error, intente nuevamente');
				$("#"+id).html("Descargar").attr("disabled",false);	
			}
		});
	});
	
});