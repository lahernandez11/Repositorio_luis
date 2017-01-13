<!--<script>$('#datepicker').datepicker();</script>-->
<script>
	$(".moneda_1").hide();
	$(".moneda_2").hide();
	<?php foreach($monedas as $moneda):?>
	$(".moneda_<?=$moneda->idmoneda?>").show();	
	<?php endforeach;?>
</script>
<br>
<div class="encabezado_caratula well">
<h5><strong>DATOS GENERALES</strong></h5>
<form id="generales">
<input type="hidden" name="idcaseta" id="idcaseta" value="<?=$caseta?>"/>
<table class="caratula">
	<tr>
    <td>SENTIDO</td>
        <td>
        	<select name="sentido" id="sentido" style="width:180px;" class="form-control">
        		<?php foreach ($sentidos as $sentido):?>
                	<option value="<?=$sentido->idsentido?>"><?=$sentido->nombre_sentido?></option>
                <?php endforeach;?>
    		</select>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>LINEA</td>
        <td>
        	<select name="linea" id="linea" style="width:180px;" class="form-control">
        		<?php foreach ($lineas as $linea):?>
                	<option value="<?=$linea->idcarril?>"><?=$linea->nombre_carril?></option>
                <?php endforeach;?>
    		</select>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>CUERPO</td>
        <td>
        	<select name="cuerpo" id="cuerpo" style="width:180px;" class="form-control">
        		<?php foreach ($cuerpos as $cuerpo):?>
                	<option value="<?=$cuerpo->idcuerpo?>"><?=$cuerpo->nombre_cuerpo?></option>
                <?php endforeach;?>
    		</select>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <!--<td>FECHA</td>
        <td>
        <div id="datepicker" class="input-append date calendario" data-date-format="yyyy-mm-dd" data-date="<?=date('Y-m-d')?>">
<input type="text" style="width:80px;" readonly="" value="<?=date('Y-m-d')?>" name="fecha">
<span class="add-on">
<i class="icon-th"></i>
</span>
</div>
        </td>-->
        <tr>
		</tr>
        <td>TURNO</td>
        <td>
        <select name="turno" id="turno" style="width:180px;" class="form-control">
        	<option value="1">- 1 -</option>
        	<option value="2">- 2 -</option>
        	<option value="3">- 3 -</option>
    	</select>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    	<td>JEFE DE TURNO</td>
        <td>
        <select name="jefe" id="jefe" style="width:180px;" class="form-control">
            <option value="0">- SELECCIONE -</option>
            <?php foreach ($jefes as $jefe):?>
            <option value="<?=$jefe->idusuario?>"><?=$jefe->nombre?> <?=$jefe->apaterno?> <?=$jefe->amaterno?></option>
            <?php endforeach;?>
        </select>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>COBRADOR</td>
        <td>
        	<select name="cobrador" id="cobrador" style="width:180px;" class="form-control">
                <option value="0">- SELECCIONE -</option>
                <?php foreach ($cobradores as $cobrador):?>
                <option value="<?=$cobrador->idusuario?>"><?=$cobrador->nombre?> <?=$cobrador->apaterno?> <?=$cobrador->amaterno?></option>
                <?php endforeach;?>
            </select>
        </td>
    </tr>
</table>
</form>
</div>
<div id="caratula" class="encabezado_caratula pull-left well">
    <form id="corte">
    <!--<input type="hidden" name="caseta" id="caseta" value="<?=$caseta?>" />-->
    <?=$caratula?>
    </form>
