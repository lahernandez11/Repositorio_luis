<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383194266_online_support.png')?>"> <a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a><a class="bom-menu" href="<?=base_url('bom/asignacion/index')?>">ASIGNACI&Oacute;N DE T&Eacute;CNICO A REPORTE </a></h4>
</div>
<?=form_open('bom/asignacion/asignar',array('class'=>'form-horizontal','role'=>'form','id'=>'asignacion'));?>
<div class="row">
	<div class="col-md-6">
    	<div class="square">
    		<h5><strong>GENERALES DEL REPORTE</strong></h5>
            <div class="col-md-12">
            	<div class="pull-right">
					<?=$result[0]["folio"]?>
                	<br>
                	<span class="label label-<?=$result[0]["color"]?>"><?=$result[0]["nombre_clasificacion"]?></span>
            	</div>	
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <strong>
                        Plaza de Cobro<br>
                        Nombre de quien reporta<br>
                        Puesto<br>
                    </strong>
                </div>
                <div class="col-md-7">
                    <?=$result[0]["nombre_plaza"]?><br>
                    <?=$result[0]["nombre_reporta"]?><br>
                    <?=$result[0]["puesto_reporta"]?>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <strong>
                        Tipo de Reporte<br>
                        Fecha Detecci&oacute;n Falla<br>
                        Hora Detecci&oacute;n Falla<br>
                    </strong>
                </div>
                <div class="col-md-7">
                    <?=$result[0]["nombre_tiporeporte"]?><br>
                    <?=$result[0]["fecha"]?><br>
                    <?=$result[0]["hora"]?>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12"><hr></div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <strong>
                        &Aacute;rea de Afectaci&oacute;n<br>
                        Tipo de Falla<br>
                        Observaciones<br>
                    </strong>
                </div>
                <div class="col-md-7">
                    <?=$result[0]["nombre_area"]?>
                    <?php if($result[0]["nombre_area"]=="CARRIL"):?>
                    <strong style="margin-left:70px;">Ubicaci&oacute;n </strong><?=$result[0]["nombre_carril"]?>
					<?php endif;?>
                    <br>
                    <?=$result[0]["nombre_tipofalla"]?><br>
                    <?=$result[0]["observacion_reporte"]?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    	<div class="square">
    		<h5><strong>DATOS DEL T&Eacute;CNICO</strong></h5>
            <br><br>
            <div class="form-group">
            	<label for="registro-fecha" class="col-sm-4 control-label">Fecha de Asignaci&oacute;n:</label>
            	<div class="col-sm-8">
                    <div id="datetimepicker4" class="input-append input-group">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="registro-fecha">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <!--<span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>-->
                    </div>
            	</div>
          	</div>
            <div class="form-group">
            	<label for="registro-hora" class="col-sm-4 control-label">Hora de Asignaci&oacute;n:</label>
            	<div class="col-sm-8">
                    <div id="datetimepicker5" class="input-append input-group">
                        <input data-format="hh:mm:ss" value="<?=date('H:i:s');?>" type="text" class="form-control required" readonly name="registro-hora">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <!--<span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar">
                          </i>
                          </span>-->
                    </div>
            	</div>
          	</div>
             <div class="form-group">
            <label for="registro-tecnico" class="col-sm-4 control-label">Nombre del T&eacute;cnico</label>
            <div class="col-sm-8">
              <select name="registro-tecnico" id="registro-tecnico" class="form-control required">
              	<option value="0">- SELECCIONE -</option>
				<?php foreach ($usuarios as $usuario):?>
                	<option value="<?=$usuario->idusuario?>"><?=$usuario->nombre?> <?=$usuario->apaterno?> <?=$usuario->amaterno?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
        </div>
    </div>
</div>
<br>
<div class="row" align="center">
	<div class="col-md-12">
        <a href="<?=base_url('bom/asignacion/index')?>" class="btn btn-warning">Cancelar</a>
        <input type="hidden" value="<?=$idreporte?>" name="idreporte">
        <input type="hidden" value="<?=$result[0]["idtiporeporte"]?>" name="idtipo">
        <input type="hidden" value="<?=$result[0]["idclasificacion"]?>" name="idclasificacion">
        <input type="submit" value="Registrar" class="btn btn-success">
    </div>
</div>
<?=form_close()?>