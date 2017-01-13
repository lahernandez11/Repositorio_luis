$(document).ready(function() {			
	$('#back').hide();
    $('#back_to').hide();
	
	$('#back_filtro').hide();
    $('#back_to_filtro').hide();
	
	$('#back_scatter').hide();
    $('#back_to_scatter').hide();
	
	$('#back_mensual').hide();
    $('#back_to_mensual').hide();
	
	$('#back').click(function(){
		idproyecto = $(this).attr("idproyecto");
		serie = $(this).attr("serie");
        $(this).hide();
        chart1.destroy();
        DrawFirst(idproyecto,serie,proyecto);                
     });
	 
	 $("#back_to").click(function(){
		valor =($("#back_to").attr("valor"));
		idproyecto = $(this).attr("idproyecto");
		serie = $(this).attr("serie");
		chart2.destroy();
		DrawSecond(valor,idproyecto,serie);
		$('#back').show();
		$('#back_to').hide();
	 });
	 
	 $('#back_filtro').click(function(){
		idproyecto = $(this).attr("idproyecto");
		serie = $(this).attr("serie");
		mi = $(this).attr("mi");
		di = $(this).attr("di");
		yi = $(this).attr("yi");
		mf = $(this).attr("mf");
		df = $(this).attr("df");
		yf = $(this).attr("yf");
		idclase = $(this).attr("clase");
		idtipo = $(this).attr("tipo");
		idsubtipo = $(this).attr("sub");
        $(this).hide();
        chart1.destroy();
		DrawFirst_filtro(mi,di,yi,mf,df,yf,idproyecto,idclase,idtipo,idsubtipo);
     });
	 
	 $("#back_to_filtro").click(function(){
		valor =($("#back_to_filtro").attr("valor"));
		idproyecto = $(this).attr("idproyecto");
		serie = $(this).attr("serie");
		mi = $(this).attr("mi");
		di = $(this).attr("di");
		yi = $(this).attr("yi");
		mf = $(this).attr("mf");
		df = $(this).attr("df");
		yf = $(this).attr("yf");
		chart2.destroy();
		DrawSecond_filtro(valor,idproyecto,serie,mi,di,yi,mf,df,yf);
		$('#back_filtro').show();
		$('#back_to_filtro').hide();
	 });
	 
	 $('#back_scatter').click(function(){
		idproyecto = $(this).attr("idproyecto");
		serie = $(this).attr("serie");
        $(this).hide();
        chart1_scatter.destroy();
        DrawFirstScatter(idproyecto,serie,proyecto);                
     });
	 
	 $("#back_to_scatter").click(function(){
		valor =($("#back_to_scatter").attr("valor"));
		idproyecto = $(this).attr("idproyecto");
		serie = $(this).attr("serie");
		chart2_scatter.destroy();
		DrawSecondScatter(valor,idproyecto,serie);
		$('#back_scatter').show();
		$('#back_to_scatter').hide();
	 });
	 
	 $('#back_mensual').click(function(){
		idproyecto = $(this).attr("idproyecto");
		//serie = $(this).attr("serie");
        serie =  $('select#man-ges-inc-combo').val();
		$(this).hide();
        chart01.destroy();
        DrawMensual(idproyecto,serie,proyecto);                
     });
	 
	 $("#back_to_mensual").click(function(){
		valor =($("#back_to_mensual").attr("valor"));
		idproyecto = $(this).attr("idproyecto");
		serie = $(this).attr("serie");
		chart02.destroy();
		DrawSecond_Mensual(valor,idproyecto,serie);
		$('#back_mensual').show();
		$('#back_to_mensual').hide();
	 });
	
    opciones = '';
	tabs = '';
	$.getJSON(base_url+'sgwc/resumen/proyectos',function(json){
		$.each(json,function(x,y){
			opciones = opciones + '<li idproyecto="'+y.idproyecto+'" proyecto="'+y.proyecto+'"><a href="#proyecto'+y.idproyecto+'" role="tab" data-toggle="tab">'+y.proyecto+'</a></li>';
			tabs = tabs + '<div class="tab-pane" id="proyecto'+y.idproyecto+'"></div>';
		});
	$('#man-ges-inc-ul').html(opciones);
	$('#man-ges-inc-tabs').html(tabs);
	}).done(function(){
		idproyecto = $('#man-ges-inc-ul li').first().attr('idproyecto');
		proyecto = $('#man-ges-inc-ul li').first().attr('proyecto');
		$('#man-ges-inc-ul li').first().addClass('active');
		$('#man-ges-inc-tabs div').first().addClass('active');
		loadCombo(idproyecto,proyecto);	
	});
	
});

	$('#combo-proyectos').on('change','#man-ges-inc-combo',function(){
		serie = $(this).val();
		idproyecto = $('#man-ges-inc-ul li.active').attr('idproyecto');
		proyecto = $('#man-ges-inc-ul li.active').attr('proyecto');
		DrawFirst(idproyecto,serie,proyecto);
		//DrawFirstScatter(idproyecto,serie,proyecto);
		loadScatters(idproyecto,serie,proyecto);
		DrawMensual(idproyecto,serie,proyecto);
			 
	});
				
	$('#combo-filtos').on('click','input#periodo',function(){
		var buscar='';
		if($(this).is(':checked'))
		{
			$('#combo-proyectos select#man-ges-inc-combo').attr('disabled',true);		
			buscar=buscar+'<script>$(document).ready(function () { var daysToAdd = 1; $("#txtFromDate").datepicker({ changeMonth: true, changeYear: true, onSelect: function (selected) { var dtMax = new Date(selected); dtMax.setDate(dtMax.getDate() + daysToAdd);  var dd = dtMax.getDate(); var mm = dtMax.getMonth() + 1; var y = dtMax.getFullYear(); var dtFormatted = mm + "/"+ dd + "/"+ y; $("#txtToDate").datepicker("option", "minDate", dtFormatted); } }); $("#txtToDate").datepicker({ changeMonth: true, changeYear: true, onSelect: function (selected) { var dtMax = new Date(selected); dtMax.setDate(dtMax.getDate() - daysToAdd);  var dd = dtMax.getDate(); var mm = dtMax.getMonth() + 1; var y = dtMax.getFullYear(); var dtFormatted = mm + "/"+ dd + "/"+ y; $("#txtFromDate").datepicker("option", "maxDate", dtFormatted) } }); });</script> <table class="table table-condensed table-bordered "><tr><td style="background:#EEEEEE"><b>Fecha: </b></td><td><input type="text" id="txtFromDate" /> A <input type="text" id="txtToDate" /></td></tr><tr><td style="background:#EEEEEE"><b>Clase: </b></td><td id="td-clase"><select id="select-clase" class="form-control"><option value="0">- SELECCIONE -</option></select></td></tr><tr><td style="background:#EEEEEE"><b>Tipo: </b></td><td id="td-tipo"><select id="select-tipo" class="form-control"><option value="0">- SELECCIONE -</option></select></td></tr><tr><td style="background:#EEEEEE"><b>Subtipo: </b></td><td id="td-subtipo"><select id="select-subtipo" class="form-control"><option value="0">- SELECCIONE -</option></select></td></tr></table><button id="buscar-filtros" class="btn btn-green" style="float:right">Buscar</button>';
			$('div#buscar_periodo').html(buscar);
		}else{
			$('#combo-proyectos select#man-ges-inc-combo').attr('disabled',false);		
			$('div#buscar_periodo').html('');
		}
	});
	
	$('#combo-filtos').on('click','select#select-clase',function(){
            
            idproyecto = $('#man-ges-inc-ul li.active').attr('idproyecto');
            fechai=$('input#txtFromDate').val();
            fechaf=$('input#txtToDate').val();
	
            if(fechai=='' || fechaf==''){
                alert('Seleccione una fecha inicio y/o fecha fin');
            }else{			
                resulti = fechai.split('/');
		resultf = fechaf.split('/');
		mi=resulti[0];
		di=resulti[1];
		yi=resulti[2];
		mf=resultf[0];
		df=resultf[1];
		yf=resultf[2];
                
		datos = 'mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf+'&idproyecto='+idproyecto;
			
                if($(this).val()==0){							
                    $.getJSON(base_url+'sgwc/resumen/desplega_clases',datos,function(json){
                    if(json.length>0){
                        clase='<select id="select-clase" class="form-control"><option value="0">- SELECCIONE -</option>';
			$.each(json,function(x,y){
                            clase=clase+'<option value="'+y.idclase+'">'+y.clase+'</option>'	;
			});
						
                        clase=clase+'</select>'	;						
			
                        $('td#td-clase').html(clase);						
			$('select#select-clase option:eq(1)').attr('selected', 'selected');
                    }else{
			$('td#td-clase').html('<select id="select-clase" class="form-control"><option value="0">- SELECCIONE -</option></select>');
                    }
		});
            }
	}
    });
	
	$('#combo-filtos').on('click','select#select-tipo',function(){
            
            idproyecto = $('#man-ges-inc-ul li.active').attr('idproyecto');
            idclase = $('select#select-clase').val();
            fechai=$('input#txtFromDate').val();
            fechaf=$('input#txtToDate').val();
            resulti = fechai.split('/');
            resultf = fechaf.split('/');
            mi=resulti[0];
            di=resulti[1];
            yi=resulti[2];
            mf=resultf[0];
            df=resultf[1];
            yf=resultf[2];
            datos='mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf+'&idproyecto='+idproyecto+'&idclase='+idclase;
            
            if($(this).val()==0){							
                $.getJSON(base_url+'sgwc/resumen/desplega_tipos',datos,function(json){
                    if(json.length>0){		
                        tipo='<select id="select-tipo" class="form-control"><option value="0">- SELECCIONE -</option>';
                        $.each(json,function(x,y){
                            tipo=tipo+'<option value="'+y.idtipo+'">'+y.tipo+'</option>'	;
                        });
                        tipo=tipo+'</select>';					
                        $('td#td-tipo').html(tipo);
                        $('select#select-tipo option:eq(1)').attr('selected', 'selected');
                    }else{
                        $('td#td-tipo').html('<select id="select-tipo" class="form-control"><option value="0">- SELECCIONE -</option></select>');
                    }
                });
            }
	});
	
	$('#combo-filtos').on('click','select#select-subtipo',function(){
            
            idproyecto = $('#man-ges-inc-ul li.active').attr('idproyecto');
            idclase = $('select#select-clase').val();
            idtipo = $('select#select-tipo').val();
            fechai=$('input#txtFromDate').val();
            fechaf=$('input#txtToDate').val();
            resulti = fechai.split('/');
            resultf = fechaf.split('/');
            mi=resulti[0];
            di=resulti[1];
            yi=resulti[2];
            mf=resultf[0];
            df=resultf[1];
            yf=resultf[2];
            datos='mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf+'&idproyecto='+idproyecto+'&idclase='+idclase+'&idtipo='+idtipo;
            
            if($(this).val()==0){			
                $.getJSON(base_url+'sgwc/resumen/desplega_subtipos',datos,function(json){
                    if(json.length>0){		
                        subtipo='<select id="select-subtipo" class="form-control"><option value="0">- SELECCIONE -</option>';
                        $.each(json,function(x,y){
                            subtipo=subtipo+'<option value="'+y.idsubtipo+'">'+y.subtipo+'</option>'	;
                        });

                        subtipo=subtipo+'</select>';					
                        $('td#td-subtipo').html(subtipo);
                        $('select#select-subtipo option:eq(1)').attr('selected', 'selected');
                    }else{
                        $('td#td-subtipo').html('<select id="select-subtipo" class="form-control"><option value="0">- SELECCIONE -</option></select>');
                    }
                });		
            }
	});
	
	$('#combo-filtos').on('change','select#select-clase',function(){
		$('td#td-tipo').html('<select id="select-tipo" class="form-control"><option value="0">- SELECCIONE -</option></select>');	
		$('td#td-subtipo').html('<select id="select-subtipo" class="form-control"><option value="0">- SELECCIONE -</option></select>');
	});
	
	$('#combo-filtos').on('change','select#select-tipo',function(){
		$('td#td-subtipo').html('<select id="select-subtipo" class="form-control"><option value="0">- SELECCIONE -</option></select>');	
	});
	
	$('#combo-filtos').on('click','#buscar-filtros',function(){
            
            $('#back_filtro').hide();
            $('#back_to_filtro').hide();
            idproyecto = $('#man-ges-inc-ul li.active').attr('idproyecto');
            fechai=$('input#txtFromDate').val();
            fechaf=$('input#txtToDate').val();
            
            if(fechai=='' || fechaf==''){
                alert('Seleccione una fecha inicio y/o fecha fin');
            }else{			
                
                resulti = fechai.split('/');
		resultf = fechaf.split('/');
		mi=resulti[0];
		di=resulti[1];
		yi=resulti[2];
		mf=resultf[0];
		df=resultf[1];
		yf=resultf[2];
		
                idproyecto = $('#man-ges-inc-ul li.active').attr('idproyecto');
		idclase = $('select#select-clase').val();
		idtipo = $('select#select-tipo').val();
		idsubtipo = $('select#select-subtipo').val();
			
		DrawFirst_filtro(mi, di, yi, mf, df, yf, idproyecto, idclase, idtipo, idsubtipo);	
		$('#back').hide();		
		$("#back_to").hide();		
			
		serie =  $('select#man-ges-inc-combo').val();
		DrawMensual_filtro(idproyecto,mi,di,yi,mf,df,yf,idclase,idtipo,idsubtipo,serie);
		loadScatters_filtro(idproyecto,mi,di,yi,mf,df,yf,idclase,idtipo,idsubtipo,serie);
            }
	});

	$('#man-ges-inc-ul').on('click','li',function(){
		idproyecto = $(this).attr('idproyecto');
		proyecto = $(this).attr('proyecto');
		loadCombo(idproyecto,proyecto);
	});
	
