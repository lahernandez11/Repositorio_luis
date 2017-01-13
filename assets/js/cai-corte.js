$(document).ready(function(e) {
	
	$("div#contenedor_caratula").on("keyup","input.numeric",function(){ 
    	this.value = this.value.replace(/[^0-9\.]/g,'');
	});
	
	//================================SELECCIONAR CASETA==================================================//	
	$("select#corte_caseta").change(function(){
				caseta=$(this).val();
				if(caseta==0){
						$("div#contenedor_caratula").html("");
						alert('Seleccione una caseta');
					}else{
					datos = "caseta="+caseta;
					//console.log($("#fecha_corte").val());
					//alert(caseta);
					datos2 = "fecha="+$("#fecha_corte").val()+"&caseta="+caseta;
					//alert(datos2);
					$.post(base_url+"cai/corte/carga_tipo_cambio",datos2,function(data){
						$("div#tipo_cambio").html(data);
						});
					$.post(base_url+"cai/corte/carga_bobina_activa",datos,function(data){
						$("div#bobina_activa").html(data);
						});
					$.post(base_url+"cai/corte/carga_caratula",datos,function(data){
						$("div#contenedor_caratula").html(data);
						});
					}
				});
				
	$("#fecha_corte").change(function(){
		fecha=$(this).val();
		caseta = $("select#corte_caseta").val();
		datos2 = "fecha="+fecha+"&caseta="+caseta;
		$.post(base_url+"index.php/corte/carga_tipo_cambio",datos2,function(data){
			$("div#tipo_cambio").html(data);
			});
		});
	
	
	
	//Funcion para Enter to Tab
    $("div#contenedor_caratula").on("keyup","input.referencia",function(event){
	indice = parseInt($(this).attr("tabindex"));
	next = indice+1;
	var charCode = (e.which) ? e.which : event.keyCode
	if (charCode==13){  
			$(":input[tabindex="+next+"]").select();
			if($(":input[tabindex="+next+"]").val()==undefined){
				if($(":input[tabindex=500]").is(":visible")){ 
					console.log("500 invisible");
					$(":input[tabindex=500]").select();
					}else{
						$(":input[tabindex=502]").select();
						console.log("500 oculto");
						}
			}
		}
	});
	
	$("div#contenedor_caratula").on("keyup","input.digitar",function(event){
	indice = parseInt($(this).attr("tabindex"));
	next = indice+1;
	var charCode = (e.which) ? e.which : event.keyCode
	if (charCode==13){  
			$(":input[tabindex="+next+"]").select();
		}
	});
	
	
	$("div#contenedor_caratula").on("keyup",".referencia",function(){
		i = $(this).attr("pago");
		j = $(this).attr("vehiculo");
		suma_columna = 0;
		suma_fila = 0;
		suma_importe_1 = 0;
		suma_importe_2 = 0;
		suma_total_aforo = 0;
		suma_total_eje = 0;
		suma_total_importe_1 = 0;
		suma_total_importe_2 = 0;
		suma_total_efectivo_1 = 0;
		suma_total_efectivo_2 = 0;
		/*suma_faltante=0;
		suma_total_ingresos=0;*/
		suma_total_tvas=0;
		suma_total_tvas_2=0;
		/*suma_total_tvas2=0;*/
		suma_total_telepeaje=0;
		suma_total_exentos=0;
		suma_total_residentes=0;
		suma_total_eludidos=0;
		/*suma_subtotal=0;*/
		
		
		
		
		
		//====================SUMAR TOTAL DE VEHICULOS POR TIPO DE PAGO===================//
		$(".column_"+i).each(function() {
			if(($(this).val()=="")||($(this).attr("vehiculo")=="5")||($(this).attr("vehiculo")=="19")||($(this).attr("vehiculo")=="20")){
				valor_columna=0;
				}else{
					valor_columna=parseInt($(this).val());
					}	
  			suma_columna = suma_columna+valor_columna;
			$("#total_column_"+i).attr("value",suma_columna);
			

			});
			
		
		//====================SUMAR TOTAL DE AFORO, EJES,IMPORTE POR TIPO DE VEHICULO===================//	
		$("."+j).each(function() {
			
			n=parseInt($("#eje_"+j).attr("eje"));//numero de ejes
			tarifa_1 = $("#tarifa_1_"+j).val();//tarifa nacional
			tarifa_2 = $("#tarifa_2_"+j).val();//tarifa extranjera
			
			if(($(this).val()=="")||($(this).attr("pago")=="10")){
				valor_fila=0;
				}else{
					valor_fila=parseInt($(this).val());
					}	
  			suma_fila = suma_fila+valor_fila;
			$("#total_aforo_"+j).attr("value",suma_fila);//Valor de suma de aforo
			$("#total_eje_"+j).attr("value",n*suma_fila);//Valor de suma de ejes
			
			if(($(this).val()=="")||($(this).attr("pago")=="8")||($(this).attr("pago")=="9")||($(this).attr("pago")=="10")||($(this).attr("pago")=="2")){
				valor_importe_1=0;
				}else{
					valor_importe_1=parseInt($(this).val());
					}
			suma_importe_1 = suma_importe_1+(valor_importe_1*tarifa_1);
			$("#total_importe_1_"+j).attr("value",suma_importe_1);//valor de importe nacional
			
			
			if(($(this).val()=="")||($(this).attr("pago")!="2")){
				valor_importe_2=0;
				}else{
					valor_importe_2=parseInt($(this).val());
					}
			suma_importe_2 = suma_importe_2+(valor_importe_2*tarifa_2);
			$("#total_importe_2_"+j).attr("value",suma_importe_2);//valor de importe extranjero
			});
			
			
		//====================SUMAR TOTAL DE AFOROS===================//
		$(".subtotal_aforo").each(function() {
			if(($(this).val()=="")||($(this).attr("id")=="total_aforo_5")||($(this).attr("id")=="total_aforo_19")||($(this).attr("id")=="total_aforo_20")){
				valor_subtotal_aforo =0;
				}else{
					valor_subtotal_aforo = parseInt($(this).val());
					}
				suma_total_aforo = suma_total_aforo+valor_subtotal_aforo;
				$("#total_aforo").attr("value",suma_total_aforo);
			});
			
		
		//====================SUMAR TOTAL DE EJES===================//
		$(".subtotal_eje").each(function() {
			if(($(this).val()=="")){
				valor_subtotal_eje =0;
				}else{
					valor_subtotal_eje = parseInt($(this).val());
					}
				suma_total_eje = suma_total_eje+valor_subtotal_eje;
				$("#total_eje").attr("value",suma_total_eje);
			});
			
			
		//====================SUMAR TOTAL DE IMPORTE NACIONAL===================//
		$(".subtotal_importe_1").each(function() {
            if(($(this).val()=="")){
				valor_subtotal_importe_1 =0;
				}else{
					valor_subtotal_importe_1 = parseInt($(this).val());
					}
				suma_total_importe_1 = suma_total_importe_1+valor_subtotal_importe_1;
				$("#total_importe_1").attr("value",suma_total_importe_1);
        	});
			
			
		//====================SUMAR TOTAL DE IMPORTE EXTRANJERO===================//
		$(".subtotal_importe_2").each(function() {
            if(($(this).val()=="")){
				valor_subtotal_importe_2 =0;
				}else{
					valor_subtotal_importe_2 = parseFloat($(this).val());
					}
				suma_total_importe_2 = suma_total_importe_2+valor_subtotal_importe_2;
				$("#total_importe_2").attr("value",suma_total_importe_2.toFixed(2));
        	});
		
		
		//===============================TOTALES MEDIOS ELECTRONICOS==============//
		$(".column_1").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_efectivo_1 = parseInt($(this).val());
			}else{
				valor_total_efectivo_1 =0;
				}
				suma_total_efectivo_1 = suma_total_efectivo_1 + (valor_total_efectivo_1*tarifa);
				
			});
		
		$(".column_3").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_tvas = parseInt($(this).val());
			}else{
				valor_total_tvas =0;
				}
				suma_total_tvas = suma_total_tvas + (valor_total_tvas*tarifa);
				
			});
			
		$(".column_4").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_tvas_2 = parseInt($(this).val());
			}else{
				valor_total_tvas_2 =0;
				}
				suma_total_tvas_2 = suma_total_tvas_2 + (valor_total_tvas_2*tarifa);
				
			});
			
			
		$(".column_5").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_telepeaje = parseInt($(this).val());
			}else{
				valor_total_telepeaje =0;
				}
				suma_total_telepeaje = suma_total_telepeaje + (valor_total_telepeaje*tarifa);
				
			});
		
		
		$(".column_6").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_residentes = parseInt($(this).val());
			}else{
				valor_total_residentes =0;
				}
				suma_total_residentes = suma_total_residentes + (valor_total_residentes*tarifa);
				
			});
			
		$(".column_7").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_residentes = parseInt($(this).val());
			}else{
				valor_total_residentes =0;
				}
				suma_total_residentes = suma_total_residentes + (valor_total_residentes*tarifa);
				
			});
			
		$(".column_8").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_exentos = parseInt($(this).val());
			}else{
				valor_total_exentos =0;
				}
				suma_total_exentos = suma_total_exentos + (valor_total_exentos*tarifa);
				
			});
			
		$(".column_9").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_exentos = parseInt($(this).val());
			}else{
				valor_total_exentos =0;
				}
				suma_total_exentos = suma_total_exentos + (valor_total_exentos*tarifa);
				
			});
			
		$(".column_10").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_1_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_eludidos = parseInt($(this).val());
			}else{
				valor_total_eludidos =0;
				}
				suma_total_eludidos = suma_total_eludidos + (valor_total_eludidos*tarifa);
				
			});
		
		$(".column_2").each(function() {
			vehiculo = $(this).attr("vehiculo");
			tarifa = $("#tarifa_2_"+vehiculo).val();
			if($(this).val()!=""){
				valor_total_efectivo_2 = parseInt($(this).val());
			}else{
				valor_total_efectivo_2 =0;
				}
				suma_total_efectivo_2 = suma_total_efectivo_2 + (valor_total_efectivo_2*tarifa);
				
			});
		
		$("#tarjetas_vas").attr("value",suma_total_tvas);//total de tarjetas vas
		$("#telepeaje").attr("value",suma_total_telepeaje);//total de telepeaje
		$("#residentes").attr("value",suma_total_residentes);//total de residentes
		$("#subtotal").attr("value",parseInt(suma_total_tvas+suma_total_telepeaje+suma_total_residentes));//subtotal
		$("#exentos").attr("value",suma_total_exentos);//total de exentos
		$("#eludidos").attr("value",suma_total_eludidos);//total de eludidos
		
		//===============================FIN TOTALES MEDIOS ELECTRONICOS==============//
		
		
		//===============================TOTALES MONEDA NACIONAL EN KEYUP DE GRID======================//
		$("#tarjetas_vas_2").attr("value",suma_total_tvas_2);//total de tarjetas vas 2
		$("#ingreso_sd_1").attr("value",parseInt(suma_total_efectivo_1)+parseInt(suma_total_tvas_2));//total de efectivo moneda nacional
		retiros_parciales_1 = $("#retiros_parciales_1").val();
		ultimo_retiro_1 = $("#ultimo_retiro_1").val();
		tvas_2 = $("#tarjetas_vas_2").val();
		ingreso_sd_1 = $("#ingreso_sd_1").val();
		
		faltante_pagado_1 = parseInt(ingreso_sd_1)-(parseInt(retiros_parciales_1)+parseInt(ultimo_retiro_1)+parseInt(tvas_2));
		if(faltante_pagado_1<0){
			$("#faltante_pagado_1").val(0);
			}else{
				$("#faltante_pagado_1").val(faltante_pagado_1);
				}
				
		faltante_pagado_1 = $("#faltante_pagado_1").val();
		total_efectivo_1 = parseInt(faltante_pagado_1) + parseInt(tvas_2) + parseInt(ultimo_retiro_1) + parseInt(retiros_parciales_1);
		$("#total_efectivo_1").val(parseInt(total_efectivo_1));
		
		total_efectivo_1 = $("#total_efectivo_1").val();
		sobrante_1 = parseInt(total_efectivo_1) - parseInt(ingreso_sd_1);
		if(sobrante_1<0){
			$("#sobrante_1").val(0);
			}else{
				$("#sobrante_1").val(sobrante_1);
				}
		subtotal = $("#subtotal").val();
		total_ingresos = parseInt(ingreso_sd_1) + parseInt(subtotal);
		$("#total_ingresos").val(total_ingresos); 		
		$("#total_depositado").val(parseInt(total_efectivo_1));
		
		
		//===============================TOTALES MONEDA EXTRANJERA EN KEYUP DE GRID======================//
		$("#ingreso_sd_2").attr("value",suma_total_efectivo_2.toFixed(2));//total de efectivo moneda extranjera
		retiros_parciales_2 = $("#retiros_parciales_2").val();
		ultimo_retiro_2 = $("#ultimo_retiro_2").val();
		ingreso_sd_2 = $("#ingreso_sd_2").val();
		//calcular faltante pagado extranjera
		faltante_pagado_2 = parseFloat(ingreso_sd_2)-(parseFloat(retiros_parciales_2)+parseFloat(ultimo_retiro_2));
		if(faltante_pagado_2<0){
			$("#faltante_pagado_2").val(0);
			}else{
				$("#faltante_pagado_2").val(faltante_pagado_2.toFixed(2));
				}
		//calcular total efectivo extranjera
		total_efectivo_2 = parseFloat(faltante_pagado_2) + parseFloat(ultimo_retiro_2) + parseFloat(retiros_parciales_2);
		$("#total_efectivo_2").val(total_efectivo_2.toFixed(2));
		//calcular sobrante extranjera
		total_efectivo_2 = $("#total_efectivo_2").val();
		sobrante_2 = parseFloat(total_efectivo_2) - parseFloat(ingreso_sd_2);
		if(sobrante_2<0){
			$("#sobrante_2").val(0);
			}else{
				$("#sobrante_2").val(sobrante_2.toFixed(2));
				}
		$("#total_a_depositar").val(total_efectivo_2);
		
		
		
		//===============================DIFERENCIA DE FOLIOS=======================//
		
		utilizados = parseInt($("#total_folios_utilizados").val());
		cancelados = parseInt($("#total_folios_cancelados").val());
		noemitidos = parseInt($("#total_folios_noemitidos").val());
		//console.log(utilizados);
		total_folios = (utilizados)-(cancelados)-(noemitidos);
		$("#total_folios").val(total_folios);
		if($("#total_column_1").val()==""){
			total_folios_efectivo_1=0;
			}else{
				if($.isNumeric($("#total_column_1").val())==false){
						total_folios_efectivo_1=0;
					}else{
						total_folios_efectivo_1 = parseInt($("#total_column_1").val());
					}	
			}
		if($("#total_column_2").val()==""){
			total_folios_efectivo_2=0;
			}else{
				if($.isNumeric($("#total_column_2").val())==false){
						total_folios_efectivo_2=0;
					}else{
						total_folios_efectivo_2 = parseInt($("#total_column_2").val());
					}	
			}
		
		total_folios_efectivo = total_folios_efectivo_1 + total_folios_efectivo_2;
		//console.log(total_folios_efectivo);
		//diferencia_folios = (total_folios_efectivo)-(utilizados);
		diferencia_folios = (total_folios_efectivo)-((utilizados)-(cancelados)-(noemitidos));
		//console.log(diferencia_folios);
		$("#diferencia_folios").val(diferencia_folios);
		
		
		console.log("d");
		
	});//Fin de Keyup .referencia (Grid)
	
	
	//===============================TOTALES MONEDA NACIONAL EN KEYUP DE RETIROS PARCIALES NACIONALES======================//
	/*$("div#totales").on("click",function(){
		console.log('');
		});*/
	$("div#contenedor_caratula").on("keyup","input#retiros_parciales_1",function(){
		console.log('keyup');
		if($(this).val()==""){
			retiros_parciales_1=0;
			}
			else{
				retiros_parciales_1=parseInt($(this).val());
				}
		if($("#ultimo_retiro_1").val()==""){
			ultimo_retiro_1=0;
			}else{
				ultimo_retiro_1 = $("#ultimo_retiro_1").val();
				}
		
		tvas_2 = $("#tarjetas_vas_2").val();
		ingreso_sd_1 = $("#ingreso_sd_1").val();
		
		
		faltante_pagado_1 = parseInt(ingreso_sd_1)-(parseInt(retiros_parciales_1)+parseInt(ultimo_retiro_1)+parseInt(tvas_2));
		if(faltante_pagado_1<0){
			$("#faltante_pagado_1").val(0);
			}else{
				$("#faltante_pagado_1").val(faltante_pagado_1);
				}
				
		faltante_pagado_1 = $("#faltante_pagado_1").val();
		total_efectivo_1 = parseInt(faltante_pagado_1) + parseInt(tvas_2) + parseInt(ultimo_retiro_1) + parseInt(retiros_parciales_1);
		$("#total_efectivo_1").val(parseInt(total_efectivo_1));
		
		total_efectivo_1 = $("#total_efectivo_1").val();
		sobrante_1 = parseInt(total_efectivo_1) - parseInt(ingreso_sd_1);
		if(sobrante_1<0){
			$("#sobrante_1").val(0);
			}else{
				$("#sobrante_1").val(sobrante_1);
				}
		subtotal = $("#subtotal").val();
		total_ingresos = parseInt(ingreso_sd_1) + parseInt(subtotal);
		$("#total_ingresos").val(total_ingresos); 		
		$("#total_depositado").val(parseInt(total_efectivo_1));
		});
		
	//===============================TOTALES MONEDA NACIONAL EN KEYUP DE ULTIMO RETIRO NACIONALES======================//
	$("div#contenedor_caratula").on("keyup","#ultimo_retiro_1",function(){
		if($(this).val()==""){
			ultimo_retiro_1=0;
			}
			else{
				ultimo_retiro_1=parseInt($(this).val());
				}
		if($("#retiros_parciales_1").val()==""){
			retiros_parciales_1=0;
			}else{
				retiros_parciales_1 = $("#retiros_parciales_1").val();
				}
		
		tvas_2 = $("#tarjetas_vas_2").val();
		ingreso_sd_1 = $("#ingreso_sd_1").val();
		
		
		faltante_pagado_1 = parseInt(ingreso_sd_1)-(parseInt(retiros_parciales_1)+parseInt(ultimo_retiro_1)+parseInt(tvas_2));
		console.log(faltante_pagado_1);
		if(faltante_pagado_1<0){
			$("#faltante_pagado_1").val(0);
			}else{
				$("#faltante_pagado_1").val(faltante_pagado_1);
				}
				
		faltante_pagado_1 = $("#faltante_pagado_1").val();
		total_efectivo_1 = parseInt(faltante_pagado_1) + parseInt(tvas_2) + parseInt(ultimo_retiro_1) + parseInt(retiros_parciales_1);
		$("#total_efectivo_1").val(parseInt(total_efectivo_1));
		
		total_efectivo_1 = $("#total_efectivo_1").val();
		sobrante_1 = parseInt(total_efectivo_1) - parseInt(ingreso_sd_1);
		if(sobrante_1<0){
			$("#sobrante_1").val(0);
			}else{
				$("#sobrante_1").val(sobrante_1);
				}
		subtotal = $("#subtotal").val();
		total_ingresos = parseInt(ingreso_sd_1) + parseInt(subtotal);
		$("#total_ingresos").val(total_ingresos); 		
		$("#total_depositado").val(parseInt(total_efectivo_1));
		});
		
		
	//===============================TOTALES MONEDA EXTRANJERA EN KEYUP DE RETIROS PARCIALES EXTRANJEROS======================//
	$("div#contenedor_caratula").on("keyup","#retiros_parciales_2",function(){
		if($(this).val()==""){
			retiros_parciales_2=0;
			}
			else{
				retiros_parciales_2=parseFloat($(this).val());
				}
		if($("#ultimo_retiro_2").val()==""){
			ultimo_retiro_2=0;
			}else{
				ultimo_retiro_2 = $("#ultimo_retiro_2").val();
				}
		
		ingreso_sd_2 = $("#ingreso_sd_2").val();
		
		
		faltante_pagado_2 = parseFloat(ingreso_sd_2)-(parseFloat(retiros_parciales_2)+parseFloat(ultimo_retiro_2));
		if(faltante_pagado_2<0){
			$("#faltante_pagado_2").val(0);
			}else{
				$("#faltante_pagado_2").val(faltante_pagado_2.toFixed(2));
				}
				
		faltante_pagado_2 = $("#faltante_pagado_2").val();
		total_efectivo_2 = parseFloat(faltante_pagado_2) + parseFloat(ultimo_retiro_2) + parseFloat(retiros_parciales_2);
		$("#total_efectivo_2").val(total_efectivo_2.toFixed(2));
		
		total_efectivo_2 = $("#total_efectivo_2").val();
		sobrante_2 = parseFloat(total_efectivo_2) - parseFloat(ingreso_sd_2);
		if(sobrante_2<0){
			$("#sobrante_2").val(0);
			}else{
				$("#sobrante_2").val(sobrante_2.toFixed(2));
				}	
		$("#total_a_depositar").val(total_efectivo_2);
		});
		
	//===============================TOTALES MONEDA EXTRANJERA EN KEYUP DE ULTIMO RETIRO EXTRANJEROS======================//
	$("div#contenedor_caratula").on("keyup","#ultimo_retiro_2",function(){
		if($(this).val()==""){
			ultimo_retiro_2=0;
			}
			else{
				ultimo_retiro_2=parseFloat($(this).val());
				}
		if($("#retiros_parciales_2").val()==""){
			retiros_parciales_2=0;
			}else{
				retiros_parciales_2 = $("#retiros_parciales_2").val();
				}
		
		ingreso_sd_2 = $("#ingreso_sd_2").val();
		
		
		faltante_pagado_2 = parseFloat(ingreso_sd_2)-(parseFloat(retiros_parciales_2)+parseFloat(ultimo_retiro_2));
		if(faltante_pagado_2<0){
			$("#faltante_pagado_2").val(0);
			}else{
				$("#faltante_pagado_2").val(faltante_pagado_2.toFixed(2));
				}
				
		faltante_pagado_2 = $("#faltante_pagado_2").val();
		total_efectivo_2 = parseFloat(faltante_pagado_2) + parseFloat(ultimo_retiro_2) + parseFloat(retiros_parciales_2);
		$("#total_efectivo_2").val(total_efectivo_2.toFixed(2));
		
		total_efectivo_2 = $("#total_efectivo_2").val();
		sobrante_2 = parseFloat(total_efectivo_2) - parseFloat(ingreso_sd_2);
		if(sobrante_2<0){
			$("#sobrante_2").val(0);
			}else{
				$("#sobrante_2").val(sobrante_2.toFixed(2));
				}	
		$("#total_a_depositar").val(total_efectivo_2);
		});
	
	
	//===============================VALIDAR FOLIOS UTILIZADOS==============================//
				
