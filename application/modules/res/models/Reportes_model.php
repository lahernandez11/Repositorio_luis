<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reportes_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    }
	
	public function desplega_carril($idusuario)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_carril WHERE idusuario=$idusuario AND idestado=1 ORDER BY nombre_plaza,nombre_carril ASC");
		return $query->result();
	} 
	
	public function desplega_reporte_todos($fecha)
	{
		$query = $this->db->query("SELECT * FROM vw_res_reporte WHERE fecha='$fecha' ORDER BY hora");
		return $query->result_array();
	}
	
	public function desplega_reporte($fecha,$turno,$carril)
	{
		$query = $this->db->query("SELECT * FROM vw_res_reporte WHERE fecha='$fecha' AND turno ='$turno' AND idcarril='$carril' ORDER BY hora");
		return $query->result_array();
	}
	
	public function desplega_reporte_t($fecha,$turno,$carril,$dia)
	{
		$query = $this->db->query("SELECT * FROM vw_res_reporte WHERE (fecha='$fecha' OR fecha='$dia' ) AND turno ='$turno' AND idcarril='$carril' ORDER BY hora");
		return $query->result_array();
	}
	
	public function desplega_reporte_turno($fecha,$carril)
	{
		$query = $this ->db->query("SELECT * FROM vw_res_reporte WHERE fecha='$fecha' AND idcarril='$carril' ORDER BY hora");
		return $query->result_array();
	}
	
	public function desplega_reporte_carril($fecha,$turno)
	{
		$query = $this->db->query("SELECT * FROM vw_res_reporte WHERE fecha='$fecha' AND turno='$turno' ORDER BY hora");
		return $query->result_array();
	}
	
	public function totales_vehiculo_todos($fecha)
	{
		$query = $this->db->query("SELECT * FROM vw_res_reporte_tipo_vehiculo WHERE fecha='$fecha' ORDER BY turno,tipo_vehiculo,nombre_carril ASC");
		return $query->result_array();
	}
	
	public function totales_vehiculo_turno($fecha,$carril)
	{
		$query = $this ->db->query("SELECT * FROM vw_res_reporte_tipo_vehiculo WHERE fecha='$fecha' AND idcarril='$carril' ORDER BY turno,tipo_vehiculo,nombre_carril ASC");
		return $query->result_array();
	}
	
	public function totales_vehiculo_carril($fecha,$turno)
	{
		$query = $this->db->query("SELECT * FROM vw_res_reporte_tipo_vehiculo WHERE fecha='$fecha' AND turno='$turno' ORDER BY turno,tipo_vehiculo,nombre_carril ASC");
		return $query->result_array();
	}
	
	public function totales_vehiculo_reporte_t($fecha,$turno,$carril,$dia)
	{
		$query = $this->db->query("SELECT * FROM vw_res_reporte_tipo_vehiculo WHERE (fecha='$fecha' OR fecha='$dia' ) AND turno ='$turno' AND idcarril='$carril' ORDER BY turno,tipo_vehiculo,nombre_carril ASC");
		return $query->result_array();
	}
	
	public function totales_vehiculo($fecha,$turno,$carril)
	{
		$query = $this->db->query("SELECT * FROM vw_res_reporte_tipo_vehiculo WHERE fecha='$fecha' AND turno ='$turno' AND idcarril='$carril' ORDER BY turno,tipo_vehiculo,nombre_carril ASC");
		return $query->result_array();
	}
}
/*
*end modules/login/models/index_model.php
*/