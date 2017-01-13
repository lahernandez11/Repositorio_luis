<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Emitir_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_encabezado_reporte($id)
	{
		$query=$this->db->query("EXEC sp_bom_info_pdf '$id'");
		return $query->result_array();
	}
	
	public function desplega_equipo_reparar($idreporte,$solucion)
	{
		$query=$this->db->query("SELECT * FROM vw_bom_reparar_equipo where idreporte=$idreporte AND idregistro_solucion=$solucion");
		return $query->result_array();
	}
	
	public function desplega_equipo_reemplazar($idreporte,$solucion)
	{
		$query=$this->db->query("SELECT * FROM vw_bom_reemplazo_equipo WHERE idreporte=$idreporte AND idregistro_solucion=$solucion");
		return $query->result_array();
	}
	
	public function guardar_documento($id,$nombre,$registra,$idregistra)
	{
		$query=$this->db->query("EXEC sp_bom_inserta_reporte_doc '$id','$nombre','$registra','$idregistra'");
		return $query->result_array();
	}
	
	public function emitir_reporte($id,$usuario)
	{
		$query=$this->db->query("EXEC sp_bom_emitir_reporte '$id','$usuario'");
		return $query->result_array();
	}
	
}