function loadCombo(idproyecto,proyecto){
		datos = 'idproyecto='+idproyecto;
		combo = '<select class="form-control selectpicker" name="mes" id="man-ges-inc-combo">';
		$.getJSON(base_url+'sgwc/resumen/meses',datos,function(json){
			$.each(json,function(x,y){
			combo = combo + '<option value="'+y.serie+'" serie="'+y.serie+'" anio="'+y.anio+'" mes="'+y.mes+'">'+y.serie+'</option>';	
			});
			combo = combo + '</select>';
			filtro='<div><input type="checkbox" id="periodo" /> Buscar por periodo:</div><div id="buscar_periodo"></div>';
			$('#combo-proyectos').html(combo);
			$('#combo-filtos').html(filtro);
		}).done(function(){
			$('.selectpicker').selectpicker();
			serie =  $('select#man-ges-inc-combo').val();
			DrawFirst(idproyecto,serie,proyecto);
			//DrawFirstScatter(idproyecto,serie,proyecto);
			DrawMensual(idproyecto,serie,proyecto);	
			loadScatters(idproyecto,serie,proyecto);		
		});
	}
	
function loadScatters(idproyecto,serie,proyecto){
	var datos = 'idproyecto='+idproyecto+'&serie='+serie;
	target=0;
	id=0;
	$.getJSON(base_url+'sgwc/resumen/segmentos',datos,function(json){
		div='';
		$.each(json,function(x,y){
			target = target+1;
			div = div+'<div class="row"><div class="col-md-12"><div class="row"><div class="col-md-12"><button id="back_scatter_'+target+'" class="btn btn-green" idproyecto="" serie="" proyecto="" style="display:none"><i class="fa fa-mail-reply"></i> Regresar a Clases</button><button id="back_to_scatter_'+target+'" class="btn btn-green" valor="" idproyecto="" serie="" style="display:none"><i class="fa fa-mail-reply"></i> Regresar a <span id="button_title_scatter_'+target+'"></span></button></div><div class="col-md-12" id="scatter_'+target+'" class="scatters" style="height:700px;"></div></div></div></div><script>$("#back_scatter_'+target+'").click(function(){idproyecto = $(this).attr("idproyecto");proyecto = $(this).attr("proyecto");serie = $(this).attr("serie");segmento=$(this).attr("segmento");target=$(this).attr("target");$(this).hide();$("#scatter_'+target+'").highcharts().destroy();DrawFirstScatter(idproyecto,serie,proyecto,segmento,target);});$("#back_to_scatter_'+target+'").click(function(){valor =($("#back_to_scatter_'+target+'").attr("valor"));idproyecto = $(this).attr("idproyecto");proyecto = $(this).attr("proyecto");serie = $(this).attr("serie");segmento=$(this).attr("segmento");target=$(this).attr("target");$("#scatter_'+target+'").highcharts().destroy();DrawSecondScatter(valor,idproyecto,serie,segmento,target);$("#back_scatter_'+target+'").show();$("#back_to_scatter_'+target+'").hide();});</script>';
		});
		div = div + '';
		$('div#contenedor-scatters').html(div);
	}).done(function(){
		$.getJSON(base_url+'sgwc/resumen/segmentos',datos,function(json2){
			$.each(json2,function(u,v){				
				id = id+1;
				DrawFirstScatter(idproyecto,serie,proyecto,v.segmento,id);
			});
		});
	});
}
	
