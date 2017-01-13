<!--<div class="page-header">
          <i class="fa fa-th fa-2x"></i> <span style="font-size:18px;">CORTE</span>
</div>-->
<div class="page-header">
	<h4><a href="<?=base_url('grl/aforo/index')?>">
    <img src="<?=base_url('assets/img/1383194873_services.png')?>"> </a>REGISTRO DE CORTE</h4>
</div>
<div id="contenedor_general">
<div id="encabezado">
<form id="fecha">
<table>
	<tr>
    	<td>CASETA</td>
        <td>
        	<select name="caseta" id="corte_caseta" class="form-control" style="width:150px;">
                <option value="0">- SELECCIONE -</option>
                <?php foreach ($plazas as $plaza):?>
                <option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
                <?php endforeach;?>
            </select>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>FECHA</td>
        <td>
        <div id="datetimepicker4" class="input-append input-group">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control" readonly name="fecha" id="fecha_corte">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
        </td>
		<td align="right" width="60%">
        	<div id="bobina_activa"></div>
            <div id="tipo_cambio"></div>
        </td>
    </tr>
</table>
</form> 
</div>
<div id="contenedor_caratula"></div>
</div>
<br><br><br><br /><br />