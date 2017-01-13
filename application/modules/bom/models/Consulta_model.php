<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class consulta_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function consulta_mp($usuario)
	{
		$query = $this->db->query("SELECT * FROM vw_bom_consulta_mp WHERE idplaza in (SELECT idplaza from [dbo].[vw_grl_usuario_plaza] WHERE idusuario=".$usuario.")
		ORDER BY prioridad DESC, horas DESC, minutos DESC");
		return $query->result_array();
	}
	
	public function select_estatus($idr,$tr,$estado)
	{
		$query = $this->db->query("EXEC sp_bom_detalle_estado '$idr','$tr','$estado'");
		return $query->result_array();
	}
	
	public function consulta_info($idr)
	{
		$query=$this->db->query("SELECT idestado FROM bom_reporte WHERE idreporte=$idr");
		return $query->result_array();
	}
	
}