function DrawFirst(idproyecto,serie,proyecto){
	$('#chart-estandares').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
	var meses = [];
	datos = 'serie='+serie+'&idproyecto='+idproyecto;
	$.getJSON(base_url+'sgwc/resumen/clases_x',datos,function(data){
		$.each(data,function(k,v){
			meses.push(v.clase);
		});
	}).done(function(){
		$.getJSON(base_url+'sgwc/resumen/clases_y',datos,function(json) {
			chart = new Highcharts.Chart({
			chart: {
				renderTo: 'chart-estandares',
				backgroundColor: 'none',
            	borderRadius: 0,
				type:'bar',
        	},
            title: {
                text: proyecto.toUpperCase()+'<br>INTERVENCIONES PARA MANTENER LOS ESTANDARES'
            },
			subtitle: {
                text: decodeURIComponent(serie)
            },
            xAxis: {
                categories: meses,
				labels: {
					rotation:0,
					align: 'right',
					style: {
						font: 'normal 9px Helvetica',
						color: '#000000'
						}
				}
            },
			yAxis: {
					lineColor: '#cccccc',
            		lineWidth: 1,
                    title: {
                        text: 'Total'
                    },
					
            },
			tooltip: {
           		pointFormat: 'TOTAL: <b>{point.y}</b>'
         	},
            legend: {
                enabled:false
            },
			credits:{
				enabled:false
			},
			plotOptions: {
             bar: {
                 allowPointSelect: true,
				 colorByPoint: true,
                 cursor: 'pointer',
                 dataLabels: {
                     enabled: true,
                     color: '#000000',
                     connectorColor: '#000000',
                     formatter: function() {
                         return '<b>'+ this.point.y;
                     }
                 },
                 point: {
                     events: {
                         click: function() {
                             $('#back').show();
							 $('#back').attr('idproyecto',idproyecto).attr('serie',serie).attr('proyecto',proyecto);
                             DrawSecond(this.category,idproyecto,serie)
                             chart.destroy();                                
                         }
                     }
                 }
             }
         },
		series: json,
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Intervenciones_estandares',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos1 = 'nivel=1&idproyecto='+idproyecto+'&serie='+serie+'&clase=&tipo=';
									window.open(base_url+'sgwc/resumen/excel_int?'+datos1)
								}
							}]
						}
					}
				}
        });
		
		chart1 = $('#chart-estandares').highcharts();
		for(j=0;j<=60;j++){
			banda = (j%2==0)?'#ffffff':'#eeeeee';
			chart1.xAxis[0].addPlotBand({     
				from: j-0.5,
				to: j+0.5,
				color:banda
				});
			}
		});
    });
}

function DrawSecond(name,idproyecto,serie){
		$('#chart-estandares').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
        datos = 'serie='+serie+'&idproyecto='+idproyecto+'&tipo='+encodeURIComponent(name);
		$.getJSON(base_url+'sgwc/resumen/tipos_y',datos,function(json) {
			chart1 = new Highcharts.Chart({
			chart: {
				renderTo: 'chart-estandares',
				backgroundColor: 'none',
            	borderRadius: 0,
				type:'pie',
        	},
            title: {
                text: name
            },
			subtitle: {
                text: 'Numero de Incidencias Por Tipo del Elemento de Estandar'
            },
			tooltip: {
            	pointFormat: 'TOTAL: <b>{point.y}</b>'
         	},
            legend: {
                enabled:false
            },
			credits:{
				enabled:false
			},
			plotOptions: {
				pie:{
					size:'70%',
					cursor: 'pointer',
            		dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					},
					point: {
                     events: {
                         click: function() {
							 	if(idproyecto==1){
							 		DrawThird(idproyecto,serie,name,this.name);
							 		$("span#button_title").text(name);
							 		$("#back_to").attr("valor",name);
							 		$('#back_to').attr('idproyecto',idproyecto).attr('serie',serie);
							 		chart1.destroy();
							 		$("#back").hide();
							 		$("#back_to").show();
								}
							}
					 	}
					}
				}
         },
		series: json,
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Intervenciones_estandares',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos2 = 'nivel=2&idproyecto='+idproyecto+'&serie='+serie+'&clase='+name+'&tipo=';
									window.open(base_url+'sgwc/resumen/excel_int?'+datos2)
								}
							}]
						}
					}
				}
        });
		});}
            
function DrawThird(idproyecto,serie,clase,tipo){
	$('#chart-estandares').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
        datos = 'serie='+serie+'&idproyecto='+idproyecto+'&tipo='+encodeURIComponent(tipo)+'&clase='+encodeURIComponent(clase); 
		$.getJSON(base_url+'sgwc/resumen/subtipos_y',datos,function(json) {
			chart2 = new Highcharts.Chart({
			chart: {
				renderTo: 'chart-estandares',
				backgroundColor: 'none',
            	borderRadius: 0,
				type:'pie',
        	},
            title: {
                text: clase+'->'+tipo
            },
			subtitle: {
                text: 'Numero de Incidencias Por Tipo del Elemento de Estandar'
            },
			tooltip: {
            	pointFormat: 'TOTAL: <b>{point.y}</b>'
         	},
            legend: {
                enabled:false
            },
			credits:{
				enabled:false
			},
			plotOptions: {
				pie:{
					size:'70%',
            		dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					},
					point: {
                     events: {
                         click: function() {
							 //DrawThird(name,this.name) 
							 //chart1.destroy();
							 }
					 	}
					}
					
				}
         },
		series: json,
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Intervenciones_estandares',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos3 = 'nivel=3&idproyecto='+idproyecto+'&serie='+serie+'&clase='+clase+'&tipo='+tipo;
									window.open(base_url+'sgwc/resumen/excel_int?'+datos3)
								}
							}]
						}
					}
				}
        });
		});}

