<div class="page-header">
          <i class="fa fa-money fa-2x"></i> <span style="font-size:18px;">MONEDAS</span>
          <a data-toggle="modal" href="#myModal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar</a>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Agregar moneda</h4>
                </div>
                <div class="modal-body">
                	<div class="form">
                        <?=form_open('grl/moneda/agregar',array("class"=>"form-horizontal validar", "role"=>"form"));?>
                          <div class="form-group">
                            <label for="input1" class="col-lg-2 control-label">Moneda</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control required" id="input1" name="input1" placeholder="Ingrese moneda">
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
    <?php foreach ($elementos as $elemento):?>
    <div class="modal fade" id="myModal<?=$elemento->idmoneda?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Modificar moneda</h4>
                </div>
                <div class="modal-body">
                	<div class="form">
                        <?=form_open('grl/moneda/cambiar',array("class"=>"form-horizontal", "role"=>"form"));?>
                          <div class="form-group">
                            <label for="input1" class="col-lg-3 control-label">Moneda</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="input1" name="input1" placeholder="Ingrese moneda" value="<?=$elemento->moneda?>">
                            </div>
                          </div>
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
                          <input type="hidden" value="<?=$elemento->idmoneda?>" name="id">
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
                <th>Moneda</th>
                <th>Acci&oacute;n</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($elementos as $elemento): $n++;?>
            	<tr>
                	<td><?=$n?></td>
                	<td><?=$elemento->moneda?></td>
                    <td>
                    	<a class="<?=$elemento->color?> cambiar-estado-catalogo" id="<?=$elemento->idmoneda?>" estado="<?=$elemento->idestado?>" ruta="grl/moneda/estado">
                        	<i class="<?=$elemento->icon?> estado"></i>
                        </a>
                        <a data-toggle="modal" href="#myModal<?=$elemento->idmoneda?>" class="btn btn-warning btn-xs" id="<?=$elemento->idmoneda?>">
                        	<i class="fa fa-edit"></i>
                        </a>
               	
                    </td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
</div>