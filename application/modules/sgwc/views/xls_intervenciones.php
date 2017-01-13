<?php
$filename=$clave." Incidencias a nivel de ".$nivel." del mes ".$mes." ".$anio.".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<body>
<table>
	<tr style="font-size:20px; font-weight:bold">
		<td colspan="20">INICIDENCIAS</td>
	</tr>
	<tr style="font-size:20px; font-weight:bold">
		<td colspan="20">'.utf8_encode($clave).'</td>
	</tr>';
	if($nivel=='clase'):
		echo '';
	elseif($nivel=='tipo'):
		echo '<tr><td>&nbsp;</td></tr>
		<tr style="font-size:16px;">
			<td colspan="20">DE LA CLASE: '.$clase.'</td>
		</tr>';
	elseif($nivel=='subtipo'):
		echo '<tr><td>&nbsp;</td></tr>
		<tr style="font-size:16px;">
			<td colspan="20">DE LA CLASE: '.$clase.'</td>
		</tr>';
		echo '<tr style="font-size:16px;">
			<td colspan="20">DEL TIPO: '.$tipo.'</td>
		</tr>';
	endif;
	echo '<tr><td>&nbsp;</td></tr>
	<tr style="font-size:10px;">
		<td colspan="20"><i>Consultado el '.date('Y-m-d H:i:s').'</i></td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<table>
	<tr valign="top" style="font-weight:bold">
		<td colspan="5">'.strtoupper($nivel).'</td>
		<td>Total</td>
	</tr>';
foreach($datos as $dato):
	echo '<tr valign="top"><td colspan="5">'.utf8_encode($dato[$nivel]).'</td>';
		echo '<td>'.$dato["total"].'</td>';
endforeach;
echo '</table></html></body></html>';
?>