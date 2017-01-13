<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Area_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_areas_activas()
	{
		$query = $this->db->query("SELECT * FROM vw_bom_areafectacion WHERE idestado=1 ORDER BY nombre_area ASC");
		return $query->result();
	}
	
	public function desplega_area($id)
	{
		$query = $this->db->query("SELECT * FROM vw_bom_areafectacion WHERE idareaafectacion=".$id."");
		return $query->result();
	}
	
	public function agrega_area($area)
	{
		$query = $this->db->query("EXEC sp_bom_agregar_areafectacion '$area'");
		return $query->result_array();
	}
	
	public function modifica_area($id,$area)
	{
		$query = $this->db->query("EXEC sp_bom_modifica_areafectacion '$id','$area'");
		return $query->result_array();
	}
	
	public function agrega_falla($idarea,$falla,$idclasificacion)
	{
		$query = $this->db->query("EXEC sp_bom_agregar_tipofalla '$falla','$idarea','$idclasificacion'");
		return $query->result_array();
	}
	
	public function modifica_falla($id,$falla,$idclasificacion)
	{
		$query = $this->db->query("EXEC sp_bom_modifica_tipofalla '$falla','$id','$idclasificacion'");
		return $query->result_array();
	}
	
	public function desplega_areas()
	{
		$query = $this->db->query("SELECT * FROM [dbo].[vw_bom_areafectacion] ORDER BY nombre_area ASC");
        return $query->result();
	}
	
	public function desplega_fallas_area($area)
    {
		$query = $this->db->query("SELECT * FROM [dbo].[vw_bom_tipofalla] WHERE idareaafectacion=".$area." ORDER BY nombre_tipofalla ASC;");
        return $query->result();
    }
	
	public function desplega_clasificaciones()
    {
		$query = $this->db->query("SELECT * FROM [dbo].[vw_bom_clasificacion] ORDER BY prioridad ASC;");
        return $query->result_array();
    }
	
	public function desplega_clasificaciones_falla($falla)
    {
		$query = $this->db->query("SELECT idclasificacion,fondo FROM [dbo].[vw_bom_tipofalla] WHERE idtipofalla='".$falla."'");
        return $query->result_array();
    }
    
	
}
/*
*end modules/login/models/index_model.php
*/