</div>
<div id="totales" class="pull-left well" style="margin-left:20px;">
<h5><strong>TOTALES</strong></h5>
<form id="totales">
<!--<input type="hidden" name="caseta" id="caseta" value="<?=$caseta?>" />-->
  <table class="caratula strong">
  <!--<tr><td class="strong">RETIRO PARCIALES</td><td><input type="text" name="retiros_parciales" id="retiros_parciales" value="0"></td></tr>
  <tr><td class="strong">ULTIMO RETIRO</td><td><input type="text" name="ultimo_retiro" id="ultimo_retiro" value="0"></td></tr>
  <tr><td class="strong">TARJETA VAS 2.0</td><td><input id="total_tvas2" name="total_tvas2" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">FALTANTE PAGADO</td><td><input id="faltante" name="faltante" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">TOTAL EFECTIVO</td><td><input id="subtotal" name="subtotal" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">INGRESO SD</td><td><input id="efectivo" name="efectivo" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">SOBRANTE</td><td><input id="sobrante" name="sobrante" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">&nbsp;</td></tr>
  <tr><td class="strong">TOTAL INGRESOS</td><td><input id="total_ingresos" name="total_ingresos" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">TOTAL DEPOSITADO</td><td><input id="total_depositado" name="total_depositado" type="text" readonly value="0"></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td class="strong">TARJETAS VAS</td><td><input id="total_tvas" name="total_tvas" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">TELEPEAJE</td><td><input id="total_telepeaje" name="total_telepeaje" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">EXENTOS</td><td><input id="total_exentos" name="total_exentos" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">RESIDENTES</td><td><input id="total_residentes" name="total_residentes" type="text" readonly value="0"></td></tr>
  <tr><td class="strong">SUBTOTAL</td><td><input id="suma_subtotal" name="suma_subtotal" type="text" readonly value="0"></td></tr>-->
  <tr>
  	<td colspan="2" class="moneda_1"><h6>MONEDA NACIONAL</h6></td>
    <td class="moneda_1">&nbsp;</td>
    <td colspan="2" class="moneda_2"><h6>MONEDA EXTRANJERA</h6></td>
  </tr>
  <tr>
  	<td class="moneda_1">RETIROS PARCIALES</td><td class="moneda_1"><input id="retiros_parciales_1" name="retiros_parciales_1" type="text" value="0" class="form-control input-sm strong digitar numeric" tabindex="500"></td>
    <td class="moneda_1">&nbsp;</td>
    <td class="moneda_2">RETIROS PARCIALES</td><td class="moneda_2"><input id="retiros_parciales_2" name="retiros_parciales_2" type="text" value="0" class="form-control input-sm strong digitar numeric" tabindex="502"></td>
  </tr>
  <tr>
  	<td class="moneda_1">ULTIMO RETIRO</td><td class="moneda_1"><input id="ultimo_retiro_1" name="ultimo_retiro_1" type="text" class="form-control input-sm strong digitar numeric" value="0"  tabindex="501"></td>
    <td class="moneda_1">&nbsp;</td>
    <td class="moneda_2">ULTIMO RETIRO</td><td class="moneda_2"><input id="ultimo_retiro_2" name="ultimo_retiro_2" type="text" class="form-control input-sm strong digitar numeric" value="0" tabindex="503"></td>
  </tr>
  <tr>
  	<td class="moneda_1">TARJETAS VAS 2.0</td><td class="moneda_1"><input id="tarjetas_vas_2" name="tarjetas_vas_2" type="text"  readonly value="0" class="form-control input-sm strong"></td>
  </tr>
  <tr>
  	<td class="moneda_1">FALTANTE PAGADO</td><td class="moneda_1"><input id="faltante_pagado_1" name="faltante_pagado_1" type="text" readonly value="0" class="form-control input-sm strong"></td>
    <td class="moneda_1">&nbsp;</td>
    <td class="moneda_2">FALTANTE PAGADO</td><td class="moneda_2"><input id="faltante_pagado_2" name="faltante_pagado_2" type="text" readonly value="0" class="form-control input-sm strong"></td>  
  </tr>
  <tr>
  	<td class="moneda_1">TOTAL EFECTIVO</td><td class="moneda_1"><input id="total_efectivo_1" name="total_efectivo_1" type="text" readonly value="0" class="form-control input-sm strong"></td>
    <td class="moneda_1">&nbsp;</td>
    <td class="moneda_2">TOTAL EFECTIVO</td><td class="moneda_2"><input id="total_efectivo_2" name="total_efectivo_2" type="text" readonly value="0" class="form-control input-sm strong"></td>
  </tr>
  <tr>
  	<td class="moneda_1">SOBRANTE</td><td class="moneda_1"><input id="sobrante_1" name="sobrante_1" type="text" class="form-control input-sm strong" readonly value="0"></td>
    <td class="moneda_1">&nbsp;</td>
    <td class="moneda_2">SOBRANTE</td><td class="moneda_2"><input id="sobrante_2" name="sobrante_2" type="text" class="form-control input-sm strong" readonly value="0"></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
  	<td class="moneda_1">INGRESO SD</td><td class="moneda_1"><input id="ingreso_sd_1" name="ingreso_sd_1" type="text" class="form-control input-sm strong" readonly value="0"></td>
    <td class="moneda_1">&nbsp;</td>
  	<td class="moneda_2">INGRESO SD</td><td class="moneda_2"><input id="ingreso_sd_2" name="ingreso_sd_2" type="text" class="form-control input-sm strong" readonly value="0"></td>
  </tr>
  <tr>
  	<td class="moneda_1">TOTAL INGRESOS</td><td class="moneda_1"><input id="total_ingresos" name="total_ingresos" type="text" class="form-control input-sm strong" readonly value="0"></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
  	<td class="moneda_1">TOTAL DEPOSITADO</td><td class="moneda_1"><input id="total_depositado" name="total_depositado" type="text" readonly value="0" class="form-control input-sm strong"></td>
    <td class="moneda_1">&nbsp;</td>
    <td class="moneda_2">TOTAL A DEPOSITAR</td><td class="moneda_2"><input id="total_a_depositar" name="total_a_depositar" type="text" readonly value="0" class="form-control input-sm strong"></td>
  </tr>
  <tr class="moneda_1"><td colspan="2"><h6>MEDIOS ELECTRONICOS</h6></td></tr>
  <tr class="moneda_1"><td>TARJETAS VAS 1.0</td><td><input id="tarjetas_vas" name="tarjetas_vas" type="text" readonly class="form-control input-sm strong" value="0"></td></tr>
  <tr class="moneda_1"><td>TELEPEAJE</td><td><input id="telepeaje" name="telepeaje" type="text" readonly class="form-control input-sm strong" value="0"></td></tr>
  <tr class="moneda_1"><td>RESIDENTES</td><td><input id="residentes" name="residentes" type="text" readonly class="form-control input-sm strong" value="0"></td></tr>
  <tr class="moneda_1"><td>SUBTOTAL</td><td><input id="subtotal" name="subtotal" type="text" readonly class="form-control input-sm strong" value="0"></td></tr>
  <tr class="moneda_1"><td colspan="2"><h6>EXENTOS DE PAGO</h6></td></tr>
  <tr class="moneda_1"><td>EXENTOS</td><td><input id="exentos" name="exentos" type="text" readonly class="form-control input-sm strong" value="0"></td></tr>
  <tr class="moneda_1"><td>ELUDIDOS</td><td><input id="eludidos" name="eludidos" type="text" readonly class="form-control input-sm strong" value="0"></td></tr>
  <tr><td colspan="2"><h6>FOLIOS</h6></td></tr>
  <tr>
  	<td>UTILIZADOS</td>
    <td><input id="total_folios_utilizados" name="total_folios_utilizados" type="text" readonly class="form-control input-sm strong" value="0"></td>
  </tr>
  <tr>
  	<td>CANCELADOS</td>
    <td><input id="total_folios_cancelados" name="total_folios_cancelados" type="text" readonly class="form-control input-sm strong" value="0"></td>
  </tr>
  <tr>
  	<td>NO EMITIDOS</td>
    <td><input id="total_folios_noemitidos" name="total_folios_noemitidos" type="text" readonly class="form-control input-sm strong" value="0"></td>
  </tr>
  <tr>
  	<td>TOTAL</td>
    <td><input type="text" id="total_folios" name="total_folios" readonly value="0" class="form-control input-sm strong"></td>
  </tr>
  <tr>
  	<td>DIFERENCIA</td>
    <td><input id="diferencia_folios" name="diferencia_folios" type="text" readonly value="0" class="form-control input-sm strong"></td>
  </tr>
  
  </table>
