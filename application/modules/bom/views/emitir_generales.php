<style>
.contenedor{
	border:solid 1px #333; padding:10px;
	}
table{
	width:100%; 
	font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; 
	font-size:10px;
	}
.hora{
	font-size:8px;
	}
.folio{
	font-size:20px;
	}
.separador{
	width:100%;
	height:10px;
	background-color:#666;
	}
.tipo{
	padding:2px;
	color:#FFF;
	border-radius:5px;
	font-size:12px;
	}
.danger{
	background-color:#F00;
	}
.primary{
	background-color:#06C;
	}
.warning{
	background-color:#F90;
	}
.letra{
	font-size:10px;
	}
.firma{
	padding:20px;}
.nombre{
	border: solid 1px #333;
	text-align:center;
	padding:10px;
	}
</style>
<table>
<tr>
	<td width="25%"><img src="assets/img/logo_.png" width="150"></td>
    <td colspan="2" width="50%" align="center">
    	<h4>GRUPO HERMES INFRAESTRUCTURA</h4>
        <h3>REPORTE DE SERVICIO DE<br>MANTENIMIENTO CORRECTIVO</h3>
    </td>
    <td width="25%" align="right">&nbsp;</td>
</tr>
<tr>
    <td colspan="4" align="right">
    	<span class="hora">FOLIO DE REPORTE:</span><br>
        <span class="folio"><strong><?=$result[0]["folio"]?></strong></span><br>
        <span class="folio tipo <?=$result[0]["color"]?>"><?=$result[0]["nombre_clasificacion"]?></span>
    </td>
</tr>
<tr>
    <td colspan="4" align="right">
    	<span class="hora">FECHA: <?=date('d/m/Y')?>&nbsp;&nbsp;&nbsp;&nbsp; HORA:<?=date('H:i:s')?></span>
    </td>
</tr>
<tr><td colspan="4"><div class="separador"></div></td></tr>
<tr class="letra">
	<td><strong>PROYECTO:</strong></td><td><?=$result[0]["nombre_proyecto"]?></td>
    <td><strong>&Aacute;REA AFECTACI&Oacute;N:</strong></td><td colspan="3"><?=$result[0]["nombre_area"]?></td>
</tr>
<tr class="letra">
	<td><strong>PLAZA DE COBRO:</strong></td><td><?=$result[0]["nombre_plaza"]?></td>
    <td><strong>UBICACI&Oacute;N:</strong></td><td>
	<?php if($result[0]["nombre_carril"]!=''):?>
	<?=$result[0]["nombre_carril"]?>
    <?php else:?>
    No aplica
    <?php endif;?>
    </td>
</tr>
<tr><td colspan="4"><div class="separador"></div></td></tr>
<tr class="letra">
	<td><strong>REPORTA:</strong></td><td colspan="3"><?=utf8_decode($result[0]["nombre_reporta"])?></td>
</tr>
<tr class="letra">
	<td><strong>PUESTO:</strong></td><td colspan="3"><?=$result[0]["puesto_reporta"]?></td>
</tr>
<tr class="letra">
	<td><strong>TIPO DE FALLA:</strong></td><td colspan="3"><?=$result[0]["nombre_area"]?></td>
</tr>
<tr class="letra">
	<td><strong>DESCRIPCI&Oacute;N DE LA FALLA:</strong></td><td colspan="3"><?=$result[0]["nombre_tipofalla"]?></td>
</tr>
<tr><td colspan="4"><div class="separador"></div></td></tr>
<tr class="letra">
	<td><strong>FECHA DE ASIGNACI&Oacute;N:</strong></td><td><?=$result[0]["fecha_asignacion"]?></td>
    <td><strong>HORA DE ASIGNACI&Oacute;N:</strong></td><td><?=$result[0]["hora_asignacion"]?></td>
</tr>
<tr class="letra">
	<td><strong>T&Eacute;CNICO ASIGNADO:</strong></td><td colspan="3"><?=utf8_decode($result[0]["tecnico"])?></td>
</tr>
<tr><td colspan="4"><div class="separador"></div></td></tr>
<tr class="letra">
	<td><strong>FECHA DE DIAGN&Oacute;STICO:</strong></td><td><?=$result[0]["fecha_diagnostico"]?></td>
    <td><strong>HORA DE DIAGN&Oacute;STICO:</strong></td><td><?=$result[0]["hora_diagnostico"]?></td>
</tr>
<tr class="letra">
	<td><strong>DIAGN&Oacute;STICO:</strong></td><td colspan="3"><?=utf8_decode($result[0]["diagnostico"])?></td>
</tr>
<tr><td colspan="4"><div class="separador"></div></td></tr>
<tr class="letra">
	<td><strong>FECHA DE SOLUCI&Oacute;N:</strong></td><td><?=$result[0]["fecha_solucion"]?></td>
    <td><strong>HORA DE SOLUCI&Oacute;N:</strong></td><td><?=$result[0]["hora_solucion"]?></td>
</tr>
<tr class="letra">
	<td><strong>ACTIVIDADES DE SOLUCI&Oacute;N:</strong></td><td colspan="3"><?=utf8_decode($result[0]["solucion"])?></td>
