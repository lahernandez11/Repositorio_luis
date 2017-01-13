$(document).ready(function(e) {
    /*TIPOS DE VEHICULOS POR PLAZA*/
	$("select.cai-vp-plaza").change(function(){
		idplaza=$(this).val();
		if(idplaza==0){
			alert("Seleccione un plaza");
			$("div#cai-vp-vehiculos").html('');
			$("div#cai-vp-posiciones").html('');
			}else{
				$("div#cai-vp-posiciones").html('');
				datos="idplaza="+idplaza;
				$.post(base_url+'grl/vehiculo_plaza/carga_vehiculos',datos,function(data){
					$("div#cai-vp-vehiculos").html(data);
					});
				}
		});
		
	$("div#cai-vp-vehiculos").on("click",".cai-vp-vehiculo",function(){
		$("div#cai-vp-posiciones").html('');
		estado = $(this).attr("estado");
		idplaza = $(this).attr("idplaza");
		idvehiculo = $(this).attr("idvehiculo");
		datos="idplaza="+idplaza+"&idvehiculo="+idvehiculo+"&estado="+estado;
		$.getJSON(base_url+"grl/vehiculo_plaza/cambiar",datos,function(data){
			if(data.msg=="ok"){
				if(estado==1){
					$("li#"+idplaza+"-"+idvehiculo).removeClass("text-success").addClass("text-danger").attr("estado",2);
					}else{
						$("li#"+idplaza+"-"+idvehiculo).removeClass("text-danger").addClass("text-success").attr("estado",1);
						}
				}else{
					alert("Ocurrio un error, intente nuevamente");
					}
			});
		});
		
	$("div#cai-vp-vehiculos").on("click",".cai-vp-orden",function(){
		idplaza = $(this).attr("idplaza");
		$.post(base_url+"grl/vehiculo_plaza/orden",datos,function(data){
			$("div#cai-vp-posiciones").html(data);
			});
		});
	
	$("div#cai-vp-posiciones").on("click","#cai-vp-guardar_orden",function(){
		datos = "idplaza="+$(this).attr("idplaza");
		$("ul#sortable li").each(function(index, element) {
			idvehiculo=$(this).attr("idvehiculo");
			orden = index+1;
			datos = datos+"&orden"+orden+"="+orden+"&idvehiculo"+orden+"="+idvehiculo;
        	});
		datos=datos+'&n='+orden;
		//alert(datos);
		$.post(base_url+"/grl/vehiculo_plaza/ordenar",datos,function(data){
				$("div#cai-vp-posiciones").html(data);
				});
		});
		

	 /*TIPOS DE PAGO POR PLAZA*/
	$("select.cai-pp-plaza").change(function(){
		idplaza=$(this).val();
		if(idplaza==0){
			alert("Seleccione un plaza");
			$("div#cai-pp-pagos").html('');
			$("div#cai-pp-posiciones").html('');
			}else{
				$("div#cai-pp-posiciones").html('');
				datos="idplaza="+idplaza;
				$.post(base_url+'cai/pago_plaza/carga_pagos',datos,function(data){
					$("div#cai-pp-pagos").html(data);
					});
				}
		});
		
	$("div#cai-pp-pagos").on("click",".cai-pp-pago",function(){
		$("div#cai-pp-posiciones").html('');
		estado = $(this).attr("estado");
		idplaza = $(this).attr("idplaza");
		idpago = $(this).attr("idpago");
		datos="idplaza="+idplaza+"&idpago="+idpago+"&estado="+estado;
		$.getJSON(base_url+"cai/pago_plaza/cambiar",datos,function(data){
			if(data.msg=="ok"){
				if(estado==1){
					$("li#"+idplaza+"-"+idpago).removeClass("text-success").addClass("text-danger").attr("estado",2);
					}else{
						$("li#"+idplaza+"-"+idpago).removeClass("text-danger").addClass("text-success").attr("estado",1);
						}
				}else{
					alert("Ocurrio un error, intente nuevamente");
					}
			});
		});
		
	$("div#cai-pp-pagos").on("click",".cai-pp-orden",function(){
		idplaza = $(this).attr("idplaza");
		$.post(base_url+"cai/pago_plaza/orden",datos,function(data){
			$("div#cai-pp-posiciones").html(data);
			});
		});
	
	$("div#cai-pp-posiciones").on("click","#cai-pp-guardar_orden",function(){
		datos = "idplaza="+$(this).attr("idplaza");
		$("ul#sortable li").each(function(index, element) {
			idpago=$(this).attr("idpago");
			orden = index+1;
			datos = datos+"&orden"+orden+"="+orden+"&idpago"+orden+"="+idpago;
        	});
		datos=datos+'&n='+orden;
		//alert(datos);
		$.post(base_url+"cai/pago_plaza/ordenar",datos,function(data){
				$("div#cai-pp-posiciones").html(data);
				});
		});
		
	
	/*TARIFA POR PLAZA*/
	$("select.cai-t-plaza").change(function(){
		idplaza=$(this).val();
		if(idplaza==0){
			alert("Seleccione un plaza");
			$("div#cai-t-tarifas").html('');
			}else{
				datos="idplaza="+idplaza;
				$.post(base_url+'cai/tarifa/detalle',datos,function(data){
					$("div#cai-t-tarifas").html(data);
					});
				}
	});
	
	/*BUSCAR CORTES*/
	$('.cai-buscar-reportes-corte').click(function(){
		datos = $('form#cai_buscar_reporte_corte').serialize();
		$.post(base_url+'cai/reporte/buscar_corte',datos,function(data){
			$("div#cai_lista_reportes").html(data);
			});
		});
		
	
});