$("div#contenedor_caratula").on("keyup",".boton_agregar_utilizados",function(event){
	var charCode = (e.which) ? e.which : event.keyCode
	if (charCode==13){
	contador = $(this).attr("contador");
	siguiente = parseInt(contador)+1;
	caseta = $('input#idcaseta').val();
	inicial = parseInt($('input#inicial'+contador).val());
	final = parseInt($('input#final'+contador).val());
	if(isNaN(inicial)==true){
		inicial="";
		}
	if(isNaN(final)==true){
		final="";
		}
	serie = $('select#serie'+contador).val();
	suma = 0;
	$('.input_folio_utilizado').each(function() {
        if((inicial==$(this).val())||(final==$(this).val())){
			suma = suma + 1;
			}else{
				suma = suma + 0;
				}
    
	});
	
	//bobina=0;
	//diferencia=0;
	$(".btn-utilizados").each(function() {
            //bobina = bobina+1;
			//inicial_dif = $('input#inicial'+bobina).val();
			//final_dif = $('input#final'+bobina).val();
			//parcial=(final_dif-inicial_dif)+1;
			//diferencia = diferencia +  parcial;
			//console.log("bobina"+bobina+"->inicial="+inicial_dif);
			//console.log("bobina"+bobina+"->final="+final_dif);
			//if(inicial_dif!=undefined){
			//		if(final_dif!=undefined){
			//				parcial=(final_dif-inicial_dif)+1;
			//				diferencia = diferencia +  parcial;
			//			}
			//		}
			//console.log("diferencia al agregar="+diferencia);
	});
	
	diferencia=0;
	for(i=1;i<=contador;i++){
		inicial_dif = $('input#inicial'+i).val();
		final_dif = $('input#final'+i).val();
		//console.log("bobina"+i+"->inicial="+inicial_dif);
		//console.log("bobina"+i+"->final="+final_dif);
		if(inicial_dif!=undefined){
					if(final_dif!=undefined){
							parcial=(final_dif-inicial_dif)+1;
							diferencia = diferencia +  parcial;
						}
					}
		}
		//console.log("diferencia al agregar="+diferencia);
		
	
	suma_rang = 0;
	rang = 0;
	$(".btn-utilizados").each(function() {
        rang = rang+1;
		final_eval = parseInt($('input#final'+rang).val());
		inicial_eval = parseInt($('input#inicial'+rang).val());
		//console.log(inicial_eval+'-'+final_eval);
		if((inicial>inicial_eval)&&(final<final_eval)){
			//console.log("ingresa a validar si"+inicial+">"+inicial_eval+"&&"+final+"<"+final_eval);
			suma_rang=suma_rang+1;
			//console.log(suma_rang);
			}
		if((inicial<final_eval)&&(final>final_eval)){
			//console.log("ingresa a evaluar si"+inicial+"<"+inicial_eval+"&&"+final+">"+final_eval);
			suma_rang=suma_rang+1;
			}
		if((final>inicial_eval)&&(final<final_eval)){
			//console.log("ingresa a evaluar si"+inicial+"<"+inicial_eval+"&&"+final+">"+final_eval);
			suma_rang=suma_rang+1;
			}
    });
	
	//console.log("suma="+suma+"suma_rang="+suma_rang);
	if((suma>2)||(suma_rang>0)||(inicial=="")||(final=="")||(parseInt(final)<parseInt(inicial))){
		alert("Ingrese un rango de folios correcto");
		$('input#inicial'+contador).val("");
		$('input#final'+contador).val("");
		}else{
			datos = "inicial="+inicial+"&final="+final+'&serie='+serie+'&caseta='+caseta;
			$.getJSON(base_url+'cai/corte/valida_folios',datos,function(data){
				if(data.kind=="green"){
					$("#total_folios_utilizados").val(diferencia);
					/*$('input#aceptar_utilizado'+contador).removeClass("boton_agregar_utilizados");
					$('input#aceptar_utilizado'+contador).removeClass("btn-primary");
					$('input#aceptar_utilizado'+contador).removeClass("enter_folio_utilizado");
					$('input#aceptar_utilizado'+contador).val("Eliminar");
					$('input#aceptar_utilizado'+contador).addClass("btn-danger");*/
					$('input#aceptar_utilizado'+contador)
						.attr('id','eliminar_utilizado'+contador)
						.attr('class','btn btn-sm btn-danger btn-utilizados boton_eliminar_utilizados')
						.attr('value','Eliminar');
	
					//$('input#aceptar_utilizado'+contador).addClass("disabled");
					$('.contenedor_folios_utilizados'+contador).after('<div class="contenedor_folios_utilizados'+siguiente+'">INICIAL<input type="text" id="inicial'+siguiente+'" name="inicial'+siguiente+'" class="input_folio_utilizado enter_folio_utilizado form-control"/>&nbsp;&nbsp;&nbsp;FINAL<input type="text" id="final'+siguiente+'" name="final'+siguiente+'" class="input_folio_utilizado enter_folio_utilizado form-control"/>&nbsp;&nbsp;&nbsp;<span id="span'+siguiente+'">SERIE</span>&nbsp;<input id="aceptar_utilizado'+siguiente+'" contador="'+siguiente+'" type="button" class="btn btn-success btn-sm boton_agregar_utilizados btn-utilizados enter_folio_utilizado" value="Agregar"/></div>');
					$('select#serie'+contador).clone().attr('id', 'serie'+siguiente).attr('name', 'serie'+siguiente).insertAfter('span#span'+siguiente);
					$('span#span'+siguiente).replaceWith('SERIE');
					$('input#inicial'+contador).attr("readonly",true);
					$('input#final'+contador).attr("readonly",true);
					$('select#serie'+contador).attr("readonly",true);
					
					utilizados = parseInt($("#total_folios_utilizados").val());
					cancelados = parseInt($("#total_folios_cancelados").val());
					noemitidos = parseInt($("#total_folios_noemitidos").val());
					total_folios = (utilizados)-(cancelados)+(noemitidos);
					$("#total_folios").val(total_folios);
					/*if($("#total_column_1").val()==""){
						total_folios_efectivo=0;	
						}else{
					total_folios_efectivo = parseInt($("#total_column_1").val());
						}*/
					/*if($("#total_column_1").val()==""){
						total_folios_efectivo_1=0;	
						}else{
							total_folios_efectivo_1 = parseInt($("#total_column_1").val());
						}*/
					if($("#total_column_1").val()==""){
						total_folios_efectivo_1=0;
						}else{
							if($.isNumeric($("#total_column_1").val())==false){
									total_folios_efectivo_1=0;
								}else{
									total_folios_efectivo_1 = parseInt($("#total_column_1").val());
								}	
						}
					if($("#total_column_2").val()==""){
						total_folios_efectivo_2=0;
						}else{
							if($.isNumeric($("#total_column_2").val())==false){
									total_folios_efectivo_2=0;
								}else{
									total_folios_efectivo_2 = parseInt($("#total_column_2").val());
								}	
						}
					total_folios_efectivo = total_folios_efectivo_1 + total_folios_efectivo_2;
					//diferencia_folios = (total_folios_efectivo)-(utilizados);
					diferencia_folios = (total_folios_efectivo)-((utilizados)-(cancelados)+(noemitidos));
					$("#diferencia_folios").val(diferencia_folios);
					//console.log("siguiente inicial");
					//$('input#inicial'+siguiente).select();
					//$('input#inicial'+siguiente).val("1");
					$("input#inicial"+siguiente).focus();
				}else{
					alert(data.msg);
					$('input#inicial'+contador).val("");
					$('input#final'+contador).val("");
					}
			});
			
		}
	}
	});
	
	
	//===============================VALIDAR FOLIOS CANCELADOS==============================//

