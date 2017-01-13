<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383246894_solutions.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. /</a><a class="bom-menu" href="<?=base_url('bom/solucion/index')?>">REGISTRO DE SOLUCI&Oacute;N</a></h4>
</div>
<?=form_open('bom/solucion/registrar',array('class'=>'form-horizontal','role'=>'form','id'=>'solucion_registrar'));?>
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
            <br>
            <!--<h5><strong>DATOS DEL T&Eacute;CNICO</strong></h5>
            <div class="row">
                <div class="col-md-5">
                    <strong>
                        Fecha de Asignaci&oacute;n<br>
                        Hora de Asignaci&oacute;n<br>
                        T&eacute;cnico<br>
                    </strong>
                </div>
                <div class="col-md-7">
                    <?=$result[0]["fecha_asignacion"]?><br>
                    <?=$result[0]["hora_asignacion"]?><br>
                    <?=$result[0]["tecnico"]?>
                </div>
            </div>
            <br>
            <h5><strong>DIAGN&Oacute;STICO</strong></h5>
            <div class="row">
                <div class="col-md-12">
                    <?=$result[0]["diagnostico"]?><br>
                </div>
            </div>
            <br>-->
        </div>
    </div>
    <div class="col-md-6">
    	<div class="square">
        	<br><br>
        	<h5><strong>DATOS DEL T&Eacute;CNICO</strong></h5>
            <div class="row">
                <div class="col-md-5">
                    <strong>
                        Fecha de Asignaci&oacute;n<br>
                        Hora de Asignaci&oacute;n<br>
                        T&eacute;cnico<br>
                    </strong>
                </div>
                <div class="col-md-7">
                    <?=$result[0]["fecha_asignacion"]?><br>
                    <?=$result[0]["hora_asignacion"]?><br>
                    <?=$result[0]["tecnico"]?>
                </div>
            </div>
            <br>
            <h5><strong>DIAGN&Oacute;STICO</strong></h5>
            <div class="row">
                <div class="col-md-12">
                    <?=$result[0]["diagnostico"]?><br>
                </div>
            </div>
            <br>
            <!--<h5><strong>SOLUCI&Oacute;N</strong></h5>
            Capture las actividades de la soluci&oacute;n
            <br><br>
            <div class="form-group">
            	<div class="col-sm-12">
                    <textarea placeholder="Actividades de la soluci&oacute;n" class="form-control" style="height:100px" name="registro-solucion"></textarea>
            	</div>
          	</div>
            <div class="form-group">
            	<div class="col-sm-12" id="reparar">
                    ¿Se requiere reportar equipo?
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="1" name="reparar">&nbsp;No
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" value="2" name="reparar">&nbsp;S&iacute;
            	</div>
                <div class="col-sm-12" id="tabla_reparar"></div>
          	</div>
            <div class="form-group">
            	<div class="col-sm-12" id="reemplazar" style="display:none;">
                    ¿Se requiere reemplazar equipo?
                    &nbsp;&nbsp;
                    <input type="radio" value="1" name="reemplazar">&nbsp;No
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" value="2" name="reemplazar">&nbsp;S&iacute;
            	</div>
                <div class="col-sm-12" id="tabla_reemplazar"></div>
          	</div>-->
        </div>
    </div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
    	<div class="square" style="min-height:300px;">
        <h5><strong>SOLUCI&Oacute;N</strong></h5>
            Capture las actividades de la soluci&oacute;n
            <br><br>
            <div class="form-group">
            	<div class="col-sm-12">
                    <textarea placeholder="Actividades de la soluci&oacute;n" class="form-control required" style="height:100px" name="registro-solucion"></textarea>
            	</div>
          	</div>
            <div class="form-group">
            	<div class="col-sm-12" id="reparar">
                	&iquest;Se requiere reparar equipo?
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="2" name="reparar">&nbsp;No
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" value="1" name="reparar" <?php if($result[0]["reparar"]==1): echo 'checked activo="1"'; endif;?> id="r_reparar" reporte="<?=$result[0]["idreporte"]?>">&nbsp;S&iacute;
            	</div>
                <div class="col-sm-12" id="tabla_reparar"></div>
          	</div>
            <div class="form-group">
            	<div class="col-sm-12" id="reemplazar" <?php if(!$result[0]["reemplazo"]==1):?> style="display:none;" <?php endif;?>>
                    &iquest;Se requiere reemplazar equipo?
                    &nbsp;&nbsp;
                    <input type="radio" value="2" name="reemplazar">&nbsp;No
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" value="1" name="reemplazar" <?php if($result[0]["reemplazo"]==1): echo 'checked activo="1"'; endif;?> id="r_reemplazar" reporte="<?=$result[0]["idreporte"]?>">&nbsp;S&iacute;
            	</div>
                <div class="col-sm-12" id="tabla_reemplazar"></div>
          	</div>
        </div>
    </div>
</div>
<br>
<?php if($result[0]["reparar"]<>1):?>
<input type="hidden" value="0" name="n_reparar" id="n_reparar">
<?php endif;?>
<?php if($result[0]["reemplazo"]<>1):?>
<input type="hidden" value="0" name="n_reemplazar" id="n_reemplazar">
<?php endif;?>
<input type="hidden" value="<?=$idreporte?>" name="idreporte">
<input type="hidden" value="<?=$result[0]["idtiporeporte"]?>" name="idtipo">
<input type="hidden" value="<?=$result[0]["idclasificacion"]?>" name="idclasificacion">
<div class="row" align="center">
	<div class="col-md-12" id="botones" style="display:none;">
        <a href="<?=base_url('bom/solucion/index')?>" class="btn btn-warning">Cancelar</a>
        <input type="submit" value="Registrar" class="btn btn-success">
    </div>
</div>
<?=form_close()?>
<br>