function DrawMensual(idproyecto,serie,proyecto){
	$('#chart-mensual').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
		datos = 'serie='+serie+'&idproyecto='+idproyecto; 
$.getJSON(base_url+'sgwc/resumen/anual',datos,function(data) {						
var seriesData = [];
var xCategories = [];
var i, cat;
for(i = 0; i < data.length; i++){
     cat = data[i].unit;
     if(xCategories.indexOf(cat) === -1){
        xCategories[xCategories.length] = cat;
     }
}
for(i = 0; i < data.length; i++){
	if(seriesData){
		var currSeries = seriesData.filter(function(seriesObject){ return seriesObject.name == data[i].status;});
      	if(currSeries.length === 0){
			if(i==1)
		  		str=data[i].status
    	  		seriesData[seriesData.length] = currSeries = {
			  	name: data[i].status,
			  	data: []
			  /*dashStyle:'solid',
			  type:'line'*/
          	};
      } else {
          currSeries = currSeries[0];
      }
      var index = currSeries.data.length;
      currSeries.data[index] = data[i].val;
    } else {
       seriesData[0] = {
           name: data[i].status,
           color: '#000',
           data: [data[i].val]     
       }
    }

}	
	
	//$('#incidencias_mensual').highcharts({
	chart0 = new Highcharts.Chart({	    
	    chart: {
	        type: 'line',
			renderTo: 'chart-mensual'
	    },
	    title: {
	        text: proyecto.toUpperCase()+'<br>COMPARATIVA DE INTERNVENCIONES PARA MANTENER LOS ESTÁNDARES'
	    },
		subtitle: {
	        text: 'DESDE ORIGEN'
	    },
	    pane: {
	    	size: '100%'
	    },
	    xAxis: {
	        categories: xCategories,
			tickmarkPlacement: 'on',
	        lineWidth: 0,
			labels: {
                    rotation: -90,
                    align: 'right',
                    style: {
                        //fontSize: '11px',
                        //fontFamily: 'Verdana, sans-serif'
                    }
                },
			plotBands: [
						//{color:'#FCFFC5',from:-1,to:12},
					]
	    },     
	    yAxis: {
	        //lineWidth: 0,
	        min: 0,
			title:{
				text:'TOTAL'
			}
	    },
	    tooltip: {
	    	shared: true,
	        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
	    },
	    legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            y: 50,
			maxHeight: 400,
            navigation: {
            	activeColor: '#3E576F',
				animation: true,
				arrowSize: 12,
				inactiveColor: '#CCC',
				style: {
					fontWeight: 'bold',
					color: '#333',
					fontSize: '12px'	
				}
			}
        },
		plotOptions: {
             line: {
                 point: {
                     events: {
                         click: function() {
                             console.log('Crear 2 chart');
							 $('#back_mensual').show();
							 $('#back_mensual').attr('idproyecto',idproyecto).attr('serie',this.series.name).attr('proyecto',proyecto);
							 //alert(this.series.name);
							 //alert(this.category+idproyecto+serie);
                             DrawSecond_Mensual(this.category,idproyecto,this.series.name);
                             chart0.destroy();                               
                         }
                     }
                 }
             }
         },
		series: seriesData,
		credits:{
				enabled:false
		},
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Comparativa',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos1 = 'nivel=1&idproyecto='+idproyecto+'&serie='+serie+'&clase=&tipo=';
									window.open(base_url+'sgwc/resumen/excel_comp?'+datos1)
								}
							}]
						}
					}
				}
	});
		chart0 = $('#chart-mensual').highcharts();
		i=0;
		$.each(chart0.series,function(){
			if(i==0||i==1||i==12){
				chart0.series[i].show();
				}else{
					chart0.series[i].hide();
					}
			i++;
		for(j=0;j<=60;j++){
			banda = (j%2==0)?'#ffffff':'#eeeeee';
			chart0.xAxis[0].addPlotBand({     
				from: j-0.5,
				to: j+0.5,
				color:banda
				});
			}
		});
    });}

function DrawSecond_Mensual(name,idproyecto,serie){
	$('#chart-mensual').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
		datos = 'serie='+serie+'&idproyecto='+idproyecto+'&tipo='+name; 
$.getJSON(base_url+'sgwc/resumen/anual_tipo',datos,function(data) {						
var seriesData = [];
var xCategories = [];
var i, cat;
for(i = 0; i < data.length; i++){
     cat = data[i].unit;
     if(xCategories.indexOf(cat) === -1){
        xCategories[xCategories.length] = cat;
     }
}
for(i = 0; i < data.length; i++){
	if(seriesData){
		var currSeries = seriesData.filter(function(seriesObject){ return seriesObject.name == data[i].status;});
      	if(currSeries.length === 0){
			if(i==1)
		  		str=data[i].status
    	  		seriesData[seriesData.length] = currSeries = {
			  	name: data[i].status,
			  	data: []
			  /*dashStyle:'solid',
			  type:'line'*/
          	};
      } else {
          currSeries = currSeries[0];
      }
      var index = currSeries.data.length;
      currSeries.data[index] = data[i].val;
    } else {
       seriesData[0] = {
           name: data[i].status,
           color: '#000',
           data: [data[i].val]     
       }
    }

}	
	
	//$('#incidencias_mensual').highcharts({
	chart01 = new Highcharts.Chart({	    
	    chart: {
	        type: 'line',
			renderTo: 'chart-mensual'
	    },
	    title: {
	        text: name
	    },
		subtitle: {
	        text: 'DESDE ORIGEN'
	    },
	    pane: {
	    	size: '100%'
	    },
	    xAxis: {
	        categories: xCategories,
			tickmarkPlacement: 'on',
	        lineWidth: 0,
			labels: {
                    rotation: -90,
                    align: 'right',
                    style: {
                        //fontSize: '11px',
                        //fontFamily: 'Verdana, sans-serif'
                    }
                },
			plotBands: [
						//{color:'#FCFFC5',from:-1,to:12},
					]
	    },     
	    yAxis: {
	        //lineWidth: 0,
	        min: 0,
			title:{
				text:'TOTAL'
			}
	    },
	    tooltip: {
	    	shared: true,
	        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
	    },
	    legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            y: 50,
			maxHeight: 400,
            navigation: {
            	activeColor: '#3E576F',
				animation: true,
				arrowSize: 12,
				inactiveColor: '#CCC',
				style: {
					fontWeight: 'bold',
					color: '#333',
					fontSize: '12px'	
				}
			}
        },
		plotOptions: {
             line: {
                 point: {
                     events: {
                         click: function() {
                         	if(idproyecto==1){
									serie = $('button#back_mensual').attr('serie');
							 		//alert(idproyecto+serie+name+this.category);
									DrawThird_Mensual(idproyecto,serie,name,this.category);
							 		$("span#button_title_mensual").text(name);
							 		$("#back_to_mensual").attr("valor",name);
							 		$('#back_to_mensual').attr('idproyecto',idproyecto).attr('serie',serie);
							 		chart01.destroy();
							 		$("#back_mensual").hide();
							 		$("#back_to_mensual").show();
								}                               
                         }
                     }
                 }
             }
         },
		series: seriesData,
		credits:{
				enabled:false
		},
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Comparativa',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos2 = 'nivel=2&idproyecto='+idproyecto+'&serie='+serie+'&clase='+name+'&tipo=';
									window.open(base_url+'sgwc/resumen/excel_comp?'+datos2)
								}
							}]
						}
					}
				}
	});
		chart01 = $('#chart-mensual').highcharts();
		i=0;
		$.each(chart01.series,function(){
			if(i==0||i==1||i==12){
				chart01.series[i].show();
				}else{
					chart01.series[i].hide();
					}
			i++;
		for(j=0;j<=60;j++){
			banda = (j%2==0)?'#ffffff':'#eeeeee';
			chart01.xAxis[0].addPlotBand({     
				from: j-0.5,
				to: j+0.5,
				color:banda
				});
			}
		});
    });}

function DrawThird_Mensual(idproyecto,serie,clase,tipo){
	$('#chart-mensual').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
		datos = 'serie='+serie+'&idproyecto='+idproyecto+'&tipo='+encodeURIComponent(tipo)+'&clase='+encodeURIComponent(clase)
$.getJSON(base_url+'sgwc/resumen/anual_subtipo',datos,function(data) {						
var seriesData = [];
var xCategories = [];
var i, cat;
for(i = 0; i < data.length; i++){
     cat = data[i].unit;
     if(xCategories.indexOf(cat) === -1){
        xCategories[xCategories.length] = cat;
     }
}
for(i = 0; i < data.length; i++){
	if(seriesData){
		var currSeries = seriesData.filter(function(seriesObject){ return seriesObject.name == data[i].status;});
      	if(currSeries.length === 0){
			if(i==1)
		  		str=data[i].status
    	  		seriesData[seriesData.length] = currSeries = {
			  	name: data[i].status,
			  	data: []
			  /*dashStyle:'solid',
			  type:'line'*/
          	};
      } else {
          currSeries = currSeries[0];
      }
      var index = currSeries.data.length;
      currSeries.data[index] = data[i].val;
    } else {
       seriesData[0] = {
           name: data[i].status,
           color: '#000',
           data: [data[i].val]     
       }
    }

}	
	
	//$('#incidencias_mensual').highcharts({
	chart02 = new Highcharts.Chart({	    
	    chart: {
	        type: 'line',
			renderTo: 'chart-mensual'
	    },
	    title: {
	        text: clase+'->'+tipo
	    },
		subtitle: {
	        text: 'DESDE ORIGEN'
	    },
	    pane: {
	    	size: '100%'
	    },
	    xAxis: {
	        categories: xCategories,
			tickmarkPlacement: 'on',
	        lineWidth: 0,
			labels: {
                    rotation: -90,
                    align: 'right',
                    style: {
                        //fontSize: '11px',
                        //fontFamily: 'Verdana, sans-serif'
                    }
                },
			plotBands: [
						//{color:'#FCFFC5',from:-1,to:12},
					]
	    },     
	    yAxis: {
	        //lineWidth: 0,
	        min: 0,
			title:{
				text:'TOTAL'
			}
	    },
	    tooltip: {
	    	shared: true,
	        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
	    },
	    legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            y: 50,
			maxHeight: 400,
            navigation: {
            	activeColor: '#3E576F',
				animation: true,
				arrowSize: 12,
				inactiveColor: '#CCC',
				style: {
					fontWeight: 'bold',
					color: '#333',
					fontSize: '12px'	
				}
			}
        },
		plotOptions: {
             line: {
                 point: {
                     events: {
                         click: function() {
                         	                             
                         }
                     }
                 }
             }
         },
		series: seriesData,
		credits:{
				enabled:false
		},
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Comparativa',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos3 = 'nivel=3&idproyecto='+idproyecto+'&serie='+serie+'&clase='+clase+'&tipo='+tipo;
									window.open(base_url+'sgwc/resumen/excel_comp?'+datos3)
								}
							}]
						}
					}
				}
	});
		chart02 = $('#chart-mensual').highcharts();
		i=0;
		$.each(chart02.series,function(){
			if(i==0||i==1||i==12){
				chart02.series[i].show();
				}else{
					chart02.series[i].hide();
					}
			i++;
		for(j=0;j<=60;j++){
			banda = (j%2==0)?'#ffffff':'#eeeeee';
			chart02.xAxis[0].addPlotBand({     
				from: j-0.5,
				to: j+0.5,
				color:banda
				});
			}
		});
    });}

function DrawFirstScatter(idproyecto,serie,proyecto,segmento,id){
	if(idproyecto==1){		
		$('div#contenedor-scatters div#scatter_'+id).html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
		var clases = [];
	var datos = 'serie='+serie+'&idproyecto='+idproyecto+'&segmento='+segmento;
	$.getJSON(base_url+'sgwc/resumen/clases_x_scatter_segmento',datos,function(data){
		$.each(data,function(k,v){
			clases.push(v.clase);
		});
	}).done(function(){
		$.getJSON(base_url+'sgwc/resumen/clases_y_scatter_segmento',datos,function(json3) {
			var km=  [];
			for(i=99;i<=165;i++){
				km.push(i);
			}
			chart_scatter = new Highcharts.Chart({
				colors: ['#7ac142'],
				chart: {
					renderTo: 'scatter_'+id,
					type: 'bubble',
					//plotBorderWidth: 1,
					zoomType: 'xy',
					inverted: true,
					marginTop: 120
				},
				title: {
					text: proyecto.toUpperCase()+'<br>INTERVENCIONES PARA MANTENER LOS ESTANDARES POR SEGMENTO'		
				},
				subtitle: {
					//text: proyecto.toUpperCase()+'<br>INTERVENCIONES PARA MANTENER LOS ESTANDARES POR KILOMETRO'		
					text: segmento.toUpperCase()+' ('+serie+')'
				},
				
				xAxis: {
					categories:clases,
					labels: {
						rotation:0,
						align: 'right',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						}
					}
				},
				yAxis: [{
					min: 99,
					max:165,
					tickPositions: km,
					lineColor: '#cccccc',
					lineWidth: 1,
					title: {
						text: 'Kilometro'
					},
					labels: {
						rotation:-45,
						align: 'right',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						}
					}
				},
				{
					min: 99,
					max:165,
					tickPositions:km,
					lineColor: '#cccccc',
					lineWidth: 1,
					title: {
						text: ''
					},
					labels: {
						rotation:-45,
						align: 'left',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						},
						y:-10
					},
					opposite: true
				}],
				legend: {
            		verticalAlign: 'top',
            		y: 60
        		},
				credits:{
					enabled:false
				},
				plotOptions: {
					bubble: {
						minSize: 10,
						maxSize: 50
					},
					series: {
						dataLabels: {
                    		align: 'center',
                    		enabled: true,
							shadow: false,
							style: {
								shadow: false,
								color:'#000'
                    		}
                		},
						allowPointSelect: true,
						point: {
							events: {
								click: function() {
									$('#back_scatter_'+id).show();
									$('#back_scatter_'+id).attr('idproyecto',idproyecto).attr('serie',serie).attr('proyecto',proyecto).attr('segmento',segmento).attr("target",id);
									DrawSecondScatter(this.category,idproyecto,serie,segmento,id)
									$('#scatter_'+id).highcharts().destroy();
									//chart_scatter.destroy();                               
								}
							}
						}
					}
				},
				tooltip: {
                	formatter: function() {
                        return '<b>Clase:</b> '+ this.x +'<br><b>KM:</b> '+this.y+'<br><b>Total:</b> '+this.point.z;
                	}
        		},
				series: json3,
				exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Intervenciones_estandares_km',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos1 = 'nivel=1&idproyecto='+idproyecto+'&serie='+serie+'&segmento='+segmento+'&clase=&tipo=';
									window.open(base_url+'sgwc/resumen/excel?'+datos1)
								}
							}]
						}
					}
				} 
			});
			
			chart_scatter = $('#scatter_'+id).highcharts();
			for(j=0;j<=60;j++){
				banda = (j%2==0)?'#ffffff':'#eeeeee';
				chart_scatter.xAxis[0].addPlotBand({     
					from: j-0.5,
					to: j+0.5,
					color:banda
				});
			}
		});		
	});
	}else{
		$('div#contenedor-scatters div#scatter_'+id).html('');
	}
}

function DrawSecondScatter(clase,idproyecto,serie,segmento,id){
	$('#scatter_'+id).html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
	proyecto = $('#man-ges-inc-ul li.active').attr('proyecto');
	var tipos = [];
	var datos = 'serie='+serie+'&idproyecto='+idproyecto+'&clase='+encodeURIComponent(clase)+'&segmento='+segmento;
	$.getJSON(base_url+'sgwc/resumen/tipos_x_scatter_segmento',datos,function(data){
		$.each(data,function(k,v){
			tipos.push(v.tipo);
		});
	}).done(function(){
		var km=  [];
		for(i=99;i<=165;i++){
			km.push(i);
		}
		$.getJSON(base_url+'sgwc/resumen/tipos_y_scatter_segmento',datos,function(json3) {
			chart1_scatter = new Highcharts.Chart({
				colors: ['#7ac142'],
				chart: {
					renderTo: 'scatter_'+id,
					type: 'bubble',
					zoomType: 'xy',
					inverted: true,
					marginTop: 120
				},
				title: {
					text: proyecto.toUpperCase()+'<br>INTERVENCIONES PARA MANTENER LOS ESTANDARES POR SEGMENTO'		
				},
				subtitle: {
					text: clase
				},
				xAxis: {
					categories:tipos,
					labels: {
						rotation:0,
						align: 'right',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						}
					}
				},
				yAxis: [{
					min: 99,
					max:165,
					tickPositions: km,
					lineColor: '#cccccc',
					lineWidth: 1,
					title: {
						text: 'Kilometro'
					},
					labels: {
						rotation:-45,
						align: 'right',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						}
					}
				},
				{
					min: 99,
					max:165,
					tickPositions:km,
					lineColor: '#cccccc',
					lineWidth: 1,
					title: {
						text: ''
					},
					labels: {
						rotation:-45,
						align: 'left',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						},
						y:-10
					},
					opposite: true
				}],
				legend: {
            		verticalAlign: 'top',
            		y: 60
        		},
				credits:{
					enabled:false
				},
				plotOptions: {
					bubble: {
						minSize: 10,
						maxSize: 50
					},
					series: {
						dataLabels: {
                    		align: 'center',
                    		enabled: true,
							shadow: false,
							style: {
								shadow: false,
								color:'#000'
                    		}
                		},
						allowPointSelect: true,
						marker: {
							enabled: true,
							symbol: 'circle',
							radius: 10
						},
						point: {
							events: {
								click: function() {
									if(idproyecto==1){
							 			DrawThirdScatter(idproyecto,serie,clase,this.category,segmento,id);
										$("span#button_title_scatter_"+id).text(clase);
							 			$("#back_to_scatter_"+id).attr("valor",clase);
							 			$("#back_to_scatter_"+id).attr('idproyecto',idproyecto).attr('serie',serie).attr("segmento",segmento).attr("target",id);
										$("#scatter_"+id).highcharts().destroy();
							 			$("#back_scatter_"+id).hide();
							 			$("#back_to_scatter_"+id).show();
									}                          
								}
							}
						}
					}
				},
				tooltip: {
                	formatter: function() {
                        return '<b>Clase:</b> '+ this.x +'<br><b>KM:</b> '+this.y+'<br><b>Total:</b> '+this.point.z;
                	}
        		},
				series: json3,
				exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Intervenciones_estandares_km',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos2 = 'nivel=2&idproyecto='+idproyecto+'&serie='+serie+'&segmento='+segmento+'&clase='+clase+'&tipo=';
									window.open(base_url+'sgwc/resumen/excel?'+datos2)
								}
							}]
						}
					}
				} 
			});
			
			chart1_scatter = $('#scatter_'+id).highcharts();
			for(j=0;j<=60;j++){
				banda = (j%2==0)?'#ffffff':'#eeeeee';
				chart1_scatter.xAxis[0].addPlotBand({     
					from: j-0.5,
					to: j+0.5,
					color:banda
				});
			}
		});		
	});
}

