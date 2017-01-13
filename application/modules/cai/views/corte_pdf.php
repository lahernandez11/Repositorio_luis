<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif";>
<table style="width:100%; font-size:9px;">
	<tr>
    	<td colspan="1" align="left" width="20%"><img src="assets/img/logo.png"></td>
        <td colspan="4" align="center"><h4><?=$proyecto?></h4>SISTEMA DE CONTROL DE AFORO E INGRESO<br>CORTE DE CAJA</td>
        <td colspan="1" align="right" width="20%"><img src="assets/img/ghi_logo_1.jpg"></td>
    </tr>
</table>
<table style="width:100%; font-size:9px;">
    <tr>
    	<td colspan="6"><hr style="color:#CCC;"></td>
    </tr>
    <tr>
    	<td colspan="2">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
    	
    </tr>
    <tr>
    	<td width="10%"><strong>Fecha de Corte:</strong></td><td width="20%"><?=$fecha?></td>
    	<td width="10%"><strong>Caseta:</strong></td><td align="left"><?=$caseta?></td>
        <td width="10%"><strong>Sentido:</strong></td><td align="left"><?=$sentido?></td>
    </tr>
    <tr>
    	<td width="10%"><strong>Turno:</strong></td><td align="left"><?=$turno?></td>
        <td width="10%"><strong>Cuerpo:</strong></td><td align="left"><?=$cuerpo?></td>
        <td width="10%"><strong>Linea:</strong></td><td align="left"><?=$linea?></td>
    </tr>
    <tr>
        <td colspan="3"><strong>Jefe de Turno:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$jefe?></td>
        <td colspan="3"><strong>Cobrador:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$cobrador?></td>
    </tr>
</table>
<hr style="color:#CCC;">
<strong style="font-size:9px;">Veh&iacute;culos/Totales</strong>
<?=$caratula?>
<hr style="color:#CCC;">
<?=$folios_utilizados?>
<hr style="color:#CCC;">
<?=$calificacion?>
<br>
<?=$firmas?>
</body>



