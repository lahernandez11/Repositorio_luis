<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tarifa_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();   
    } 
	
    public function desplega($id)
    {
		$query = $this->db->query("SELECT * FROM vw_cai_tarifa WHERE idplaza in (SELECT idplaza
									  FROM vw_grl_usuario_plaza
									  WHERE idusuario=".$id.")");
        return $query->result();
    }
	
	public function desplega_detalle($id)
    {
		$query = $this->db->query("SELECT * FROM vw_cai_tarifa_detalle
									  WHERE idtarifa=".$id);
        return $query->result();
    }
	
	public function agrega($fecha,$moneda,$idplaza,$registra,$Vehiculos,$Tarifas)
	{
		$query = $this->db->query("EXEC sp_cai_agregar_tarifa '$fecha','$moneda','$idplaza','$registra','$Vehiculos','$Tarifas'");
		return $query->result_array();
	}
	
}
/*
*end modules/login/models/index_model.php
*/