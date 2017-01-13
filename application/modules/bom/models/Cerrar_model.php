<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cerrar_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function cerrar_reporte($idreporte,$registra,$observaciones,$equipos,$fechas)
	{
		$query=$this->db->query("EXEC sp_bom_cerrar_reporte '$idreporte','$registra','$observaciones','$equipos','$fechas'");
		return $query->result_array();
	}
	
	public function desplegar_remplazos($idreporte,$idregistro_solucion)
	{
		$query=$this->db->query("SELECT * FROM vw_bom_reparar_equipo WHERE idreporte=".$idreporte." and idregistro_solucion=".$idregistro_solucion.";
");
		return $query->result_array();
	}
}