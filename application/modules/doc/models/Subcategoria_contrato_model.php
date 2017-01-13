<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subcategoria_contrato_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	
	public function desplegar_subcategorias($idcontrato,$idcategoria)
	{
		$query = $this->db->query("EXEC sp_doc_desplegar_subcategoria_contrato ".$idcontrato.",".$idcategoria.""); 	
        return $query->result_array();
	}
	
	public function cambiar_subcategorias($idcontrato,$idcategoria,$idsubcategoria,$idestado)
	{
		$query = $this->db->query("EXEC sp_doc_agregar_eliminar_subcategoria_contrato $idcontrato,$idcategoria,$idsubcategoria,$idestado"); 	
        return $query->result_array();
	}
	
}