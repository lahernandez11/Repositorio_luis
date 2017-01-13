<div class="page-header">
          <i class="fa fa-barcode fa-2x"></i> <span style="font-size:18px;">BOBINAS</span>
          <a data-toggle="modal" href="#myModal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar</a>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Agregar bobina</h4>
                </div>
                <div class="modal-body">
                	<div class="form">
                        <?=form_open('cai/bobina/agregar',array("class"=>"form-horizontal validar", "role"=>"form"));?>
                          <div class="form-group">
                            <label for="input1" class="col-lg-2 control-label">Inicial</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control required" id="input1" name="input1" placeholder="Inicial">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input2" class="col-lg-2 control-label">Final</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control required" id="input2" name="input2" placeholder="Final">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input3" class="col-lg-2 control-label">Serie</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control required" id="input3" name="input3" placeholder="Final">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input4" class="col-lg-2 control-label">Plaza</label>
                            <div class="col-lg-10">
                              <select name="input4" class="form-control">
                              	<?php foreach ($plazas as $plaza):?>
								<option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
                                <?php endforeach;?>
                              </select>
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
	<table id="example" class="table table-bordered table-striped table-condensed">
    	<thead>
        	<tr>
            	<th>#</th>
                <th>Proyecto</th>
                <th>Plaza</th>
                <th>Inicial</th>
                <th>Final</th>
                <th>Serie</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($elementos as $elemento): $n++;?>
            	<tr class="<?=$elemento->color?>">
                	<td><?=$n?></td>
                	<td><?=$elemento->nombre_proyecto?></td>
                    <td><?=$elemento->nombre_plaza?></td>
                    <td><?=$elemento->inicial?></td>
                    <td><?=$elemento->final?></td>
                    <td><?=$elemento->clave?></td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
</div>