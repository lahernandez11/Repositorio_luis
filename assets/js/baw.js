$(document).ready(function(e) {	
	//carga div de respuesta automatica
	/*$('select#tipo_solicitud').change(function(){
		if($('select#tipo_solicitud').val()=='0'){
				$('div#respuesta-automatica').html('');			
				}else{
					tipo = $('select#tipo_solicitud').val();
					datos='tipo='+tipo;
					$.post(base_url+'baw/respuesta/carga_respuesta',datos,function(data){					
						$('div#respuesta-automatica').html(data);
					});
				}
	});*/
	
	
	$('select.campo-solicitud').change(function(){
		no_sel=0;
		$('select.campo-solicitud').each(function(index, element) {
            if($(this).val()==0){
				no_sel = no_sel + 1;
				}else{
					no_sel = no_sel + 0;
					}
        });
		//alert(no_sel);
		if(no_sel==0){
			tipo = $('select#tipo_solicitud').val();
			proyecto = $('select#proyecto').val();
					datos='tipo='+tipo+'&proyecto='+proyecto;
					$.post(base_url+'baw/respuesta/carga_respuesta',datos,function(data){					
						$('div#respuesta-automatica').html(data);
					});
			}else{
				$('div#respuesta-automatica').html('');
				}
		
	});
	
	//registro respuesta
	$("button#registro").click(function() {		
		var sHTML = $('#summernote').eq(0).code();
		sHTML = sHTML.replace(/&nbsp;/g,' ');
		var asunto = $('#asunto').val();	
		errores=0;
			$("input:text.required").each(function() {
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
					if(confirm('ESTA USTED SEGURO DE QUE DESEA REGISTRAR?')){
						datos='idproyecto='+$('select#proyecto').val()+'&accion='+$('#accion').val()+'&tipo='+$('select#tipo_solicitud').val()+'&asunto='+asunto+'&texto='+sHTML;
						//alert(datos);			
						$.post(base_url+'baw/respuesta/registrar',datos,function(data){
							$('div#resultado').html(data);
						});
					}else{
						return false;
					}
				}
		//alert(sHTML);			
	});
	
	//Vista Previa
	$(".vista_previa").click(function(){
		var sHTML = $('#summernote').eq(0).code();
		if($("#tipo_solicitud").val()!=0){
			$("div#cuerpo").html(sHTML);
			$("div#asunto").html($("input#asunto").val());
			$('#myModal').modal('show');
			}
		});
	
	//form respuesta a solicitud
	$("button#btn_respuesta").click(function() {
		var sHTML = $('#summernote').eq(0).code();	
		var solicitud = $("#solicitud").val();
		if(confirm('ESTA USTED SEGURO DE QUE DESEA REGISTRAR LA RESPUESTA?')){
			datos='solicitud='+solicitud+'&respuesta='+sHTML;
			$.post(base_url+'baw/administrar/respuesta',datos,function(data){
							$('div#mensaje_respuesta').html(data);
			});
			return true;
						
		}else{
			return false;
		}					
	});
	
	//editar solicitud tipo o correo
	$("button.editar").click(function(){
		accion=$(this).attr("id");
		if(accion=='editar'){
			$(this).text("Guardar");
			$(this).attr("id","guardar");
			$("#tipo-solicitud").attr("disabled",false);
			$("#correo").attr("disabled",false);			
		}
		else{			
			errores=0;
			$("input#correo").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
						
			if(errores>0){
					return false;
			}
			if($("#correo").val().indexOf('@', 0) == -1 || $("#correo").val().indexOf('.', 0) == -1) {
            	alert('El e-mail no es correcto.');
            	return false;
        	}	
			else{
				datos='correo='+$('#correo').val()+'&tipo='+$('#tipo-solicitud').val()+'&solicitud='+$('#idsolicitud').val();												
				$.getJSON(base_url+'baw/administrar/modificar_solicitud',datos,function(data){
				});
					$(this).text("Editar");
					$(this).attr("id","editar");
					$("#tipo-solicitud").attr("disabled",true);
					$("#correo").attr("disabled",true);													
			}
		}
	});
	
	
	
	//solicitudes descartadas
	$('div#menu').on('click','.descartados',function(){
		if(confirm('ESTA USTED SEGURO DE QUE DESEA DESCARTAR LA SOLICITUD?')){
			return true;						
		}else{
			return false;
		}
	});
	
	//solicitud de datos
	$("a#info").click(function(){
		//$("#cargando_info").addClass("alert alert-info");
		//$("#cargando_info").html('<i class="fa fa-spinner fa-spin fa-3x"></i> Por favor espere.');
	});
	
	//usuarios para solicitud de datos
	$("select#usuario_pregunta").change(function(){
		var str = "";
		var correo ="";
    	$("select option:selected").each(function() {
      		str += $( this ).text() + " ";
			correo += $( this ).attr("correo") + " ";
    	});
		n = $('#conteo').val();	
		sig=parseInt(n)+1;
		$('#conteo').val(sig);
		contenedor="<div class='row' id='dcorreo_usuario"+sig+"'><div class='col-sm-2'></div><div class='dcorreo_usuario col-sm-9'><input type='text' name='usuario"+sig+"' class='form-control usuarios' value='"+str+"' readonly ><input type='hidden' name='correo"+sig+"' class='correos' value='"+correo+"' ></div><div class='col-sm-1'><a id='"+sig+"' class='eliminar_correo' > X </a></div></div>";
		$(contenedor).insertAfter('div#usuario');
		//$( "div#usuario" ).text(str);
		//$("#correo_enviar").val(correo);
		//$("#usuario_enviar").val(str);
	});
	
	$("div#solicitar").on("click",".eliminar_correo",function(){
		id=$(this).attr("id");
		$("div#dcorreo_usuario"+id).remove();
	});
	
	//enviar solicitud de datos
	$("button#btn_enviar").click(function() {
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
					if(confirm('ESTA USTED SEGURO DE QUE DESEA SOLICITAR INFORMACION?')){
													
							//return true;
							url = base_url+"baw/administrar/solicitudes_atendidas/"+$("#id").val()+"/0";
							$(location).attr('href',url);							
						}else{
							return false;
							}
					}				
	});
	
	//LOADING STATE
	/*$(".loading-state").click(function(){
		$(this).html("<i class='fa fa-refresh fa-spin'></i> Enviando...").attr("disabled",true);
		$('.cancelar-state').attr("disabled",true);
	});*/
	
	
	$("a#info").click(function(){
		$(this).html("<i class='fa fa-refresh fa-spin'></i> Procesando...").attr("disabled",true);
		
		
	});
	
	$("form").submit(function(){
		$('.loading-state').html("<i class='fa fa-refresh fa-spin'></i> Enviando...").attr("disabled",true);
		$('.cancelar-state').attr("disabled",true);
		return true;
	});
	
	//form respuesta a informacion
	
	$("button#btn_informacion").click(function() {
		var sHTML = $('#summernote').eq(0).code();	
		var solicitud = $("#solicitud").val();
		if(confirm('ESTA USTED SEGURO DE QUE DESEA RESPONDER COMENTARIO?')){
			$("#mensaje_cargando").addClass("alert alert-info");
			$("#mensaje_cargando").html('<i class="fa fa-spinner fa-spin fa-3x"></i> El mensaje se esta enviando por favor espere.');
			
			datos='solicitud='+solicitud+'&respuesta='+sHTML+'&usuario='+$("#usuario_solicita").val();
			$.getJSON(base_url+'baw/informacion/responder_comentario',datos,function(data){
				if(data.msg!='ko'){
					url = base_url+"baw/informacion/informacion_responder/"+$("#idrespuesta").val();
					$(location).attr('href',url);
				}else{
					alert('Ocurrió un error, intente nuevamente');
				}	
			});
			return true;
						
		}else{
			return false;
		}					
	});
	
	//cerrar tema
	$("button.btn-cerrar").click(function() {		
		var id = $(this).attr("id");
		if(confirm('ESTA USTED SEGURO DE QUE CERRAR EL TEMA?')){
			datos='solicitud='+id+'&idcon'+$("#idsolicitud").val();
			$.getJSON(base_url+'baw/administrar/cerrar_tema',datos,function(data){
				if(data.msg!='ko'){
					url = base_url+"baw/administrar/solicitudes_atendidas/"+$("#idsolicitud").val()+"/0";
					$(location).attr('href',url);
				}else{
					alert('Ocurrió un error, intente nuevamente');
				}									
			});
			return true;						
		}else{
			return false;
		}					
	});
	
	
	//Para seccion de facturacion
	//Editar datos de la solicitud
	$("button.fact-editar").click(function(){
		accion=$(this).attr("id");
		if(accion=='editar'){
			$(this).text("Guardar");
			$(this).attr("id","guardar");
			$("#tipo-solicitud").attr("disabled",false);
			$("#correo").attr("disabled",false);			
		}
		else{			
			errores=0;
			$("input#correo").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
						
			if(errores>0){
					return false;
			}
			if($("#correo").val().indexOf('@', 0) == -1 || $("#correo").val().indexOf('.', 0) == -1) {
            	alert('El e-mail no es correcto.');
            	return false;
        	}	
			else{
				datos='correo='+$('#correo').val()+'&tipo='+$('#tipo-solicitud').val()+'&solicitud='+$('#idsolicitud').val();												
				$.getJSON(base_url+'baw/facturacion/modificar_solicitud',datos,function(data){
				});
					$(this).text("Editar");
					$(this).attr("id","editar");
					$("#tipo-solicitud").attr("disabled",true);
					$("#correo").attr("disabled",true);													
			}
		}
	});
	
	//cerrar tema
	$("button.fact-btn-cerrar").click(function() {		
		var id = $(this).attr("id");
		if(confirm('ESTA USTED SEGURO DE QUE CERRAR EL TEMA?')){
			datos='solicitud='+id+'&idcon'+$("#idsolicitud").val();
			$.getJSON(base_url+'baw/facturacion/cerrar_tema',datos,function(data){
				if(data.msg!='ko'){
					url = base_url+"baw/facturacion/solicitudes_atendidas/"+$("#idsolicitud").val()+"/0";
					$(location).attr('href',url);
				}else{
					alert('Ocurrió un error, intente nuevamente');
				}									
			});
			return true;						
		}else{
			return false;
		}					
	});
	
	//enviar solicitud de datos
	$("button#fact_btn_enviar").click(function() {
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
					if(confirm('ESTA USTED SEGURO DE QUE DESEA SOLICITAR INFORMACION?')){
													
							//return true;
							url = base_url+"baw/facturacion/solicitudes_atendidas/"+$("#id").val()+"/0";
							$(location).attr('href',url);							
						}else{
							return false;
							}
					}				
	});
	
	/*$('.seleccionar').click(function(){
		if($(this).hasClass('fa-square-o')){
			$(this).removeClass('fa-square-o').addClass('fa-check-square-o');
		}else{
			$(this).removeClass('fa-check-square-o').addClass('fa-square-o');
		}
		
		total=0;
		$('i.fa-check-square-o').each(function(index, element) {
        	tarifa =parseFloat($(this).attr('tarifa'));
			total = total + tarifa;
        });
		total = total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		$('td#total-tickets-seleccionados').text(total);
		
	});
				
	
	$('.validar-tickets').click(function(){
		$("span#tickets-mensaje").html('');
		count=0;
		$('.seleccionar').each(function(index, element) {
			if($(this).hasClass('fa-check-square-o')){count++;}
		});
		
		if(count>0){
			$('.seleccionar').each(function(index, element) {
            	if($(this).hasClass('fa-check-square-o')){
					var folio = $(this).attr('folio');
					var idticket = $(this).attr('idticket');
					datos = 'idsolicitud_ticket='+idticket;
					$.getJSON(base_url+'baw/facturacion/validar_ticket',datos,function(data){
						$("span#tickets-mensaje").append(data.msg).show().fadeOut(10000);
						if(data.val==0){
							$('i#'+idticket).removeClass('fa-check-square-o').addClass('fa-square-o');
						}
						});
				}
			});
			$(this).hide();
			$('.eliminar-tickets').show();
			$('.btn-acc-tickets').text('Ver tickets');
			$('a#info').removeClass('disabled');
			$('input#btn-responder-solicitud').removeClass('disabled');
		}else{
			alert('SELECCIONE LOS FOLIOS QUE DESAR VALIDAR');
			}
	});
	
	
	$('.eliminar-tickets').click(function(){
		$("span#tickets-mensaje").html('');
		if(confirm('LA VALIDACION DE TICKET SERA REVERTIDA, TODAS LAS SOLICITUDS DE INFORMACION Y TODAS LAS RESPUESTAS A SOLICITUDES DE INFORMACION SERAN ELIMINADAS, DESEA CONTINUAR?')){
			idsolicitud=$(this).attr("idsolicitud");
			datos="idsolicitud="+idsolicitud;
			$.getJSON(base_url+'baw/facturacion/eliminar_tickets',datos,function(data){
				if(data.msg=='ok'){
					$('.seleccionar').each(function(index, element) {
						if($(this).hasClass('fa-check-square-o')){
								$(this).removeClass('fa-check-square-o').addClass('fa-square-o');
						}
					});
					$("span#tickets-mensaje").append("<div class='alert alert-success'>La validacion de tickets fue revertida</div>").show().fadeOut(10000);
					$('.eliminar-tickets').hide();
					$('.validar-tickets').show();
					$('td#total-tickets-seleccionados').text('0.00');
					$('.btn-acc-tickets').text('Validar tickets');
					$('a#info').addClass('disabled');
					$('input#btn-responder-solicitud').addClass('disabled');
					$('div#preguntas').html('<div class="col-sm-12"><label class="control-label">No se ha hecho solicitud de informaci&oacute;m</label></div>');
				}else{
					alert('LA VALIDACION DE TICKETS NO PUDO SER REVERTIDA, INTENTE NUEVAMENTE');	
					}
			});
		}
	});*/
	
	$('.celda-validar-ticket input').click(function(){
		//stotal=0;
		total=0;
		$('.celda-validar-ticket').each(function(index, element) {
			idticket = $(this).attr('idticket');
			if($('input[name="validar'+idticket+'"]:checked').val()==2){
				tarifa =parseFloat($(this).attr('tarifa'));
				total = total + tarifa;
				}else{
					total = total + 0;
					}
        });
		total = total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		$('td#total-tickets-seleccionados').text(total);
		
	});
	
	
	$('.validar-tickets').click(function(){
		celdas=0;
		validados=0;
		$("span#tickets-mensaje").html('');
		$('.celda-validar-ticket').each(function(index, element) {
			celdas = celdas + 1;
            var folio = $(this).attr('folio');
			var idticket = $(this).attr('idticket');
			var estado = $('input[name="validar'+idticket+'"]:checked').val();
			if(estado!=null){
				validados = validados + 1;
				datos = 'idsolicitud_ticket='+idticket+'&estado='+estado;
				if($('td#'+idticket).hasClass('contar')){
					$.getJSON(base_url+'baw/facturacion/validar_ticket',datos,function(data){
						$("span#tickets-mensaje").append(data.msg).show().fadeOut(10000);
						if(data.val==0){
							$('input[name="validar'+idticket+'"][value="2"]').attr('checked', false);
							$('input[name="validar'+idticket+'"][value="3"]').prop('checked', true);
							$('input[name="validar'+idticket+'"][value="2"]').attr('disabled', true);
							$('input[name="validar'+idticket+'"][value="3"]').prop('disabled', true);
							$('td#'+idticket).addClass('no_contar');
							$('td#'+idticket).removeClass('contar');
						}else{
							$('td#'+idticket).addClass('no_contar');
							$('td#'+idticket).removeClass('contar');
							$('input[name="validar'+idticket+'"][value="2"]').attr('disabled', true);
							$('input[name="validar'+idticket+'"][value="3"]').prop('disabled', true);
						}
					});
				}
			}
			
        });
		
		//alert('celdas='+celdas+'&validados='+validados);
		
		if(celdas==validados){
			$(this).hide();
			$('.eliminar-tickets').show();
			$('.notificar-tickets').show();
			}else{
				$('.eliminar-tickets').show();
				}
		/**/
		
		total=0;
		$('.celda-validar-ticket').each(function(index, element) {
			idticket = $(this).attr('idticket');
			if($('input[name="validar'+idticket+'"]:checked').val()==2){
				tarifa =parseFloat($(this).attr('tarifa'));
				total = total + tarifa;
				}else{
					total = total + 0;
					}
        });
		total = total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		$('td#total-tickets-seleccionados').text(total);
		
	});
	
	$('.eliminar-tickets').click(function(){
		$("span#tickets-mensaje").html('');
		if(confirm('LA VALIDACION DE TICKET SERA REVERTIDA, TODAS LAS SOLICITUDS DE INFORMACION Y TODAS LAS RESPUESTAS A SOLICITUDES DE INFORMACION SERAN ELIMINADAS, DESEA CONTINUAR?')){
			idsolicitud=$(this).attr("idsolicitud");
			datos="idsolicitud="+idsolicitud;
			$.getJSON(base_url+'baw/facturacion/eliminar_tickets',datos,function(data){
				if(data.msg!='Error'){
					$('.celda-validar-ticket').each(function(index, element) {
						var idticket = $(this).attr('idticket');
						if($('td#'+idticket).hasClass('no_vacio')){
							$('input[name="validar'+idticket+'"][value="2"]').attr('checked', false);
							$('input[name="validar'+idticket+'"][value="3"]').prop('checked', false);
							$('input[name="validar'+idticket+'"][value="2"]').attr('disabled', false);
							$('input[name="validar'+idticket+'"][value="3"]').prop('disabled', false);
							$('td#'+idticket).addClass('contar');
							$('td#'+idticket).removeClass('no_contar');
						}
					});
					$("span#tickets-mensaje").append("<div class='alert alert-success'>La validacion de tickets fue revertida</div>").show().fadeOut(10000);
					$('.eliminar-tickets').hide();
					$('.notificar-tickets').hide();
					$('.validar-tickets').show();
					$('td#total-tickets-seleccionados').text(data.msg);
				}else{
					alert('LA VALIDACION DE TICKETS NO PUDO SER REVERTIDA, INTENTE NUEVAMENTE');	
					}
			});
		}
	});
	
	$('.notificar-tickets').click(function(){
		$("span#tickets-mensaje").html('');
		idsolicitud = $(this).attr('idsolicitud');
		datos = 'idsolicitud='+idsolicitud;
		$.getJSON(base_url+'baw/facturacion/notificar_tickets',datos,function(data){
				if(data.msg=='ok'){
					$("span#tickets-mensaje").append("<div class='alert alert-success'>La notificacion fue enviada correctamente.</div>").show().fadeOut(10000);
					$('.eliminar-tickets').hide();
					$('.notificar-tickets').hide();
					}else{
						$("span#tickets-mensaje").append("<div class='alert alert-success'>No ha sido posible enviar la notificacion, intente nuevamente.</div>").show().fadeOut(10000);
						}
		});
	});
	
	/*=================VALIDACION AUTOMATICA=============================*/
	
	$('#comenzar_validacion_automatica').click(function(){
		fecha = $('#validacion_automatica_fecha').val();
		$('#validacion_automatica_resumen').html('<div class="alert alert-info"><i class="fa fa-refresh fa-spin"></i> Validando ...</div>');
		datos = 'fecha='+fecha;
		$.getJSON(base_url+'baw/facturacion/validar_archivos',datos,function(json){
			//if(json.msg==2){
			  //if(json.msg>=1){
				resumen='<table class="table table-condensed table-bordered table-striped"><thead><tr><th>#</th><th width="10%">Folio solicitud</th><th>Tickets de la solicitud</th><th>Tickets no validados</th><th>Tickets validados</th><th>Tickets validados previamente</th><th>Total de solicitud ($)</th><th>Total de tickets validados ($)</th><th>Total de tickets no validados ($)</th><th>Inefectividad</th><th width="2%">&nbsp;</th></tr></thead><tbody>';
				i=0;
				$.getJSON(base_url+'baw/facturacion/ejecutar_validacion',datos,function(json){
					$.each(json,function(x,y){
						i++;
						resumen = resumen + '<tr class="fila" id="'+y.idsolicitud+'"><td>'+i+'</td><td>'+y.folio+'</td><td align="center">'+y.total_tickets+'</td><td align="center">'+y.tickets_no_validados+'</td><td align="center">'+y.tickets_validados+'</td><td align="center">'+y.tickets_validados_previamente+'</td><td align="right">'+y.total_tarifa+'</td><td align="right">'+y.total_tarifa_validados+'</td><td align="right">'+y.total_tarifa_no_validados+'</td><td align="center">'+y.inefectividad+'%</td><td class="not"></td></tr>';
					});
					resumen = resumen + '</tbody></table>';
					if(i>0){
						btn =  '<a target="_blank" href="'+base_url+'/baw/facturacion/ejecutar_validacion_pdf/'+json[0].idvalidacion+'" style="margin-left:10px;" id="validacion_automatica_pdf" class="btn btn-danger pull-right" fecha="'+fecha+'">Ver PDF</a><a id="validacion_automatica_notificar" class="btn btn-primary pull-right" fecha="'+fecha+'">Enviar notificaciones</a><br><div class="clearfix"><br></div>';
					}else{
						btn = '<div class="clearfix"></div>';
					}
					$('#validacion_automatica_resumen').html('<span class="pull-left">Fueron encontradas '+i+' solicitudes del dia '+fecha+'</span>'+btn+resumen+btn);
				});
			/*}else{
				$('#validacion_automatica_resumen').html('<div class="alert alert-danger"><i class="fa fa-warning"></i> La validaci&oacute;n no puede realizarse debido a que no se encuentran todos los archivos necesarios para llevarla a cabo. Verifique que han sido cargados previamente.</div>');
			}*/
		});
	});
	
	$('#validacion_automatica_resumen').on('click','a#validacion_automatica_notificar',function(){
		$('#validacion_automatica_resumen table tr.fila').each(function(index, element) {
            var idsolicitud = $(this).attr("id");
			datos = 'idsolicitud='+idsolicitud;
			$.getJSON(base_url+'baw/facturacion/notificar_tickets',datos,function(json){
				if(json.msg=='ok'){
					$('tr#'+idsolicitud+' td.not').html('<i style="color:green" class="fa fa-envelope"></i>');
				}else{
					$('tr#'+idsolicitud+' td.not').html('<i style="color:red" class="fa fa-envelope"></i>');
				}
			});
        });
	});
	
	/*===================FIN VALIDACION AUTOMATICA========================*/
	
	/*==========================INICIA BUSQUEDA===========================*/
	
	$('input#evento').keyup(function(){
		//$('tr.loading').remove();
		//$('<tr class="loading"><td></td></tr>').insertAfter('table#grid thead');
		valor = $(this).val();
		if(valor.length>3){
			$('div#loading').show();
			$('#resultados').hide();
			console.log('mosrta');
			datos = 'valor='+valor;
			$.getJSON(base_url+'baw/facturacion/buscar',datos,function(json){
				//$('tr.loading').remove();
				$("#grid").igGrid({
					width: '100%',
					columns: [
						{ headerText: "PLAZA", key: "nombre_plaza", dataType: "string", width: "10%" },
						{ headerText: "SOLICITUD", key: "folio", dataType: "string", width: "10%" },
						{ headerText: "FECHA", key: "fecha", dataType: "string", width: "8%" },
						{ headerText: "HORA", key: "hora", dataType: "string", width: "8%" },
						{ headerText: "EVENTO", key: "folio_evento", dataType: "string", width: "10%" },
						{ headerText: "TARIFA", key: "tarifa", dataType: "string", width: "10%" },
						{ headerText: "ESTADO", key: "estado", dataType: "string", width: "10%" },
						{ headerText: "VALIDA", key: "valida", dataType: "string", width: "20%" },
						{ headerText: "FECHA VALIDA", key: "fecha_valida", dataType: "string", width: "10%" },
						{ headerText: "RESPONDE", key: "usuario_respuesta", dataType: "string", width: "20%" },
						{ headerText: "FECHA RESPUESTA", key: "fecha_respuesta", dataType: "string", width: "10%" },
					],
					
					autofitLastColumn: false,
					autoGenerateColumns: false,
					dataSource: json,
					dataRendered: function (evt, ui) {
							ui.owner.element.find("tr td:nth-child(3)").css("background-color", "#99C85F");
							ui.owner.element.find("tr td:nth-child(4)").css("background-color", "#99C85F");
							ui.owner.element.find("tr td:nth-child(5)").css("background-color", "#99C85F");
							ui.owner.element.find("tr td:nth-child(6)").css("background-color", "#99C85F");
							ui.owner.element.find("tr td:nth-child(7)").css("background-color", "#99C85F");
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
							pageSize: 10,
							pageSizeList : [10, 20, 50, 100, 500, 1000]
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
						/*{
							name: "Summaries"
						}*/
					]
				});
			}).done(function(){
				$('div#loading').hide();
				$('div#resultados').show();
			});
		}else{
			$('div#resultados').html('<table id="grid" style="font-size:10px;"></table>');
		}
	});
	
	/*========================FINALIZA BUSQUEDA===========================*/
	
	/*CONSULTA DE SOLICITUD DE INFORMACION */
	$("#grid").on("click",".sol_info",function(){
		datos="idsolicitud="+$(this).attr("id");
		$.getJSON(base_url+'baw/informacion/modal_solicitud_info',datos,function(data){	
			$("#folio").html(data.folio);	
			$("#escrito_por").val(data.nombre_solicitante);
			$("#correo").val(data.mail_solicitante);
			$("#tipo").val(data.tipo_solicitud);
			$("#tema").val(data.tema_solicitud);
			$("#descripcion").text(data.mensaje_solicitud);		
		});
	});
	
	/*========================FORMULARIO DE RESPUESTA A SOLICTITUD DE INFORMACION===========================*/
	$('form#respuesta').on('click','button.loading-state',function(){		
		var aHTML = $('form#respuesta #summernote').code();		
		var res=aHTML.replace(/<p>|<br>|<div>|&nbsp;|<\/p>|<\/div>|\b|\n|\r|\s|\S|\t/g, "");
		if(res==''){
			alert('Complete los campos');
			return false;			
		}		
		else{			
			return true;
		}
	});
	
});