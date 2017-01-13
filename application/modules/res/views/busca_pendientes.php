<script>
$(document).ready(function(){
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
   
    $("form#cambiar").on("submit",function() {
			errores=0;			
			$("select.required").each(function() {
				if($(this).val()=='0'){
						errores = errores+1;
						$(this).css("border","1px solid red");
					}else{
						$(this).css("border","1px solid #ccc");
						}
			});
			$("input:text.required").each(function() {
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
});
</script>
<?php foreach ($elementos as $elemento):?>
                    <div class="modal fade" id="myModal<?=$elemento->idresidente?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title">Pendientes Modificar</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form">
                                        <?=form_open('res/residentes/cambiar',array("enctype" => "multipart/form-data","class"=>"form-horizontal", "role"=>"form","id"=>"cambiar"));?>
                                          <div class="form-group">
                                            <label for="input1" class="col-lg-3 control-label">Nombre</label>
                                            <div class="col-lg-9">
                                              <input type="text" class="form-control required" id="input1" name="input1" placeholder="Ingrese Nombre" value="<?=$elemento->nombre?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="input1" class="col-lg-3 control-label">Apellido Paterno</label>
                                            <div class="col-lg-9">
                                              <input type="text" class="form-control required" id="input2" name="input2" placeholder="Ingrese Apellido Paterno" value="<?=$elemento->apaterno?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="input1" class="col-lg-3 control-label">Apellido Materno</label>
                                            <div class="col-lg-9">
                                              <input type="text" class="form-control required" id="input3" name="input3" placeholder="Ingrese Apellido Materno" value="<?=$elemento->amaterno?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="input1" class="col-lg-3 control-label">No. IFE</label>
                                            <div class="col-lg-9">
                                              <input type="text" class="form-control required" id="input4" name="input4" placeholder="No. IFE" value="<?=$elemento->no_ife?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="input1" class="col-lg-3 control-label">Municipio</label>
                                            <div class="col-lg-9">
                                              <select class="form-control required" name="select1" id="select1">
												<option value="0">--SELECCIONE--</option>
												<?php foreach($municipios as $municipio):?>
                                                <option value="<?=$municipio->idmunicipio?>"><?=$municipio->nombre_municipio?></option>
                                                <?php endforeach;?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="input1" class="col-lg-3 control-label">Localidad</label>
                                            <div class="col-lg-9">
											  <select class="form-control required" name="select2" id="select2" readonly>
												<option value="0">--SELECCIONE--</option>
                                              </select>	
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="input1" class="col-lg-3 control-label">Imagen Frente</label>
                                                <div class="col-lg-9">                                	
                                                    <input type="file" name="i_frente" id="i_frente" accept="image/jpeg" />	
                                                </div>                                
                                          </div>
                                          <div class="form-group">
                                            <label for="input1" class="col-lg-3 control-label">Imagen Atras</label>
                                                <div class="col-lg-9">                                	
                                                    <input type="file" name="i_atras" id="i_atras" accept="image/jpeg" />	
                                                </div>                                
                                          </div>
                                          <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-9">
                                              <button type="submit" class="btn btn-warning">Modificar</button>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <span id="errores" class="col-lg-offset-3 errores"></span>
                                          </div>
                                          <input type="hidden" value="<?=$elemento->idresidente?>" name="id">
                                        <?=form_close();?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  <button type="button" class="btn btn-success guardar-form-catalogo">Guardar</button>-->
                                </div>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div>
           		 <?php endforeach;?>                    
          <br><br>    
	<table id="example" class="table table-bordered table-striped table-condensed">
    	<thead>
        	<tr>
            	<th>#</th>
                <th>IFE</th>                
                <th>Acci&oacute;n</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($elementos as $elemento): $n++;?>
            	<tr>
                	<td><?=$n?></td>
                	<td><?=$elemento->no_ife?></td>                    
                    <td>
                    	<a href="#" class="<?=$elemento->color?> cambiar-estado-catalogo" id="<?=$elemento->idresidente?>" estado="<?=$elemento->idestado?>" ruta="res/residentes/estado">
                        	<i class="<?=$elemento->icon?> estado"></i>
                        </a>
                        <a data-toggle="modal" href="#myModal<?=$elemento->idresidente?>" class="btn btn-warning btn-xs" id="<?=$elemento->idresidente?>">
                        	<i class="fa fa-edit"></i>
                        </a>
               	
                    </td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
  </div>