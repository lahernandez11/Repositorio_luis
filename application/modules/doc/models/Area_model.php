<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Area_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_areas()
	{
		$this->db->select("*");
		$this->db->from("vw_doc_area_involucrada");
		$this->db->order_by("nombre_area_involucrada");
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_niveles()
	{
		$this->db->select("idnivel,descripcion_nivel");
		$this->db->from("doc_nivel_usuario");
		$this->db->order_by("idnivel");
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_areas_activas()
	{
		$this->db->select("*");
		$this->db->from("vw_doc_area_involucrada");
		$this->db->where("idestado_area",1);
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_area($idarea_involucrada)
	{
		$this->db->select("*");
		$this->db->from("vw_doc_area_involucrada");
		$this->db->where("idarea_involucrada",$idarea_involucrada);
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_usuarios_agregados($idarea)
	{
		$this->db->select("*");
		$this->db->from("vw_doc_area_involucrada_nivel_usuario");
		$this->db->where("idarea_involucrada",$idarea);
		$this->db->where("idestado",1);
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function agregar_area($area,$user)
	{
		$query = $this->db->query("EXEC sp_doc_agregar_area_involucrada '$area','$user'");
        return $query->result_array();
	}
	
	public function agregar_usuario($idarea,$idnivel,$usuario,$correo,$user)
	{
		$query = $this->db->query("EXEC sp_doc_agregar_area_nivel_usuario $idarea,$idnivel,'$usuario','$correo','$user'");
        return $query->result_array();
	}
	
	public function editar_area($idarea,$area)
	{
		$query = $this->db->query("EXEC sp_doc_modificar_area_involucrada $idarea,'$area'");
        return $query->result_array();
	}
	
	public function cambiar_estado($idarea,$estado)
	{
		$query = $this->db->query("EXEC sp_doc_cambiar_estado_area_involucrada $idarea,$estado");
        return $query->result_array();
	}
	
	public function cambiar_estado_usuario($idnivel_area_usuario)
	{
		$query = $this->db->query("EXEC sp_doc_eliminar_area_nivel_usuario $idnivel_area_usuario");
        return $query->result_array();
	}
	
}