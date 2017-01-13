<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Respuesta_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function tipo_solicitud()
	{
		$query=$this->db->query("SELECT * FROM con_tipo_solicitud WHERE idestado=1 ORDER BY tipo_solicitud");
		return $query->result();
		
	}
	
	public function proyecto()
	{
		$query=$this->db->query("SELECT * FROM grl_proyecto WHERE idestado=1 ORDER BY nombre_proyecto");
		return $query->result();
		
	}
	
	public function carga_respuesta($tipo,$proyecto)
	{
		$query=$this->db->query("SELECT * FROM baw_respuesta_automatica WHERE idtipo_solicitud=".$tipo. "AND idproyecto=".$proyecto );
		return $query->result_array();
	}
	
	public function inserta_respuesta($accion,$tipo,$asunto,$texto,$iduser,$idproyecto)
	{
		$query=$this->db->query("EXEC sp_baw_agregar_respuesta_automatica '$accion','$tipo','$asunto','$texto','$iduser','$idproyecto'");
		return $query->result_array();
		
	}
	
	public function muestra_texto($id)
	{
		$query=$this->db->query("SELECT * FROM baw_respuesta_automatica WHERE idrespuesta_automatica=".$id);
		return $query->result_array();
	}
	
}