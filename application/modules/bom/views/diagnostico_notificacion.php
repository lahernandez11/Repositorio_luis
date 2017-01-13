<HTML><HEAD><META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"></HEAD><BODY>
<div style="padding:10px;border:solid 1px #ccc;
font-family:Arial,Helvetica,sans-serif;font-size:12px;">
<table style="background-color:#eeeeee; width:100%;">
<tr>
<td colspan="2">
<img src="http://fianzas.grupohi.mx/img/correo.png">
</td>
</tr>
</table>
<br>
<span style="font-size:25px;"><i><strong>
NOTIFICACI&Oacute;N DE REPORTE DE FALLA EN EQUIPO DE PEAJE
</strong></i></span>
<br><br>
<?php foreach($result as $r):
if($r['color']=='primary')
{$color='blue';}
elseif($r['color']=='warning')
{$color='#fe8e00';}
elseif($r['color']=='danger')
{$color='red';}
?>
<fieldset>
<legend>REPORTE DE ATENCI&Oacute;N EN EQUIPO DE PEAJE</legend>
<br>
Por medio de la presente se le informa que se ha registrado
el diagn&oacute;stico:
<br/>
<div align="right" style="font-size:25px; color:<?=$color?>">
Folio: <?=$r['folio']?> <br/>
Clasificaci&oacute;n: <?=$r['nombre_clasificacion']?> <br/>
Tipo de Reporte: <?=$r['nombre_tiporeporte']?> <br/>
</div>
<br/>
<div align="right">
Fecha Detecci&oacute;n Falla: <?=$r['fecha']?><br/>
Hora Detecci&oacute;n Falla: <?=$r['hora']?><br/> 
</div>
<br/>
<hr width="100%">
<table>
<tr>
<td>Proyecto: </td>
<td><?=$r['nombre_proyecto']?></td>
</tr>
<tr>
<td>Plaza de cobro: </td>
<td><?=$r['nombre_plaza']?></td>
</tr>
<tr>
<td>Nombre de quien reporta: </td>
<td><?=$r['nombre_reporta']?></td>
</tr>
<tr>
<td>Puesto: </td>
<td><?=$r['puesto_reporta']?></td>
</tr>
</table>
<br><br>
<hr width="100%">
<table>
<tr>
<td>&Aacute;rea de Afectaci&oacute;n: </td>
<td><?=$r['nombre_area']?></td>
</tr>
<?php if($r['nombre_area']="CARRIL"):?>
<tr>
<td>Carril: </td>
<td><?=$r['nombre_carril']?></td>
</tr>

<?php endif;?>
<tr>
<td>Tipo de Falla :</td>
<td><?=$r['nombre_tipofalla']?></td>
</tr>
<tr>
<td valign="top">Observaciones: </td>
<td><?=$r['observacion_reporte']?></td>
</tr>
</table>
<br><br>
<hr width="100%">
<table>
<tr>
<td>Fecha de Asignaci&oacute;n: </td>
<td><?=$r['fecha_asignacion']?></td>
</tr>
<tr>
<td>Hora de Asignaci&oacute;n: </td>
<td><?=$r['hora_asignacion']?></td>
</tr>
<tr>
<td>Nombre del T&eacute;cnico: </td>
<td><?=$r['tecnico']?></td>
</tr>
</table>
<br><br>
<hr width="100%">
<table>
<tr>
<td valign="top">Diagn&oacute;stico: </td>
<td><?=$r['diagnostico']?></td>
</tr>
</table>
<?php if(sizeof($reparos)>0):?>
<BR>
<i><strong>EQUIPO QUE REQUIERE REPARACI&Oacute;N</strong></i>
    	<table style="font-size:12px; width:100%;" cellpadding="0" cellspacing="0" border="1">
        	<tr style="background-color:#CCC;" >
            	<td align="center"><strong>EQUIPO</strong></td>
                <td align="center"><strong>MARCA</strong></td>
                <td align="center"><strong>MODELO</strong></td>
                <!--<td align="center"><strong>CAPACIDAD</strong></td>
                <td align="center"><strong>SERIE</strong></td>-->
                <td align="center"><strong>MOTIVO</strong></td>                
                <td align="center"><strong>UBICACI&Oacute;N</strong></td>
                <td align="center"><strong>FECHA DE REGRESO</strong></td>
            </tr>
            <?php $n=0; foreach($reparos as $elemento): $n++;?>
            <tr>
            	<td align="center"><?=$elemento["nombre_equipo"]?></td>
                <td align="center"><?=$elemento["marca"]?></td>
                <td align="center"><?=$elemento["modelo"]?></td>
                <!--<td align="center"><?=$elemento["capacidad"]?></td>
                <td align="center"><?=$elemento["serie"]?></td>-->
                <td><?=$elemento["motivo"]?></td>                
                <td align="center"><?=$elemento["destino"]?></td>                
                <td align="center"><?=$elemento["fecha"]?></td>
            </tr>
            <?php endforeach?>
        </table>
<?php endif;?>
<?php if(sizeof($reemplazos)>0):?>
<BR>
<i><strong>MATERIALES REQUERIDOS POR DA&Ntilde;O O REEMPLAZO</strong></i>
        <table style="font-size:12px; width:100%;" cellpadding="0" cellspacing="0" border="1">
        <tr>
<td colspan="6" align="center" style="font-size:10px; "><i>(MATERIALES A SUSTITUIR)</i></td>
</tr>
        	<tr style="background-color:#CCC;">
            	<td align="center"><strong>EQUIPO</strong></td>
                <td align="center"><strong>MARCA</strong></td>
                <td align="center"><strong>MODELO</strong></td>
                <!--<td align="center"><strong>CAPACIDAD</strong></td>
                <td align="center"><strong>SERIE</strong></td>-->
                <td align="center"><strong>MOTIVO</strong></td>
                <td align="center"><strong>UBICACI&Oacute;N</strong></td>
            </tr>
            <?php $n=0; foreach($reemplazos as $elemento): $n++;?>
            <tr>
                <td align="center"><?=$elemento["r_nombre_equipo"]?></td>
                <td align="center"><?=$elemento["r_marca"]?></td>
                <td align="center"><?=$elemento["r_modelo"]?></td>
                <!--<td align="center"><?=$elemento["r_capacidad"]?></td>
                <td align="center"><?=$elemento["r_serie"]?></td>-->
                <td><?=$elemento["r_motivo"]?></td>
                <td align="center"><?=$elemento["r_ubicacion"]?></td>
            </tr>
            <?php endforeach?>
        </table>
       	
<?php endif;?>
<br><br>
</fieldset>
<?php endforeach ?>
<span style="font-size:10px;"><i><strong>
<br><br>
Mensaje enviado desde el m&oacute;dulo de proyectos carreteros.
<br/>
SAO.- Grupo Hermes Infraestructura.
</strong></i></span>
</div>
</body>
</html>