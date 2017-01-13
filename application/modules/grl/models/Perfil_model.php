<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Perfil_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
    public function desplega()
    {
		$query = $this->db->query("SELECT * FROM vw_grl_perfil");
        return $query->result();
    }
	
	
	public function agrega($perfil)
	{
		$query = $this->db->query("EXEC sp_grl_agregar_perfil '$perfil'");
		return $query->result();
	}
	
	public function estado($id,$estado)
	{
		$data = array(
               'idestado' => $estado
            );

		$this->db->where('idperfil', $id);
		$this->db->update('grl_perfil', $data);
		return $this->db->affected_rows();
		/*$query = $this->db->query("EXEC sp_grl_cambia_estado '[opi].[grl_perfil]','$id','$estado'");
		return $query->result();*/
	}
	
	public function cambia($id,$perfil)
	{
		$data = array(
               'nombre_perfil' => $perfil
            );

		$this->db->where('idperfil', $id);
		$this->db->update('grl_perfil', $data);
		return $this->db->affected_rows();
	}
	
    
	
}
/*
*end modules/login/models/index_model.php
*/