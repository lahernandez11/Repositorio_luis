<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subcategoria_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_subcategorias()
	{
		$this->db->select("cat_subcategoria,cat_estado,botones");
		$this->db->from("vw_doc_subcategoria");
		$this->db->order_by("cat_subcategoria");
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_subcategoria($idsubcategoria)
	{
		$this->db->select("cat_subcategoria");
		$this->db->from("vw_doc_subcategoria");
		$this->db->where("idcat_subcategoria",$idsubcategoria);
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function agregar_subcategoria($subcategoria,$user)
	{
		$query = $this->db->query("EXEC sp_doc_agregar_subcategoria '$subcategoria',$user");
        return $query->result_array();
	}
	
	public function editar_subcategoria($idsubcategoria,$subcategoria)
	{
		$query = $this->db->query("EXEC sp_doc_modificar_subcategoria $idsubcategoria,'$subcategoria'");
        return $query->result_array();
	}
	
	public function cambiar_estado_subcategoria($idsubcategoria,$estado)
	{
		$query = $this->db->query("EXEC sp_doc_cambia_estado_subcategoria $idsubcategoria,$estado");
        return $query->result_array();
	}
	
}