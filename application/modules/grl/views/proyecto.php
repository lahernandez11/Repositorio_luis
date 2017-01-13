<div class="page-header">
          <i class="fa fa-building fa-2x"></i> <span style="font-size:18px;">PROYECTOS</span>
          <a data-toggle="modal" href="#myModal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar</a>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Agregar proyecto</h4>
                </div>
                <div class="modal-body">
                	<div class="form">
                        <?=form_open('grl/proyecto/agregar',array("class"=>"form-horizontal validar", "role"=>"form"));?>
                          <div class="form-group">
                            <label for="input1" class="col-lg-2 control-label">Proyecto</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control required" id="input1" name="input1" placeholder="Ingrese proyecto">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input2" class="col-lg-2 control-label">Clave</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control required" id="input2" name="input2" placeholder="Clave">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input3" class="col-lg-2 control-label">Direcci&oacute;n</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control" id="input3" name="input3" placeholder="Direcci&oacute;n">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button type="submit" class="btn btn-success">Agregar</button>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10 errores">
                              
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
    <div class="modal fade" id="myModal<?=$elemento->idproyecto?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Modificar proyecto</h4>
                </div>
                <div class="modal-body">
                	<div class="form">
                        <?=form_open('grl/proyecto/cambiar',array("class"=>"form-horizontal", "role"=>"form"));?>
                          <div class="form-group">
                            <label for="input1" class="col-lg-2 control-label">Proyecto</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control" id="input1" name="input1" placeholder="Ingrese proyecto" value="<?=$elemento->nombre_proyecto?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input2" class="col-lg-2 control-label">Clave</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control" id="input2" name="input2" placeholder="Ingrese clave" value="<?=$elemento->clave?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input3" class="col-lg-2 control-label">Direcci&oacute;n</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control" id="input3" name="input3" placeholder="Ingrese direcci&oacute;n" value="<?=$elemento->direccion?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button type="submit" class="btn btn-warning">Modificar</button>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10 ">
                            
                            </div>
                          </div>
                          <input type="hidden" value="<?=$elemento->idproyecto?>" name="id">
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
                <th>Proyecto</th>
                <th>Clave</th>
                <th>Direcci&oacute;n</th>
                <th>Acci&oacute;n</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($elementos as $elemento): $n++;?>
            	<tr>
                	<td><?=$n?></td>
                	<td><?=$elemento->nombre_proyecto?></td>
                    <td><?=$elemento->clave?></td>
                    <td><?=$elemento->direccion?></td>
                    <td>
                    	<a href="#" class="<?=$elemento->color?> cambiar-estado-catalogo" id="<?=$elemento->idproyecto?>" estado="<?=$elemento->idestado?>" ruta="grl/proyecto/estado">
                        	<i class="<?=$elemento->icon?> estado"></i>
                        </a>
                        <a data-toggle="modal" href="#myModal<?=$elemento->idproyecto?>" class="btn btn-warning btn-xs" id="<?=$elemento->idproyecto?>">
                        	<i class="fa fa-edit"></i>
                        </a>
                        	
                    </td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
</div>