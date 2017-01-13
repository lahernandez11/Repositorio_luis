<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Permiso_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    	
	public function desplega_permisos($id)
	{
		$query = $this->db->query("EXEC sp_grl_mostrar_menu_perfil '$id'");
        return $query->result();
	}
	
	public function agrega($menu,$perfil)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_menu_perfil '$perfil','$menu'");
		return $query->result_array();
	}
	
	public function elimina($menu,$perfil)
	{
		$query = $this->db->query("EXEC sp_grl_elimina_menu_perfil '$perfil','$menu'");
		return $query->result_array();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/