function DrawThirdScatter(idproyecto,serie,clase,tipo,segmento,id){
	$('#scatter_'+id).html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
	proyecto = $('#man-ges-inc-ul li.active').attr('proyecto');
	var subtipos = [];
	var datos = 'serie='+serie+'&idproyecto='+idproyecto+'&clase='+encodeURIComponent(clase)+'&tipo='+encodeURIComponent(tipo)+'&segmento='+segmento;
	$.getJSON(base_url+'sgwc/resumen/subtipos_x_scatter_segmento',datos,function(data){
		$.each(data,function(k,v){
			subtipos.push(v.subtipo);
		});
	}).done(function(){
		var km=  [];
		for(i=99;i<=165;i++){
			km.push(i);
		}
		$.getJSON(base_url+'sgwc/resumen/subtipos_y_scatter_segmento',datos,function(json4) {
			chart2_scatter = new Highcharts.Chart({
				colors: ['#7ac142'],
				chart: {
					renderTo: 'scatter_'+id,
					type: 'bubble',
					zoomType: 'xy',
					inverted: true,
					marginTop: 120
				},
				title: {
					text: proyecto.toUpperCase()+'<br>INTERVENCIONES PARA MANTENER LOS ESTANDARES POR SEGMENTO'		
				},
				subtitle: {
					text: clase+'->'+tipo
				},
				xAxis: {
					categories:subtipos,
					labels: {
						rotation:0,
						align: 'right',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						}
					}
				},
				yAxis: [{
					min: 99,
					max:165,
					tickPositions: km,
					lineColor: '#cccccc',
					lineWidth: 1,
					title: {
						text: 'Kilometro'
					},
					labels: {
						rotation:-45,
						align: 'right',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						}
					}
				},
				{
					min: 99,
					max:165,
					tickPositions:km,
					lineColor: '#cccccc',
					lineWidth: 1,
					title: {
						text: ''
					},
					labels: {
						rotation:-45,
						align: 'left',
						style: {
							font: 'normal 9px Helvetica',
							color: '#000000'
						},
						y:-10
					},
					opposite: true
				}],
				legend: {
            		verticalAlign: 'top',
            		y: 60
        		},
				credits:{
					enabled:false
				},
				plotOptions: {
					bubble: {
						minSize: 10,
						maxSize: 50
					},
					series: {
						dataLabels: {
                    		align: 'center',
                    		enabled: true,
							shadow: false,
							style: {
								shadow: false,
								color:'#000'
                    		}
                		},
						allowPointSelect: true,
						marker: {
							enabled: true,
							symbol: 'circle',
							radius: 10
						},
						point: {
							events: {
								click: function() {                        
								}
							}
						}
					}
				},
				tooltip: {
                	formatter: function() {
                        return '<b>Clase:</b> '+ this.x +'<br><b>KM:</b> '+this.y+'<br><b>Total:</b> '+this.point.z;
                	}
        		},
				series: json4,
				exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Intervenciones_estandares_km',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos3 = 'nivel=3&idproyecto='+idproyecto+'&serie='+serie+'&segmento='+segmento+'&clase='+clase+'&tipo='+tipo;
									window.open(base_url+'sgwc/resumen/excel?'+datos3)
								}
							}
							]
						}
					}
				} 
			});
			
			chart2_scatter = $('#scatter_'+id).highcharts();
			for(j=0;j<=60;j++){
				banda = (j%2==0)?'#ffffff':'#eeeeee';
				chart2_scatter.xAxis[0].addPlotBand({     
					from: j-0.5,
					to: j+0.5,
					color:banda
				});
			}
		});		
	});
}

function DrawFirst_filtro(mi, di, yi, mf, df, yf, idproyecto, idclase, idtipo, idsubtipo){
	
    $('#chart-estandares').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
    var meses = [];
    datos='mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf+'&idproyecto='+idproyecto+'&idclase='+idclase+'&idtipo='+idtipo+'&idsubtipo='+idsubtipo;
    
    $.getJSON(base_url+'sgwc/resumen/clases_x_filtro',datos,function(data){
        $.each(data,function(k,v){
            meses.push(v.clase);
	});
        
    }).done(function(){	
        $.getJSON(base_url+'sgwc/resumen/clases_y_filtro',datos,function(json) {
            chart = new Highcharts.Chart({
            chart: {
		renderTo: 'chart-estandares',
		backgroundColor: 'none',
            	borderRadius: 0,
		type:'bar',
            },
            title: {
                text: proyecto.toUpperCase()+'<br>INTERVENCIONES PARA MANTENER LOS ESTANDARES'
            },
            subtitle: {
                text: di+'/'+mi+'/'+yi+' A '+df+'/'+mf+'/'+yf
            },
            xAxis: {
                categories: meses,
		labels: {
                    rotation:0,
                    align: 'right',
                    style: {
                        font: 'normal 9px Helvetica',
                        color: '#000000'
                    }
		}
            },
            yAxis: {
                lineColor: '#cccccc',
            	lineWidth: 1,
                title: {
                    text: 'Total'
                },			
            },
            tooltip: {
                pointFormat: 'TOTAL: <b>{point.y}</b>'
            },
            legend: {
                enabled:false
            },
            credits:{
                enabled:false
            },
            plotOptions: {
                bar: {
                    allowPointSelect: true,
                    colorByPoint: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.y;
                        }
                    },
                    point: {
                        events: {
                            click: function() {
                                $('#back_filtro').show();
                                $('#back_filtro').attr('idproyecto',idproyecto).attr('serie',serie).attr('proyecto',proyecto).attr('mi',mi).attr('di',di).attr('yi',yi).attr('mf',mf).attr('df',df).attr('yf',yf).attr('clase',idclase).attr('tipo',idtipo).attr('sub',idsubtipo);
                                DrawSecond_filtro(this.category,idproyecto,serie,mi,di,yi,mf,df,yf)
                                chart.destroy();                               
                         }
                     }
                 }
             }
         },
		series: json,
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Intervenciones_estandares',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos1 = 'nivel=1&idproyecto='+idproyecto+'&serie='+serie+'&clase=&tipo=';
									window.open(base_url+'sgwc/resumen/excel_int?'+datos1)
								}
							}]
						}
					}
				}
        });
		
		chart1 = $('#chart-estandares').highcharts();
		for(j=0;j<=60;j++){
			banda = (j%2==0)?'#ffffff':'#eeeeee';
			chart1.xAxis[0].addPlotBand({     
				from: j-0.5,
				to: j+0.5,
				color:banda
				});
			}
		});
    });
}

function DrawSecond_filtro(name,idproyecto,serie,mi,di,yi,mf,df,yf){
    
    $('#chart-estandares').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
    datos = 'serie='+serie+'&idproyecto='+idproyecto+'&tipo='+encodeURIComponent(name)+'&mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf;
    $.getJSON(base_url+'sgwc/resumen/tipos_y_filtro',datos,function(json) {
        chart1 = new Highcharts.Chart({
            chart: {
		renderTo: 'chart-estandares',
		backgroundColor: 'none',
            	borderRadius: 0,
		type:'pie',
            },
            title: {
                text: name
            },
            subtitle: {
                text: 'Numero de Incidencias Por Tipo del Elemento de Estandar'
            },
            tooltip: {
            	pointFormat: 'TOTAL: <b>{point.y}</b>'
            },
            legend: {
                enabled:false
            },
            credits:{
		enabled:false
            },
            plotOptions: {
                pie:{
                    size:'70%',
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
			color: '#000000',
			connectorColor: '#000000',
			format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    },
                    point: {
                        events: {
                            click: function() {
                                if(idproyecto==1){
                                    DrawThird_filtro(idproyecto,serie,name,this.name,mi,di,yi,mf,df,yf);
                                    $("span#button_title").text(name);
                                    $("#back_to_filtro").attr("valor",name);
                                    $('#back_to_filtro').attr('idproyecto',idproyecto).attr('serie',serie).attr('mi',mi).attr('di',di).attr('yi',yi).attr('mf',mf).attr('df',df).attr('yf',yf);
                                    chart1.destroy();
                                    $("#back_filtro").hide();
                                    $("#back_to_filtro").show();
				}
                            }
			}
                    }
		}
            },
            series: json,
            exporting: {
		type: 'image/jpeg',
		sourceWidth: 800,
		sourceHeight: 600,
		scale: 1,
		filename: 'Intervenciones_estandares',
		buttons: {
                    contextButton: {
			menuItems: [{
                            text: 'Exportar en JPEG',
                            onclick: function() {
                                this.exportChart();
                            }
			},{
                            text: 'Exportar en XLS',
                            onclick: function() {
				datos2 = 'nivel=2&idproyecto='+idproyecto+'&serie='+serie+'&clase='+name+'&tipo=';
				window.open(base_url+'sgwc/resumen/excel_int?'+datos2)
                            }
			}]
                    }
                }
            }
        });
    });
}

function DrawThird_filtro(idproyecto,serie,clase,tipo,mi,di,yi,mf,df,yf){
	$('#chart-estandares').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
        datos = 'serie='+serie+'&idproyecto='+idproyecto+'&tipo='+encodeURIComponent(tipo)+'&clase='+encodeURIComponent(clase)+'&mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf; 
		$.getJSON(base_url+'sgwc/resumen/subtipos_y_filtro',datos,function(json) {
			chart2 = new Highcharts.Chart({
			chart: {
				renderTo: 'chart-estandares',
				backgroundColor: 'none',
            	borderRadius: 0,
				type:'pie',
        	},
            title: {
                text: clase+'->'+tipo
            },
			subtitle: {
                text: 'Numero de Incidencias Por Tipo del Elemento de Estandar'
            },
			tooltip: {
            	pointFormat: 'TOTAL: <b>{point.y}</b>'
         	},
            legend: {
                enabled:false
            },
			credits:{
				enabled:false
			},
			plotOptions: {
				pie:{
					size:'70%',
            		dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					},
					point: {
                     events: {
                         click: function() {
							 //DrawThird(name,this.name) 
							 //chart1.destroy();
							 }
					 	}
					}
					
				}
         },
		series: json,
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Intervenciones_estandares',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos3 = 'nivel=3&idproyecto='+idproyecto+'&serie='+serie+'&clase='+clase+'&tipo='+tipo;
									window.open(base_url+'sgwc/resumen/excel_int?'+datos3)
								}
							}]
						}
					}
				}
        });
		});
}

function DrawMensual_filtro(idproyecto,mi,di,yi,mf,df,yf,idclase,idtipo,idsubtipo,serie){
	$('#chart-mensual').html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
		datos = 'idproyecto='+idproyecto+'&mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf+'&idclase='+idclase+'&idtipo='+idtipo+'&idsubtipo='+idsubtipo; 
$.getJSON(base_url+'sgwc/resumen/anual_filtro',datos,function(data) {						
var seriesData = [];
var xCategories = [];
var i, cat;
for(i = 0; i < data.length; i++){
     cat = data[i].unit;
     if(xCategories.indexOf(cat) === -1){
        xCategories[xCategories.length] = cat;
     }
}
for(i = 0; i < data.length; i++){
	if(seriesData){
		var currSeries = seriesData.filter(function(seriesObject){ return seriesObject.name == data[i].status;});
      	if(currSeries.length === 0){
			if(i==1)
		  		str=data[i].status
    	  		seriesData[seriesData.length] = currSeries = {
			  	name: data[i].status,
			  	data: []
			  /*dashStyle:'solid',
			  type:'line'*/
          	};
      } else {
          currSeries = currSeries[0];
      }
      var index = currSeries.data.length;
      currSeries.data[index] = data[i].val;
    } else {
       seriesData[0] = {
           name: data[i].status,
           color: '#000',
           data: [data[i].val]     
       }
    }

}	
	
	//$('#incidencias_mensual').highcharts({
	chart0 = new Highcharts.Chart({	    
	    chart: {
	        type: 'line',
			renderTo: 'chart-mensual'
	    },
	    title: {
	        text: proyecto.toUpperCase()+'<br>COMPARATIVA DE INTERNVENCIONES PARA MANTENER LOS ESTÁNDARES'
	    },
		subtitle: {
	        text: 'DESDE ORIGEN'
	    },
	    pane: {
	    	size: '100%'
	    },
	    xAxis: {
	        categories: xCategories,
			tickmarkPlacement: 'on',
	        lineWidth: 0,
			labels: {
                    rotation: -90,
                    align: 'right',
                    style: {
                        //fontSize: '11px',
                        //fontFamily: 'Verdana, sans-serif'
                    }
                },
			plotBands: [
						//{color:'#FCFFC5',from:-1,to:12},
					]
	    },     
	    yAxis: {
	        //lineWidth: 0,
	        min: 0,
			title:{
				text:'TOTAL'
			}
	    },
	    tooltip: {
	    	shared: true,
	        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
	    },
	    legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            y: 50,
			maxHeight: 400,
            navigation: {
            	activeColor: '#3E576F',
				animation: true,
				arrowSize: 12,
				inactiveColor: '#CCC',
				style: {
					fontWeight: 'bold',
					color: '#333',
					fontSize: '12px'	
				}
			}
        },
		plotOptions: {
             line: {
                 point: {
                     events: {
                         click: function() {
                             console.log('Crear 2 chart');
							 $('#back_mensual').show();
							 $('#back_mensual').attr('idproyecto',idproyecto);
							 //alert(this.series.name);
							 //alert(this.category+idproyecto+serie);
                             DrawSecond_Mensual(this.category,idproyecto,this.series.name);
                             chart0.destroy();                               
                         }
                     }
                 }
             }
         },
		series: seriesData,
		credits:{
				enabled:false
		},
		exporting: {
					type: 'image/jpeg',
					sourceWidth: 800,
					sourceHeight: 600,
					scale: 1,
					filename: 'Comparativa',
					buttons: {
						contextButton: {
							menuItems: [{
								text: 'Exportar en JPEG',
								onclick: function() {
									this.exportChart();
								}
							},{
								text: 'Exportar en XLS',
								onclick: function() {
									datos1 = 'nivel=1&idproyecto='+idproyecto+'&serie='+serie+'&clase=&tipo=';
									window.open(base_url+'sgwc/resumen/excel_comp?'+datos1)
								}
							}]
						}
					}
				}
	});

		chart0 = $('#chart-mensual').highcharts();
		i=0;
		$.each(chart0.series,function(){
			if(i==0||i==1||i==12){
				chart0.series[i].show();
				}else{
					chart0.series[i].hide();
					}
			i++;
		for(j=0;j<=60;j++){
			banda = (j%2==0)?'#ffffff':'#eeeeee';
			chart0.xAxis[0].addPlotBand({     
				from: j-0.5,
				to: j+0.5,
				color:banda
				});
			}
		});
    });
}

