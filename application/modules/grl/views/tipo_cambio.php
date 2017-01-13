<div class="page-header">
          <i class="fa fa-usd fa-2x"></i> <span style="font-size:18px;">TIPOS DE CAMBIO</span>
          <br><br>
          </div>
<div>
    <?=form_open('grl/tipo_cambio/agregar',array("class"=>"form-horizontal validar", "role"=>"form"));?>
                          <div class="form-group">
                            <label for="input1" class="col-lg-2 control-label">Moneda</label>
                            <div class="col-lg-3">
                              <select name="input1" class="form-control">
                              <?php foreach($elementos as $elemento):?>
                              	<option value="<?=$elemento->idmoneda?>"><?=$elemento->moneda?></option>
                              <?php endforeach;?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
            	<label for="input2" class="col-lg-2 control-label">Fecha</label>
            	<div class="col-lg-3">
                    <div id="datetimepicker4" class="input-append input-group">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="input2">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
            	</div>
          	</div>
                          <div class="form-group">
                            <label for="input3" class="col-lg-2 control-label">Tipo de Cambio</label>
                            <div class="col-lg-3">
                              <input type="text" class="form-control required" id="input3" name="input3" placeholder="Ingrese tipo de cambio">
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