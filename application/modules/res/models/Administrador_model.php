<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administrador_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_submenu($idperfil)
	{
		$query=$this->db->query("SELECT * FROM grl_menu_perfil mp INNER JOIN grl_menu m ON (mp.idmenu=m.idmenu) where m.idpadre=35 AND mp.idperfil=".$idperfil." and m.idestado=1");
		return $query->result_array();
	}
	
	
	
	
}