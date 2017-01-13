$(document).ready(function(e) {
    $("#datetimepicker3").datetimepicker({pickTime:false}).on("changeDate",function(e){
		sel=e.date;
		console.log('sel='+sel);
		today=new Date();
		limite_sup=today.setDate(today.getDate()-1);
		console.log('limite_sup='+limite_sup);
		if(sel<limite_sup){
			console.log('ok');
			}else{
				ayer = new Date(today.getTime());
				anio = ayer.getFullYear();
				mes = (ayer.getMonth() +1).toString();
				mes = (mes.length>1)?mes:'0'+mes;
				dia = ayer.getDate().toString();
				dia = (dia.length>1)?dia:'0'+dia;
				console.log(anio+'-'+mes+'-'+dia);
				var picker=$("#datetimepicker3").data("datetimepicker");
				picker.setDate(anio+'-'+mes+'-'+dia);
		}
	});
	
	$('#datetimepicker4').datetimepicker({
      pickTime: false
    });
	
	$('#datetimepicker5').datetimepicker({
      pickDate: false
    });
});