</form>
  </div>
<div class="clearfix"></div>
<div class="well">
<h5><strong>FOLIOS</strong></h5>
<form id="folios">
<!--<input type="hidden" name="caseta" id="caseta" value="<?=$caseta?>" />-->
<div class="row encabezado_caratula">
	<div class="col-md-4" id="utilizados">UTILIZADOS<br /><br />
        <div class="contenedor_folios_utilizados1">
        	INICIAL<input type="text" class="input_folio_utilizado enter_folio_utilizado form-control" id="inicial1" name="inicial1"/>&nbsp;&nbsp;&nbsp;FINAL<input type="text"  class="form-control input_folio_utilizado  enter_folio_utilizado" id="final1" name="final1" />&nbsp;&nbsp;&nbsp;SERIE<select class="serie_folio_utilizado  enter_folio_utilizado form-control" name="serie1" id="serie1">
            <?php foreach ($series as $serie):?>
            	<option value="<?=$serie->clave?>"><?=$serie->clave?></option>
			<?php endforeach;?>
            </select>
        	<input id="aceptar_utilizado1" contador="1" type="button" class="btn btn-success btn-sm boton_agregar_utilizados btn-utilizados  enter_folio_utilizado" value="Agregar"/>
        </div>
    </div>
    <div class="col-md-3" id="cancelados">CANCELADOS<br /><br />
    	<div class="contenedor_folios_cancelados1">
    		FOLIO<input type="text" class="form-control input_folio_cancelado enter_folio_cancelado" id="cancelado1" name="cancelado1" />&nbsp;&nbsp;&nbsp;SERIE<select class="serie_folio_cancelado enter_folio_cancelado form-control" name="serie_cancelado1" id="serie_cancelado1">
            <?php foreach ($series as $serie):?>
            	<option value="<?=$serie->clave?>"><?=$serie->clave?></option>
			<?php endforeach;?>
            </select>&nbsp;<input id="aceptar_cancelado1" contador="1" type="button" class="btn btn-success btn-sm boton_agregar_cancelados btn-cancelados enter_folio_cancelado" value="Agregar"/>
    	</div>
    </div>
    <div class="col-md-2" id="no_emitidos">NO EMITIDOS<br /><br />
    <div class="contenedor_folios_noemitidos1">
    		FOLIO<input type="text" class="form-control input_folio_noemitido enter_folio_noemitido" id="noemitido1" name="noemitido1" />
            <!--SERIE<select class="serie_folio_noemitido" name="serie_noemitido1" id="serie_noemitido1">
            <?php foreach ($series as $serie):?>
            	<option value="<?=$serie->clave?>"><?=$serie->clave?></option>
			<?php endforeach;?>
            </select>--><input id="aceptar_noemitido1" contador="1" type="button" class="btn btn-success btn-sm boton_agregar_noemitidos btn-noemitidos enter_folio_noemitido" value="Agregar"/>
    	</div>
    </div>