$("div#contenedor_caratula").on("click",".boton_agregar_cancelados",function(){
	contador = $(this).attr("contador");
	siguiente = parseInt(contador)+1;
	caseta = $('input#idcaseta').val();
	cancelado = $('input#cancelado'+contador).val();
	serie = $('select#serie_cancelado'+contador).val();
	suma=0;
	
	
	
	cancelados=0;
	$('.input_folio_cancelado').each(function() {
        if(cancelado==$(this).val()){
			suma = suma + 1;
			}else{
				suma = suma + 0;
				}
		cancelados = cancelados+1;
    	});
	
		
	$('.input_folio_noemitido').each(function() {
        if(cancelado==$(this).val()){
			suma = suma + 1;
			}else{
				suma = suma + 0;
				}
    	});
	
	
	bobina = 0;
	suma_rangos = 0;	
	$(".btn-utilizados").each(function() {
            bobina = bobina+1;
			inicial = $('input#inicial'+bobina).val();
			final = $('input#final'+bobina).val();
			if((inicial!="")||(final!="")){
				if((parseInt(cancelado)>=parseInt(inicial))&&(parseInt(cancelado)<=parseInt(final))){
					suma_rangos = suma_rangos + 1;
					}
			}
        	
		});
	
	if((suma>1)||(cancelado=="")||(suma_rangos==0)){
		alert("Ingrese un folio correcto");
		$('input#cancelado'+contador).val("");
		}else{
			datos = 'cancelado='+cancelado+'&caseta='+caseta+'&serie='+serie;
			$.getJSON(base_url+'cai/corte/valida_folios_cancelados',datos,function(data){
				if(data.kind=="green"){
					$("#total_folios_cancelados").val(cancelados);
					$('input#aceptar_cancelado'+contador).removeClass("boton_agregar_utilizados btn-primary");
					$('input#aceptar_cancelado'+contador).addClass("disabled");
					$('.contenedor_folios_cancelados'+contador).after('<div class="contenedor_folios_cancelados'+siguiente+'">FOLIO<input type="text" id="cancelado'+siguiente+'" name="cancelado'+siguiente+'" class="input_folio_cancelado enter_folio_cancelado form-control"/>&nbsp;&nbsp;&nbsp;<span id="span_cancelado'+siguiente+'">SERIE</span>&nbsp;<input id="aceptar_cancelado'+siguiente+'" contador="'+siguiente+'" type="button" class="btn btn-success btn-sm boton_agregar_cancelados btn-cancelados enter_folio_cancelado" value="Agregar"/></div>');
					$('select#serie_cancelado'+contador).clone().attr('id', 'serie_cancelado'+siguiente).attr('name', 'serie_cancelado'+siguiente).insertAfter('span#span_cancelado'+siguiente);
					$('span#span_cancelado'+siguiente).replaceWith('SERIE');
					$('input#cancelado'+contador).attr("readonly",true);
					$('select#serie_cancelado'+contador).attr("readonly",true);
					
					utilizados = parseInt($("#total_folios_utilizados").val());
					cancelados = parseInt($("#total_folios_cancelados").val());
					noemitidos = parseInt($("#total_folios_noemitidos").val());
					total_folios = (utilizados)-(cancelados)+(noemitidos);
					$("#total_folios").val(total_folios);
					/*if($("#total_column_1").val()==""){
						total_folios_efectivo=0;	
						}else{
					total_folios_efectivo = parseInt($("#total_column_1").val());
						}*/
					/*if($("#total_column_1").val()==""){
						total_folios_efectivo_1=0;	
						}else{
							total_folios_efectivo_1 = parseInt($("#total_column_1").val());
						}*/
					if($("#total_column_1").val()==""){
						total_folios_efectivo_1=0;
						}else{
							if($.isNumeric($("#total_column_1").val())==false){
									total_folios_efectivo_1=0;
								}else{
									total_folios_efectivo_1 = parseInt($("#total_column_1").val());
								}	
						}
					if($("#total_column_2").val()==""){
						total_folios_efectivo_2=0;
						}else{
							if($.isNumeric($("#total_column_2").val())==false){
									total_folios_efectivo_2=0;
								}else{
									total_folios_efectivo_2 = parseInt($("#total_column_2").val());
								}	
						}
					total_folios_efectivo = total_folios_efectivo_1 + total_folios_efectivo_2;
					diferencia_folios = (total_folios_efectivo)-((utilizados)-(cancelados)+(noemitidos));
					//diferencia_folios = (total_folios_efectivo)-(utilizados);
					$("#diferencia_folios").val(diferencia_folios);
					$("input#cancelado"+siguiente).focus();
					}else{
						alert(data.msg);
						$('input#cancelado'+contador).val("");
						}
				});
				
				
			}
			
			
	});
	
	
	//===============================VALIDAR FOLIOS NO EMITIDOS==============================//

