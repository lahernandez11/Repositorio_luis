<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Moneda_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
    public function desplega()
    {
		$query = $this->db->query("SELECT * FROM vw_grl_moneda");
        return $query->result();
    }
	
	
	public function agrega($moneda,$registra)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_moneda '$moneda','$registra'");
		return $query->result_array();
	}
	
	public function estado($id,$estado)
	{
		$data = array(
               'idestado' => $estado
            );

		$this->db->where('idmoneda', $id);
		$this->db->update('grl_moneda', $data);
		return $this->db->affected_rows();
	}
	
	public function cambia($id,$moneda)
	{
		$query = $this->db->query("EXEC sp_grl_modifica_moneda '$id','$moneda'");
		return $query->result_array();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/