<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resumen_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function detalle_resumen()
	{
		$query=$this->db->query("SELECT SUM(tecnico) as tecnico,SUM(diag) as diag,SUM(solucion) as solucion,SUM(emitir) as emitir,SUM(cerrar) as cerrar,
		 sum(tecnico+diag+solucion+cerrar)as total,idplaza,nombre_plaza,clave
	     FROM [dbo].[vw_bom_resumen] GROUP BY idplaza,nombre_plaza,clave ORDER BY clave,nombre_plaza");
		return $query->result_array();
	}
}

?>