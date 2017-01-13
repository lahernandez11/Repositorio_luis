<div class="page-header">
	<i class="fa fa-barcode fa-2x"></i> <span style="font-size:18px;">REPORTE DE CORTE</span>
</div>
<div id="cai_buscador">
	<form id="cai_buscar_reporte_corte">
    	<table>
        	<td><strong>PLAZA:</strong></td>
            <td>
            	<select name="plaza" id="plaza" class="form-control">
                <?php foreach ($plazas as $plaza):?>
                	<option value="<?=$plaza->idplaza?>"><?=$plaza->nombre_plaza?></option>
                <?php endforeach;?>
                </select>
            </td>
            <td>&nbsp;</td>
            <td><strong>TURNO:</strong></td>
            <td>
            	<select name="turno" id="turno" class="form-control">
                	<option value="0">- TODOS -</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
            	</select>
            </td>
            <td>&nbsp;</td>
            <td><strong>FECHA:</strong></td>
            <td>
            	<div id="datetimepicker4" class="input-append input-group">
                        <input data-format="yyyy-MM-dd" value="<?=date('Y-m-d');?>" type="text" class="form-control" readonly name="fecha">
                        <span class="input-group-addon add-on">
                        <i data-time-icon="fa fa-calendar" data-date-icon="fa fa-calendar">
                          </i>
                          </span>
                    </div>
            </td>
            <td>&nbsp;</td>
            <td>
            	<a class="btn btn-success cai-buscar-reportes-corte">BUSCAR</a>
            </td>
        </table>
    </form>
</div>
<br>
<div id="cai_lista_reportes">
	<table id="example" class="table table-bordered table-striped table-condensed">
    	<thead>
        	<tr>
            	<th>#</th>
                <th>Fecha</th>
                <th>Plaza</th>
                <th>Sentido</th>
                <th>Turno</th>
                <th>Linea</th>
                <th>Registra</th>
                <th>Aforo</th>
                <th>Acci&oacute;n</th>
            </tr>
        </thead>
    	<tbody>
        	<?php $n=0; foreach($elementos as $elemento): $n++;?>
            	<tr>
                	<td><?=$n?></td>
                	<td><?=$elemento->fecha?></td>
                    <td><?=$elemento->nombre_plaza?></td>
                    <td><?=$elemento->nombre_sentido?></td>
                    <td><?=$elemento->turno?></td>
                    <td><?=$elemento->nombre_carril?></td>
                    <td><?=$elemento->nombre?> <?=$elemento->apaterno?> <?=$elemento->amaterno?></td>
                    <td><?=$elemento->aforo?></td>
                    <td align="center">
                    	<a href="<?=base_url('cai/reporte/corte_pdf/'.$elemento->idcorte)?>" class="btn btn-xs btn-primary">Ver PDF</a>
                    <?php if($idperfil==1||$idperfil==6||$idperfil==7):?>
						<a href="<?=base_url('cai/corte/eliminar/'.$elemento->idcorte)?>" class="btn btn-danger btn-xs">Eliminar</a> 
					<?php endif;?>
                    </td>
                </tr>
    		<?php endforeach;?>
        </tbody>
    </table>
</div>