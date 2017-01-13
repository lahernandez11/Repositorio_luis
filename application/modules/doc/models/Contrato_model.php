<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contrato_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplegar_contratos()
	{
		$this->db->select("nombre_proyecto,numero_contrato,descripcion_contrato,fechainicio_tabla,fechafin_tabla,cat_estado,botones");
		$this->db->from("vw_doc_contrato");
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function desplegar_contrato($idcontrato)
	{
		$this->db->select("idproyecto,numero_contrato,descripcion_contrato,fecha_inicio,fecha_fin,idcat_estado,doc_contrato");
		$this->db->from("vw_doc_contrato");
		$this->db->where("idcontrato",$idcontrato);
		$query = $this->db->get(); 	
        return $query->result_array();
	}
	
	public function agregar_contrato($idproyecto,$numero,$descripcion,$finicio,$ffin,$estado,$archivo,$user)
	{
		$query = $this->db->query("EXEC sp_doc_agregar_contrato $idproyecto,'$numero','$descripcion','$finicio','$ffin',$estado,'$archivo','$user'");
        return $query->result_array();
	}
	
	public function editar_contrato($idcontrato,$idproyecto,$numero,$descripcion,$finicio,$ffin,$estado,$archivo,$user)
	{
		$query = $this->db->query("EXEC sp_doc_modificar_contrato $idcontrato,$idproyecto,'$numero','$descripcion','$finicio','$ffin',$estado,'$archivo','$user'");
        return $query->result_array();
	}
	
	public function cambiar_estado_contrato($idcontrato,$estado)
	{
		$query = $this->db->query("EXEC sp_doc_cambia_estado_contrato $idcontrato,$estado");
        return $query->result_array();
	}
	
	public function desplega_lista_contratos($idusuario)
	{
		$query = $this->db->query("EXEC sp_doc_cambia_estado_contrato $idcontrato,$estado");
        return $query->result_array();
	}
	
}