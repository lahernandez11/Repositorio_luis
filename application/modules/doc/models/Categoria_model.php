<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categoria_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_categorias()
	{
		$this->db->select("cat_categoria,cat_estado,botones");
		$this->db->from("vw_doc_categoria");
		$this->db->order_by("cat_categoria", "asc"); 
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_categoria($idcategoria)
	{
		$this->db->select("cat_categoria");
		$this->db->from("vw_doc_categoria");
		$this->db->where("idcat_categoria",$idcategoria);
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function agregar_categoria($categoria,$user)
	{
		$query = $this->db->query("EXEC sp_doc_agregar_categoria '$categoria',$user");
        return $query->result_array();
	}
	
	public function editar_categoria($idcategoria,$categoria)
	{
		$query = $this->db->query("EXEC sp_doc_modificar_categoria $idcategoria,'$categoria'");
        return $query->result_array();
	}
	
	public function cambiar_estado_contrato($idcategoria,$estado)
	{
		$query = $this->db->query("EXEC sp_doc_cambia_estado_categoria $idcategoria,$estado");
        return $query->result_array();
	}
	
	public function cambiar_estado_categoria($idcategoria,$estado)
	{
		$query = $this->db->query("EXEC sp_doc_cambia_estado_categoria $idcategoria,$estado");
        return $query->result_array();
	}
	
}