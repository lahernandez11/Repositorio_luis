<?php

include_once('D:/xampp/htdocs/dev-opc.grupohi.mx/sgwc/npv/Net/SSH2.php');
require_once('D:/xampp/htdocs/dev-opc.grupohi.mx/sgwc/npv/class.phpmailer.php');


$ssh = new Net_SSH2('192.99.17.91:22');
if (!$ssh->login('sgwc_incidencias', 'P"L;cKYGt-Z$')){
		echo "servidor mal<br/>";
	
}

else
{
	echo "servidor bien <br/>";
}
$ssh->disconnect();
?>
