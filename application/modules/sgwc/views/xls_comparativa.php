<?php
$filename=$clave." Comparativa de incidencias a nivel de ".$nivel." del mes ".$mes." ".$anio.".xls";
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
		<td colspan="10">COMPARATIVA DE INICIDENCIAS</td>
	</tr>
	<tr style="font-size:20px; font-weight:bold">
		<td colspan="10">'.utf8_encode($clave).'</td>
	</tr>';
	if($nivel=='clase'):
		echo '';
	elseif($nivel=='tipo'):
		echo '<tr><td>&nbsp;</td></tr>
		<tr style="font-size:16px;">
			<td colspan="10">DE LA CLASE: '.$clase.'</td>
		</tr>';
	elseif($nivel=='subtipo'):
		echo '<tr><td>&nbsp;</td></tr>
		<tr style="font-size:16px;">
			<td colspan="10">DE LA CLASE: '.$clase.'</td>
		</tr>';
		echo '<tr style="font-size:16px;">
			<td colspan="10">DEL TIPO: '.$tipo.'</td>
		</tr>';
	endif;
	echo '<tr><td>&nbsp;</td></tr>
	<tr style="font-size:10px;">
		<td colspan="10"><i>Consultado el '.date('Y-m-d H:i:s').'</i></td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<table>
	<tr valign="top" style="font-weight:bold">
	<td>'.strtoupper($nivel).'</td>';
foreach ($meses as $mes):
	echo '<td>'.$mes["serie"].'</td>';
endforeach;
echo '</tr>';
foreach($datos as $dato):
	echo '<tr valign="top"><td>'.utf8_encode($dato[$nivel]).'</td>';
	foreach ($meses as $mes):
		$indice = '_'.str_replace(' ','_',$mes["serie"]);
		echo '<td>'.str_replace(' ','_',$dato[$indice]).'</td>';
		//echo '<td>'.str_replace(' ','_',$indice).'</td>';
	endforeach;
endforeach;
echo '</tr></table></html></body></html>';
?>