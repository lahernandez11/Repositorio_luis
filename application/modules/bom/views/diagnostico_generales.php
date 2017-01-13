<div class="page-header">
	<h4>
    <img src="<?=base_url('assets/img/1383194873_services.png')?>"><a class="bom-menu" href="<?=base_url('bom/home/index')?>"> BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTTO. / </a><a class="bom-menu" href="<?=base_url('bom/diagnostico/index')?>">REGISTRO DE DIAGN&Oacute;STICOS</a></h4>
</div>
<?=form_open('bom/diagnostico/registrar',array('class'=>'form-horizontal','role'=>'form','id'=>'diagnostico_registrar'));?>
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
            <br><br>
            <h5><strong>DIAGN&Oacute;STICO</strong></h5>
            Por favor, registre el diagn&oacute;stico
            <br><br>
            <div class="form-group">
            	<div class="col-sm-12">
                    <textarea placeholder="Digite el diagn&oacute;stico" class="form-control" style="height:100px" name="registro-diagnostico"></textarea>
            	</div>
          	</div>
        </div>
    </div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
    	<div class="square" style="min-height:300px;">
        <h5><strong>DIAGN&Oacute;STICO</strong></h5>
            <div class="form-group">
            	<div class="col-sm-12" id="reparar">
                	&iquest;Se requiere reparar equipo?
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="2" name="reparar">&nbsp;No
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" value="1" name="reparar">&nbsp;S&iacute;
            	</div>
                <div class="col-sm-12" id="tabla_reparar"></div>
          	</div>
            <div class="form-group" id="contenedor-reemplazar">
            	<div class="col-sm-12" id="reemplazar" style="display:none;">
                    &iquest;Se requiere reemplazar equipo?
                    &nbsp;&nbsp;
                    <input type="radio" value="2" name="reemplazar">&nbsp;No
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" value="1" name="reemplazar">&nbsp;S&iacute;
            	</div>
                <div class="col-sm-12" id="tabla_reemplazar"></div>
          	</div>
        </div>
    </div>
</div>
<br>
<div class="row" align="center">
	<div class="col-md-12">
        <a href="<?=base_url('bom/diagnostico/index')?>" class="btn btn-warning">Cancelar</a>
        <input type="hidden" value="0" name="n_reparar" id="n_reparar">
		<input type="hidden" value="0" name="n_reemplazar" id="n_reemplazar">
        <input type="hidden" value="<?=$idreporte?>" name="idreporte" id="idreporte">
        <input type="hidden" value="<?=$result[0]["idtiporeporte"]?>" name="idtipo">
        <input type="hidden" value="<?=$result[0]["idclasificacion"]?>" name="idclasificacion">
        <input type="submit" value="Registrar" class="btn btn-success">
    </div>
</div>
<?=form_close()?>