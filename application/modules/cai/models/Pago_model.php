<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pago_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
    public function desplega()
    {
		$query = $this->db->query("SELECT * FROM vw_cai_tipo_pago");
        return $query->result();
    }
	
	
	public function agrega($pago,$clave,$registra)
	{
		$query = $this->db->query("EXEC sp_cai_agregar_tipo_pago '$pago','$clave','$registra'");
		return $query->result_array();
	}
	
	public function estado($id,$estado)
	{
		$data = array(
               'idestado' => $estado
            );

		$this->db->where('idtipo_pago', $id);
		$this->db->update('cai_tipo_pago', $data);
		return $this->db->affected_rows();
	}
	
	public function cambia($id,$pago,$clave)
	{
		$query = $this->db->query("EXEC sp_cai_modifica_tipo_pago '$id','$pago','$clave'");
		return $query->result_array();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/