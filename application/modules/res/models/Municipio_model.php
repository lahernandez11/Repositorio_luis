<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Municipio_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_municipios()
	{
		$query = $this->db->query("SELECT * FROM vw_res_municipio WHERE idestado=1 ORDER BY nombre_municipio ASC");
		return $query->result();
	}
	
	public function desplega_municipio($municipio)
	{
		$query = $this->db->query("SELECT * FROM vw_res_municipio WHERE idmunicipio=$municipio");
		return $query->result();
	}
	
	public function agrega_municipio($municipio)
	{
		$query = $this->db->query("EXEC sp_res_agregar_municipio '$municipio'");
		return $query->result_array();
	}
	
	public function modifica_municipio($id,$municipio)
	{
		$query = $this->db->query("EXEC sp_res_modifica_municipio '$id','$municipio'");
		return $query->result_array();
	}
	
	public function desplega_localidades_municipio($municipio)
    {
		$query = $this->db->query("SELECT * FROM vw_res_localidad WHERE idmunicipio=".$municipio." ORDER BY nombre_localidad ASC;");
        return $query->result();
    }
	
	public function agrega_localidad($idmunicipio,$localidad)
	{
		$query = $this->db->query("EXEC sp_res_agregar_localidad '$localidad','$idmunicipio'");
		return $query->result_array();
	}
	
	public function modifica_localidad($idlocalidad,$localidad)
	{
		$query = $this->db->query("EXEC sp_res_modifica_localidad '$localidad','$idlocalidad'");
		return $query->result_array();
	}
}