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
Por medio de la presente se le informa que se ha detectado el siguiente 
comportamiento en el equipo de peaje:
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
</table>
<br><br>
<hr width="100%">
<table>
<tr>
<td>Puesto: </td>
<td><?=$r['puesto_reporta']?></td>
</tr>
<tr>
<td>&Aacute;rea de Afectaci&oacute;n: </td>
<td><?=$r['nombre_area']?></td>
</tr>
<tr>
<td>Tipo de Falla :</td>
<td><?=$r['nombre_tipofalla']?></td>
</tr>
<tr>
<td>Observaciones: </td>
<td><?=$r['observacion_reporte']?></td>
</tr>
</table>
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