function loadScatters_filtro(idproyecto,mi,di,yi,mf,df,yf,idclase,idtipo,idsubtipo,serie){
	var datos = 'idproyecto='+idproyecto+'&mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf+'&idclase='+idclase+'&idtipo='+idtipo+'&idsubtipo='+idsubtipo; 
	target=0;
	id=0;
	$.getJSON(base_url+'sgwc/resumen/segmentos_filtro',datos,function(json){
		div='';
		$.each(json,function(x,y){
			target = target+1;
			div = div+'<div class="row"><div class="col-md-12"><div class="row"><div class="col-md-12"><button id="back_scatter_'+target+'" class="btn btn-green" idproyecto="" serie="" proyecto="" style="display:none"><i class="fa fa-mail-reply"></i> Regresar a Clases</button><button id="back_to_scatter_'+target+'" class="btn btn-green" valor="" idproyecto="" serie="" style="display:none"><i class="fa fa-mail-reply"></i> Regresar a <span id="button_title_scatter_'+target+'"></span></button></div><div class="col-md-12" id="scatter_'+target+'" class="scatters" style="height:700px;"></div></div></div></div><script>$("#back_scatter_'+target+'").click(function(){idproyecto = $(this).attr("idproyecto");proyecto = $(this).attr("proyecto");serie = $(this).attr("serie");segmento=$(this).attr("segmento");target=$(this).attr("target");$(this).hide();$("#scatter_'+target+'").highcharts().destroy();DrawFirstScatter_filtro(idproyecto,serie,v.segmento,id,mi,di,yi,mf,df,yf,idclase,idtipo,idsubtipo);});$("#back_to_scatter_'+target+'").click(function(){valor =($("#back_to_scatter_'+target+'").attr("valor"));idproyecto = $(this).attr("idproyecto");proyecto = $(this).attr("proyecto");serie = $(this).attr("serie");segmento=$(this).attr("segmento");target=$(this).attr("target");$("#scatter_'+target+'").highcharts().destroy();DrawSecondScatter(valor,idproyecto,serie,segmento,target);$("#back_scatter_'+target+'").show();$("#back_to_scatter_'+target+'").hide();});</script>';
		});
		div = div + '';
		$('div#contenedor-scatters').html(div);
	}).done(function(){
		$.getJSON(base_url+'sgwc/resumen/segmentos_filtro',datos,function(json2){
			$.each(json2,function(u,v){				
				id = id+1;
				DrawFirstScatter_filtro(idproyecto,serie,v.segmento,id,mi,di,yi,mf,df,yf,idclase,idtipo,idsubtipo);
			});
		});
	});
}

function DrawFirstScatter_filtro(idproyecto,serie,segmento,id,mi,di,yi,mf,df,yf,idclase,idtipo,idsubtipo){
    
    if(idproyecto==1){		
	$('div#contenedor-scatters div#scatter_'+id).html('<h1 class="ajax-loading-animation" align="center"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
	var clases = [];
	var datos = 'serie='+serie+'&idproyecto='+idproyecto+'&segmento='+segmento+'&mi='+mi+'&di='+di+'&yi='+yi+'&mf='+mf+'&df='+df+'&yf='+yf+'&idclase='+idclase+'&idtipo='+idtipo+'&idsubtipo='+idsubtipo;
	$.getJSON(base_url+'sgwc/resumen/clases_x_scatter_segmento_filtro',datos,function(data){
		$.each(data,function(k,v){
			clases.push(v.clase);
		});
	}).done(function(){		
            $.getJSON(base_url+'sgwc/resumen/clases_y_scatter_segmento_filtro',datos,function(json3) {
		var km=  [];
		for(i=99;i<=165;i++){
                    km.push(i);
		}
		
                chart_scatter = new Highcharts.Chart({
                    colors: ['#7ac142'],
                    chart: {
                        renderTo: 'scatter_'+id,
			type: 'bubble',
			//plotBorderWidth: 1,
			zoomType: 'xy',
			inverted: true,
			marginTop: 120
                    },
                    title: {
                        text: proyecto.toUpperCase()+'<br>INTERVENCIONES PARA MANTENER LOS ESTANDARES POR SEGMENTO'		
                    },
                    subtitle: {
                        //text: proyecto.toUpperCase()+'<br>INTERVENCIONES PARA MANTENER LOS ESTANDARES POR KILOMETRO'		
                        text: segmento.toUpperCase()+' ('+serie+')'
                    },
                    xAxis: {
			categories:clases,
			labels: {
                            rotation:0,
                            align: 'right',
                            style: {
                                font: 'normal 9px Helvetica',
                                color: '#000000'
                            }
			}
                    },
                    yAxis: [{
			min: 99,
			max:165,
			tickPositions: km,
			lineColor: '#cccccc',
			lineWidth: 1,
			title: {
                            text: 'Kilometro'
			},
			labels: {
                            rotation:-45,
                            align: 'right',
                            style: {
                                font: 'normal 9px Helvetica',
				color: '#000000'
                            }
			}
                    },
                    {   
                        min: 99,
                        max:165,
                        tickPositions:km,
                        lineColor: '#cccccc',
                        lineWidth: 1,
			title: {
                            text: ''
			},
			labels: {
                            rotation:-45,
                            align: 'left',
                            style: {
                                font: 'normal 9px Helvetica',
                                color: '#000000'
                            },
                            y:-10
			},
			opposite: true
                    }],
                    legend: {
                        verticalAlign: 'top',
            		y: 60
                    },
                    credits:{
			enabled:false
                    },
                    plotOptions: {
                        bubble: {
			minSize: 10,
			maxSize: 50
                    },
                    series: {
			dataLabels: {
                            align: 'center',
                            enabled: true,
                            shadow: false,
                            style: {
				shadow: false,
				color:'#000'
                            }
                	},
			allowPointSelect: true,
			point: {
                            events: {
                                click: function() {
                                    $('#back_scatter_'+id).show();
                                    $('#back_scatter_'+id).attr('idproyecto',idproyecto).attr('serie',serie).attr('proyecto',proyecto).attr('segmento',segmento).attr("target",id);
                                    DrawSecondScatter(this.category,idproyecto,serie,segmento,id)
                                    $('#scatter_'+id).highcharts().destroy();
                                    //chart_scatter.destroy();                               
				}
                            }
			}
                    }
		},
                tooltip: {
                    formatter: function() {
                        return '<b>Clase:</b> '+ this.x +'<br><b>KM:</b> '+this.y+'<br><b>Total:</b> '+this.point.z;
                    }
                },
		series: json3,
		exporting: {
                    type: 'image/jpeg',
                    sourceWidth: 800,
                    sourceHeight: 600,
                    scale: 1,
                    filename: 'Intervenciones_estandares_km',
                    buttons: {
			contextButton: {
                            menuItems: [{
				text: 'Exportar en JPEG',
				onclick: function() {
                                    this.exportChart();
				}
                            },{
                            text: 'Exportar en XLS', onclick: function() {
				datos1 = 'nivel=1&idproyecto='+idproyecto+'&serie='+serie+'&segmento='+segmento+'&clase=&tipo=';
				window.open(base_url+'sgwc/resumen/excel?'+datos1)
                                }
                            }]
			}
                    }
		} 
            });
			
            chart_scatter = $('#scatter_'+id).highcharts();
            
                for(j=0;j<=60;j++){
                    banda = (j%2==0)?'#ffffff':'#eeeeee';
                    chart_scatter.xAxis[0].addPlotBand({     
                        from: j-0.5,
			to: j+0.5,
			color:banda
                    });
                }
            });		
	});
    }else{
        $('div#contenedor-scatters div#scatter_'+id).html('');
    }
}