$("div#contenedor_caratula").on("click",".boton_agregar_noemitidos",function(){
	contador = $(this).attr("contador");
	siguiente = parseInt(contador)+1;
	caseta = $('input#idcaseta').val();
	//alert(caseta);
	noemitido = $('input#noemitido'+contador).val();
	serie = $('select#serie_noemitido'+contador).val();
	suma=0;
	noemitidos=0;
	$('.input_folio_noemitido').each(function() {
        if(noemitido==$(this).val()){
			suma = suma + 1;
			}else{
				suma = suma + 0;
				}
			noemitidos = noemitidos+1;
    	});
	
		
		
	//if((suma>1)||(noemitido=="")||(suma_rangos==0)){
	if((suma>1)||(noemitido=="")){
		alert("Ingrese un folio correcto");
		$('input#noemitido'+contador).val("");
		}else{
			datos = 'noemitido='+noemitido+'&caseta='+caseta;
			$.getJSON(base_url+'cai/corte/valida_folios_noemitidos',datos,function(data){
				if(data.kind=="green"){
					$("#total_folios_noemitidos").val(noemitidos);
					$('input#aceptar_noemitido'+contador).removeClass("boton_agregar_noemitidos btn-primary");
					$('input#aceptar_noemitido'+contador).addClass("disabled");
					$('.contenedor_folios_noemitidos'+contador).append('<div class="contenedor_folios_noemitidos'+siguiente+'">FOLIO<input type="text" id="noemitido'+siguiente+'" name="noemitido'+siguiente+'" class="input_folio_noemitido enter_folio_noemitido form-control"/>&nbsp;<input id="aceptar_noemitido'+siguiente+'" contador="'+siguiente+'" type="button" class="btn btn-success btn-sm boton_agregar_noemitidos btn-noemitidos enter_folio_noemitido" value="Agregar"/></div>');
					$('.hello').remove();
					/*$('select#serie_noemitido'+contador).clone().attr('id', 'serie_noemitido'+siguiente).attr('name', 'serie_noemitido'+siguiente).insertAfter('span#span_noemitido'+siguiente);*/
					
					$('input#noemitido'+contador).attr("readonly",true);
					$('select#serie_noemitido'+contador).attr("readonly",true);
					
					utilizados = parseInt($("#total_folios_utilizados").val());
					cancelados = parseInt($("#total_folios_cancelados").val());
					noemitidos = parseInt($("#total_folios_noemitidos").val());
					total_folios = (utilizados)-(cancelados)+(noemitidos);
					$("#total_folios").val(total_folios);
					/*if($("#total_column_1").val()==""){
						total_folios_efectivo=0;	
						}else{
					total_folios_efectivo = parseInt($("#total_column_1").val());
						}*/
					/*if($("#total_column_1").val()==""){
						total_folios_efectivo_1=0;	
						}else{
							total_folios_efectivo_1 = parseInt($("#total_column_1").val());
						}*/
					if($("#total_column_1").val()==""){
						total_folios_efectivo_1=0;
						}else{
							if($.isNumeric($("#total_column_1").val())==false){
									total_folios_efectivo_1=0;
								}else{
									total_folios_efectivo_1 = parseInt($("#total_column_1").val());
								}	
						}
					if($("#total_column_2").val()==""){
						total_folios_efectivo_2=0;
						}else{
							if($.isNumeric($("#total_column_2").val())==false){
									total_folios_efectivo_2=0;
								}else{
									total_folios_efectivo_2 = parseInt($("#total_column_2").val());
								}	
						}
					total_folios_efectivo = total_folios_efectivo_1 + total_folios_efectivo_2;
					//diferencia_folios = (total_folios_efectivo)-(utilizados);
					diferencia_folios = (total_folios_efectivo)-((utilizados)-(cancelados)+(noemitidos));
					//console.log(diferencia_folios);
					$("#diferencia_folios").val(diferencia_folios);
					$("input#noemitido"+siguiente).focus();
					}else{
						alert(data.msg);
						$('input#noemitido'+contador).val("");
						}
				});
			}
	});
	
	
	//ENTER PARA FOLIOS UTILIZADOS
	$("div#contenedor_caratula").on("keyup",".enter_folio_utilizado",function(event){
	var charCode = (e.which) ? e.which : event.keyCode
	if (charCode==13){
		  if($(this).val()=="Agregar"){
		  	console.log('Agregar');
		  }else{
			  $(this).next().focus();
			  }
		}
	});
	
	//ENTER PARA FOLIOS CANCELADOS
	$("div#contenedor_caratula").on("keyup",".enter_folio_cancelado",function(event){
	var charCode = (e.which) ? e.which : event.keyCode
	if (charCode==13){  
		  if($(this).val()=="Agregar"){
		  	console.log('Agregar');
		  }else{
			  $(this).next().focus();
			  }	 
		}
	});
	
	//ENTER PARA FOLIOS NO EMITIDOS
	$("div#contenedor_caratula").on("keyup",".enter_folio_noemitido",function(event){
	var charCode = (e.which) ? e.which : event.keyCode
	if (charCode==13){  
		  if($(this).val()=="Agregar"){
		  	console.log('Agregar');
		  }else{
			  $(this).next().focus();
			  }	 
		}
	});
	
	//=====================================ELIMINAR FOLIOS UTILIZADOS=======================//
	$("div#contenedor_caratula").on("click",".boton_eliminar_utilizados",function(){
		contador = $(this).attr("contador");
		
		//Eliminar cancelados dentro del rango
		contador_cancelados=0;
		$(".btn-cancelados").each(function() {
			contador_cancelados = contador_cancelados + 1;
			valor_contador = $(this).attr("contador");
            valor_eliminado = parseInt($("#cancelado"+contador_cancelados).val());
			valor_inicial = parseInt($("#inicial"+contador).val());
			valor_final = parseInt($("#final"+contador).val());
			if((valor_eliminado>=valor_inicial)&&(valor_eliminado<=valor_final)){
				$("div.contenedor_folios_cancelados"+contador_cancelados).remove();
				}
        });
		
		num_cancelados = 0;
		$(".btn-cancelados").each(function() {
			if($(this).val()!=""){
				//alert($(this).val());
				valor_contador = $(this).attr("contador");
            	valor_eliminado = parseInt($("#cancelado"+contador).val());
				//alert(valor_eliminado);
				/*if($.isNumeric(valor_eliminado)){
					//console.log("numerico");
					num_cancelados = num_cancelados + 1;
					}else{
						//console.log("no sumar");
						}*/
				
				}
			num_cancelados = num_cancelados +1;
			//console.log($(this).val());
			//console.log("cancelados="+num_cancelados);
			});
		//alert("cancelados="+num_cancelados);
		$("#total_folios_cancelados").val(num_cancelados-1)
		$("div.contenedor_folios_utilizados"+contador).remove();
		bobina=parseInt(contador)+1;
			
		diferencia=0;
		for(i=1;i<=bobina;i++){
		inicial_dif = $('input#inicial'+i).val();
		final_dif = $('input#final'+i).val();
		//console.log("bobina"+i+"->inicial="+inicial_dif);
		//console.log("bobina"+i+"->final="+final_dif);
		if($.isNumeric(inicial_dif)){
					if($.isNumeric(final_dif)){
							parcial=(final_dif-inicial_dif)+1;
							diferencia = diferencia +  parcial;
						}
					}
		
		}
		
		
		//console.log("diferencia al eliminar="+diferencia);
		
		
		
		
		$("#total_folios_utilizados").val(diferencia);
		utilizados = parseInt($("#total_folios_utilizados").val());
		cancelados = parseInt($("#total_folios_cancelados").val());
		noemitidos = parseInt($("#total_folios_noemitidos").val());
		total_folios = (utilizados)-(cancelados)+(noemitidos);
		$("#total_folios").val(total_folios);
		
					if($("#total_column_1").val()==""){
						total_folios_efectivo_1=0;
						}else{
							if($.isNumeric($("#total_column_1").val())==false){
									total_folios_efectivo_1=0;
								}else{
									total_folios_efectivo_1 = parseInt($("#total_column_1").val());
								}	
						}
					if($("#total_column_2").val()==""){
						total_folios_efectivo_2=0;
						}else{
							if($.isNumeric($("#total_column_2").val())==false){
									total_folios_efectivo_2=0;
								}else{
									total_folios_efectivo_2 = parseInt($("#total_column_2").val());
								}	
						}
					//total_folios_efectivo = total_folios_efectivo_1 + total_folios_efectivo_10;
			diferencia_folios = (total_folios_efectivo)-((utilizados)-(cancelados)+(noemitidos));
			$("#diferencia_folios").val(diferencia_folios);			
		});
	
	
	$("div#contenedor_caratula").on("click","#guardar_corte",function(){
	errores=0;
	/*$("select").css("color", "black");*/
	
	if($("select#jefe").val()=="0"){
		//$("select#jefe").css("color", "red" );
		errores = errores +1;
		}
	if($("select#cobrador").val()=="0"){
		//$("select#cobrador").css("color", "red" );
		errores = errores +1;
		}
	/*if($("input#inicial1").val()==""){
		$("input#inicial1").css("border","1px solid red");
		errores = errores +1;
		}
	if($("input#final1").val()==""){
		$("input#final1").css("border","1px solid red");
		errores = errores +1;
		}
	if(errores>0){	
		alert("Tienes "+errores+" errores");
	}else{*/
			noemitidos=0;
			utilizados=0;
			cancelados=0;
			$(".btn-noemitidos").each(function() {
				noemitidos = noemitidos+1;
			});
			$(".btn-cancelados").each(function() {
				cancelados = cancelados+1;
			});
			
			$(".btn-utilizados").each(function() {
				utilizados = utilizados+1;
			});
			
			ultimo_cancelado = $(".btn-cancelados").last().attr("contador");
			
			ultimo = $(".btn-utilizados").last().attr("contador");
			console.log("ultimo="+ultimo);
	//alert(noemitidos);
	validar=0;
	if((noemitidos>1)||(cancelados)>1){
		if(($("textarea#comentarios").val()=="")||($("textarea#comentarios").val()=="SIN COMENTARIOS.")){
			validar = validar+ 1;
			}else{
				validar = validar + 0;
				}
		}
	else{
		validar= validar+0;;
		}
if(errores==0){		
	if($("#diferencia_folios").val()==0){
		if(validar==0){
			if(confirm("Desea guardar el corte con los datos de la calificacion?")){
				
				datos_num = "noemitidos="+noemitidos+"&cancelados="+ultimo_cancelado+"&utilizados="+ultimo;
				datos_fecha = $("form#fecha").serialize();
				datos_corte = $("form#corte").serialize();
				datos_generales = $("form#generales").serialize();
				datos_totales = $("form#totales").serialize();
				datos_calificacion = $("form#calificacion").serialize();
				datos_folios = $("form#folios").serialize();
				datos = datos_fecha+'&'+datos_generales+'&'+datos_totales+'&'+datos_calificacion+'&'+datos_folios+'&'+datos_corte+'&'+datos_num;
				alert(datos);
				$("div#contenedor_general").html('<div class="well"><i class="fa fa-cog fa-spin fa-2x"></i> Guardando corte...</div>');
				$.post(base_url+"cai/corte/agregar",datos,function(data){
					$("div#contenedor_general").html(data);
					});
				
				}
			}else{
				alert("Existe algun folio no emitido y/o cancelado, favor de escribir un comentario valido");
				}
		}else{
			alert("Favor de llenar correctamente el formato");
			}
}else{
	alert("Favor de llenar correctamente el formato");
}
	});

});//Fin de document ready