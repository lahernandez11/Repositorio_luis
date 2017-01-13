<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registro_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
    
	
    public function agrega_registro_reporte($plaza,$area,$carril,$reporta,$puesto,$tipo,$fecha,$hora,$falla,$observaciones,$clasificacion,$registra)
	{
		$query = $this->db->query("EXEC sp_bom_alta_reporte '$tipo','$falla','$clasificacion','$registra','$plaza','$observaciones','1','$carril','$area','$fecha','$hora','$puesto','$reporta'");
		return $query->result_array();
	}
	
	public function pdf_registro($id)
	{
		$query = $this->db->query("EXEC sp_bom_info_registro '$id'");
		return $query->result();
	}
	
}