</div>
</form>
</div>
<div class="well">
<h5><strong>CALIFICACI&Oacute;N DE CORTE</strong></h5>
<form id="calificacion">
<!--<input type="hidden" name="caseta" id="caseta" value="<?=$caseta?>" />-->
<table id="calificacion" class="encabezado_caratula" width="100%">
	<tr>
    	<td>PRESENTACION</td>
        <td>
        CORRECTO&nbsp;&nbsp;<input type="radio" name="presentacion" value="1" checked="checked"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            INCORRECTO&nbsp;&nbsp;<input type="radio" name="presentacion" value="2"/>
        </td>
        <td style="text-align:right;">DISCREPANCIAS</td><td><input type="text" name="discrepancias" class="form-control input sm"/></td>
        <td style="text-align:right;">ERRORES</td><td><input type="text" name="errores" class="form-control input sm"/></td>
		<td style="text-align:right;">VIOLACIONES SRV</td><td><input type="text" name="violaciones_srv" class="form-control input sm"/></td>
    </tr>
    <tr>
		<td style="text-align:right;">DISCREPANCIAS SRV</td><td><input type="text" name="discrepancias_srv" class="form-control input sm"/></td>
    	<td style="text-align:right;">VIOLACIONES</td><td><input type="text" name="violaciones" class="form-control input sm"/></td>
        <td style="text-align:right;">REPORTES ADMIN</td><td><input type="text" name="reportes_admin" class="form-control input sm"/></td>
        <td style="text-align:right;">COMENTARIOS</td><td colspan="3"><textarea name="comentarios" id="comentarios" class="form-control input sm">SIN COMENTARIOS.</textarea></td>
    </tr>
</table>
</form>
</div>
<br />
<a class="btn btn-success pull-right" href="#" id="guardar_corte"><i class="icon-save"></i> GUARDAR CORTE</a>
<br />