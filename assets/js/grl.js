$(document).ready(function(e) {
	//base_url='http://172.20.74.92:3029/';
	base_url='http://opc.grupohi.mx/';
    //base_url='http://localhost/opc/';
	//Funciones para guardar catalogos generales
	$("form.validar").on("submit",function() {
			errores=0;
			$("form.validar input:text.required").each(function() {
				if($(this).val()==""){
					errores = errores+1;
					$(this).css("border","1px solid #c00");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			
			$("form.validar input:text.numeric").each(function() {
				if($.isNumeric($(this).val())==false){
						errores = errores+1;
						$(this).css("border","1px solid #c00");
					}else{
						$(this).css("border","1px solid #ccc");
						}
            });
			
			
			$("form.validar textarea.required").each(function() {
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
					return true;
					}
		});
		
	
	$('.cambiar-estado-catalogo').click(function(){
		id = $(this).attr("id");
		estado=$(this).attr("estado");
		ruta=$(this).attr("ruta");
		datos="id="+id+"&estado="+estado;
		console.log(datos);
		$.getJSON(base_url+ruta,datos,function(data){
			//alert(data.msg);
			if(data.msg=='ok'){
				if(estado==1){
						$('a#'+id).attr("estado",2).removeClass('btn-success').addClass('btn-danger');
						$('a#'+id+' i.estado').removeClass('fa-eye').addClass('fa-eye-slash');
					}else{
						$('a#'+id).attr("estado",1).removeClass('btn-danger').addClass('btn-success');
						$('a#'+id+' i.estado').removeClass('fa-eye-slash').addClass('fa-eye');
						}
				}else{
					alert('Ocurrio un error, intente nuevamente');
					}
			});
		});
		
		
	$('.cambiar-clave').click(function(){
		actual = $('#actual').val();
		nueva = $('#nueva').val();
		confirmar = $('#confirmar').val();
		datos = 'actual='+actual+'&nueva='+nueva+'&confirmar='+confirmar;
		console.log(datos);
		$.getJSON(base_url+'login/home/cambiar_clave',datos,function(data){
			$("div#mensaje_cambio_clave").html('<span class="text-'+data.kind+'">'+data.msg+'</span>').show().fadeOut(3000);
			});
		});
	
	/*====FUNCIONES PARA CUERPOS=====*/	
	$('select#select-plaza').change(function(){
		plaza = $(this).val();
		datos = 'plaza='+plaza;
		$.post(base_url+'grl/cuerpo/carga_cuerpo',datos,function(data){
			$('div.detalle').html(data);
			});
		});
		
	
	$('div.detalle').on('click','a.agregar_cuerpo',function(){
		 actual = $(this).attr("n");
		 sig  = actual + 1;
		 div = '<div id="contenedor'+sig+'"><div class="form-group"><input type="text" class="form-control" id="cuerpo'+sig+'" n="'+sig+'" name="cuerpo'+sig+'" placeholder="Ingrese cuerpo"></div>&nbsp;<a href="#" id="boton_agregar'+sig+'"  class="btn btn-success agregar_cuerpo" n="'+sig+'"><i class="fa fa-plus"></i></a></div>';
		 modificar = '<a href="#" id="modificar_anterior'+actual+'" n="'+actual+'" class="btn btn-warning modificar_cuerpo"><i class="fa fa-edit"></i></a>';
		 cuerpo=$('input#cuerpo'+actual).val();
		 plaza=$('input#plaza').val();
		 datos='cuerpo='+cuerpo+'&plaza='+plaza;
		 $.getJSON(base_url+'grl/cuerpo/agregar',datos,function(data){
			 if(data.msg!='ko'){
				 $(div).insertAfter('#contenedor'+actual);
				 $('a#boton_agregar'+actual).removeClass('btn-success').removeClass('agregar_cuerpo').addClass('btn-danger').addClass('eliminar_cuerpo');
				 $('a#boton_agregar'+actual+' i').removeClass('fa-plus').addClass('fa-minus');
				 $('a#boton_agregar'+actual).attr("idcuerpo",data.msg);
				 $('input#cuerpo'+actual).attr('readonly',true);
				 $(modificar).insertAfter('a#boton_agregar'+actual);
				 }else{
					 alert('Ocurrió un error, intente nuevamente');
					 }
			 });
		 });
		 
		
	$('div.detalle').on('click','a.eliminar_cuerpo_anterior',function(){
		id = $(this).attr("id");
		datos = "id="+id;
		console.log(datos);
		$.getJSON(base_url+'grl/cuerpo/eliminar',datos,function(data){
			if(data.msg=='ok'){
				$("div#contenedor_anterior"+id).remove();
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
	
	$('div.detalle').on('click','a.eliminar_cuerpo',function(){
		id = $(this).attr("idcuerpo");
		n=$(this).attr("n");
		datos = "id="+id;
		console.log(datos);
		$.getJSON(base_url+'grl/cuerpo/eliminar',datos,function(data){
			if(data.msg=='ok'){
				$("div#contenedor"+n).remove();
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});	
	
	$('div.detalle').on('click','a.modificar_cuerpo_anterior',function(){
		id = $(this).attr("cuerpo");
		datos = "id="+id;
		$("a#modificar"+id).removeClass("btn-warning").addClass("btn-success").removeClass('modificar_cuerpo_anterior').addClass('guardar-cuerpo');
		$('a#modificar'+id+' i').removeClass('fa-edit').addClass('fa-save');
		$('div#contenedor_anterior'+id+' input').attr('readonly',false);
		});
	
	$('div.detalle').on('click','a.guardar-cuerpo',function(){
		id = $(this).attr("cuerpo");
		cuerpo = $('div#contenedor_anterior'+id+' input').val();
		datos = "id="+id+'&cuerpo='+cuerpo;
		$.getJSON(base_url+'grl/cuerpo/modificar',datos,function(data){
			if(data.msg=='ok'){
					$('a#modificar'+id).removeClass("btn-success").addClass("btn-warning").removeClass('guardar-cuerpo').addClass('modificar_cuerpo_anterior');
					$('a#modificar'+id+' i').removeClass('fa-save').addClass('fa-edit');
					$('div#contenedor_anterior'+id+' input').attr('readonly',true);
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
	
	$('div.detalle').on('click','a.modificar_cuerpo',function(){
		actual = $(this).attr("n");
		$(this).removeClass("btn-warning").addClass("btn-success").removeClass('modificar_cuerpo').addClass('guardar_cuerpo');
		$('a#modificar_anterior'+actual+' i').removeClass('fa-edit').addClass('fa-save');
		$('div#contenedor'+actual+' input').attr('readonly',false);
		});
		
	
	$('div.detalle').on('click','a.guardar_cuerpo',function(){
		n = $(this).attr("n");
		id = $('a#boton_agregar'+n).attr("idcuerpo")
		cuerpo = $('div#contenedor'+n+' input').val();
		datos = "id="+id+'&cuerpo='+cuerpo;
		console.log(datos);
		$.getJSON(base_url+'grl/cuerpo/modificar',datos,function(data){
			if(data.msg=='ok'){
					$('a#modificar_anterior'+n).removeClass("btn-success").addClass("btn-warning").removeClass('guardar_cuerpo').addClass('modificar_cuerpo');
					$('a#modificar_anterior'+n+' i').removeClass('fa-save').addClass('fa-edit');
					$('div#contenedor'+n+' input').attr('readonly',true);
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
	
	
		
	/*====FUNCIONES PARA SENTIDOS=====*/	
	$('select#select-plaza-sentido').change(function(){
		$('div.detalle').html('');
		plaza = $(this).val();
		datos = 'plaza='+plaza;
		$.post(base_url+'grl/sentido/carga_cuerpo',datos,function(data){
			$('div.detalle_cuerpo').html(data);
			});
		});	
	
	$('div.detalle_cuerpo').on('change','select#select-plaza-cuerpo',function(){
		$('div.detalle').html('');
		cuerpo=$(this).val();
		plaza=$("input#plaza").val();
		datos = 'cuerpo='+cuerpo+'&plaza='+plaza;
		console.log(datos);
		$.post(base_url+'grl/sentido/carga_sentido',datos,function(data){
			$('div.detalle').html(data);
			});
		});
	
	$('div.detalle').on('click','a.agregar_sentido',function(){
		 actual = $(this).attr("n");
		 sig  = actual + 1;
		 div = '<div id="contenedor'+sig+'"><div class="form-group"><input type="text" class="form-control" id="sentido'+sig+'" n="'+sig+'" name="sentido'+sig+'" placeholder="Ingrese sentido"></div>&nbsp;<a href="#" id="boton_agregar'+sig+'"  class="btn btn-success agregar_sentido" n="'+sig+'"><i class="fa fa-plus"></i></a></div>';
		 modificar = '<a href="#" id="modificar_anterior'+actual+'" n="'+actual+'" class="btn btn-warning modificar_sentido"><i class="fa fa-edit"></i></a>';
		 sentido=$('input#sentido'+actual).val();
		 cuerpo=$('input#cuerpo').val();
		 datos='sentido='+sentido+'&cuerpo='+cuerpo;
		 $.getJSON(base_url+'grl/sentido/agregar',datos,function(data){
			 if(data.msg!='ko'){
				 $(div).insertAfter('#contenedor'+actual);
				 $('a#boton_agregar'+actual).removeClass('btn-success').removeClass('agregar_sentido').addClass('btn-danger').addClass('eliminar_sentido');
				 $('a#boton_agregar'+actual+' i').removeClass('fa-plus').addClass('fa-minus');
				 $('a#boton_agregar'+actual).attr("idsentido",data.msg);
				 $('input#sentido'+actual).attr('readonly',true);
				 $(modificar).insertAfter('a#boton_agregar'+actual);
				 }else{
					 alert('Ocurrió un error, intente nuevamente');
					 }
			 });
		 });
		 
	$('div.detalle').on('click','a.eliminar_sentido_anterior',function(){
		id = $(this).attr("id");
		datos = "id="+id;
		console.log(datos);
		$.getJSON(base_url+'grl/sentido/eliminar',datos,function(data){
			if(data.msg=='ok'){
				$("div#contenedor_anterior"+id).remove();
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
	
	$('div.detalle').on('click','a.eliminar_sentido',function(){
		id = $(this).attr("idsentido");
		n=$(this).attr("n");
		datos = "id="+id;
		console.log(datos);
		$.getJSON(base_url+'grl/sentido/eliminar',datos,function(data){
			if(data.msg=='ok'){
				$("div#contenedor"+n).remove();
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
		
		
	$('div.detalle').on('click','a.modificar_sentido_anterior',function(){
		id = $(this).attr("sentido");
		datos = "id="+id;
		$("a#modificar"+id).removeClass("btn-warning").addClass("btn-success").removeClass('modificar_sentido_anterior').addClass('guardar-sentido');
		$('a#modificar'+id+' i').removeClass('fa-edit').addClass('fa-save');
		$('div#contenedor_anterior'+id+' input').attr('readonly',false);
		});
	
	$('div.detalle').on('click','a.guardar-sentido',function(){
		id = $(this).attr("sentido");
		sentido = $('div#contenedor_anterior'+id+' input').val();
		datos = "id="+id+'&sentido='+sentido;
		$.getJSON(base_url+'grl/sentido/modificar',datos,function(data){
			if(data.msg=='ok'){
					$('a#modificar'+id).removeClass("btn-success").addClass("btn-warning").removeClass('guardar-sentido').addClass('modificar_sentido_anterior');
					$('a#modificar'+id+' i').removeClass('fa-save').addClass('fa-edit');
					$('div#contenedor_anterior'+id+' input').attr('readonly',true);
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});	
	
	$('div.detalle').on('click','a.modificar_sentido',function(){
		actual = $(this).attr("n");
		$(this).removeClass("btn-warning").addClass("btn-success").removeClass('modificar_sentido').addClass('guardar_sentido');
		$('a#modificar_anterior'+actual+' i').removeClass('fa-edit').addClass('fa-save');
		$('div#contenedor'+actual+' input').attr('readonly',false);
		});
		
	
	$('div.detalle').on('click','a.guardar_sentido',function(){
		n = $(this).attr("n");
		id = $('a#boton_agregar'+n).attr("idsentido")
		sentido = $('div#contenedor'+n+' input').val();
		datos = "id="+id+'&sentido='+sentido;
		console.log(datos);
		$.getJSON(base_url+'grl/sentido/modificar',datos,function(data){
			if(data.msg=='ok'){
					$('a#modificar_anterior'+n).removeClass("btn-success").addClass("btn-warning").removeClass('guardar_sentido').addClass('modificar_sentido');
					$('a#modificar_anterior'+n+' i').removeClass('fa-save').addClass('fa-edit');
					$('div#contenedor'+n+' input').attr('readonly',true);
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
	
	
	/*====FUNCIONES PARA LINEAS=====*/	
	$('select#select-plaza-linea').change(function(){
		plaza = $(this).val();
		datos = 'plaza='+plaza;
		$.post(base_url+'grl/linea/carga_linea',datos,function(data){
			$('div.detalle').html(data);
			});
		});	
		
	$('div.detalle').on('click','a.agregar_linea',function(){
		 actual = $(this).attr("n");
		 sig  = actual + 1;
		 div = '<div id="contenedor'+sig+'"><div class="form-group"><input type="text" class="form-control" id="linea'+sig+'" n="'+sig+'" name="linea'+sig+'" placeholder="Ingrese linea" size="50"></div>&nbsp;<a href="#" id="boton_agregar'+sig+'"  class="btn btn-success agregar_linea" n="'+sig+'"><i class="fa fa-plus"></i></a></div>';
		 modificar = '<a href="#" id="modificar_anterior'+actual+'" n="'+actual+'" class="btn btn-warning modificar_linea"><i class="fa fa-edit"></i></a>';
		 linea=$('input#linea'+actual).val();
		 plaza=$('input#plaza').val();
		 datos='linea='+linea+'&plaza='+plaza;
		 $.getJSON(base_url+'grl/linea/agregar',datos,function(data){
			 if(data.msg!='ko'){
				 $(div).insertAfter('#contenedor'+actual);
				 $('a#boton_agregar'+actual).removeClass('btn-success').removeClass('agregar_linea').addClass('btn-danger').addClass('eliminar_linea');
				 $('a#boton_agregar'+actual+' i').removeClass('fa-plus').addClass('fa-minus');
				 $('a#boton_agregar'+actual).attr("idlinea",data.msg);
				 $('input#linea'+actual).attr('readonly',true);
				 $(modificar).insertAfter('a#boton_agregar'+actual);
				 }else{
					 alert('Ocurrió un error, intente nuevamente');
					 }
			 });
		 });
	
	$('div.detalle').on('click','a.modificar_linea_anterior',function(){
		id = $(this).attr("linea");
		datos = "id="+id;
		$("a#modificar"+id).removeClass("btn-warning").addClass("btn-success").removeClass('modificar_linea_anterior').addClass('guardar');
		$('a#modificar'+id+' i').removeClass('fa-edit').addClass('fa-save');
		$('div#contenedor_anterior'+id+' input').attr('readonly',false);
		});
	
	$('div.detalle').on('click','a.guardar',function(){
		id = $(this).attr("linea");
		linea = $('div#contenedor_anterior'+id+' input').val();
		datos = "id="+id+'&linea='+linea;
		$.getJSON(base_url+'grl/linea/modificar',datos,function(data){
			if(data.msg=='ok'){
					$('a#modificar'+id).removeClass("btn-success").addClass("btn-warning").removeClass('guardar').addClass('modificar_linea_anterior');
					$('a#modificar'+id+' i').removeClass('fa-save').addClass('fa-edit');
					$('div#contenedor_anterior'+id+' input').attr('readonly',true);
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
	
	$('div.detalle').on('click','a.modificar_linea',function(){
		actual = $(this).attr("n");
		$(this).removeClass("btn-warning").addClass("btn-success").removeClass('modificar_linea').addClass('guardar_linea');
		$('a#modificar_anterior'+actual+' i').removeClass('fa-edit').addClass('fa-save');
		$('div#contenedor'+actual+' input').attr('readonly',false);
		});
		
	
	$('div.detalle').on('click','a.guardar_linea',function(){
		n = $(this).attr("n");
		id = $('a#boton_agregar'+n).attr("idlinea")
		linea = $('div#contenedor'+n+' input').val();
		datos = "id="+id+'&linea='+linea;
		console.log(datos);
		$.getJSON(base_url+'grl/linea/modificar',datos,function(data){
			if(data.msg=='ok'){
					$('a#modificar_anterior'+n).removeClass("btn-success").addClass("btn-warning").removeClass('guardar_linea').addClass('modificar_linea');
					$('a#modificar_anterior'+n+' i').removeClass('fa-save').addClass('fa-edit');
					$('div#contenedor'+n+' input').attr('readonly',true);
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
	
		
	
	$('div.detalle').on('click','a.eliminar_linea_anterior',function(){
		id = $(this).attr("id");
		datos = "id="+id;
		$.getJSON(base_url+'grl/linea/eliminar',datos,function(data){
			if(data.msg=='ok'){
				$("div#contenedor_anterior"+id).remove();
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});
	
	$('div.detalle').on('click','a.eliminar_linea',function(){
		id = $(this).attr("idlinea");
		n=$(this).attr("n");
		datos = "id="+id;
		console.log(datos);
		$.getJSON(base_url+'grl/linea/eliminar',datos,function(data){
			if(data.msg=='ok'){
				$("div#contenedor"+n).remove();
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		});	
	
	
	/*=====FUNCIONES PARA PERFILES======*/
	$('select#select-perfil').change(function(){
		perfil = $(this).val();
		datos = 'perfil='+perfil;
		$.post(base_url+'grl/permiso/carga_permiso',datos,function(data){
			$('div.detalle').html(data);
			});
		});
		
	$('div.detalle').on('click','div.permiso',function(){
		estado = $(this).attr("estado");
		idmenu = $(this).attr("id");
		idperfil = $(this).attr("perfil");
		datos="idmenu="+idmenu+"&idperfil="+idperfil;
		if(estado==0){
			console.log('Agregar '+datos);
			$.getJSON(base_url+'grl/permiso/agregar',datos,function(data){
			if(data.msg=='ok'){
				$('div.detalle div#'+idmenu).removeClass('text-danger').addClass('text-success').attr('estado','1');
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
		}else{
			console.log('Eliminar '+datos);
			$.getJSON(base_url+'grl/permiso/eliminar',datos,function(data){
			if(data.msg=='ok'){
				$('div.detalle div#'+idmenu).removeClass('text-success').addClass('text-danger').attr('estado','0');
				}else{
					alert('Ocurrió un error, intente nuevamente');
					}
			});
			}
	});	
	
	
	/*=============FUNCIONES PARA CKECKED DE PLAZAS DE USUARIO========*/
	$('.btn-modificar-usuario').click(function(){
  		idusuario=$(this).attr("id");
		datos='idusuario='+idusuario;
		var plazas = [];
		$.getJSON(base_url+"grl/usuario/carga_plazas",datos,function(data){
			$.each(data,function(k,v){
				//alert(v.idplaza);
				plazas.push(v.idplaza);
				});
			}).done(function(){
				
				Array.prototype.inArray = function (value)
					{
					 // Returns true if the passed value is found in the
					 // array. Returns false if it is not.
					 var i;
					 for (i=0; i < this.length; i++)
					 {
					 if (this[i] == value)
					 {
					 return true;
					 }
					 }
					 return false;
				};
				//alert(plazas+'idusuario='+idusuario);
				$('#myModal'+idusuario+' input:checkbox').each(function(index, element) {
					//alert($(this).val());
					//if($.inArray($(this).val(),plazas)){
					if(plazas.inArray($(this).val())){
						check = $(this).val();
						//alert($(this).val() +'en el arreglo' + plazas);
						$('#myModal'+idusuario+' div#checkbox'+check+' input').attr("checked",true);
						}
					});
				}); 
		});
	
});