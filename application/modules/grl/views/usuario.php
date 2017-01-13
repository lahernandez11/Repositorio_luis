<div class="page-header">
          <i class="fa fa-group fa-2x"></i> <span style="font-size:18px;">USUARIOS</span>
          <a data-toggle="modal" href="#myModal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar</a>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Agregar usuario</h4>
                </div>
                <div class="modal-body">
                	<div class="form">
                        <?=form_open('grl/usuario/agregar',array("class"=>"form-horizontal validar", "role"=>"form"));?>
                          <div class="form-group">
                            <label for="input1" class="col-lg-3 control-label">Nombre</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control required" id="input1" name="input1" placeholder="Ingrese nombre">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input2" class="col-lg-3 control-label">A. Paterno</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control required" id="input2" name="input2" placeholder="Ingrese apellido paterno">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input3" class="col-lg-3 control-label">A. Materno</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control required" id="input3" name="input3" placeholder="Ingrese apellido materno">
                            </div>
                          </div>
                           <div class="form-group">
                            <label for="input4" class="col-lg-3 control-label">Correo</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control required" id="input4" name="input4" placeholder="Ingrese correo">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input5" class="col-lg-3 control-label">Perfil</label>
                            <div class="col-lg-9">
                              <select class="form-control" name="input5">
                              	<?php foreach ($perfiles as $perfil):?>
                                	<option value="<?=$perfil->idperfil?>"><?=$perfil->nombre_perfil?></option>
                                <?php endforeach;?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input6" class="col-lg-3 control-label">Usuario</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control required" id="input6" name="input6" placeholder="Ingrese usuario">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input7" class="col-lg-3 control-label">Clave</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control required" id="input7" name="input7" placeholder="Ingrese clave">
                            </div>
                          </div>
                          <strong>Acceso a Plazas de Cobro</strong><hr>
                          <?php foreach ($plazas as $plaza):?>
                          <div class="checkbox">
                          	<label for="input7" class="col-lg-3 control-label"></label>
                            <label class="control-label">
                              <input type="checkbox" value="<?=$plaza->idplaza?>" name="checkbox[]"> <?=$plaza->nombre_plaza?> (<?=$plaza->clavep?>)
                            </label>
                          </div>
                          <?php endforeach?>
                          <br><br>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-success">Agregar</button>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9 errores">
                              
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
        <div>
    <?php foreach($elementos as $elemento):?>
    <div class="modal fade" id="myModal<?=$elemento->idusuario?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Modificar usuario</h4>
                </div>
                <div class="modal-body">
                	<div class="form">
                        <?=form_open('grl/usuario/cambiar',array("class"=>"form-horizontal", "role"=>"form"));?>
                          <div class="form-group">
                            <label for="input1" class="col-lg-3 control-label">Nombre</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="input1" name="input1" placeholder="Ingrese perfil" value="<?=$elemento->nombre?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input2" class="col-lg-3 control-label">A. Paterno</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="input2" name="input2" placeholder="Ingrese apellido paterno" value="<?=$elemento->apaterno?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input3" class="col-lg-3 control-label">A. Materno</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="input3" name="input3" placeholder="Ingrese apellido materno" value="<?=$elemento->amaterno?>">
                            </div>
                          </div>
                           <div class="form-group">
                            <label for="input4" class="col-lg-3 control-label">Correo</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="input4" name="input4" placeholder="Ingrese correo" value="<?=$elemento->correo?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input5" class="col-lg-3 control-label">Perfil</label>
                            <div class="col-lg-9">
                              <select class="form-control" name="input5">
                              	<?php foreach ($perfiles as $perfil):?>
                                	<option value="<?=$perfil->idperfil?>"
                                    <?php if($perfil->idperfil==$elemento->idperfil):echo 'selected';endif;?>
                                    ><?=$perfil->nombre_perfil?></option>
                                <?php endforeach;?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input6" class="col-lg-3 control-label">Usuario</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="input6" name="input6" placeholder="Ingrese usuario" readonly value="<?=$elemento->usuario?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input7" class="col-lg-3 control-label">Clave</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="input7" name="input7" placeholder="Ingrese clave">
                            </div>
                          </div>
                          <strong>Acceso a Plazas de Cobro</strong><hr>
                          <?php foreach ($plazas as $plaza):?>
                          <div class="checkbox" id="checkbox<?=$plaza->idplaza?>">
                          	<label for="input7" class="col-lg-3 control-label"></label>
                            <label class="control-label">
                              <input type="checkbox" value="<?=$plaza->idplaza?>" name="checkbox[]"> <?=$plaza->nombre_plaza?> (<?=$plaza->clavep?>)
                            </label>
                          </div>
                          <?php endforeach?>
                          <br><br>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-warning">Modificar</button>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9 ">
                              <!--errores-->
                            </div>
                          </div>
                      
                          <input type="hidden" value="<?=$elemento->idusuario?>" name="id">
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
	<table id="example" class="table table-bordered table-striped table-condensed">
    	<thead>
        	<tr>
            	<th>#</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Perfil</th>
                <th>Acci&oacute;n</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($elementos as $elemento): $n++;?>
            	<tr>
                	<td><?=$n?></td>
                	<td><?=$elemento->usuario?></td>
                    <td><?=$elemento->nombre?> <?=$elemento->apaterno?> <?=$elemento->amaterno?></td>
                    <td><?=$elemento->correo?></td>
                    <td><?=$elemento->nombre_perfil?></td>
                    <td>
                        <a data-toggle="modal" href="#myModal<?=$elemento->idusuario?>" class="btn btn-warning btn-xs btn-modificar-usuario" id="<?=$elemento->idusuario?>">
                        	<i class="fa fa-edit"></i>
                        </a>
                        	
                    </td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
</div>