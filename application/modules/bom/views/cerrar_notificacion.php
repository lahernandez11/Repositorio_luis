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
Por medio de la presente se le informa que se ha cerrado el reporte
de fallas en equipo de peaje.
<br/>
<div align="right" style="font-size:25px; color:<?=$color?>">
Folio: <?=$r['folio']?> <br/>
Clasificaci&oacute;n: <?=$r['nombre_clasificacion']?> <br/>
Tipo de Reporte: <?=$r['nombre_tiporeporte']?> <br/>
</div>
<br/>
<div align="right">
Fecha Detecci&oacute;n Falla: <?=$r['hora']?><br/> 
Hora Detecci&oacute;n Falla: <?=$r['fecha']?><br/>
</div>
<br/>
</fieldset>
<?php endforeach ?>
<span style="font-size:10px;"><i><strong>
<br><br>
Mensaje enviado desde el m&oacute;dulo de proyectos carreteros.
</strong></i></span>
</div>
</body>
</html>