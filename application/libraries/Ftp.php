<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ftp {
		
	function ConectarFTP(){
		$conn_id = ftp_connect("ns5002111.ip-192-99-17.net"); //SE CONECTA AL SERVIDOR
		$login_result = ftp_login($conn_id, "sgwc_khernandez", "Her123-"); //USUARIO Y CONTRASEÑA
		$mode = ftp_pasv($conn_id, TRUE);
		return $conn_id;
	}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */