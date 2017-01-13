<HTML><HEAD><META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset; charset=UTF-8==UTF-8"></HEAD><BODY>
<div style="padding:10px;border:solid 1px #ccc;width:820px;font-family:Arial,Helvetica,sans-serif;font-size:12px;">
<table style="background-color:#eeeeee">
<tr>
<td style="width:810px;" align="center">
<img src="http://fianzas.grupohi.mx/img/correo.png">
</td>
</tr>
</table>
<br>
<span style="font-size:18px"><i><strong>
RESUMEN DE ACTIVIDADES PENDIENTES
</strong></i></span>
<br/><br/>
<span style="font-size:14px"><i><strong>
BIT&Aacute;CORA DE OPERACI&Oacute;N Y MANTENIMIENTO
</strong></i></span>
<br><br>
<table style="text-align:left; font-size:13px;" border="1">
<thead>
<tr>
<th style="color:#FFF; background-color:#000" align="center">PLAZA</th>
<th style="color:#FFF; background-color:#000" align="center">ASIGNAR <br/> T&Eacute;CNICO</th>
<th style="color:#FFF; background-color:#000" align="center">REGISTRAR <br/> DIAGN&Oacute;STICO</th>
<th style="color:#FFF; background-color:#000" align="center">REGISTRAR <br/> SOLUCI&Oacute;N</th>
<th style="color:#FFF; background-color:#000" align="center">EMITIR <br/> REPORTE</th>               
<th style="color:#FFF; background-color:#000" align="center">CERRAR <br/> REPORTE</th>
</tr>               
</tr>
</thead>
<tbody>

<?php 
$total_t=0; 
$total_d=0;
$total_s=0;
$total_e=0;
$total_c=0;
foreach ($result as $resultado):
$total_t=$resultado['tecnico']+$total_t;
$total_d=$resultado['diag']+$total_d;
$total_s=$resultado['solucion']+$total_s;
$total_e=$resultado['emitir']+$total_e;
$total_c=$resultado['cerrar']+$total_c;
?>
<?php if($resultado['total']>0): ?>
<tr>
<td style="background-color:#666;color:#fff;">
<?=$resultado['clave']?> - 
<?=$resultado['nombre_plaza']?>
</td>
<?php 

if ($resultado['tecnico']>0):?>
<td style="color:red" align="center"><?=$resultado['tecnico']?></td>
<?php else: ?>
<td align="center"><?=$resultado['tecnico']?></td>
<?php endif; ?>

<?php if ($resultado['diag']>0):?>
<td style="color:red" align="center"><?=$resultado['diag']?></td>
<?php else: ?>
<td align="center"><?=$resultado['diag']?></td>
<?php endif; ?>

<?php if ($resultado['solucion']>0):?>
<td style="color:red" align="center"><?=$resultado['solucion']?></td>
<?php else: ?>
<td align="center"><?=$resultado['solucion']?></td>
<?php endif; ?>

<?php if ($resultado['emitir']>0):?>
<td style="color:red" align="center"><?=$resultado['emitir']?></td>
<?php else: ?>
<td align="center"><?=$resultado['emitir']?></td>
<?php endif; ?>

<?php if ($resultado['cerrar']>0):?>
<td style="color:red" align="center"><?=$resultado['cerrar']?></td>
<?php else: ?>
<td align="center"><?=$resultado['cerrar']?></td>
<?php endif; ?>
<tr>
<?php endif;?>
<?php endforeach ?>
<tr>
<td style="color:#FFF; background-color:#000" align="center">TOTAL</td>
<td style="color:#FFF; background-color:#000" align="center"><?=$total_t?></td>
<td style="color:#FFF; background-color:#000" align="center"><?=$total_d?></td>
<td style="color:#FFF; background-color:#000" align="center"><?=$total_s?></td>
<td style="color:#FFF; background-color:#000" align="center"><?=$total_e?></td>
<td style="color:#FFF; background-color:#000" align="center"><?=$total_c?></td>
</tr>             
</tbody>	
</table>
<div style="clear:both;"></div>			
<br>
<span style="font-size:10px;"><i><strong>
Mensaje enviado autom&aacute;ticamente desde el m&oacute;dulo 
de proyectos carreteros.
<br/>
SAO - Grupo Hermes Infraestructura.
</strong></i></span>
</div>
</body>
</html>