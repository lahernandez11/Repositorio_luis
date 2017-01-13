<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cuerpo_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_cuerpo_plaza($id)
	{
		$query = $this->db->query("SELECT * FROM grl_cuerpo WHERE idplaza=".$id." ORDER BY nombre_cuerpo");
        return $query->result();
	}
	
	public function agrega($cuerpo,$plaza)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_cuerpo '$cuerpo','$plaza'");
		return $query->result_array();
	}
	
	public function elimina($cuerpo)
	{
		$query = $this->db->query("EXEC sp_grl_elimina_cuerpo '$cuerpo'");
		return $query->result_array();
	}
	
	public function modifica($id,$cuerpo)
	{
		$query = $this->db->query("EXEC sp_grl_modifica_cuerpo '$id','$cuerpo'");
		return $query->result_array();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/