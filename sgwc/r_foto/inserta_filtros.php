<?php
$serverName = '172.20.74.3\GHIAPP'; //serverName\instanceName
$connectionInfo = array( "Database"=>"opi", "UID"=>"oaguayo", "PWD"=>"2014_opc7");
$link=sqlsrv_connect($serverName,$connectionInfo);

$res_select = sqlsrv_query("SET ANSI_NULLS ON;");
$res_select = sqlsrv_query("SET ANSI_WARNINGS ON;");
$stmt = sqlsrv_query($link,'{CALL sp_foto_inserta_descripciones ()}');

?>