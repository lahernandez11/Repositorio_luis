$(function(){
	$('input[type=file]').bootstrapFileInput();
    $('.file-inputs').bootstrapFileInput();
    $(".messages").hide();

   	var fileExtension = "";
    $(':file').change(function(){
    	var file = $("#archivo")[0].files[0];
        var fileName = file.name;
        console.log(fileName);
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        var fileSize = file.size;
        var fileType = file.type;
		total = ((fileSize/1000));
		total = (total/1000).toFixed(2);
        showMessage("<div class='alert alert-info'>Archivo para subir: " + fileName + ", peso total: " + total + " MB.</div>");
	});
    
	$(':button').click(function(){
		if($('select#plaza').val()==0){
			alert('Seleccione una plaza');
		}
		else{
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			if(!isXls(fileExtension))
			{
				console.log("fileExtension" + fileExtension);
				message = $("<div class='alert alert-danger'><i class='fa fa-warning'></i>El archivo no es valido.</div>");
				showMessage(message);
			}
			else
			{
				archivo = $("#archivo")[0].files[0];
        		nombrearchivo = archivo.name;
				$.ajax({
				url: base_url+'baw/facturacion/procesaExcel',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function(){
					message = $("<div class='alert alert-info'><i class='fa fa-refresh fa-spin'></i> Subiendo el archivo "+nombrearchivo+", por favor espere...</div>");
					showMessage(message);
					$('#btn-cargar-tickets').attr('disabled',true)
				},
				success: function(data){
					var json_data = JSON.parse(data);
					console.log(json_data);
					if(typeof json_data.msj !== "undefined"){
						message = $("<div class='alert alert-success'>"+ json_data.msj+ "</div>");
					}else{
						message = $("<div class='alert alert-danger'>"+ json_data.error+ "</div>");
					}
					$('#btn-cargar-tickets').attr('disabled',false)
					showMessage(message);
					if(isXls(fileExtension))
					{
									
					}
	
							},
							error: function(){
								message = $("<div class='alert alert-danger'><i class='fa fa-warning'></i> Ha ocurrido un error. Verifique el contenido del archivo.</div>");
								$('#btn-cargar-tickets').attr('disabled',false)
								showMessage(message);
							}
						});
					}
		}
	});
			
            function showMessage(message){
                $(".messages").html("").show();
                $(".messages").html(message);
            }
			
            function isXls(extension)
            {
                switch (extension.toLowerCase())
                {
                    case 'xls': case 'xlsx':;
                        return true;
                    break;
                    default:
                        return false;
                    break;
                }
            }
 });