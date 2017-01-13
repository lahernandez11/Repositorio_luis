<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Linea_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_linea_plaza($id)
	{
		$query = $this->db->query("SELECT * FROM [dbo].[grl_carril] WHERE idplaza=".$id." ORDER BY nombre_carril");
        return $query->result();
	}
	
	public function agrega($linea,$plaza)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_linea '$linea','$plaza'");
		return $query->result_array();
	}
	
	public function elimina($linea)
	{
		$query = $this->db->query("EXEC sp_grl_elimina_linea '$linea'");
		return $query->result_array();
	}
	
	public function modifica($id,$linea)
	{
		$query = $this->db->query("EXEC sp_grl_modifica_linea '$id','$linea'");
		return $query->result_array();
	}
		
}
/*
*end modules/login/models/index_model.php
*/