</tr>
<?php  if($result[0]["reparar"]==1): ?>
<tr><td colspan="4"><strong><i>EQUIPO QUE REQUIERE REPARACI&Oacute;N</i></strong></td></tr>
<tr>
	<td colspan="4">
    	<table style="font-size:8px;" cellpadding="0" cellspacing="0" border="1">
        	<tr style="background-color:#CCC;" >
            	<td align="center"><strong>EQUIPO</strong></td>
                <td align="center"><strong>MARCA</strong></td>
                <td align="center"><strong>MODELO</strong></td>
                <!--<td align="center"><strong>CAPACIDAD</strong></td>-->
                <!--<td align="center"><strong>SERIE</strong></td>-->
                <td align="center"><strong>MOTIVO</strong></td>                
                <td align="center"><strong>DESTINO</strong></td>
                <td align="center"><strong>FECHA DE REGRESO</strong></td>
            </tr>
            <?php $n=0; foreach($reparar as $elemento): $n++;?>
            <tr>
                <td align="center"><?=utf8_decode($elemento["nombre_equipo"])?></td>
                <td align="center"><?=utf8_decode($elemento["marca"])?></td>
                <td align="center"><?=utf8_decode($elemento["modelo"])?></td>
                <!--<td align="center"><?=$elemento["capacidad"]?></td>-->
                <!--<td align="center"><?=$elemento["serie"]?></td>-->
                <td><?=utf8_decode($elemento["motivo"])?></td>
                <td align="center"><?=utf8_decode($elemento["destino"])?></td>
                <td align="center"><?=$elemento["fecha"]?></td>
            </tr>
            <?php endforeach?>
        </table>
    </td>
</tr>
<?php endif;?>
<?php  if($result[0]["remplazo"]==1): ?>
<tr><td colspan="4"><br/><strong><i>MATERIALES REQUERIDOS POR DA&Ntilde;O O REEMPLAZO</i></strong></td></tr>
</table>
<table style="font-size:8px; width:100%" cellpadding="0" cellspacing="0" border="1">
<tr>
<td colspan="5" align="center" style="font-size:8px; "><i>(MATERIALES A SUSTITUIR)</i></td>
</tr> 
        	<tr style="background-color:#CCC;">
            	<td align="center"><strong>EQUIPO</strong></td>
                <td align="center"><strong>MARCA</strong></td>
                <td align="center"><strong>MODELO</strong></td>
                <!--<td align="center"><strong>CAPACIDAD</strong></td>-->
                <!--<td align="center"><strong>SERIE</strong></td>-->
                <td align="center"><strong>MOTIVO</strong></td>
                <td align="center"><strong>UBICACI&Oacute;N</strong></td>
            </tr>
            <?php $n=0; foreach($reemplazar as $elemento): $n++;?>
            <tr>
                <td align="center"><?=utf8_decode($elemento["r_nombre_equipo"])?></td>
                <td align="center"><?=utf8_decode($elemento["r_marca"])?></td>
                <td align="center"><?=utf8_decode($elemento["r_modelo"])?></td>
                <!--<td align="center"><?=$elemento["r_capacidad"]?></td>-->
                <!--<td align="center"><?=$elemento["r_serie"]?></td>-->
                <td><?=utf8_decode($elemento["r_motivo"])?></td>
                <td align="center"><?=utf8_decode($elemento["r_ubicacion"])?></td>
            </tr>
            <?php endforeach?>           
</table>
<br/>
<table style="font-size:8px; width:100%" cellpadding="0" cellspacing="0" border="1">
<tr>
<td colspan="5" align="center" style="font-size:8px;"><i>(MATERIALES QUE LOS SUSTITUYEN)</i></td>
</tr>
        	<tr style="background-color:#CCC;" >
            	<td align="center"><strong>EQUIPO</strong></td>
                <td align="center"><strong>MARCA</strong></td>
                <td align="center"><strong>MODELO</strong></td>
                <!--<td align="center"><strong>CAPACIDAD</strong></td>-->
                <td align="center"><strong>SERIE</strong></td>
                <td align="center"><strong>MOTIVO</strong></td>
                <!--<td align="center"><strong>UBICACI&Oacute;N</strong></td>-->
            </tr>
            <?php $n=0; foreach($reemplazar as $elemento): $n++;?>
            <tr>
                <td align="center"><?=utf8_decode($elemento["n_nombre_equipo"])?></td>
                <td align="center"><?=utf8_decode($elemento["n_marca"])?></td>
                <td align="center"><?=utf8_decode($elemento["n_modelo"])?></td>
                <!--<td align="center"><?=$elemento["n_capacidad"]?></td>-->
                <td align="center"><?=$elemento["n_serie"]?></td>
                <td><?=utf8_decode($elemento["n_motivo"])?></td>
                <!--<td align="center"><?=$elemento["n_ubicacion"]?></td>-->
            </tr>
            <?php endforeach?>           
        </table>
<?php endif;?>
<br>
<table>
<tr><td colspan="4"><div class="separador"></div></td></tr>
<tr class="letra">
	<td colspan="4"><strong>OBSERVACIONES:</strong></td>
</tr>
<tr class="letra">
	<td colspan="4">
	<div class="contenedor"><?=utf8_decode($result[0]["observacion_reporte"])?></div></td>
</tr>
</table>
<br>
<table>
	<tr>
    	<td width="33%">
        	<div class="firma">
            	<div class="nombre">T&Eacute;CNICO DE MANTENIMIENTO
                <br><br><br><br><br><br>
                NOMBRE Y FIRMA</div>
            </div>
        </td>
        <td width="33%">
        	<div class="firma">
            	<div class="nombre">SUPERVISOR GHI
                <br><br><br><br><br><br>
                NOMBRE Y FIRMA</div>
            </div>
        </td>
        <td width="33%">
        	<div class="firma">
            	<div class="nombre">SUPERVISOR
                <br><br><br><br><br><br>
                NOMBRE Y FIRMA</div>
            </div>
        </td>
    </tr>
</table>