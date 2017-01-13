<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vehiculo_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
    public function desplega()
    {
		$query = $this->db->query("SELECT * FROM vw_grl_vehiculo");
        return $query->result();
    }
	
	
	public function agrega($vehiculo,$clave,$ejes,$registra)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_tipovehiculo '$vehiculo','$clave','$ejes','$registra'");
		return $query->result_array();
	}
	
	public function estado($id,$estado)
	{
		$data = array(
               'idestado' => $estado
            );

		$this->db->where('idtipo_vehiculo', $id);
		$this->db->update('grl_tipo_vehiculo', $data);
		return $this->db->affected_rows();
	}
	
	public function cambia($id,$vehiculo,$clave,$ejes)
	{
		$query = $this->db->query("EXEC sp_grl_modifica_tipovehiculo '$id','$vehiculo','$clave','$ejes'");
		return $query->result_array();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/