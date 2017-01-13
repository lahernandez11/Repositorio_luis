<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Actividad_estado_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_estados()
	{
		$this->db->select("*");
		$this->db->from("vw_doc_cat_estado_actividad");
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_estado($idestado_actividad)
	{
		$this->db->select("idestado_actividad,estado_actividad,descripcion_dashboard");
		$this->db->from("vw_doc_cat_estado_actividad");
		$this->db->where("idestado_actividad",$idestado_actividad);
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function agregar_estado($estado,$descripcion,$user)
	
	{
		$query = $this->db->query("EXEC sp_doc_agregar_estado_actividad '$estado','$descripcion','$user'");
        return $query->result_array();
	}
	
	public function editar_estado($idestado_actividad,$estado,$descripcion)
	{
		$query = $this->db->query("EXEC sp_doc_modificar_estado_actividad $idestado_actividad,'$estado','$descripcion'");
        return $query->result_array();
	}
	
	public function cambiar_estado($idestado_actividad,$estado)
	{
		$query = $this->db->query("EXEC sp_doc_cambiar_estado_estado_actividad $idestado_actividad,$estado");
        return $query->result_array();
	}
	
}