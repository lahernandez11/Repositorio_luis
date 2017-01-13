<div class="page-header">
	<h4><a href="<?=base_url('res/residentes/index')?>">
    <i class="fa fa-user bom-menu fa-2x"></i> </a>CONSULTA RESIDENTES</h4>
    <a data-toggle="modal" href="#myModal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar</a>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Agregar Residente</h4>
                </div>
                <div class="modal-body">
                	<div class="form">
                        <?=form_open('res/residentes/agregar',array("id" => "alta","enctype" => "multipart/form-data", "class"=>"form-horizontal validar", "role"=>"form"));?>                 
                          <div class="form-group">
                            <label for="input1" class="col-lg-3 control-label">Nombre</label>
                            	<div class="col-lg-9">
                                	<input type="text" class="form-control required" id="input1" name="input1" placeholder="Ingrese Nombre" >
                                </div>
                          </div>
                          <div class="form-group">
                          	<label for="input1" class="col-lg-3 control-label">Apellido Paterno</label>
                            	<div class="col-lg-9">
                                	<input type="text" class="form-control required" id="input2" name="input2" placeholder="Ingrese Apellido Paterno" >
                                </div>
                          </div>
                          <div class="form-group">
                          	<label for="input1" class="col-lg-3 control-label">Apellido Materno</label>
                            	<div class="col-lg-9">
                                	<input type="text" class="form-control required" id="input3" name="input3" placeholder="Ingrese Apellido Materno" >
                                </div>
                          </div>
                          <div class="form-group">
                          	<label for="input1" class="col-lg-3 control-label">No. IFE</label>
                            	<div class="col-lg-9">
                                	<input type="text" class="form-control required" id="input4" name="input4" placeholder="Ingrese IFE" >
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
                            <div class="col-lg-offset-2 col-lg-10">
                              <button type="submit" class="btn btn-success">Agregar</button>
                            </div>
                          </div>
                          <div class="form-group">
                          	<div id="error_imagen" class="col-lg-offset-3 errores">                                              
                            </div>
                          </div>
                        <?=form_close();?>
                	</div>
                </div>
                <div class="modal-footer">
                  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-success guardar-form-catalogo">Guardar</button>-->
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <br><br>
</div>

    <input id="buscador_residente" name="buscador_residente" placeholder="Ingrese Nombre de Residente"  class="form-control"/>
	<br/>
    <div id="residentes"></div>
</div>	

