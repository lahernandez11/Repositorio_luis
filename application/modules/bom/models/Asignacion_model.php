<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Asignacion_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_reporte($id)
	{
		$query = $this->db->query("EXEC sp_bom_info_registro '$id'");
		return $query->result_array();
	}
	
	public function asigna_tecnico($idreporte,$tecnico,$registra,$fecha,$hora)
	{
		$query = $this->db->query("EXEC sp_bom_inserta_asignacion_tecnico '$idreporte','$tecnico','$registra','$fecha','$hora'");
		return $query->result_array();
	}
	
}