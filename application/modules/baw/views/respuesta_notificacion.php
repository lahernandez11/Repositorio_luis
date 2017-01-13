$cuerpo = '
	<style>
	#cuerpo{
		margin:0;
		padding:10px;
		font-family:Arial, Helvetica, sans-serif;
		font-size:12px;
		border:solid 1px #ccc;
		width:400px;
		max-width:400px;
		}
	#header{
		background-color:#ebebeb;
		padding:10px;
		}
	.campo{
		background-color:#888888;
		color:#ffffff;
		font-weight:300;
		padding:5px;
		font-size:12px;
		text-align:right;
		}
	.valor{
		background-color:#efefef;
		padding:5px;
		font-size:12px;
		}
	.leyenda{
		font-size:10px;
		}
	</style>
	<div id="cuerpo">
<div id="header" align="center">
<?php foreach($respuesta_correo as $respuesta):?>
<h4>Ticket #'.$data["respuesta_correo"][0]["folio"].'</h4>
</div>
<br>
<div>'.
$data["respuesta_correo"][0]["respuesta"].'</div>		
		<br>
		<i style="font-size:10px;">
		<strong>Mensaje enviado automáticamente desde la página<br>
		http://www.autopista-lerma-3marias.com.mx/<strong></strong>.
		</i>
	</div>
		<br>
		<i style="font-size:10px;">
		<strong>Mensaje enviado automáticamente desde la página<br>
		http://www.autopista-lerma-3marias.com.mx/<strong></strong>.
		</i>
	</div>
	';