<script>
$(document).ready(function(e) {
    $('#datetimepicker4').datetimepicker({
      pickTime: false
    });
});
</script>
<h5><strong>Vehiculos</strong></h5>
<?=form_open('cai/tarifa/agregar',array('id'=>'agregar_tarifa'))?>
<table style="width:100%;">
	<tr>
    	<td style="text-align:right;">MONEDA</td>
        <td>
        <select name="moneda" class="form-control">
			<?php foreach ($monedas as $moneda):?>
            <option value="<?=$moneda->idmoneda?>"><?=$moneda->moneda?></option>
            <?php endforeach;?>
        </select>
        </td>
        <td>&nbsp;</td>
        <td style="text-align:right;">FECHA</td>
        <td>
        <div id="datetimepicker4" class="input-append input-group">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control required" readonly name="fecha">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
        </td>
    </tr>
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
    <tr>
<?php 
$n=1;
foreach ($vehiculos as $vehiculo):?>
      <td style="text-align:right;"><?=$vehiculo->tipo_vehiculo?></td>
      <td><input type="text" id="input<?=$vehiculo->idtipo_vehiculo?>" name="input<?=$vehiculo->idtipo_vehiculo?>" class="required numeric form-control"/><td>
<?php if($n%2 == 0):?>
</tr>
<tr>
<?php endif; $n++;?>
<?php endforeach;?>
</tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td colspan="5" align="center"><input type="submit" value="Agregar" class="btn btn-success"></td>
</tr>
</table>
<input type="hidden" name="idplaza" value="<?=$idplaza?>">
<?=form_close()?>