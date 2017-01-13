<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sentido_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_cuerpo_plaza($id)
	{
		$query = $this->db->query("SELECT * FROM [dbo].[grl_cuerpo] WHERE idplaza=".$id);
        return $query->result();
	}
	
	public function desplega_cuerpo_sentido($id)
	{
		$query = $this->db->query("SELECT * FROM [dbo].[grl_sentido] WHERE idcuerpo=".$id);
        return $query->result();
	}
	
	public function agrega($cuerpo,$sentido)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_sentido '$sentido','$cuerpo'");
		return $query->result_array();
	}
	
	public function elimina($sentido)
	{
		$query = $this->db->query("EXEC sp_grl_elimina_sentido '$sentido'");
		return $query->result_array();
	}
	
	public function modifica($id,$sentido)
	{
		$query = $this->db->query("EXEC sp_grl_modifica_sentido '$id','$sentido'");
		return $query->result_array();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/