<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registro_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function inserta_texto($texto,$iduser)
	{
		$query=$this->db->query("EXEC sp_baw_agregar_texto '$texto','$iduser'");
		return $query->result_array();
		
	}
	
	public function muestra_texto($id)
	{
		$query=$this->db->query("SELECT * FROM vw_baw_muestra_texto WHERE idtexto=".$id);
		return $query->result_array();
	}
	
}