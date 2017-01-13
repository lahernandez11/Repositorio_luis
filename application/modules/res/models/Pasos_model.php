<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pasos_model extends CI_Model
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
	
	public function nombre_carril($idcarril,$idusuario)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_carril WHERE idcarril=$idcarril AND idusuario=$idusuario");
		return $query->result_array();
	}  
	
	public function desplega_vehiculo($idplaza)
	{
		$query = $this->db->query("SELECT * FROM vw_grl_tipo_vehiculo_plaza WHERE idplaza=$idplaza ORDER BY tipo_vehiculo");
		return $query->result_array();
	} 
	
	public function guarda_registro($placas,$ife,$vehiculo,$iduser,$ip,$turno,$fecha,$hora,$idcarril,$idplaza,$comercial)
	{
		$query = $this->db->query("EXEC sp_res_inserta_paso '$placas','$ife','$vehiculo','$iduser','$ip','$turno','$fecha','$hora','$idcarril','$idplaza','$comercial'");
		return $query->result_array();
	}  
	
}
/*
*end modules/login/models/index_model.php
*/