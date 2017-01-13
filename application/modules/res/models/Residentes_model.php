<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Residentes_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function total_pendicentes()
	{
		$query = $this->db->query("SELECT COUNT(idresidente)residente FROM vw_res_residente WHERE nombre=NULL AND apaterno=NULL AND idmunicipio=NULL AND idlocalidad=NULL");
		return $query->result();
	} 
	
	public function desplega_pendientes($busca)
	{
		$query = $this->db->query("SELECT * FROM vw_res_residente WHERE no_ife LIKE '%$busca%'");
		return $query->result();
	} 
	
	public function desplega_residentes()
	{
		$query = $this->db->query("SELECT TOP 100 * FROM vw_res_residente WHERE nombre <> '' AND apaterno <> '' AND amaterno <> '' AND idmunicipio <> '' AND idlocalidad <> '' ORDER BY nombre_municipio");
		return $query->result();
	} 
	
	public function busca_residentes($busca)
	{
		$query = $this->db->query("SELECT * FROM vw_res_residente WHERE nombre LIKE '%$busca%' OR apaterno LIKE '%$busca%' OR amaterno LIKE '%$busca%' OR apellido LIKE '%$busca%' ORDER BY nombre_municipio");
		return $query->result();
	} 
	
	public function desplega_municipio()
	{
		$query=$this->db->query("SELECT * FROM vw_res_municipio WHERE idestado=1 ORDER BY nombre_municipio");
		return $query->result();
	}
	
	public function desplega_localidad($municipio)
	{
		$query=$this->db->query("SELECT * FROM vw_res_localidad WHERE idestado=1 AND idmunicipio=$municipio ORDER BY nombre_localidad");
		return $query->result();
	}
	
	public function cambia($id,$input1,$input2,$input3,$input4,$select1,$select2)
	{
		$query=$this->db->query("EXEC sp_res_modifica_pendientes '$id','$input1','$input2','$input3','$input4','$select1','$select2'");
		return $query->result_array();
	}
	
	public function cambia_imagen($id,$input1,$input2,$input3,$input4,$select1,$select2,$imagen_f,$imagen_a)
	{
		$query=$this->db->query("EXEC sp_res_modifica_pendientes_imagen '$id','$input1','$input2','$input3','$input4','$select1','$select2','$imagen_f','$imagen_a'");
		return $query->result_array();
	}
	
	public function estado($id,$estado)
	{
		$data = array(
               'idestado' => $estado
            );

		$this->db->where('idresidente', $id);
		$this->db->update('res_residente', $data);
		return $this->db->affected_rows();
	}
	
	public function agrega($input1,$input2,$input3,$input4,$select1,$select2,$imagen_f,$imagen_a)
	{
		$query=$this->db->query("EXEC sp_res_agregar_residente '$input1','$input2','$input3','$input4','$select1','$select2','$imagen_f','$imagen_a'");
		return $query->result_array();
	}
	
}
/*
*end modules/login/models/index_model.php
*/