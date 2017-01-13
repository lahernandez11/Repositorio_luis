<div class="page-header">
	<h4><a href="<?=base_url('bom/home/index')?>">
    <img src="<?=base_url('assets/img/1383255394_edit_property.png')?>"> <a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a>REGISTRO DE REPORTES
    <div class="btn-group pull-right" style="margin-left:5px;">
  		<a class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-question-circle"></i></a>
  		<ul class="dropdown-menu ayuda">
    		<li><a href="<?=base_url('downloads/bom/v20140408_opi-registrar-reporte.pdf')?>" download><i class="fa fa-file"></i> Registrar Reporte</a></li>
  		</ul>
	</div>
    </h4>
</div>
<?=form_open('bom/registro/registrar',array('class'=>'form-horizontal','role'=>'form','id'=>'registro'));?>
<div class="row">
	<div class="col-md-6">
    	<div class="square">
        	<h5><strong>DATOS DE LA PLAZA DE COBRO</strong></h5>
            <br>
            Por favor, seleccione los datos para poder hac&eacute;r el reporte de atenci&oacute;n:
            <br><br>
    		
          <div class="form-group">
            <label for="registro-plaza" class="col-sm-4 control-label">Plaza:</label>
            <div class="col-sm-8">
              <select name="registro-plaza" id="registro-plaza" class="form-control required">
              	<option value="0">- SELECCIONE -</option>
				<?php foreach($plazas as $plaza):?>
                    <option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="registro-area" class="col-sm-4 control-label">&Aacute;rea de Afectaci&oacute;n:</label>
            <div class="col-sm-8">
              <select name="registro-area" id="registro-area" class="form-control required">
              	<option value="0">- SELECCIONE -</option>
				<?php foreach($areas as $area):?>
                    <option value="<?=$area->idareaafectacion?>"><?=$area->nombre_area?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="registro-carril" class="col-sm-4 control-label">Ubicaci&oacute;n:</label>
            <div class="col-sm-8" id="registro-carril">
              <select name="registro-carril" id="registro-carril" class="form-control" disabled>
              	<option value="0">--</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="registro-reporta" class="col-sm-4 control-label">Reporta:</label>
            <div class="col-sm-8">
              <input type="text" name="registro-reporta" id="registro-reporta" class="form-control" value="<?=$usuario?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="registro-puesto" class="col-sm-4 control-label">Puesto:</label>
            <div class="col-sm-8">
              <?php foreach($perfiles as $perfil):?>
              	<input type="text" name="registro-puesto" id="registro-puesto" class="form-control" value="<?=$perfil->nombre_perfil?>" readonly>
              <?php endforeach;?>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6">
    	<div class="square">
        <h5><strong>DATOS DEL REPORTE</strong></h5>
        	<!--<div style="height:20px;"></div>-->
            <br>
            <div class="form-group">
            	<label for="registro-tipo" class="col-sm-4 control-label">Tipo de Reporte:</label>
            	<div class="col-sm-8">
                    <input type="radio" value="2" name="registro-tipo" checked>&nbsp;Falla en Equipo
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" value="1" name="registro-tipo">&nbsp;Solicitud de Mantenimiento
            	</div>
          	</div>
            <div class="form-group">
            	<label for="registro-fecha" class="col-sm-6 control-label">Fecha en que se detecta la falla:</label>
            	<div class="col-sm-6">
                    <div id="datetimepicker4" class="input-append input-group">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="registro-fecha">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                        <!--<span class="add-on">
                          <i data-time-icon="fa fa-user" data-date-icon="fa fa-user">
                          </i>
                        </span>-->
                    </div>
            	</div>
          	</div>
            <div class="form-group">
            	<label for="registro-hora" class="col-sm-6 control-label">Hora en que se detecta la falla:</label>
            	<div class="col-sm-6">
                    <div id="datetimepicker5" class="input-append input-group">
                        <input data-format="hh:mm:ss" value="<?=date('H:i:s');?>" type="text" class="form-control required" readonly name="registro-hora">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                        <!--<span class="add-on">
                          <i data-time-icon="fa fa-user" data-date-icon="fa fa-user">
                          </i>
                        </span>-->
                    </div>
            	</div>
          	</div>
           <div class="form-group">
            <label for="registro-falla" class="col-sm-4 control-label">Tipo de Falla:</label>
            <div class="col-sm-8" id="registro-falla">
              <select name="registro-falla" id="registro-falla" class="form-control required">
              	<option value="0">--</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="registro-observaciones" class="col-sm-4 control-label">Observaciones:</label>
            <div class="col-sm-8" id="registro-observaciones">
              <textarea name="registro-observaciones" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="registro-clasificacion" class="col-sm-4 control-label">Clasificaci&oacute;n:</label>
            <div class="col-sm-8" id="registro-clasificacion">
            	<select name="registro-clasificacion" id="registro-clasificacion" class="form-control required">
                	<option value="0">- SELECCIONE -</option>                   
              	</select>              
            </div>
          </div>
        </div>
    </div>
</div>
<br>
<div class="row" align="center">
	<div class="col-md-12">
    	<a href="<?=base_url('bom/home/index')?>" class="btn btn-warning">Cancelar</a>
        <input type="submit" value="Registrar" class="btn btn-success">
    </div>
</div>
<?=form_close();?>